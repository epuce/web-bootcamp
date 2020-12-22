<?php 
    require_once __DIR__ . "/../database-wrapper.php";

    if (isset($_GET["id"])) {
        $sql = "SELECT name, price, id FROM products WHERE id=".$_GET["id"];
        $product = DB::run($sql)->fetch_all(MYSQLI_ASSOC)[0];
        $a = "a";
    }

    echo $product["name"];

    if (!empty($_POST["id"])) {
        $name = $_POST["name"];
        $price = $_POST["price"];
        $id = $_POST["id"];
        $updateSql = "UPDATE products SET name='$name', price=$price WHERE id=$id";

        DB::run($updateSql);

        Header("Location: /products/list.php");
    } else if (isset($_POST["id"])) {
        $name = $_POST["name"];
        $price = $_POST["price"];
        $addSql = "INSERT INTO products (name, price) VALUES ('$name', $price)";

        DB::run($addSql);

        Header("Location: /products/list.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input name="name" value="<?= $product["name"] ?? '' ?>">
        <input name="price" value="<?= $product["price"] ?? '' ?>">
        <input type="hidden" name="id" value="<?= $product["id"] ?? '' ?>">

        <button>Save</button>
    </form>
</body>
<script>
    let isTimeoutActive = null;

    document.getElementsByName("name")[0].addEventListener('keyup', function() {
        if (isTimeoutActive) {
            clearTimeout(isTimeoutActive);
        }

        isTimeoutActive = setTimeout(function() {
            const name = document.getElementsByName("name")[0].value;
            fetch("/products/api.php?product_name=" + name,)
            .then(response => response.json())
            .then(function(data) {
                console.log(data)

                if (data.products) {
                    alert("product exists");
                }
            })
        }, 500)

    });
    

</script>
</html>