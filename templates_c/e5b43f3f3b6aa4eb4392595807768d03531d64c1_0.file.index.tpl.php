<?php
/* Smarty version 4.3.0, created on 2023-04-12 04:53:37
  from 'C:\xampp\htdocs\quanlycuahang\views\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_64361d318a13f0_64524772',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e5b43f3f3b6aa4eb4392595807768d03531d64c1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\quanlycuahang\\views\\index.tpl',
      1 => 1680919038,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64361d318a13f0_64524772 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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
            <input placeholder="Số điện thoại..."/>
            <input type="password" placeholder="Mật khẩu..."/>
            <button onclick="Login()">ĐĂNG NHẬP</button>
        </div>
    </div>
</body>
<?php echo '<script'; ?>
 src="js/index"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"><?php echo '</script'; ?>
>
</html><?php }
}
