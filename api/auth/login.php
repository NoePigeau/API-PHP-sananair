<?php

require_once __DIR__ . '/../../dao/user.php';
require_once __DIR__ . '/../../dao/session.php';
require_once __DIR__ . '/../../utils/server.php';

ensureHttpMethod('POST');

$content = file_get_contents('php://input');
$_POST = json_decode($content, true);

if(isset($_POST['login']) && isset($_POST['password'])) {
   $user = userUsingCredentials($_POST["login"], $_POST["password"]);
   if($user) {
        $token = sessionInsert($user["id"]);
        header("Content-Type: application/json");
        echo json_encode([
            "token" => $token
        ]);
   } else {
       http_response_code(404); // NOT_FOUND
   }
} else {
    http_response_code(400); // BAD_REQUEST
}