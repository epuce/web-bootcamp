<?php
include_once "api/helpers/database-wrapper.php";

$database = new DatabaseWrapper();

$database->openDatabaseConnection();

$sqlArray =[
    "0.0.1" => "CREATE TABLE IF NOT EXISTS db_schema
    (
        id varchar(10) NOT NULL,
        PRIMARY KEY (id)
    )",
    "1" => "CREATE TABLE IF NOT EXISTS list
    (
        description varchar(20),
        id int NOT NULL AUTO_INCREMENT,
        PRIMARY KEY (id)
    )",
	"1.0.1" => "ALTER TABLE list ADD (
		order_id int NOT NULL,
		checked boolean DEFAULT FALSE
    )",
    "1.0.3" => ""
];

foreach($sqlArray as $id => $row) {
    if ($database->execute("SELECT * FROM db_schema WHERE  id='$id'")) {
        echo "SQL with ID: $id already executed".PHP_EOL;
    } else {
        $database->execute($row);
        $database->execute("INSERT INTO db_schema (id) VALUES ('$id')");

        echo "Executing SQL with ID: $id".PHP_EOL;
    }
}

$database->closeDatabaseConnection();
