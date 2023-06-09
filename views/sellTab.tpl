<div class="tab active-tab" id="sell-container">
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
            {foreach from=$products item=product}
                {if $product.price neq "Chưa có giá"}
                    <div class="product" onclick="AddProductToOrder(event, {$product.id})">
                        <img src="http://localhost/quanlycuahang/{$product.image}" alt="image" />
                        <p>{$product.name}</p>
                        <p>{$product.price}</p>
                    </div>
                {/if}
            {/foreach}
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
</div>