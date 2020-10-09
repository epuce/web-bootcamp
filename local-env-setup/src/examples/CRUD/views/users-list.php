<? session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./scripts.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="p-3">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="title">
                Users
            </h1>
            <h4 <?= isset($_SESSION["user_id"]) ? '' : 'hidden' ?>>
                You have signed in as <?= $_SESSION["user_name"] ?>
            </h4>
        </div>


        <div>
            <a <?= isset($_SESSION["user_id"]) ? 'hidden' : '' ?> href="/CRUD/login.php" class="btn btn-primary">
                Login
            </a>

            <a href="/CRUD/request-access-token.php" class="btn btn-warning">
                Request edit access
            </a>

            <a <?= isset($_SESSION["user_id"]) ? '' : 'hidden' ?> href="/CRUD/logout.php" class="btn btn-primary">
                Logout
            </a>

            <a href="/CRUD/add" class="btn btn-primary">
                Add user
            </a>
        </div>
    </div>

    <table class="table">
        <tr>
            <th>Name</th>
            <th>Password</th>
            <th></th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row["name"] ?></td>
                <td><?= $row["password"] ?></td>
                <td>
                    <a href="/CRUD/edit.php?id=<?= $row["id"] ?>" class="btn btn-primary">Edit</a>

                    <a href="/CRUD/delete.php?id=<?= $row["id"] ?>" class="btn btn-danger">Delete (PHP)</a>

                    <!-- TODO create delete jQuery logic -->
                    <button class="btn btn-danger js-delete-row" data-id="<?= $row["id"] ?>">Delete (jQuery)</button>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>