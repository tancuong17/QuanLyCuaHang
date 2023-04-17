<?php
/* Smarty version 4.3.0, created on 2023-04-17 07:41:02
  from 'C:\xampp\htdocs\quanlycuahang\views\billTab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_643cdbee7fd4b0_64710593',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '049dab13674ffebd89aa41fb1cfa5bea58828ae8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\quanlycuahang\\views\\billTab.tpl',
      1 => 1681708036,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_643cdbee7fd4b0_64710593 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="tab" id="order-manager">
    <div id="order-manager-header">
        <p style="font-size: 1.2rem;">Danh sách hóa đơn</p>
        <div class="search-container">
            <img onclick="RefreshBill()" src="https://cdn-icons-png.flaticon.com/512/521/521260.png" alt="image"
                class="refresh-icon" />
            <div class="form-search">
                <input id="keywordBill" placeholder="Mã hóa đơn..." />
                <img onclick="SearchBill()" src="https://cdn-icons-png.flaticon.com/512/3917/3917132.png" alt="image" />
            </div>
        </div>
    </div>
    <div id="order-container">
        <div id="bill-table">
            <table>
                <tr>
                    <th>Mã hóa đơn</th>
                    <th>Số lượng đồ uống</th>
                    <th>Ngày mua</th>
                    <th>Tổng tiền</th>
                    <th>Người bán</th>
                    <th></th>
                </tr>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bills']->value, 'bill');
$_smarty_tpl->tpl_vars['bill']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['bill']->value) {
$_smarty_tpl->tpl_vars['bill']->do_else = false;
?>
                    <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['bill']->value['id'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['bill']->value['quantity'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['bill']->value['createDate'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['bill']->value['total'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['bill']->value['name'];?>
</td>
                        <td style="text-align: center;">
                            <img onclick="OpenDetailOrderModal(event, <?php echo $_smarty_tpl->tpl_vars['bill']->value['id'];?>
)"
                                src="https://cdn-icons-png.flaticon.com/512/4305/4305363.png" alt="image" />
                        </td>
                    </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </table>
        </div>
    </div>
</div>
<div id="detail-order-container">
    <div class="background">
    </div>
    <div class="modal">
        <div class="modal-header">
            <p>Chi tiết hóa đơn</p>
            <img onclick="CloseDetailOrderModal()" src="https://static.thenounproject.com/png/128143-200.png"
                alt="image" />
        </div>
        <div class="modal-body">
            <p id="idBill"></p>
            <p id="quantityInOrder"></p>
            <p id="totalPrice"></p>
            <p id="createDate"></p>
            <p id="manSell"></p>
            <div id="table">
                <table id="table-product-in-bill">
                    <tr>
                        <th>Thức uống</th>
                        <th>SL</th>
                        <th>ĐG</th>
                        <th>T.Tiền</th>
                    </tr>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <p>Tổng tiền: 25,000đ</p>
        </div>
    </div>
</div><?php }
}
