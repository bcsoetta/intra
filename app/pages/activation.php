<?php

$code = "";

if (isset($_SERVER['REQUEST_URI'])) {
	$uri1 = $_SERVER['REQUEST_URI'];
	$uri2 = explode("/", $uri1);
	if (isset($uri2[2])) {
		$uri3 = explode("=", $uri2[2]);
		if ($uri3[0] == "activation?code") {
			if (isset($uri3[1])) {
				$code = $uri3[1];
			}
		}
	}
}

?>

<div id="actinfo">Activating, please wait..</div>
