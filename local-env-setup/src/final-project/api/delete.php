<?php

require_once "helpers/database-wrapper.php";

$database = new DatabaseWrapper();

$database->openDatabaseConnection();

$id = $_GET['id'];

$sql = "DELETE FROM list WHERE id=$id";

$response = ['id' => $id];

echo json_encode($response);

$database->execute($sql);
