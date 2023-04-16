<?php
    require "../../model/product.php";
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $products = array();
    $stament = $connect->prepare("SELECT * FROM product LEFT JOIN price ON price.id_product = product.id");
    $stament->execute();
    while ($row = $stament->fetch()) {
        if (date($row['start_date']) <= date("Y-m-d") && date($row['end_date']) >= date("Y-m-d")) {
            $price = number_format($row['price'], 0, '.', ',');
            array_push($products, array("id" => $row['id'], "image" => $row['image'], "name" => $row['name'], "price" => $price . "đ"));
        }
        else if($row['start_date'] == null){
            array_push($products, array("id" => $row['id'], "image" => $row['image'], "name" => $row['name'], "price" => "Chưa có giá"));
        }
    }
    echo json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>