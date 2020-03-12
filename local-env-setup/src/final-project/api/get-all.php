<?php

require_once __DIR__ . "/helpers/database-wrapper.php";

$sql = "SELECT * FROM list ORDER BY order_id DESC";

echo DatabaseWrapper::getArrayResult($sql);