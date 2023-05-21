<?php
/* Smarty version 4.3.1, created on 2023-05-18 10:23:55
  from 'C:\xampp\htdocs\quanlycuahang\views\sellTab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6465e09b396fb8_54127098',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c0de9e7feaaaecacc061374d66f0b8cf8404f180' => 
    array (
      0 => 'C:\\xampp\\htdocs\\quanlycuahang\\views\\sellTab.tpl',
      1 => 1682519979,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6465e09b396fb8_54127098 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="tab active-tab" id="sell-container">
    <div class="product-choose-container">
        <div class="product-choose-header">
            <p style="font-size: 1.2rem;">Sản phẩm
            </p>
            <div class="search-container">
                <img onclick="RefreshProductChoose()" src="https://cdn-icons-png.flaticon.com/512/521/521260.png"
                    alt="image" class="refresh-icon" />
                <div class="form-search">
                    <input placeholder="Tên sản phẩm..." id="keyword" />
                    <img onclick="SearchProductChoose()" src="https://cdn-icons-png.flaticon.com/512/3917/3917132.png"
                        alt="image" />
                </div>
            </div>
        </div>
        <div class="product-choose-body" id="containerChoose" style="position: relative;">
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
            <div id="load-product"
                style="width: 100%; height: 80vh; position: absolute; gap: 0.5rem; display: none; justify-content: center; align-items: center; flex-direction: column;">
                <img style="width: 10rem; height: 10rem; object-fit: cover;border-radius: 50%;"
                    src="https://media.tenor.com/YUF4morhOVcAAAAM/peach-cat-boba-tea.gif" />
                <p>Đang tải chờ xíu!</p>
            </div>
            <div id="no-result-product"
                style="width: 100%; height: 80vh; position: absolute; gap: 0.5rem; display: none; justify-content: center; align-items: center; flex-direction: column;">
                <img style="width: 10rem; height: 10rem; object-fit: cover; border-radius: 50%;"
                    src="https://media.tenor.com/6-uKeByY478AAAAM/imissyoulods-brrt-brrt.gif" />
                <p>Không tìm thấy sản phẩm nào!</p>
            </div>
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
                        <th>SẢN PHẨM</th>
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
