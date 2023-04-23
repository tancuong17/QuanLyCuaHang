<?php
    require "../../model/product.php";
    $id =  $_POST['id'];
    $idProduct = $_POST['idProduct'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $stamentCheck = $connect->prepare("SELECT count(*) as count FROM price WHERE id_product = ? and id != ? and date(start_date) <= date(?) and date(end_date) >= date(?)");
    $stamentCheck->execute([$idProduct, $id, $endDate, $startDate]);
    $row = $stamentCheck->fetch(); 
    if($row['count'] == 0){
        $stament = $connect->prepare("UPDATE price SET start_date = ?, end_date = ? WHERE id = ?");
        $stament->execute([$startDate, $endDate, $id]);
        echo "1";
    }
    else{
        echo "0";
    }
?>