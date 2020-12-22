<?php

use DB\DB;

require_once __DIR__ . "/../../vendor/autoload.php";
DB::setDbName('final-project');

$requestPayload = json_decode(file_get_contents('php://input'),1);

$id = $requestPayload['id'];

$sql = sprintf("UPDATE list SET description='%s', checked=%s, order_id=%s WHERE id=$id", $requestPayload['description'], !!$requestPayload['checked'] ? 1 : 0, $requestPayload['order_id']);
DB::run($sql);

$sql = "SELECT * FROM list WHERE id=$id";
echo DB::getArrayResult($sql);