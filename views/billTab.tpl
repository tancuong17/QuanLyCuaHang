<div class="tab" id="order-manager">
    <div id="order-manager-header">
        <p style="font-size: 1.2rem;">Danh sách hóa đơn</p>
        <div class="form-search">
            <input placeholder="Mã hóa đơn..." />
            <img src="https://cdn-icons-png.flaticon.com/512/3917/3917132.png" alt="image" />
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
                {foreach from=$bills item=bill}
                    <tr>
                        <td>{$bill.id}</td>
                        <td>{$bill.quantity}</td>
                        <td>{$bill.createDate}</td>
                        <td>{$bill.total}</td>
                        <td>{$bill.name}</td>
                        <td style="text-align: center;">
                            <img onclick="OpenDetailOrderModal(event, {$bill.id})" src="https://cdn-icons-png.flaticon.com/512/4305/4305363.png" alt="image" />
                        </td>
                    </tr>
                {/foreach}
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
                        <th>Size</th>
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
</div>