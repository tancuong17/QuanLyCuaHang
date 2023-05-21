<?php
    $id = $_POST['id'];
    $list = array();
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $stament = $connect->prepare("SELECT product.name, detail_bill.quantity, price.price FROM bill INNER JOIN detail_bill ON bill.id = detail_bill.id_order INNER JOIN product ON detail_bill.id_product = product.id INNER JOIN price ON detail_bill.id_product = price.id_product where bill.id = ? and time(price.start_date) <= time(bill.create_date) and time(price.end_date) >= time(bill.create_date)");
    $stament->execute([$id]);
    if($stament->rowCount() == 0){
        $stament2 = $connect->prepare("SELECT product.name, detail_bill.quantity, product.price FROM bill INNER JOIN detail_bill ON bill.id = detail_bill.id_order INNER JOIN product ON detail_bill.id_product = product.id where bill.id = ?");
        $stament2->execute([$id]);
        while ($row = $stament2->fetch()) {
            array_push($list, array("name" => $row['name'], "quantity" => $row["quantity"], "price" => $row["price"]));
        }
    }
    else{
        while ($row = $stament->fetch()) {
            array_push($list, array("name" => $row['name'], "quantity" => $row["quantity"], "price" => $row["price"]));
        }
    }
    echo json_encode($list, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>