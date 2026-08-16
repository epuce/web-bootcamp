<?php
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Placeholders keep the user input out of the SQL string (no injection)
    $stmt = db()->prepare('INSERT INTO Users (name, profession) VALUES (?, ?)');
    $stmt->execute([$_POST['name'] ?? '', $_POST['profession'] ?? '']);

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="scripts.js" defer></script>
</head>
<body>
<div class="d-flex justify-content-center p-3">
    <form id="form" action="add.php" method="post">
        <div class="mb-3">
            <label class="form-label">User
                <input class="form-control" name="name" value="">
            </label>
        </div>
        <div class="mb-3">
            <label class="form-label">Profession
                <input class="form-control" name="profession">
            </label>
        </div>
        <div class="d-flex justify-content-center gap-2">
            <button class="btn btn-primary" type="submit">Add user (PHP)</button>
            <button class="btn btn-primary" id="submit" type="button">Add user (fetch)</button>
        </div>
    </form>
</div>
</body>
</html>
