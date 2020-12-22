<?php

use DB\DB;

require_once __DIR__ . "/../../database-wrapper.php";
DB::setDbName('final-project');

$id = $_GET['id'];

$sql = "SELECT * FROM list WHERE id='$id'";

echo DB::getArrayResult($sql);
