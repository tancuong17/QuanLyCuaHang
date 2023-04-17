<?php
    $id = $_POST['id'];
    $list = array();
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $stament = $connect->prepare("SELECT product.name, detail_bill.quantity, price.price FROM bill INNER JOIN detail_bill ON bill.id = detail_bill.id_order INNER JOIN product ON detail_bill.id_product = product.id INNER JOIN price ON product.id = price.id_product WHERE date(price.start_date) <= now() and date(price.end_date) >= now() and bill.id = ?");
    $stament->execute([$id]);
    while ($row = $stament->fetch()) {
        array_push($list, array("name" => $row['name'], "quantity" => $row["quantity"], "price" => $row["price"]));
    }
    echo json_encode($list, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>