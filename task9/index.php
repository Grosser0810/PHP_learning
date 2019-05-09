<?php
include 'db.php';


$getBrands = "SELECT * FROM brands";
$brands = mysqli_query($connection, $getBrands);
if(!$brands) {
    echo "Запрос не удался";
}


$new = $_POST['brand'];
$submitBrand = $_POST['submit_brand'];

if(isset($submitBrand)){
     $sqlBrand = mysqli_query($connection,"INSERT INTO brands (id, brand) VALUES (NULL, '{$new}')");
    }

$product = $_POST['product'];
$submitProduct = $_POST['submit_product'];

if(isset($submitProduct)){
    $sqlProduct = mysqli_query($connection,"INSERT INTO products (id, product) VALUES (NULL, '{$product}')");
    if(!$submitProduct){
        echo "no";
    }
}

$img = $_FILES['img']['name'];
$cost = $_POST['cost'];
$name = $_POST['name'];
$description = $_POST['description'];
$idBrands = $_POST['id_brands'];
$idProducts = $_POST['id_products'];
$submitItems = $_POST['submit_item'];

if (isset($submitItems)){
    $sqlItem = mysqli_query($connection,"INSERT INTO items (id,image,cost,name,description,id_brands,id_products) VALUES (NULL,'{$img}','{$cost}','{$name}','{$description}','{$idBrands}','{$idProducts}')");
}



?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>админка</title>
</head>
<body>
<h3>Добавить новый бренд</h3>
<form action="" method="post">
    <input type="text" name="brand"><br>
    <input type="submit" name="submit_brand" value="Добавить">
</form>
<h3>Добавить новыую категорию</h3>
<form action="" method="post">
    <input type="text" name="product"><br>
    <input type="submit" name="submit_product" value="Добавить">
</form>
<h3>Добавить новый товар</h3>
<form action="" method="post" enctype="multipart/form-data">
    выберите картинку<br>
    <input type="file" name="img"><br>
    укажите стоимость<br>
    <input type="text" name="cost"><br>
    укажите название продукта<br>
    <input type="text" name="name"><br>
    описание продукта<br>
    <textarea name="description" id="" cols="30" rows="10"></textarea><br>
    id бренда<br>
    <input type="text" name="id_brands"><br>
    id категории<br>
    <input type="text" name="id_products"><br>
    <input type="submit" name="submit_item" value="Добавить товар">
</form>


</body>
</html>