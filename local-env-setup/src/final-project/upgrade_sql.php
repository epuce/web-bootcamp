<?php

namespace finalProject;

require_once __DIR__ . "/../vendor/autoload.php";

use DB\DB;
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
	"1.0.4" => "CREATE TABLE users (
		username varchar(255) NOT NULL,
		password varchar(60) NOT NULL
    )",
	"1.0.5" => "ALTER TABLE users ADD (
        id int NOT NULL AUTO_INCREMENT,
        PRIMARY KEY (id)
    )",
	"1.0.6" => "ALTER TABLE users MODIFY COLUMN	username varchar(255) NOT NULL UNIQUE",
    "1.0.7" => "ALTER TABLE list ADD (
        user_id int NOT NULL DEFAULT 1,
        FOREIGN KEY (user_id) REFERENCES users(id)
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
