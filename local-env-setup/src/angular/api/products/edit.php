<?php

use DB\DB;

require_once __DIR__ . "/../../../vendor/autoload.php";

class ProductEdit {

    public function show() {
        $data = $_POST;

        $sql = sprintf("UPDATE products SET name='%s', price=%s WHERE id=%s", $data["name"], $data["price"], $data["id"]);

        $id = DB::run($sql);
    }
}

(new ProductEdit())->show();