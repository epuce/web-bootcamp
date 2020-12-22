<?php
require_once __DIR__ . "/../../database-wrapper.php";


$id = $_POST['id'];
$name = $_POST['name'];
$profession = $_POST['profession'];

$sql = "UPDATE Users SET name='$name', profession='$profession' WHERE id=$id";

$response = DB::getArrayResult($sql);

echo $response;