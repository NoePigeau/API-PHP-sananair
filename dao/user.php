<?php

require_once __DIR__ . '/../utils/database.php';

function insertUser(string $login, string $password): ?string {
    $connection = getDatabaseConnection();
    $sql = "INSERT INTO User (login, password) VALUES (?, ?)";
    $params = [$login, hash('sha512', $password)]; // 128 length
    return databaseInsert($connection, $sql, $params);
}

function loginExists(string $login): ?string {
    $connection = getDatabaseConnection();
    $sql = "SELECT id FROM User WHERE login = ?";
    $params = [$login];
    $res = databaseFindOne($connection, $sql, $params);
    return $res ? $res["id"] : null;
}

function getUserById(string $id): ?array {
    $connection = getDatabaseConnection();
    $sql = "SELECT id, login FROM User WHERE id = ?";
    $params = [$id];
    return databaseFindOne($connection, $sql, $params);
}

function userUsingCredentials(string $login, string $pwd): ?array {
    $connection = getDatabaseConnection();
    $sql = "SELECT id, login FROM User WHERE login = ? AND password = ?";
    $params = [
        $login,
        hash('sha512', $pwd)
    ];
    return databaseFindOne($connection, $sql, $params);
}