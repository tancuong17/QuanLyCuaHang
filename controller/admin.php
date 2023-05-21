<?php
require "../model/product.php";
require "../vendor/autoload.php";
header("Access-Control-Allow-Origin: * ");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400'); 
$smarty = new Smarty();
$connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
$products = array();
$prices = array();
$bills = array();
$stament = $connect->prepare("SELECT product.id, product.name, product.image, product.price FROM product");
$stament->execute();
while ($row = $stament->fetch()) {
    $price = number_format($row['price'], 0, '.', ',');
    array_push($products, array("id" => $row['id'], "image" => $row['image'], "name" => $row['name'], "price" => $price . "đ"));
}
$smarty->assign("products", $products);
$smarty->display("../views/admin.tpl");
?>