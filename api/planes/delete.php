<?php

require_once __DIR__ . '/../../dao/plane.php';
require_once __DIR__ . '/../../utils/server.php';

ensureHttpMethod('DELETE');

if(isset($_GET["id"])) {

    $success = deletePlane($_GET["id"]);
    if($success !== null) {
        if($success) {
            http_response_code(204);
            header("Content-Length: 0");
        } else {
            http_response_code(404);
        }
    } else {
        http_response_code(500);
    }
} else {
    http_response_code(400);
}