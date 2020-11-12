<?php
require_once __DIR__ . "/../database-wrapper.php";
DB::setDbName('final-project');

$sqlArray =[
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
];

$createDdSchema = "CREATE TABLE IF NOT EXISTS db_schema
(
    id varchar(10) NOT NULL,
    PRIMARY KEY (id)
)";

DB::run($createDdSchema);

foreach($sqlArray as $id => $row) {
    if (DB::run("SELECT * FROM db_schema WHERE  id='$id'")->num_rows !== 0) {
        echo "SQL with ID: $id already executed".PHP_EOL;
    } else {
        DB::run($row);
        DB::run("INSERT INTO db_schema (id) VALUES ('$id')");

        echo "Executing SQL with ID: $id".PHP_EOL;
    }
}
