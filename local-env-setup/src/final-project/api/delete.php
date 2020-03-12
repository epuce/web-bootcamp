<?php

require_once __DIR__ ."/helpers/database-wrapper.php";

$id = $_GET['id'];

$sql = "DELETE FROM list WHERE id=$id";

$response = ['id' => $id];

echo json_encode($response);

DatabaseWrapper::execute($sql);
