<?php

require_once __DIR__ . "/helpers/database-wrapper.php";

$requestPayload = json_decode(file_get_contents('php://input'),1);

$sql = sprintf("INSERT INTO list (description, checked, order_id) VALUES ('%s', '%s', '%s')", $requestPayload['description'], !!$requestPayload['checked'] ? 1 : 0, $requestPayload['order_id']);

$id = DatabaseWrapper::execute($sql);

echo DatabaseWrapper::getArrayResult("SELECT * FROM list ORDER BY id DESC LIMIT 1");