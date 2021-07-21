<?php

require_once __DIR__ . '/../../dao/plane.php';
require_once __DIR__ . '/../../utils/server.php';

ensureHttpMethod('POST');

$content = file_get_contents('php://input');
$_POST = json_decode($content, true);

if(isset($_POST['model']) && isset($_POST['capacity'])) {
    $lastId = insertPlane($_POST['model'], $_POST['capacity']);
    if($lastId) {
       $plane = getPlaneById($lastId);
       if($plane) {
           header('Access-Control-Allow-Origin: *');
           http_response_code(201);
           header('Content-Type: application/json');
           echo json_encode($plane);
        } else {
            http_response_code(500);
        }
    } else {
        http_response_code(500);
    }
} else {
    http_response_code(400); // BAD_REQUEST
}