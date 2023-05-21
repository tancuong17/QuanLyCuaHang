<?php
    require "../../model/product.php";
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $products = array();
    $stament = $connect->prepare("SELECT product.id, product.name, product.image, product.price FROM product");
    $stament->execute();
    while ($row = $stament->fetch()) {
        $price = number_format($row['price'], 0, '.', ',');
        array_push($products, array("id" => $row['id'], "image" => $row['image'], "name" => $row['name'], "price" => $price . "đ"));
    }
    echo json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>