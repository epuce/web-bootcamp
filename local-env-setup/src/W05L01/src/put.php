<?php
require_once "database-wrapper.php";

$database = new DatabaseWrapper();

$database->openDatabaseConnection('web-bootcamp');

$id = $_POST['id'];
$name = $_POST['name'];
$profession = $_POST['profession'];

$sql = "UPDATE Users SET name='$name', profession='$profession' WHERE id=$id";

$response = $database->execute($sql);

$database->closeDatabaseConnection();

echo $database->responseToArray($response);