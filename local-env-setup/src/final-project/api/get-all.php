<?php

require_once __DIR__ . "/../../database-wrapper.php";

DB::setDbName("final-project");
$sql = "SELECT * FROM list ORDER BY order_id DESC";

echo DB::getArrayResult($sql);