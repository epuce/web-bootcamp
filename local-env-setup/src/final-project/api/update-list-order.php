<?php

use DB\DB;

require_once __DIR__ . "/../../vendor/autoload.php";
DB::setDbName("final-project");

$requestPayload = json_decode(file_get_contents('php://input'),1);

foreach ($requestPayload as $row) {
	$sql = sprintf("UPDATE list SET order_id='%s' WHERE id=%s", $row['order_id'], $row['id']);
	DB::run($sql);
}

$sql = "SELECT * FROM list";

echo DB::getArrayResult($sql);