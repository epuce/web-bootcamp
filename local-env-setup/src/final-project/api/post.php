<?php

use DB\DB;

session_start();
require_once __DIR__ . "/../../vendor/autoload.php";
DB::setDbName('final-project');

$requestPayload = json_decode(file_get_contents('php://input'),1);
$userId = $_SESSION["user_id"];


$sql = sprintf(
    "INSERT INTO list (description, checked, order_id, user_id) VALUES ('%s', '%s', '%s', '%s')",
    $requestPayload['description'],
    !!$requestPayload['checked'] ? 1 : 0, $requestPayload['order_id'],
    $userId
);

$id = DB::run($sql);

echo DB::getArrayResult("SELECT * FROM list ORDER BY id DESC LIMIT 1");