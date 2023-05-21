<?php
     $keyword = $_POST['keyword'];
     $list = array();
     $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
     $stament = $connect->prepare("SELECT product.id, product.name, product.image, product.price FROM product WHERE name like '%".$keyword."%'");
     $stament->execute();
     while ($row = $stament->fetch()) {
          $price = number_format($row['price'], 0, '.', ',');
          array_push($list, array("id" => $row['id'], "image" => $row['image'], "name" => $row['name'], "price" => $price . "đ"));
     }
     echo json_encode($list);
?>