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
        <span onclick="UserModal()">Xin chào, Nguyễn Tấn Cường</span>
    </div>
    <div id="menu">
        <img onclick="CloseMenu()" src="https://static.thenounproject.com/png/128143-200.png" alt="image" />
        <p class="active" onclick="OpenTab(event, 0)">BÁN HÀNG</p>
        <p onclick="OpenTab(event, 1)">HÓA ĐƠN</p>
        <p onclick="OpenTab(event, 2)">SẢN PHẨM</p>
        <p onclick="OpenTab(event, 3)">BẢNG GIÁ</p>
        <p onclick="OpenTab(event, 4)">THỐNG KÊ</p>
    </div>
    <div id="user-modal">
        <p>Thông tin</p>
        <p>Đổi mật khẩu</p>
        <p onclick="Logout()">Đăng xuất</p>
    </div>
    <div id="tab-container">
        {include file="./sellTab.tpl"}
        {include file="./billTab.tpl"}
        {include file="./productTab.tpl"}
        {include file="./priceTab.tpl"}
        {include file="./statisticalTab.tpl"}
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="js/index"></script>
<script src="js/admin"></script>
</html>