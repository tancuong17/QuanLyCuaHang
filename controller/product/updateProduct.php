<?php
    require "../../model/product.php";
    $name = $_POST['name'];
    $id = $_POST['id'];
    $time = time();
    $nameImage = 'images/'.(string)$time . ".jpg"; 
    move_uploaded_file($_FILES['file']['tmp_name'], '../../'. $nameImage);
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $stament = $connect->prepare("UPDATE product SET name = ?, image = ? where id = ?");
    $stament->execute([$name, $nameImage, $id]);
    echo json_encode(new Product($id, $name, $nameImage, date("Y-m-d H:i:s")), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>