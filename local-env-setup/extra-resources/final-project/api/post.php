<?php

include_once "src/helpers/database-wrapper.php";

$database = new DatabaseWrapper();

$database->openDatabaseConnection();

$sql = "";

$database->execute();

$database->closeDatabaseConnection();