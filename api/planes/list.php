<?php

// include -> inclure un fichier mais pas obligatoire
// require -> inclure un fichier si inexistant crash
// include_once -> eq include sauf qu'une seule fois
// require_once -> eq require sauf qu'une seule fois
// __DIR__ -> retourne le chemin du fichier courant

require_once __DIR__ . '/../../dao/plane.php';
require_once __DIR__ . '/../../utils/server.php';

ensureHttpMethod('GET');

$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 20;
$model = isset($_GET['model']) ? $_GET['model'] : null;
$capacity = isset($_GET['capacity']) ? intval($_GET['capacity']) : null;

$planes = searchPlanes($model, $capacity, $limit, $offset);
if($planes !== null) {
    $json = json_encode($planes);
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    echo $json;
} else {
    http_response_code(500);
}