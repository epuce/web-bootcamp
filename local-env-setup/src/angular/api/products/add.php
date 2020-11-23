<?php

use DB\DB;

require_once __DIR__ . "/../../../vendor/autoload.php";

class ProductAdd {

    public function show() {
        $data = $_POST;

        $sql = sprintf("INSERT INTO products (name, price) VALUES ('%s', %s)", $data["name"], $data["price"]);

        $id = DB::run($sql);

        echo json_encode(["id" => $id]);
    }
}

(new ProductAdd())->show();