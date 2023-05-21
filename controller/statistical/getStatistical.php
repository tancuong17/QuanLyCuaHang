<?php
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $stament = $connect->prepare("SELECT detail_bill.id_product, product.name, SUM(detail_bill.quantity) as quantity, price.price * SUM(detail_bill.quantity) as total, price.price as price FROM bill INNER JOIN detail_bill ON bill.id and detail_bill.id_order INNER JOIN product ON detail_bill.id_product INNER JOIN price ON product.id = price.id_product WHERE bill.id = detail_bill.id_order and detail_bill.id_product = product.id and product.id = price.id_product AND time(price.start_date) <= time(bill.create_date) AND time(price.end_date) >= time(bill.create_date) and bill.create_date >= date(?) and bill.create_date <= date(?) GROUP BY detail_bill.id_product ORDER BY quantity DESC");
    $stament->execute([$startDate, $endDate]);
    $stament2 = $connect->prepare("SELECT detail_bill.id_product, product.name, SUM(detail_bill.quantity) as quantity, product.price * SUM(detail_bill.quantity) as total, product.price as price FROM bill INNER JOIN detail_bill ON bill.id and detail_bill.id_order INNER JOIN product ON detail_bill.id_product INNER JOIN price ON product.id = price.id_product WHERE bill.id = detail_bill.id_order and detail_bill.id_product = product.id and product.id = price.id_product and bill.create_date >= date(?) and bill.create_date <= date(?) GROUP BY detail_bill.id_product ORDER BY quantity DESC");
    $stament2->execute([$startDate, $endDate]);
    $result = array();
    $result2 = array();
    while ($row = $stament->fetch()) {
        array_push($result, array("id" => $row['id_product'], "name" => $row["name"], "quantity" => $row["quantity"], "price" => $row["price"], "total" => $row["total"]));
    }
    while ($row = $stament2->fetch()) {
        array_push($result2, array("id" => $row['id_product'], "name" => $row["name"], "quantity" => $row["quantity"], "price" => $row["price"], "total" => $row["total"]));
    }
    $result3 = array_diff_key($result2, $result);
    echo json_encode(array_merge($result, $result3), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>