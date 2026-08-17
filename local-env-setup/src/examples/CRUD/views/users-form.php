<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $edit ? 'Edit' : 'Add' ?> user — web-bootcamp CRUD</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/bootcamp-theme.css">
</head>
<body>
    <main class="bc-shell" style="max-width:480px">
        <header class="bc-header" style="justify-content:flex-start">
            <div class="bc-brand">
                <span class="mark">&lt;/&gt;</span>
                <span><?= $edit ? 'Edit user' : 'Add user' ?><small>CRUD example</small></span>
            </div>
        </header>

        <div class="bc-card">
            <form action="/CRUD/<?= $edit ? 'edit.php' : 'add' ?>" method="post">
                <label class="bc-field">
                    <span>Name</span>
                    <input class="form-control" name="name" value="<?= htmlspecialchars($name) ?>" autocomplete="off">
                </label>
                <label class="bc-field">
                    <span>Password</span>
                    <input class="form-control" name="password" value="<?= htmlspecialchars($password) ?>" autocomplete="off">
                </label>
                <input hidden name="id" value="<?= htmlspecialchars($id) ?>">
                <div style="display:flex;gap:10px;margin-top:20px">
                    <button class="btn btn-primary" type="submit" name="submit">Save (PHP)</button>
                    <button class="btn btn-secondary js-save-date">Save (jQuery)</button>
                </div>
            </form>
        </div>

        <p style="margin-top:20px"><a href="/CRUD">← Back to users</a></p>
    </main>
</body>
</html>
