<?php
require_once __DIR__ . '/db.php';

$name = '';
$profession = '';
$id = (int) ($_POST['id'] ?? $_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = db()->prepare('UPDATE Users SET name = ?, profession = ? WHERE id = ?');
    $stmt->execute([$_POST['name'] ?? '', $_POST['profession'] ?? '', $id]);

    header('Location: index.php');
    exit;
}

if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = db()->prepare('SELECT name, profession FROM Users WHERE id = ?');
$stmt->execute([$id]);
$user = $stmt->fetch();

if ($user) {
    $name = $user['name'];
    $profession = $user['profession'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="scripts.js" defer></script>
</head>
<body>
<div class="d-flex justify-content-center p-3">
    <form id="form" action="edit.php" method="post">
        <div class="mb-3">
            <label class="form-label">User
                <input class="form-control" name="name" value="<?= htmlspecialchars($name) ?>">
            </label>
        </div>
        <div class="mb-3">
            <label class="form-label">Profession
                <input class="form-control" name="profession" value="<?= htmlspecialchars($profession) ?>">
            </label>
        </div>
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="d-flex justify-content-center gap-2">
            <button class="btn btn-primary" type="submit">Update user (PHP)</button>
            <button class="btn btn-primary" id="submit" type="button">Update user (fetch)</button>
        </div>
    </form>
</div>
</body>
</html>
