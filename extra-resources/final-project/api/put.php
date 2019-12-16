<?php

include_once "api/helpers/database-wrapper.php";

$database = new DatabaseWrapper();

$database->openDatabaseConnection();

$requestPayload = json_decode(file_get_contents('php://input'),1);

$id = $requestPayload['id'];

$sql = sprintf("UPDATE list SET description='%s', checked=%s, order_id=%s WHERE id=$id", $requestPayload['description'], !!$requestPayload['checked'] ? 1 : 0, $requestPayload['order_id']);

$database->execute($sql);

$sql = "SELECT * FROM list WHERE id=$id";

$result = $database->execute($sql);

echo json_encode($result);

$database->closeDatabaseConnection();