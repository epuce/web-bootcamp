<?php

require_once "database-wrapper.php";

$database = new DatabaseWrapper();

$database->openDatabaseConnection('web-bootcamp');

// $sql = "CREATE DATABASE IF NOT EXISTS `web-bootcamp`";

$sql = "CREATE TABLE IF NOT EXISTS Users
(
   name varchar(20),
   profession varchar(20),
   id int NOT NULL AUTO_INCREMENT,
   PRIMARY KEY (id)
)";

$database->execute($sql);

$users = [
    [
        "name" => "Ed",
        "profession" => "Programmer"
    ], [
        "name" => "Alex",
        "profession" => "Sales agent"
    ], [
        "name" => "Jim",
        "profession" => "Programmer"
    ]
];

foreach ($users as $item) {
//    $sql = "INSERT INTO Users (name, profession) VALUES ('" . $item['name'] . "', '" . $item['profession'] . "')";
   // OR
   $sql = sprintf("INSERT INTO Users (name, profession) VALUES ('%s', '%s')", $item['name'], $item['profession']);

   $database->execute($sql);
}

//$sql = "UPDATE Users
//SET name='not Jim', profession='Not a programmer'
//WHERE id=3
//";

//$sql = "SELECT * FROM Users";
//$sql = "SELECT name FROM Users WHERE profession='Programmer'";

//$response = $database->execute($sql);

//echo $database->responseToArray($response);

//$sql = "
//ALTER TABLE Users ADD (
//    id int NOT NULL AUTO_INCREMENT,
//    PRIMARY KEY (id)
//);";

//$sql = "
//CREATE TABLE Purchases (
//    time datetime,
//    product varchar(20),
//    id int NOT NULL AUTO_INCREMENT,
//    userId int,
//    PRIMARY KEY (id),
//    FOREIGN KEY (userId) REFERENCES Users(id)
//);";

$purchases = [
    [
        "time" => new DateTime('2019-09-11'),
        "product" => "Laptop",
        "userId" => 1
    ], [
        "time" => new DateTime(NULL, new DateTimeZone('Europe/Helsinki')),
        "product" => "Bike",
        "userId" => 1
    ], [
        "time" => new DateTime('2019-09-8', new DateTimeZone('Europe/Helsinki')),
        "product" => "Washing machine",
        "userId" => 2
    ]
];
//
//foreach ($purchases as $item) {
//    $sql = sprintf("INSERT INTO Purchases (time, product, userId) VALUES ('%s', '%s', '%s')", $item['time']->format('Y-m-d H:i:s'), $item['product'], $item['userId']);
//    $database->execute($sql);
//}

//$sql = "
//SELECT Users.name
//FROM Purchases INNER JOIN Users
//ON Purchases.userId=Users.id
//GROUP BY Users.name;
//";
//
//$response = $database->execute($sql);
//
//echo $database->responseToArray($response);

$database->execute($sql);

$database->closeDatabaseConnection();