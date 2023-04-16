<?php
/* Smarty version 4.3.0, created on 2023-04-15 03:38:23
  from 'C:\xampp\htdocs\quanlycuahang\views\sellTab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_643a000f5f8e25_39542261',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c0de9e7feaaaecacc061374d66f0b8cf8404f180' => 
    array (
      0 => 'C:\\xampp\\htdocs\\quanlycuahang\\views\\sellTab.tpl',
      1 => 1681521633,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_643a000f5f8e25_39542261 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="tab active-tab" id="sell-container">
    <div class="product-choose-container">
        <div class="product-choose-header">
            <p style="font-size: 1.2rem;">Sản phẩm</p>
            <div class="search-container">
                <img onclick="RefreshProductChoose()" src="https://cdn-icons-png.flaticon.com/512/521/521260.png" alt="image" class="refresh-icon"/>
                <div class="form-search">
                    <input placeholder="Tên sản phẩm..." id="keyword"/>
                    <img onclick="SearchProduct()" src="https://cdn-icons-png.flaticon.com/512/3917/3917132.png" alt="image" />
                </div>
            </div>
        </div>
        <div class="product-choose-body" id="containerChoose">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                <?php if ($_smarty_tpl->tpl_vars['product']->value['price'] != "Chưa có giá") {?>
                    <div class="product" onclick="AddProductToOrder(event, <?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
)">
                        <img src="http://localhost/quanlycuahang/<?php echo $_smarty_tpl->tpl_vars['product']->value['image'];?>
" alt="image" />
                        <p><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</p>
                        <p><?php echo $_smarty_tpl->tpl_vars['product']->value['price'];?>
</p>
                    </div>
                <?php }?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
    </div>
    <div id="create-order-container">
        <div class="create-order-header">
            <p>Hóa đơn</p>
        </div>
        <div class="create-order-body">
            <div id="table">
                <table id="table-order">
                    <tr>
                        <th>Thức uống</th>
                        <th>ĐG</th>
                        <th>SL</th>
                        <th></th>
                    </tr>
                </table>
            </div>
        </div>
        <div class="create-order-footer">
            <p id="quantity-in-order">Số lượng: 0</p>
            <button onclick="Pay()">Thanh toán</button>
        </div>
    </div>
</div><?php }
}
