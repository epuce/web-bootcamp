<?php

include_once "helpers/database-wrapper.php";

$sql = "SELECT * FROM list ORDER BY order_id DESC";

DatabaseWrapper::execute($sql);