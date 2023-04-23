<?php
     $keyword = $_POST['keyword'];
     $list = array();
     $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
     $stament = $connect->prepare("SELECT product.id, product.name, product.image, price.price, price.start_date, price.end_date FROM `product` LEFT JOIN price ON product.id = price.id_product WHERE name like '%".$keyword."%'");
     $stament->execute();
     while ($row = $stament->fetch()) {
          if (date($row['start_date']) <= date("Y-m-d") && date($row['end_date']) >= date("Y-m-d")) {
               $price = number_format($row['price'], 0, '.', ',');
               array_push($list, array("id" => $row['id'], "image" => $row['image'], "name" => $row['name'], "price" => $price . "đ"));
           }
           else if($row['start_date'] == null){
               array_push($list, array("id" => $row['id'], "image" => $row['image'], "name" => $row['name'], "price" => "Chưa có giá"));
           }
     }
     echo json_encode($list);
?>