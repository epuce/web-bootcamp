<?php

include_once "helpers/database-wrapper.php";
    
$database = new DatabaseWrapper();

$database->openDatabaseConnection();

$id = $_GET['id'];

$sql = "SELECT * FROM list WHERE id='$id'";

$result = $database->execute($sql);

echo json_encode($result);

$database->closeDatabaseConnection();