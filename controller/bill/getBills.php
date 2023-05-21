<?php
    $list = array();
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $stamentBills = $connect->prepare("SELECT bill.id, account.name, SUM(detail_bill.quantity) as quantity, bill.create_date FROM bill INNER JOIN detail_bill ON bill.id = detail_bill.id_order INNER JOIN account ON bill.username = account.phonenumber GROUP BY bill.id ORDER BY bill.create_date DESC");
    $stamentBills->execute();
    while ($row = $stamentBills->fetch()) {
        array_push($list, array("id" => $row['id'], "quantity" => $row["quantity"], "createDate" => $row["create_date"], "name" => $row['name']));
    }
    echo json_encode($list, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>