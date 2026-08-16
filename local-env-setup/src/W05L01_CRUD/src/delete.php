<?php
require_once __DIR__ . '/../db.php';
header('Content-Type: application/json');

$stmt = db()->prepare('DELETE FROM Users WHERE id = ?');
$stmt->execute([(int) ($_GET['id'] ?? 0)]);

echo json_encode(['deleted' => $stmt->rowCount()]);
