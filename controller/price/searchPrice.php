<?php
     $keyword = $_POST['keyword'];
     $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
     $stament = $connect->prepare("SELECT price.id, product.id as idProduct, product.name, price.price, price.start_date, price.end_date FROM price INNER JOIN product ON product.id = price.id_product WHERE product.name like '%".$keyword."%'");
     $stament->execute([$keyword]);
     $prices = array();
     while ($row = $stament->fetch()) {
        $price = number_format($row['price'], 0, '.', ',');
        array_push($prices, array("id" => $row['id'], "idProduct" => $row["idProduct"], "nameProduct" => $row["name"], "price" => $price . "đ", "startDate" => $row["start_date"], "endDate" => $row["end_date"]));
     }
     echo json_encode($prices, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>