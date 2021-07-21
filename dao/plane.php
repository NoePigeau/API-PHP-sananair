<?php

require_once __DIR__ . '/../utils/database.php';

function insertPlane(string $model, int $capacity): ?string {
    $connection = getDatabaseConnection();
    $sql = "INSERT INTO Plane (model, capacity) VALUES (?, ?)";
    $params = [$model, $capacity];
    return databaseInsert($connection, $sql, $params);
}

function getPlaneById(string $id): ?array {
    $connection = getDatabaseConnection();
    $sql = "SELECT id, model, capacity FROM Plane WHERE id = ?";
    $params = [$id];
    return databaseFindOne($connection, $sql, $params);
}

function searchPlanes(?string $model, ?int $capacity, int $limit, int $offset): ?array {
    $connection = getDatabaseConnection();
    $where = [];
    $params = [];
    if($model !== null) {
        array_push($where, 'model LIKE ?');
        $params[] = "%". $model . "%"; // eq array_push
    }
    if($capacity !== null) {
        $where[] = 'capacity > ?';
        $params[] = $capacity;
    }
    $sql = "SELECT id, model, capacity FROM Plane";
    if(count($where) > 0) {
        $whereClause = join(" AND ", $where);
        $sql .= " WHERE " . $whereClause;
    }
    $sql .= " LIMIT $offset, $limit";
    return databaseFindAll($connection, $sql, $params);
}

function deletePlane(string $id): ?bool {
    $connection = getDatabaseConnection();
    $sql = "DELETE FROM Plane WHERE id = ?";
    $params = [$id];
    $affectedRows = databaseExec($connection, $sql, $params);
    if($affectedRows !== null) {
        return $affectedRows === 1;
    }
    return null;
}

function updatePlane(string $id, ?string $model, ?int $capacity): ?bool {
    $connection = getDatabaseConnection();
    $set = [];
    $params = [];
    if($model !== null) {
        array_push($set, 'model = ?');
        $params[] = $model;
    }
    if($capacity !== null) {
        $set[] = 'capacity = ?';
        $params[] = $capacity;
    }
    $setClause = join(", ", $set);
    $sql = "UPDATE Plane SET " . $setClause . " WHERE id = ?";
    $params[] = $id;
    $affectedRows = databaseExec($connection, $sql, $params);
    if($affectedRows !== null) {
        return $affectedRows === 1;
    }
    return null;
}