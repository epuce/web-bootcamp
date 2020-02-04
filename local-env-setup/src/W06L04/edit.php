<?php
require_once "src/database-wrapper.php";

$database = new DatabaseWrapper();

$database->openDatabaseConnection('web-bootcamp');

$arr = isset($_POST['arr']) ? $_POST['arr'] : [];

// $arr[] = "test";

var_dump($arr);

if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $profession = $_POST['profession'];

    $sql = "UPDATE Users SET name='$name', profession='$profession' WHERE id=$id";

    $response = $database->execute($sql);

    // redirect to index.php
    header("Location: index.php");
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM Users WHERE id=$id";

    $response = $database->execute($sql);

    while($res = mysqli_fetch_array($response))
    {
        $name = $res['name'];
        $profession = $res['profession'];
    }
} else {
    header("Location: index.php");
}

$database->closeDatabaseConnection();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="scripts.js"></script></head>

    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
<body>

<div class="d-flex justify-content-center p-3">
    <form id="form" action="edit.php" method="post">
        <div class="form-group">
            <label>
                User

                <input class="form-control" name="name" value="<?php echo $name ?>"/>
            </label>
        </div>

        <div class="form-group">
            <label>
                Profession

                <input class="form-control" name="profession" value="<?php echo $profession ?>">
            </label>
        </div>

        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="hidden" name="arr" value="<?php echo $arr ?>">

        <div class="form-group d-flex justify-content-center">
            <button class="btn btn-primary" type="submit" name="update">Update user (PHP)</button>
        </div>

        <div class="d-flex justify-content-center">
            <button class="btn btn-primary" id="submit" type="button" name="update">Update user (jQuery)</button>
        </div>
    </form>
</div>

</body>
</html>
