<?php
    if (isset($_POST['submit'])) {
        require_once __DIR__ . "/../../database-wrapper.php";

        $sql = sprintf("INSERT INTO Users (name, profession) VALUES ('%s', '%s')", $_POST['name'], $_POST['profession']);

        DB::run($sql);
        // header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="scripts.js"></script></head>

    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
<body>
<div class="d-flex justify-content-center p-3">
    <form id="form" action="add.php" method="post">
        <div class="form-group">
            <label>
                User

                <input class="form-control" name="name" value=""/>
            </label>
        </div>

        <div class="form-group">
            <label>
                Profession

                <?php $_POST['age'] ?>
                <input class="form-control" name="age" type="number" >
            </label>
        </div>

        <div class="form-group d-flex justify-content-center">
            <button class="btn btn-primary" type="submit" name="submit">Add user (PHP)</button>
        </div>

        <div class="d-flex justify-content-center">
            <button class="btn btn-primary" id="submit" type="button" name="submit">Add user (jQuery)</button>
        </div>
    </form>
</div>
</body>
</html>