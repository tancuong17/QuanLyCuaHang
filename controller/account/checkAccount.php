<?php
    require "../../vendor/autoload.php";
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    session_start();
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];
    $stament = $connect->prepare("SELECT * from account WHERE phonenumber = ? and password = ?");
    $stament->execute([$phonenumber, $password]);
    $row = $stament->fetch();
    if($stament->rowCount() == 0)
        $_SESSION['login'] = 0;
    else
        $_SESSION['login'] = 1;
    $key = 'NTC17';
    $payload = [
        'iss' => 'localhost',
        'aud' => 'localhost',
        'iat' =>  1356999524,
        'nbf' => 1357000000
    ];
    $jwt = JWT::encode($payload, $key, 'HS256');
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
    echo json_encode(array("jwt" => $jwt, "phonenumber" => $row['phonenumber'], "name" => $row['name'], "role" => $row['role'], "check" => $stament->rowCount()));
?>