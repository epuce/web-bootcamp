# 🔄 CRUD (Create, Read, Update, Delete)

## PHP + HTML

* Displaying data directly in HTML

```php
// index.php
<?php
require_once __DIR__ . "/path-to/database-wrapper.php";

// Building the prepared-statement habit even with no user input here (see W04L02)
$stmt = $pdo->query('SELECT id, name, profession FROM Users');
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
```

```html
<table class="table">
    <thead>
    <tr bgcolor='#CCCCCC'>
        <th>Name</th>
        <th>Profession</th>
        <th></th>
    </tr>
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
```

## CRUD

* [C - create](local-env-setup/src/W05L01_CRUD/add.php)
* [R - read](local-env-setup/src/W05L01_CRUD/index.php)
* [U - update](local-env-setup/src/W05L01_CRUD/edit.php)
* [D - delete](local-env-setup/src/W05L01_CRUD/delete.php)

## Data manipulation with API requests

* [Requests with fetch](local-env-setup/src/W05L01_CRUD/scripts.js)
* [PUT - update](local-env-setup/src/W05L01_CRUD/src/put.php)
* [POST - create](local-env-setup/src/W05L01_CRUD/src/post.php)
* [DELETE](local-env-setup/src/W05L01_CRUD/src/delete.php)

> [!TIP]
> **Checkup**
>
> 1. Create a new data table with minimum 2 fields
> 2. Add all 4 data manipulation functions with PHP
>     * CREATE
>     * READ
>     * UPDATE
>     * DELETE
