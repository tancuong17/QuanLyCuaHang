<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/2794/2794430.png">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <div id="login-container">
        <div id="login">
            <span>NTC MILKTEA</span>
            <input placeholder="Số điện thoại..." id="phonenumber" value="0382572663"/>
            <input type="password" placeholder="Mật khẩu..." id="password" value="0123456789"/>
            <button onclick="Login()">ĐĂNG NHẬP</button>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="js/authentication"></script>
<script src="js/index"></script>
</html>