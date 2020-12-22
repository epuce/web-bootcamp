<?php

use DB\DB;

require_once __DIR__ ."/../../database-wrapper.php";
DB::setDbName('final-project');

$id = $_GET['id'];

$sql = "DELETE FROM list WHERE id=$id";

$response = ['id' => $id];

echo json_encode($response);

DB::run($sql);
