<?php
require_once __DIR__ . '/db.php';

$users = db()->query('SELECT id, name, profession FROM Users')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="scripts.js" defer></script>
    <style>.btn { color: #fff; }</style>
</head>
<body>
    <div class="p-3">
        <div id="header" class="d-flex justify-content-between align-items-center">
            <h1>Users</h1>
            <a class="btn btn-primary" href="add.php">Add User</a>
        </div>

        <table class="table">
            <thead>
                <tr><th>Name</th><th>Profession</th><th></th></tr>
            </thead>
            <tbody>
            <?php foreach ($users as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['profession']) ?></td>
                    <td>
                        <a class="btn btn-primary" href="edit.php?id=<?= (int) $row['id'] ?>">Edit</a>
                        <a class="btn btn-danger" href="delete.php?id=<?= (int) $row['id'] ?>">Delete (PHP)</a>
                        <button class="btn btn-danger delete" data-id="<?= (int) $row['id'] ?>">Delete (fetch)</button>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>
</html>
