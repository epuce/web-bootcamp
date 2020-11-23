<?php
header("Access-Control-Allow-Origin: *");

require_once __DIR__ . "/../../../vendor/autoload.php";
use DB\DB;

class ProductList {

    public function show() {
        $sql = "SELECT * FROM products";

        $response = DB::run($sql)->fetch_all(MYSQLI_ASSOC);

        echo json_encode($response);
    } 
}

(new ProductList())->show();