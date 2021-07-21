<?php

require_once __DIR__ . '/../utils/database.php';

/**
 * @param string $userId
 * @return string|null Le token de la session
 */
function sessionInsert(string $userId): ?string {
    $connection = getDatabaseConnection();
    $sql = "INSERT INTO Session (token, idUser, expirationDate) VALUES (?, ?, ?)";

    $dt = new DateTime();
    $dt->add(new DateInterval("P15D"));
    $expirationDate = $dt->format("Y-m-d");

    $tokenBytes = random_bytes(32);
    $token = bin2hex($tokenBytes);

    $params = [
        $token,
        $userId,
        $expirationDate
    ];
    databaseInsert($connection, $sql, $params);
    return $token;
}

function sessionWithToken(string $token): ?array {
    $connection = getDatabaseConnection();
    $sql = "SELECT token, idUser, expirationDate FROM Session WHERE token = ? AND expirationDate > NOW()";
    $params = [
        $token
    ];
    return databaseFindOne($connection, $sql, $params);
}