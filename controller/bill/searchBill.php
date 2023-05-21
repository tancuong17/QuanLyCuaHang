<?php
     $keyword = $_POST['keyword'];
     $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
     $stament = $connect->prepare("SELECT bill.id, account.name, SUM(detail_bill.quantity) as quantity, bill.create_date FROM bill INNER JOIN detail_bill ON bill.id = detail_bill.id_order INNER JOIN product ON detail_bill.id_product = product.id INNER JOIN account ON bill.username = account.phonenumber WHERE bill.id = ? GROUP BY bill.id");
     $stament->execute([$keyword]);
     $bill = null;
     while ($row = $stament->fetch()) {
        $bill = array("id" => $row['id'], "quantity" => $row["quantity"], "createDate" => $row["create_date"], "name" => $row['name']);
     }
     echo json_encode($bill, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>