<?php
    require "../../model/product.php";
    $idProduct = $_POST['idProduct'];
    $size = $_POST['size'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $stament = $connect->prepare("UPDATE price SET start_date = ?, end_date = ? where id_product = ? and size = ?");
    $stament->execute([$startDate, $endDate, $idProduct, $size]);
    echo json_encode(array("idProduct" => $idProduct, "size" => $size, "startDate" => $startDate, "endDate" => $endDate));
?>