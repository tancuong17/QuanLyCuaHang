<?php
/* Smarty version 4.3.1, created on 2023-05-18 10:23:55
  from 'C:\xampp\htdocs\quanlycuahang\views\admin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6465e09b044953_30396705',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a160a5db1f943bc0ab0c114eae55d31460a6ccd6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\quanlycuahang\\views\\admin.tpl',
      1 => 1684220602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./sellTab.tpl' => 1,
    'file:./billTab.tpl' => 1,
    'file:./productTab.tpl' => 1,
    'file:./statisticalTab.tpl' => 1,
  ),
),false)) {
function content_6465e09b044953_30396705 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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
        <?php $_smarty_tpl->_subTemplateRender("file:./sellTab.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php $_smarty_tpl->_subTemplateRender("file:./billTab.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php $_smarty_tpl->_subTemplateRender("file:./productTab.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php $_smarty_tpl->_subTemplateRender("file:./statisticalTab.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>
</body>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/gh/amiryxe/easy-number-separator/easy-number-separator.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/authentication"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/admin"><?php echo '</script'; ?>
>
</html><?php }
}
