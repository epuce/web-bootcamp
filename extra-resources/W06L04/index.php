<?php
require_once "src/database-wrapper.php";

$database = new DatabaseWrapper();

$database->openDatabaseConnection('web-bootcamp');

$sql = "SELECT * FROM Users";

$response = $database->execute($sql);

$database->closeDatabaseConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="scripts.js"></script></head>

    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .btn {
            color: #FFFFFF !important;
        }
    </style>
<body>
    <div class="p-3">
        <div id="header" class="d-flex justify-content-between align-items-center">
            <h1>Users</h1>

            <a class="btn btn-primary" href="add.php">Add User</a>
        </div>

        <table class="table">
            <thead>
            <tr bgcolor='#CCCCCC'>
                <th>Name</th>
                <th>Profession</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            while($row = mysqli_fetch_array($response)) {
                echo "<tr>";
                echo "<td>".$row['NAME']."</td>";
                echo "<td>".$row['PROFESSION']."</td>";
                echo "<td>
                        <a class=\"btn btn-primary\" href=\"edit.php?id=$row[id]\">Edit</a> 
                        <a class=\"btn btn-danger\" href=\"delete.php?id=$row[id]\">Delete (PHP)</a>
                        <a class=\"btn btn-danger delete\" data-id=\"$row[id]\">Delete (jQuery)</a>
                      </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
