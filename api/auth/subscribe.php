<?php

require_once __DIR__ . '/../../dao/user.php';
require_once __DIR__ . '/../../utils/server.php';

ensureHttpMethod('POST');

$content = file_get_contents('php://input');
$_POST = json_decode($content, true);

if(isset($_POST['login']) && isset($_POST['password'])) {
    $existingId = loginExists($_POST['login']);
    if($existingId === null) {
        $lastId = insertUser($_POST['login'], $_POST['password']);
        if($lastId) {
            $user = getUserById($lastId);
            header("Content-Type: application/json");
            http_response_code(201); // CREATED
            echo json_encode($user);
        } else {
            http_response_code(500);
        }
    } else {
        http_response_code(409);
    }
} else {
    http_response_code(400); // BAD_REQUEST
}