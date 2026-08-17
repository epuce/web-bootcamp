<? session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users — web-bootcamp CRUD</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./scripts.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap first: the lesson demonstrates a CSS framework… -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- …then the web-bootcamp theme restyles it to match the course. -->
    <link rel="stylesheet" href="/assets/bootcamp-theme.css">
</head>

<body>
    <main class="bc-shell">
        <header class="bc-header">
            <div class="bc-brand">
                <span class="mark">&lt;/&gt;</span>
                <span>Users<small>CRUD example</small></span>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:10px;align-items:center">
                <?php if (isset($_SESSION["user_id"])) { ?>
                    <span class="bc-badge">Signed in as <?= htmlspecialchars($_SESSION["user_name"]) ?></span>
                <?php } ?>
                <a <?= isset($_SESSION["user_id"]) ? 'hidden' : '' ?> href="/CRUD/login.php" class="btn btn-secondary">Login</a>
                <a href="/CRUD/request-access-token.php" class="btn btn-warning">Request edit access</a>
                <a <?= isset($_SESSION["user_id"]) ? '' : 'hidden' ?> href="/CRUD/logout.php" class="btn btn-secondary">Logout</a>
                <a href="/CRUD/add" class="btn btn-primary">+ Add user</a>
            </div>
        </header>

        <div class="bc-card" style="padding:0;overflow:hidden">
            <table class="table" style="margin:0">
                <tr>
                    <th>Name</th>
                    <th>Password</th>
                    <th style="text-align:right">Actions</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td style="font-weight:600;color:var(--heading)"><?= htmlspecialchars($row["name"]) ?></td>
                        <td style="font-family:var(--mono);color:var(--muted)"><?= htmlspecialchars($row["password"]) ?></td>
                        <td style="text-align:right;white-space:nowrap">
                            <a href="/CRUD/edit.php?id=<?= $row["id"] ?>" class="btn btn-primary">Edit</a>
                            <a href="/CRUD/delete.php?id=<?= $row["id"] ?>" class="btn btn-danger">Delete (PHP)</a>
                            <button class="btn btn-danger js-delete-row" data-id="<?= $row["id"] ?>">Delete (jQuery)</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <p class="bc-foot">Built for the <b>web-bootcamp</b> course.</p>
    </main>
</body>

</html>
