<?php
/* Smarty version 4.3.1, created on 2023-04-20 08:11:52
  from 'C:\xampp\htdocs\quanlycuahang\views\priceTab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6440d7a8cd4f04_74586891',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e24d1eabee0b3e09e5fd5877dbd4f31e5a7c7cae' => 
    array (
      0 => 'C:\\xampp\\htdocs\\quanlycuahang\\views\\priceTab.tpl',
      1 => 1681801332,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6440d7a8cd4f04_74586891 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="tab" id="price-manager">
    <div id="price-manager-header">
        <p style="font-size: 1.2rem;">Bảng giá</p>
        <div class="form-header">
            <div class="search-container">
                <img onclick="RefreshPrices()" src="https://cdn-icons-png.flaticon.com/512/521/521260.png"
                    alt="image" class="refresh-icon" />
                <div class="form-search">
                    <input placeholder="Tên sản phẩm..." id="keywordPrice"/>
                    <img onclick="SearchPrice()"  src="https://cdn-icons-png.flaticon.com/512/3917/3917132.png" alt="image" />
                </div>
                <button onclick="OpenAddPriceModal()">Thêm bảng giá</button>
            </div>
        </div>
    </div>
    <div id="table-price">
        <table id="prices">
            <tr>
                <th>MÃ</th>
                <th>SẢN PHẨM</th>
                <th>GIÁ</th>
                <th>NGÀY BẮT ĐẦU</th>
                <th>NGÀY KẾT THÚC</th>
                <th></th>
            </tr>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['prices']->value, 'price', false, 'i');
$_smarty_tpl->tpl_vars['price']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['price']->value) {
$_smarty_tpl->tpl_vars['price']->do_else = false;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['price']->value['id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['price']->value['nameProduct'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['price']->value['price'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['price']->value['startDate'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['price']->value['endDate'];?>
</td>
                    <td style="text-align: center;">
                        <img onclick="OpenUpdatePriceModal(event, <?php echo $_smarty_tpl->tpl_vars['price']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
, <?php echo $_smarty_tpl->tpl_vars['price']->value['idProduct'];?>
)"
                            src="https://cdn-icons-png.flaticon.com/512/875/875100.png" alt="image" />
                    </td>
                </tr>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </table>
    </div>
</div>
<div id="add-price-container">
    <div class="background">
    </div>
    <div class="modal">
        <div class="modal-header">
            <p>Thêm bảng giá</p>
            <img onclick="CloseAddPriceModal()" src="https://static.thenounproject.com/png/128143-200.png"
                alt="image" />
        </div>
        <div class="modal-body">
            <fieldset>
                <legend>Sản phẩm: </legend>
                <select id="idProduct">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                        <option value=<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </fieldset>
            <fieldset>
                <legend>Giá: </legend>
                <input type="number" min="0" id="price" />
            </fieldset>
            <fieldset>
                <legend>Ngày bắt đầu: </legend>
                <input type="date" id="startDate" />
            </fieldset>
            <fieldset>
                <legend>Ngày kết thúc: </legend>
                <input type="date" id="endDate" />
            </fieldset>
        </div>
        <div class="modal-footer">
            <button onclick="AddPrice()">Thêm bảng giá</button>
        </div>
    </div>
</div>
<div id="update-price-container">
    <div class="background">
    </div>
    <div class="modal">
        <div class="modal-header">
            <p>Cập nhật bảng giá</p>
            <img onclick="CloseUpdatePriceModal()" src="https://static.thenounproject.com/png/128143-200.png"
                alt="image" />
        </div>
        <div class="modal-body">
            <fieldset>
                <legend>Sản phẩm: </legend>
                <p id="nameProductPriceUpdate"></p>
            </fieldset>
            <fieldset>
                <legend>Giá: </legend>
                <p id="priceUpdate"></p>
            </fieldset>
            <fieldset>
                <legend>Ngày bắt đầu: </legend>
                <input type="date" id="startDateUpdate" />
            </fieldset>
            <fieldset>
                <legend>Ngày kết thúc: </legend>
                <input type="date" id="endDateUpdate" />
            </fieldset>
        </div>
        <div class="modal-footer">
            <button id="update-price-btn" onclick="UpdatePrice()">Cập nhật</button>
        </div>
    </div>
</div><?php }
}
