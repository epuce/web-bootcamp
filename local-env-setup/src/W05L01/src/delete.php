<?php

echo $_GET;

if (isset($_GET['id'])) {
    require_once "database-wrapper.php";

    $database = new DatabaseWrapper();

    $database->openDatabaseConnection('web-bootcamp');

    $id = $_GET['id'];

    $sql = "DELETE FROM Users WHERE id=$id";

    $response = $database->execute($sql);

    echo $database->responseToArray($response);
}

