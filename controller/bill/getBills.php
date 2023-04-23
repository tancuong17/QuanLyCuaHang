<?php
    $list = array();
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $stamentBills = $connect->prepare("SELECT bill.id, account.name, SUM(detail_bill.quantity) as quantity, SUM(detail_bill.quantity * price.price) as total, bill.create_date FROM bill INNER JOIN detail_bill ON bill.id = detail_bill.id_order INNER JOIN product ON detail_bill.id_product = product.id INNER JOIN price ON product.id = price.id_product INNER JOIN account ON bill.username = account.phonenumber WHERE date(price.start_date) <= now() and date(price.end_date) >= now() GROUP BY bill.id ORDER BY bill.create_date DESC");
    $stamentBills->execute();
    while ($row = $stamentBills->fetch()) {
        $total = number_format($row['total'], 0, '.', ',');
        array_push($list, array("id" => $row['id'], "quantity" => $row["quantity"], "total" => $total . "đ", "createDate" => $row["create_date"], "name" => $row['name']));
    }
    echo json_encode($list, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>