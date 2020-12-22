<?php

use MVC\entity\Product;

require_once __DIR__ . "/../components/modifyForm.php";
    class listView {
        private $productList;

        public function __construct($data = [])
        {
            $this->productList = $data;
        }


        public function html() {
            ?>
                <table>
                    <thead>
                        <tr>
                            <td colspan="3">Products</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>Price</td>
                            <td>Category</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($this->productList as $item) { 
                            $product = new Product();
                            $product->setName($item["name"]);
                            $product->setCategoryId($item["category_id"]);
                            ?>
                            <tr>
                                <td><?= $product->getName() ?></td>
                                <td><?= $item["price"] ?></td>
                                <td><?= $product->getCategoryName() ?></td>
                                <td>
                                    <a href="/mvc/?page=list&action=modify&product_id=<?= $item['id']?>">Edit</a>
                                    <a href="/mvc/?page=delete&product_id=<?= $item['id']?>">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <a href="/mvc/?page=list&action=modify">Add product</a>

                <form method="POST">
                    <input type="hidden" name="logOut">
                    <button type="submit">Log out</button>
                </form>
            <?php
        }
    }
?>