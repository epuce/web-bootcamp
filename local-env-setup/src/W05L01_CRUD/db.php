<?php

// A single shared PDO connection for this CRUD example.
// Callers ALWAYS use prepared statements (placeholders), never string-built SQL.

function db(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $pdo = new PDO(
            'mysql:host=mysql-server-80;dbname=web-bootcamp-db;charset=utf8mb4',
            'root',
            'root_password',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ],
        );
    }

    return $pdo;
}
