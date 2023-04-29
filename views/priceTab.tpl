<div class="tab" id="price-manager">
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
            {foreach from=$prices key=i item=price}
                <tr>
                    <td>{$price.id}</td>
                    <td>{$price.nameProduct}</td>
                    <td>{$price.price}</td>
                    <td>{$price.startDate}</td>
                    <td>{$price.endDate}</td>
                    <td style="text-align: center;">
                        <img onclick="OpenUpdatePriceModal(event, {$price.id}, {$i + 1}, {$price.idProduct})"
                            src="https://cdn-icons-png.flaticon.com/512/875/875100.png" alt="image" />
                    </td>
                </tr>
            {/foreach}
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
                </select>
            </fieldset>
            <fieldset>
                <legend>Giá: </legend>
                <input type="text" min="0" id="price" class="number-separator"/>
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
</div>