<?php
    session_start();
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];
    $stament = $connect->prepare("SELECT * from account WHERE phonenumber = ? and password = ?");
    $stament->execute([$phonenumber, $password]);
    if($stament->rowCount() == 0)
        $_SESSION['login'] = 0;
    else
        $_SESSION['login'] = 1;
    echo $stament->rowCount();
?>