<?php

require_once "database-wrapper.php";

$database = new DatabaseWrapper();

$database->openDatabaseConnection('web-bootcamp');

$sql = sprintf("INSERT INTO Users (name, profession) VALUES ('%s', '%s')", $_POST['name'], $_POST['profession']);

$response = $database->execute($sql);

$database->closeDatabaseConnection();

echo $database->responseToArray($response);
