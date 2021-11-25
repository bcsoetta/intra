<?php

	require_once 'vendor/autoload.php';
	require_once 'app/config.php';
	require_once 'app/libs/session.php';

	if (file_exists("app/templates/header.php")) {
		include "app/templates/header.php";
	}

	$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	if (isset($_GET['dt'])) {
		switch ($_GET['dt']) {
			case 'activation':
				break;
			case 'login':
				// sessiony();

				$query = parse_url($url, PHP_URL_QUERY);
				parse_str($query, $arr_query);
				if (array_key_exists('appid', $arr_query)) {
					$appid =  $arr_query['appid'];
				} else {
					$appid =  null;
				}
				
				break;
			case 'daftar':
				// sessiony();
				break;
			default:
				$dt = $_GET['dt'];
				if (file_exists("app/pages/" . $dt . ".php")) {
					if (isset($_SESSION['sstat']) && !empty($_SESSION['sstat'])) {
						if (file_exists("app/templates/menu.php")) {
							include "app/templates/menu.php";
						}
					} 
				} else {
					include "app/pages/error.php";
				}
				break;
		} ?>
		<!-- pages file loaded here -->
		<div id="app-content">
			<?php
				if (isset($_GET['dt'])) {
					$dt = $_GET['dt'];
					if (file_exists("app/pages/" . $dt . ".php")) {
						include "app/pages/" . $dt . ".php";
					}
				}
			?>
		</div>
	<?php } else {
		// sessiony();
		if (file_exists("app/templates/front.php")) {
			include "app/templates/front.php";
		}
	}
?>

<?php
	if (file_exists("app/templates/footer.php")) {
		include "app/templates/footer.php";
	}
	if (file_exists("app/templates/js.php")) {
		include "app/templates/js.php";
	}
	if (isset($_GET['dt'])) {
		$dt = $_GET['dt'];
		if (file_exists("app/pages/" . $dt . "_js.php")) {
			include "app/pages/" . $dt . "_js.php";
		}
	}
	if (file_exists("app/templates/ssojs.php")) {
		include "app/templates/ssojs.php";
	}
?>

