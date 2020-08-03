<?php

// error_reporting(0);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Asia/Jakarta timezone setting
date_default_timezone_set('Asia/Jakarta');

// $root = "http://".$_SERVER['HTTP_HOST'];
// $root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
// baseurl
define('baseurl', 'http://intra.bcsoetta.du/');
// pathurl
define('pathurl', $_SERVER['DOCUMENT_ROOT']);


// Database
define('host', 'localhost');
define('username', 'root');
define('password', '');
define('dbname', 'db_sso');
define('port', '');
define('socket', '');

// SSO Server
define('SSO_SERVER', 'https://ssoserv.bcsoetta.org/');
define('SSO_BROKER_ID', '7');
define('SSO_BROKER_SECRET', 'q9Qk3e8PL4');

// Email
define('MAIL_HOST', 'ssl://mail.bcsoetta.org');
define('MAIL_USERNAME', 'admin@bcsoetta.org');
define('MAIL_PASSWORD', 'kpu8c503tt4');
define('MAIL_SECURE', 'PHPMailer::ENCRYPTION_STARTTLS'); // ENCRYPTION_SMTPS / ENCRYPTION_STARTTLS
define('MAIL_PORT', 465); // 465 // 587
