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
	$data = [];
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
