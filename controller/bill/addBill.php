<?php
    require "../../model/price.php";
    date_default_timezone_set("Asia/Bangkok");
    $list = $_POST['list'];
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $stament = $connect->prepare("INSERT INTO bill VALUES (?,?,?)");
    $stament->execute([null, 123456789, date("Y-m-d H:i:s")]);
    $lastId = $connect->lastInsertId();
    for ($i=0; $i < count(array_values($list)); $i++) { 
        $connect->prepare("INSERT INTO detail_bill VALUES (?,?,?)")->execute([$lastId, array_values($list[$i])[0], array_values($list[$i])[1]]);
    }
    echo $lastId;
?>