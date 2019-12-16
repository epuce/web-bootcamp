<?php

include_once "helpers/database-wrapper.php";

$database = new DatabaseWrapper();

$database->openDatabaseConnection();

$sql = "SELECT * FROM list ORDER BY order_id DESC";

$result = $database->execute($sql);

echo json_encode($result);

$database->closeDatabaseConnection();