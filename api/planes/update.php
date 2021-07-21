<?php

require_once __DIR__ . '/../../dao/plane.php';
require_once __DIR__ . '/../../utils/server.php';

ensureHttpMethod('PUT');

$content = file_get_contents('php://input');
$_POST = json_decode($content, true);

$model = isset($_POST['model']) ? $_POST['model'] : null;
$capacity = isset($_POST['capacity']) ? intval($_POST['capacity']) : null;

if(isset($_POST["id"]) && ($model || $capacity)) {
    $success = updatePlane($_POST["id"], $model, $capacity);
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