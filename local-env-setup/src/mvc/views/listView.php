<?php 
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
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($this->productList as $product) { ?>
                            <tr>
                                <td><?= $product["name"] ?></td>
                                <td><?= $product["price"] ?></td>
                                <td>
                                    <a>Edit</a>
                                    <a href="/mvc/?page=delete&product_id=<?= $product['id']?>">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php
        }
    }
?>