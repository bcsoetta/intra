<?php

function sessiony() {
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	if (isset($_SESSION['sstat']) && !empty($_SESSION['sstat'])) {
	    header('Location: /service/home');
	} 
}

function sessionx() {
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if (isset($_SESSION['sstat']) && !empty($_SESSION['sstat'])) {

	}
}