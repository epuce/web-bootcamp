<?php 
    require_once __DIR__ . "/../database-wrapper.php";

    $sql = "SELECT * FROM products";
    $products = DB::run($sql)->fetch_all(MYSQLI_ASSOC);
    $a = "a";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product list</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
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
            <?php foreach($products as $product) { ?>
                <tr>
                    <td><?= $product["name"] ?></td>
                    <td><?= $product["price"] ?></td>
                    <td>
                        <a href="/products/modify.php?id=<?= $product["id"] ?>">
                            Edit
                        </a>
                        <a href="/products/delete.php?id=<?= $product["id"] ?>">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="/products/modify.php">Add products</a>
</body>
</html>

<script>
    // $.ajax({
    //     url: "/products/api.php?table=cars"
    // }).done(function(response) {
    //     response = JSON.parse(response);
    //     if (response.error) {
    //         alert(response.error)
    //     }
    // })
</script>