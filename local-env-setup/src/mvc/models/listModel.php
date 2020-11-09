<?php
    require_once __DIR__ . "/../../database-wrapper.php";

    class listModel {

        public function getAll() {
            $sql = "SELECT * FROM products";
            $response = DB::run($sql)->fetch_all(MYSQLI_ASSOC);

            return $response;
        }

        public function deleteById($id) {
            $sql = "DELETE FROM products WHERE id=$id";
            DB::run($sql);
        }
    }
?>