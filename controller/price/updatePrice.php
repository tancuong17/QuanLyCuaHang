<?php
    require "../../model/product.php";
    $idProduct = $_POST['idProduct'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $stament = $connect->prepare("UPDATE price SET start_date = ?, end_date = ? where id_product = ?");
    $stament->execute([$startDate, $endDate, $idProduct]);
    echo json_encode(array("idProduct" => $idProduct, "startDate" => $startDate, "endDate" => $endDate), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>