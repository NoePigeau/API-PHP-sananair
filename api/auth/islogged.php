<?php

require_once __DIR__ . '/../../utils/server.php';

header("Content-Type: application/json");

$user = ensureUserConnected();

echo json_encode($user);