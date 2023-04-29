<?php
    require "../../model/product.php";
    $name = $_POST['name'];
    $id = $_POST['id'];
    $time = time();
    $nameImage = 'images/'.(string)$time . ".jpg";
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $stamentImage = $connect->prepare("SELECT * FROM product WHERE id = ?");
    $stamentImage->execute([$id]);
    $row = $stamentImage->fetch();
    $linkImage = "";
    if(move_uploaded_file($_FILES['file']['tmp_name'], '../../'. $nameImage)){
        $stament = $connect->prepare("UPDATE product SET name = ?, image = ? where id = ?");
        $stament->execute([$name, $nameImage, $id]);
        unlink("../../".$row['image']);
        $linkImage = $nameImage;
    }
    else{
        $stament = $connect->prepare("UPDATE product SET name = ?, image = ? where id = ?");
        $stament->execute([$name, $row['image'], $id]);
        $linkImage = $row['image'];
    }
    echo json_encode(new Product($id, $name, $linkImage, date("Y-m-d H:i:s")), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>