<?php

require_once __DIR__ . "/helpers/database-wrapper.php";

$requestPayload = json_decode(file_get_contents('php://input'),1);

$id = $requestPayload['id'];

$sql = sprintf("UPDATE list SET description='%s', checked=%s, order_id=%s WHERE id=$id", $requestPayload['description'], !!$requestPayload['checked'] ? 1 : 0, $requestPayload['order_id']);
DatabaseWrapper::execute($sql);

$sql = "SELECT * FROM list WHERE id=$id";
echo DatabaseWrapper::getArrayResult($sql);