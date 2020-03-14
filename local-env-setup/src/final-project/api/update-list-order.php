<?php

require_once __DIR__ . "/helpers/database-wrapper.php";

$requestPayload = json_decode(file_get_contents('php://input'),1);

foreach ($requestPayload as $row) {
	$sql = sprintf("UPDATE list SET order_id='%s' WHERE id=%s", $row['order_id'], $row['id']);
	DatabaseWrapper::execute($sql);
}

$sql = "SELECT * FROM list";

echo DatabaseWrapper::getArrayResult($sql);