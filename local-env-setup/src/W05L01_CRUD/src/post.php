<?php
require_once __DIR__ . '/../db.php';
header('Content-Type: application/json');

$stmt = db()->prepare('INSERT INTO Users (name, profession) VALUES (?, ?)');
$stmt->execute([$_POST['name'] ?? '', $_POST['profession'] ?? '']);

echo json_encode(['id' => (int) db()->lastInsertId()]);
