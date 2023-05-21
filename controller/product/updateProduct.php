<?php
    require "../../model/product.php";
    date_default_timezone_set('Asia/Bangkok');
    $name = $_POST['name'];
    $price = $_POST['price'];
    $id = $_POST['id'];
    $time = time();
    $nameImage = 'images/'.(string)$time . ".jpg";
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $stamentImage = $connect->prepare("SELECT * FROM product WHERE id = ?");
    $stamentImage->execute([$id]);
    $row = $stamentImage->fetch();
    $linkImage = "";
    if($row["price"] != $price){
        $stamentPrice = $connect->prepare("INSERT INTO price VALUES (?,?,?,?,?,?)");
        $stamentPrice->execute([null, $id, $row['price'], $row['update_date'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s")]);
    }
    if(move_uploaded_file($_FILES['file']['tmp_name'], '../../'. $nameImage)){
        $stament = $connect->prepare("UPDATE product SET name = ?, image = ?, price = ?, update_date = ? where id = ?");
        $stament->execute([$name, $nameImage, $price, date("Y-m-d H:i:s"), $id]);
        unlink("../../".$row['image']);
        $linkImage = $nameImage;
    }
    else{
        $stament = $connect->prepare("UPDATE product SET name = ?, image = ?, price = ?, update_date = ? where id = ?");
        $stament->execute([$name, $row['image'], $price, date("Y-m-d H:i:s"), $id]);
        $linkImage = $row['image'];
    }
    echo "OK";
?>