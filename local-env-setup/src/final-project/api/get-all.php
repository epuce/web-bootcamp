<?php

use DB\DB;

session_start();
require_once __DIR__ . "/../../database-wrapper.php";

DB::setDbName("final-project");

$userId = $_SESSION['user_id'];
$sql = "SELECT * FROM list WHERE user_id = $userId ORDER BY order_id DESC";

echo DB::getArrayResult($sql);