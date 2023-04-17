<?php
    require "../../model/product.php";
    date_default_timezone_set("Asia/Bangkok");
    $name = $_POST['name'];
    $time = time();
    $nameImage = 'images/'.(string)$time . ".jpg"; 
    move_uploaded_file($_FILES['file']['tmp_name'], '../../'. $nameImage);
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $stament = $connect->prepare("INSERT INTO product VALUES (?,?,?,?)");
    $stament->execute([null, $name, $nameImage, date("Y-m-d H:i:s")]);
    $id = $connect->lastInsertId();
    echo json_encode(new Product($id, $name, $nameImage, date("Y-m-d H:i:s")), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>