<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Intra - BCSOETTA</title>
		<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
		<?php
		if (isset($_GET['dt'])) {
			$dt = $_GET['dt'];
			if (file_exists("app/pages/" . $dt . "_css.php")) {
				include "app/pages/" . $dt . "_css.php";
			}
		}
		?>
	</head>
	<body>
		<div id="contentx">
			<?php if (isset($_SESSION['sstat']) && $_SESSION['sstat']) { $homeurl = baseurl . 'service/home';
			} else {$homeurl = baseurl; } ?>
			<h1><a id="wtitle" href="<?php echo $homeurl; ?>">Intra.</a></h1>
