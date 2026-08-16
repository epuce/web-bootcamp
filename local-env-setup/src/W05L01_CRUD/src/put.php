<?php
require_once __DIR__ . '/../db.php';
header('Content-Type: application/json');

$stmt = db()->prepare('UPDATE Users SET name = ?, profession = ? WHERE id = ?');
$stmt->execute([$_POST['name'] ?? '', $_POST['profession'] ?? '', (int) ($_POST['id'] ?? 0)]);

echo json_encode(['updated' => $stmt->rowCount()]);
