<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/2794/2794430.png">
    <link rel="stylesheet" href="css/admin">
</head>
<body>
    <div id="header">
        <div>
            <img onclick="OpenMenu()" src="https://cdn-icons-png.flaticon.com/512/5036/5036960.png" alt="image" />
            <p>NTC MILKTEA</p>
        </div>
        <div>
            <span onclick="UserModal()" id="name"></span>
            <p id="logout" style="font-size: 1rem; border: 1px solid rgb(155, 9, 9); background-color: rgb(155, 9, 9); color: white; padding: 0.2rem 0.3rem; border-radius: 0.3rem;" onclick="Logout()">Đăng xuất</p>
        </div>
    </div>
    <div id="menu">
        <img onclick="CloseMenu()" src="https://static.thenounproject.com/png/128143-200.png" alt="image" />
        <p class="active" onclick="OpenTab(0)">BÁN HÀNG</p>
        <p onclick="OpenTab(1)">HÓA ĐƠN</p>
        <p onclick="OpenTab(2)">SẢN PHẨM</p>
        <p onclick="OpenTab(3)" id="export-excel">THỐNG KÊ</p>
    </div>
    <div id="tab-container">
        {include file="./sellTab.tpl"}
        {include file="./billTab.tpl"}
        {include file="./productTab.tpl"}
        {include file="./statisticalTab.tpl"}
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/amiryxe/easy-number-separator/easy-number-separator.js"></script>
<script src="js/authentication"></script>
<script src="js/admin"></script>
</html>