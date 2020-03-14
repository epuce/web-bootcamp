<?php

require_once __DIR__ . "/helpers/database-wrapper.php";

$id = $_GET['id'];

$sql = "SELECT * FROM list WHERE id='$id'";
echo DatabaseWrapper::getArrayResult($sql);
