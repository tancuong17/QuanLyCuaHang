<?php
/* Smarty version 4.3.1, created on 2023-04-20 11:18:45
  from 'C:\xampp\htdocs\quanlycuahang\views\productTab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6441037549a750_29511113',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8740523f11bef27814c176c2b3a9cc517bce771a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\quanlycuahang\\views\\productTab.tpl',
      1 => 1681982017,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6441037549a750_29511113 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="tab" id="product-manager">
    <div id="product-manager-header">
        <p style="font-size: 1.2rem;">Danh sách sản phẩm</p>
        <div class="search-container">
            <img onclick="RefreshProduct()" src="https://cdn-icons-png.flaticon.com/512/521/521260.png"
                alt="image" class="refresh-icon" />
            <div class="form-search">
                <input placeholder="Tên sản phẩm..." id="keywordProduct" />
                <img onclick="SearchProduct()" src="https://cdn-icons-png.flaticon.com/512/3917/3917132.png"
                    alt="image" />
            </div>
            <button onclick="OpenAddProductModal()">Thêm sản phẩm</button>
            <img onclick="OpenAddProductExcelModal()" style="width: 2.5rem; height: 2.5rem;" src="https://cdn-icons-png.flaticon.com/512/888/888850.png" alt="image" />
        </div>
    </div>
    <div id="product-container">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
            <div class="product" onclick="OpenDetailProductModal(event)">
                <img src="http://localhost/quanlycuahang/<?php echo $_smarty_tpl->tpl_vars['product']->value['image'];?>
" alt="image" />
                <p>Mã: <?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
</p>
                <p><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</p>
                <p><?php echo $_smarty_tpl->tpl_vars['product']->value['price'];?>
</p>
            </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
</div>
<div id="add-product-container">
    <div class="background">
    </div>
    <div class="modal">
        <div class="modal-header">
            <p>Thêm sản phẩm</p>
            <img onclick="CloseAddProductModal()" src="https://static.thenounproject.com/png/128143-200.png"
                alt="image" />
        </div>
        <div class="modal-body">
            <label for="file">
                <img id="image" src="https://static.thenounproject.com/png/3322766-200.png" alt="image" />
            </label>
            <input type="file" id="file" onchange="UploadImage('image', 'file')" />
            <fieldset>
                <legend>Tên sản phẩm: </legend>
                <input id="name" />
            </fieldset>
        </div>
        <div class="modal-footer">
            <button onclick="AddProduct()">Thêm sản phẩm</button>
        </div>
    </div>
</div>
<div id="add-product-excel-container">
    <div class="background">
    </div>
    <div class="modal">
        <div class="modal-header">
            <p>Thêm sản phẩm từ Excel</p>
            <img onclick="CloseAddProductExcelModal()" src="https://static.thenounproject.com/png/128143-200.png"
                alt="image" />
        </div>
        <div class="modal-body">
            <div style="display: flex; align-items: center; margin: 0.5rem 0;">
                <img style="width: 2.5rem; height: 2.5rem; object-fit: cover;" src="https://cdn-icons-png.flaticon.com/512/888/888850.png" alt="image" />
                <input type="file" onchange="getDataExcel()" id="file-excel" style="width: 100%; border: 1px solid lightgreen; padding: 0.3rem;"/>
            </div>
            <div id="product-excel-container" style="display: grid; gap: 0.5rem; grid-template-columns: repeat(4, 1fr); height: 70vh; overflow: auto;">
            </div>
        </div>
        <div class="modal-footer">
            <button onclick="AddProductExcel()">Thêm sản phẩm</button>
        </div>
    </div>
</div>
<div id="update-product-container">
    <div class="background">
    </div>
    <div class="modal">
        <div class="modal-header">
            <p>Cập nhật sản phẩm</p>
            <img onclick="CloseDetailProductModal()" onclick="CloseAddProductModal()"
                src="https://static.thenounproject.com/png/128143-200.png" alt="image" />
        </div>
        <div class="modal-body">
            <label for="file-update">
                <img id="image-update" src="https://static.thenounproject.com/png/3322766-200.png" alt="image" />
            </label>
            <input type="file" id="file-update" onchange="UploadImageUpdate()" />
            <fieldset>
                <legend>Mã sản phẩm: </legend>
                <input id="id-update" disabled />
            </fieldset>
            <fieldset>
                <legend>Tên sản phẩm: </legend>
                <input id="name-update" />
            </fieldset>
        </div>
        <div class="modal-footer">
            <button onclick="UpdateProduct()">Cập nhật</button>
        </div>
    </div>
</div><?php }
}
