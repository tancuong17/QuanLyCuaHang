<?php
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $stament = $connect->prepare("SELECT detail_bill.id_product, product.name, SUM(detail_bill.quantity) as quantity, price.price * SUM(detail_bill.quantity) as total, price.price as price FROM bill INNER JOIN detail_bill ON bill.id and detail_bill.id_order INNER JOIN product ON detail_bill.id_product INNER JOIN price ON product.id = price.id_product WHERE bill.id = detail_bill.id_order and detail_bill.id_product = product.id and product.id = price.id_product AND date(price.start_date) <= now() AND date(price.end_date) >= now() and bill.create_date >= date(?) and bill.create_date <= date(?) GROUP BY detail_bill.id_product ORDER BY quantity DESC");
    $stament->execute([$startDate, $endDate]);
    $result = array();
    while ($row = $stament->fetch()) {
        array_push($result, array("id" => $row['id_product'], "name" => $row["name"], "quantity" => $row["quantity"], "price" => $row["price"], "total" => $row["total"]));
    }
    echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>