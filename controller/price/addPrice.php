<?php
    require "../../model/price.php";
    date_default_timezone_set("Asia/Bangkok");
    $idProduct = $_POST['idProduct'];
    $price = $_POST['price'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $stamentCheck = $connect->prepare("SELECT count(*) as count FROM price WHERE id_product = ? and date(start_date) < date(?) and date(end_date) > date(?)");
    $stamentCheck->execute([$idProduct, $endDate, $startDate]);
    $row = $stamentCheck->fetch();
    if($row['count'] == 0){
        $stament = $connect->prepare("INSERT INTO price VALUES (?,?,?,?,?)");
        $check = $stament->execute([$idProduct, $price, $startDate, $endDate, date("Y-m-d H:i:s")]);
        $id = $connect->lastInsertId();
        $stamentGetProduct = $connect->prepare("SELECT * FROM product WHERE id = ?");
        $stamentGetProduct->execute([$idProduct]);
        $row = $stamentGetProduct->fetch();
        $nameProduct = $row["name"];
        echo json_encode(array("result" => 1, "nameProduct" => $nameProduct, "price" => $price, "startDate" => $startDate, "endDate" => $endDate, "date" => date("Y-m-d H:i:s")));
    }
    else{
        echo json_encode(array("result" => 0));
    }
?>