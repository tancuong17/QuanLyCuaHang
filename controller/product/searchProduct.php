<?php
     $keyword = $_POST['keyword'];
     $list = array();
     $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
     $stament = $connect->prepare("SELECT product.id, product.name, product.image, price.price FROM `product` LEFT JOIN price ON product.id = price.id_product WHERE name like '%".$keyword."%'");
     $stament->execute();
     while ($row = $stament->fetch()) {
         array_push($list, array("id" => $row['id'], "name" => $row["name"], "image" => $row["image"], "price" => $row["price"]));
     }
     echo json_encode($list);
?>