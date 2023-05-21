<?php
    require "../../model/product.php";
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $idProduct = $_POST["idProduct"];
    $prices = array();
    $stament = $connect->prepare("SELECT * FROM price where id_product = ?");
    $stament->execute([$idProduct]);
    while ($row = $stament->fetch()) {
        $price = number_format($row['price'], 0, '.', ',');
        array_push($prices, array("price" => $price."đ", "startDate" => $row['start_date'], "endDate" => $row['end_date']));
    }
    echo json_encode($prices, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>