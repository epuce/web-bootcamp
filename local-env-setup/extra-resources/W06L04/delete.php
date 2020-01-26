<?php

if (isset($_GET['id'])) {
    require_once "src/database-wrapper.php";

    $database = new DatabaseWrapper();

    $database->openDatabaseConnection('web-bootcamp');

    $id = $_GET['id'];

    $sql = "DELETE FROM Users WHERE id=$id";

    $database->execute($sql);

    $database->closeDatabaseConnection();
}

header("Location: index.php");
