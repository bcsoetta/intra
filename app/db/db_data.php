<?php

require_once '../../app/config.php';
require_once '../../vendor/autoload.php';
require_once 'db_connect.php';
require_once pathurl.'/app/libs/functions.php';
include_once '../config.php';

use Respect\Validation\Validator as v;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['action'])) {
    $dt = array('dt' => $_POST);
	$data = [];
    if ($_POST['action'] == 'daftar') {
	    $vForm = v::key(
	    	'dt',
	    	v::key('name', v::notEmpty()->stringType()->alnum(' ', '.', ','))
	    	->key('username', v::notEmpty()->noWhitespace()->stringType()->alnum())
	    	->key('password', v::notEmpty()->noWhitespace()->identical($_POST['confirmPassword']))
	    	->key('email', v::notEmpty()->noWhitespace()->email())
	    )->validate($dt);

	    $name = $_POST['name'];
	    $username = $_POST['username'] . ".bcsoetta.org";
	    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	    $confirmPassword = $_POST['confirmPassword'];
	    $email = $_POST['email'];

	    $acticode = sha1(mt_rand(10000,99999).time().$email);
		$expired = date('Y-m-d', strtotime('+3 days'));
		$expiredx = date('d/m/Y', strtotime('+3 days'));

	    if (isset($_POST['terms'])) {
	    	$terms = $_POST['terms'];
	    }

	    if (!$vForm) {
	    	$data['info'] = 'Terdapat isian data yang tidak valid';
	    	echo json_encode($data);
	    	die();
	    } else {
	    	$u = mysqli_query($con, "SELECT * FROM auth WHERE username = '$username'");
	    	if (mysqli_num_rows($u) > 0) {
	    		$data['info'] = 'Username sudah digunakan, gunakan username lainnya.';
	    		echo json_encode($data);
	    		die();
	    	}
	    	$u = mysqli_query($con, "SELECT * FROM customer WHERE email = '$email'");
	    	if (mysqli_num_rows($u) > 0) {
	    		$data['info'] = 'Email sudah digunakan, gunakan email lainnya.';
	    		echo json_encode($data);
	    		die();
	    	}
            $au = mysqli_query($con, "INSERT INTO auth (`username`, `password`, `group`) VALUES ('$username', '$password', 'customer')");
            if (mysqli_affected_rows($con) > 0) {
                $uid = mysqli_query($con, "SELECT user_id FROM auth WHERE username = '$username'");
                list($user_id) = mysqli_fetch_array($uid);
                $ak = mysqli_query($con, "INSERT INTO aktivasi (user_id, code, expired) VALUES ('$user_id', '$acticode', '$expired')");
                if (mysqli_affected_rows($con) > 0) {
                    $cu = mysqli_query($con, "INSERT INTO customer (user_id, nama, email) VALUES ('$user_id', '$name', '$email')");
                    if (mysqli_affected_rows($con) > 0) {
                        $mail = new PHPMailer(true);
    					try {
    						//Server settings
    					    $mail->SMTPDebug = false;
    					    $mail->isSMTP();
    					    $mail->Host       = MAIL_HOST;
    					    $mail->SMTPAuth   = true;
    					    $mail->Username   = MAIL_USERNAME;
    					    $mail->Password   = MAIL_PASSWORD;
    					    $mail->SMTPSecure = MAIL_SECURE;
    					    $mail->Port       = MAIL_PORT;

    					    //Recipients
    					    $mail->setFrom(MAIL_USERNAME, 'bcsoetta.org');
    					    $mail->addReplyTo(MAIL_USERNAME, 'Info');

    					    // Notification
    					    $mail->addAddress(MAIL_USERNAME, 'Akun baru bcsoetta.org');

    					    $mail->isHTML(true);
    					    $mail->Subject = 'Akun baru bcsoetta.org';
    					    $mail->Body    = 'Username: ' . $username . "<br>Email: " . $email;
    					    $mail->send();

    					    $mail->ClearAddresses();

    					    // Activation link to client
    					    $mail->addAddress($email);
    					    // Content
    					    $mail->isHTML(true);
    					    $mail->Subject = 'Link aktivasi bcsoetta.org';
    					    $mail->Body    = 'Akun:<br>Username: '.$username.'<br>Password: '.$_POST['password'].'<br><br>Silahkan klik link aktivasi di bawah untuk mengaktifkan akun Anda.<br>' . baseurl . 'user/activation?code=' . $acticode . "<br>" . "Kode aktivasi akan expired pada " . $expiredx . ".";
    					    $mail->send();

    					    $data['info'] = 'Terima kasih. Pendaftaran berhasil dilakukan.<br>Silahkan klik link aktivasi yang kami kirim ke email Anda.';
    	    				echo json_encode($data);
    					} catch(Exception $e) {

    					}
                    } else {
                        // echo json_encode('g3');
                    }
                } else {
                    // echo json_encode('g2');
                }
            } else {
                // echo json_encode('g1');
            }
	    }
	}

    if ($_POST['action'] == 'activation') {
		$code = $_POST['code'];
		$expired = date('Y-m-d');
		$status = [];

        $ak = mysqli_query($con, "UPDATE aktivasi SET `status` = 'aktif' WHERE code = '$code' AND expired >= '$expired' AND `status` = 'tidak aktif'");
        if (mysqli_affected_rows($con) > 0) {
            $cc = mysqli_query($con, "SELECT user_id FROM aktivasi WHERE code = '$code'");
            list($user_id) = mysqli_fetch_array($cc);
            $au = mysqli_query($con, "UPDATE auth SET `status` = 'enabled' WHERE user_id = '$user_id'");
            if (mysqli_affected_rows($con) > 0) {
    			$status['status'] = 'Activated';
    		} else {
    			$x = mysqli_query($con, "SELECT `status`, expired FROM aktivasi WHERE code = '$code'");
    				if (mysqli_num_rows($x) > 0) {
    				while ($d = mysqli_fetch_array($x)) {
    					if ($d['status'] == 'enabled') {
    						$status['status'] = 'Account is already activated';
    					}
    					if ($d['expired'] <= $expired) {
    						$status['status'] = 'Code activation is expired';
    					}
    				}
    			} else {
    				$status['status'] = 'Code activation failed!';
    			}
    		}
        } else {
            $status['status'] = 'Activation failed!';
        }
		echo json_encode($status);
	}

    if ($_POST['action'] == 'login') {
        $data = [];
        $password = $_POST['password'];
        $username = $_POST['username'];
        try {
            $sso = new Sso();
            $u = $sso->login($username, $password);
            $_SESSION['email'] = $u['email'];
            $_SESSION['user_id'] = $u['user_id'];
            $_SESSION['username'] = $u['username'];
            $_SESSION['name'] = $u['name'];
            $_SESSION['group'] = $u['group'];
            $data['info'] = "Berhasil login";
        } catch (\Exception $e) {
            $data['info'] = $e->getMessage();
        }
        echo json_encode($data);
    }

    if ($_POST['action'] == 'uprofil') {
        // $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $action = $_POST['action'];

        // hidden
		$user_id = $_POST['user_id'];
		
		$data = [];

		// username
		// if (v::stringType()->notEmpty()->alnum('.')->validate($username)) {
		// 	$q = mysqli_query($con, "UPDATE auth SET username = '$username' WHERE user_id = '$user_id'");
		// 	if (mysqli_affected_rows($con) > 0) {
		// 		if (session_status() == PHP_SESSION_NONE) {
		// 		    session_start();
		// 		}
  		//      $_SESSION['username'] = $username;
		// 		$data['usernamei'] = 'Username berhasil diupdate';
		// 	} else {
		// 		$data['usernamei'] = 'Username tidak diupdate';
		// 	}
		// }
        
        // password
		if (v::notEmpty()->validate($password)) {
			if (v::identical($password)->validate($confirmPassword)) {
				$passx = password_hash($password, PASSWORD_DEFAULT);
				$q = mysqli_query($con, "UPDATE auth SET password = '$passx' WHERE user_id = '$user_id'");
				if (mysqli_affected_rows($con) > 0) {
					$data['passwordi'] = 'Password berhasil diupdate';
				} else {
					$data['passwordi'] = 'Password gagal diupdate';
				}
			}
		}

		// echo $data;

		echo json_encode($data);
	}
}
