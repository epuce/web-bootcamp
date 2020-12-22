<?php

require_once __DIR__ . "/../../database-wrapper.php";

$sql = sprintf("INSERT INTO Users (name, profession) VALUES ('%s', '%s')", $_POST['name'], $_POST['profession']);

$response = DB::getArrayResult($sql);

echo $response;