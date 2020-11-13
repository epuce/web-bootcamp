<?php

namespace MVC\entity;

require_once __DIR__ . "/../../vendor/autoload.php";
use DB\DB;

class Product {
    private $name;
    private $price;
    private $category_id;
    private $id;

    private $_category_name;

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name ?? 'unspecified';
    }
    
    public function setCategoryId(int $category_id): void {
        $this->category_id = $category_id;
    }

    public function getCategoryId(): int {
        return $this->category_id;
    }

    public function getCategoryName(): string {
        if (!isset($this->_category_name)) {
            $sql = "SELECT title FROM product_categories WHERE id =" . $this->getCategoryId();
            $this->_category_name = DB::run($sql)->fetch_assoc()["title"];
        }

        return $this->_category_name;
    }
}
?>