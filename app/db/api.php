<?php

require_once '../libs/sso/Broker.php';
include_once '../libs/sso/Exception.php';
include_once '../libs/sso/NotAttachedException.php';
include_once '../config.php';


$broker = new Jasny\SSO\Broker(SSO_SERVER, SSO_BROKER_ID, SSO_BROKER_SECRET);

if (empty($_REQUEST['command']) || !method_exists($broker, $_REQUEST['command'])) {
    header("Content-Type: application/json");
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(['error' => 'Command not specified']);
    return;
}

try {
    $result = $broker->{$_REQUEST['command']}();
} catch (Exception $e) {
    $status = $e->getCode() ?: 500;
    $result = ['error' => $e->getMessage()];
}

// JSONP
if (!empty($_GET['callback'])) {
    if (!isset($result)) $result = null;
    if (!isset($status)) $status = isset($result) ? 200 : 204;

    header('Content-Type: application/javascript');
    echo $_GET['callback'] . '(' . json_encode($result) . ', ' . $status . ')';
    return;
}

// REST
if (!$result) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    session_destroy();
    http_response_code(204);
} else {
    http_response_code(isset($status) ? $status : 200);
    header("Content-Type: application/json");
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if ($result['group'] === 'beacukai') {
        if (in_array('', $result)) {
            $result['apps_data'] = null;
        }
        $_SESSION['sdata'] = $result;
        $_SESSION['sstat'] = true;
        echo json_encode($result);
    } else {
        session_destroy();
    }
}
