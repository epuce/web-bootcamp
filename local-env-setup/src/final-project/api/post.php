<?php

require_once __DIR__ . "/../../database-wrapper.php";
DB::setDbName('final-project');

$requestPayload = json_decode(file_get_contents('php://input'),1);

var_dump($requestPayload);

$sql = sprintf("INSERT INTO list (description, checked, order_id) VALUES ('%s', '%s', '%s')", $requestPayload['description'], !!$requestPayload['checked'] ? 1 : 0, $requestPayload['order_id']);

$id = DB::run($sql);

echo DB::getArrayResult("SELECT * FROM list ORDER BY id DESC LIMIT 1");