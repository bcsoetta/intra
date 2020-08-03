<?php

include(pathurl."/app/libs/sso/Broker.php");
include(pathurl."/app/libs/sso/Exception.php");
include(pathurl."/app/libs/sso/NotAttachedException.php");

$broker = new Jasny\SSO\Broker(SSO_SERVER, SSO_BROKER_ID, SSO_BROKER_SECRET);

try {
    $result = $broker->logout();
} catch (Exception $e) {
    $status = $e->getCode() ?: 500;
    $result = ['error' => $e->getMessage()];
}

if (!$result) {
    http_response_code(204);
} else {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();
    session_destroy();
    session_write_close();
    header('Location: /');
}

?>


