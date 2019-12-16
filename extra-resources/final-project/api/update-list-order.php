<?php

include_once "api/helpers/database-wrapper.php";

$database = new DatabaseWrapper();

$database->openDatabaseConnection();

$requestPayload = json_decode(file_get_contents('php://input'),1);


foreach ($requestPayload as $row) {
	$sql = sprintf("UPDATE list SET order_id='%s' WHERE id=%s", $row['order_id'], $row['id']);

	$database->execute($sql);
}

$sql = "SELECT * FROM list";

$result = $database->execute($sql);

echo json_encode($result);

$database->closeDatabaseConnection();