<?php
/* Smarty version 4.3.1, created on 2023-05-18 10:23:55
  from 'C:\xampp\htdocs\quanlycuahang\views\billTab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6465e09b85bf87_91479543',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '049dab13674ffebd89aa41fb1cfa5bea58828ae8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\quanlycuahang\\views\\billTab.tpl',
      1 => 1684313997,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6465e09b85bf87_91479543 (Smarty_Internal_Template $_smarty_tpl) {
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
            <table id="table-of-bill">
                <tr>
                    <th>MÃ</th>
                    <th>SỐ LƯỢNG SẢN PHẨM</th>
                    <th>NGÀY MUA</th>
                    <th>NGƯỜI BÁN</th>
                    <th></th>
                </tr>
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
                        <th>SẢN PHẨM</th>
                        <th>SL</th>
                        <th>ĐG</th>
                        <th>T.TIỀN</th>
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
