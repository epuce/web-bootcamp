<?php

echo $_GET;

if (isset($_GET['id'])) {
    require_once __DIR__ . "/../../database-wrapper.php";


    $id = $_GET['id'];

    $sql = "DELETE FROM Users WHERE id=$id";

    $response = DB::getArrayResult($sql);

    echo $database;
}

