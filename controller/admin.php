<?php
require "../model/product.php";
require "../vendor/autoload.php";
$smarty = new Smarty();
$connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
$products = array();
$prices = array();
$bills = array();
$stament = $connect->prepare("SELECT product.id, product.name, product.image, price.price, price.start_date, price.end_date FROM product LEFT JOIN price ON price.id_product = product.id ORDER BY product.id DESC");
$stament->execute();
while ($row = $stament->fetch()) {
    if (date($row['start_date']) <= date("Y-m-d") && date($row['end_date']) >= date("Y-m-d")) {
        $price = number_format($row['price'], 0, '.', ',');
        array_push($products, array("id" => $row['id'], "image" => $row['image'], "name" => $row['name'], "price" => $price . "đ"));
    }
    else if($row['start_date'] == null){
        array_push($products, array("id" => $row['id'], "image" => $row['image'], "name" => $row['name'], "price" => "Chưa có giá"));
    }
}
$stamentPrice = $connect->prepare("SELECT price.id, product.id as idProduct, product.name, price.price, price.start_date, price.end_date FROM price INNER JOIN product on price.id_product = product.id ORDER BY price.create_date DESC");
$stamentPrice->execute();
while ($row = $stamentPrice->fetch()) {
    $price = number_format($row['price'], 0, '.', ',');
    array_push($prices, array("id" => $row['id'], "idProduct" => $row['idProduct'], "nameProduct" => $row["name"], "price" => $price . "đ", "startDate" => $row["start_date"], "endDate" => $row["end_date"]));
}

$smarty->assign("products", $products);
$smarty->assign("prices", $prices);
$smarty->display("../views/admin.tpl");
?>