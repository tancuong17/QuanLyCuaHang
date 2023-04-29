<?php
    require "../../model/product.php";
    date_default_timezone_set("Asia/Bangkok");
    $name = $_POST['name'];
    $nameImage = 'images/'.$_FILES['file']['size'].".".pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['file']['tmp_name'], '../../'. $nameImage);
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $stament = $connect->prepare("INSERT INTO product VALUES (?,?,?,?)");
    $stament->execute([null, $name, $nameImage, date("Y-m-d H:i:s")]);
    $id = $connect->lastInsertId();
    echo json_encode(array("id" => $id, "image" => $nameImage, "name" => $name));
?>