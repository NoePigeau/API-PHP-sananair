<?php

require_once __DIR__ . '/../dao/session.php';
require_once __DIR__ . '/../dao/user.php';

function ensureHttpMethod(string $method): void {
    if($_SERVER['REQUEST_METHOD'] !== $method) {
        http_response_code(405);
        die();
    }
}

function ensureUserConnected(): array {
    $headers = getallheaders();
    if(isset($headers["Authorization"])) {
        $auth = $headers["Authorization"];
        $array = explode(" ", $auth);
        if(count($array) === 2 && $array[0] === "Bearer") {
            $token = $array[1];
            $session = sessionWithToken($token);
            if($session) {
                $user = getUserById($session["idUser"]);
                if($user) {
                    return $user;
                }
            }
        }
    }
    http_response_code(401);
    die();
}