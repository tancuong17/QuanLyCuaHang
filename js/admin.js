let check = 0;
let idProduct = 0;
let totalPay = 0;
let listIdProductInOrder = new Array();
function OpenMenu() {
    document.getElementById("menu").style.left = "0";
}
function CloseMenu() {
    document.getElementById("menu").style.left = "-15%";
}
function UserModal() {
    if (check == 0) {
        document.getElementById("user-modal").style.display = "flex";
        check = 1;
    }
    else {
        document.getElementById("user-modal").style.display = "none";
        check = 0;
    }
}
function OpenTab(e, index) {
    let menuItem = document.querySelectorAll("#menu p");
    let tab = document.getElementsByClassName("tab");
    for (let j = 0; j < menuItem.length; j++) {
        menuItem[j].style.background = "whitesmoke";
    }
    for (let i = 0; i < tab.length; i++) {
        if (i == index)
            tab[i].style.display = "grid";
        else
            tab[i].style.display = "none";
    }
    e.target.style.background = "white";
    CloseMenu();
}

function OpenAddProductModal() {
    document.getElementById("add-product-container").style.display = "grid";
}

function CloseAddProductModal() {
    document.getElementById("add-product-container").style.display = "none";
}

function OpenDetailOrderModal(e, idBill) {
    let tr = document.querySelectorAll("#table-product-in-bill tr");
    for (let j = 1; j < tr.length; j++) {
        tr[j].remove();
    }
    document.getElementById("detail-order-container").style.display = "grid";
    document.getElementById("idBill").innerHTML = "Mã hóa đơn: " + e.target.parentElement.parentElement.children[0].innerHTML;
    document.getElementById("quantityInOrder").innerHTML = "Số lượng đồ uống: " + e.target.parentElement.parentElement.children[1].innerHTML;
    document.getElementById("totalPrice").innerHTML = "Tổng tiền: " + e.target.parentElement.parentElement.children[3].innerHTML;
    document.getElementById("createDate").innerHTML = "Ngày mua: " + e.target.parentElement.parentElement.children[2].innerHTML;
    document.getElementById("manSell").innerHTML = "Người bán: " + e.target.parentElement.parentElement.children[4].innerHTML;
    $.ajax({
        url: "http://localhost/quanlycuahang/api/getBill",
        type: "post",
        dataType: "json",
        data: { "id": idBill },
        success: function (result) {
            for (let i = 0; i < result.length; i++) {
                $("#table-product-in-bill").append(`
                <tr>
                    <td>`+ result[i].name + `</td>
                    <td>`+ result[i].quantity + `</td>
                    <td>`+ result[i].price.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + "đ" + `</td>
                    <td>`+ (result[i].price * result[i].quantity).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + "đ" + `</td>
                </tr>
            `);
            }
        }
    });
}

function CloseDetailOrderModal() {
    document.getElementById("detail-order-container").style.display = "none";
}

function OpenDetailProductModal(e) {
    document.getElementById("image-update").src = e.target.children[0].src;
    document.getElementById("id-update").value = e.target.children[1].innerHTML.slice(3);
    document.getElementById("name-update").value = e.target.children[2].innerHTML;
    document.getElementById("update-product-container").style.display = "grid";
}

function CloseDetailProductModal() {
    document.getElementById("update-product-container").style.display = "none";
}

function UploadImage() {
    let file = document.getElementById("file");
    let fr = new FileReader();
    fr.readAsDataURL(file.files[0]);
    fr.addEventListener('load', () => {
        const url = fr.result;
        document.getElementById("image").src = url;
    })
}

function UploadImageUpdate() {
    let file = document.getElementById("file-update");
    let fr = new FileReader();
    fr.readAsDataURL(file.files[0]);
    fr.addEventListener('load', () => {
        const url = fr.result;
        document.getElementById("image-update").src = url;
    })
}

function AddProduct() {
    let name = document.getElementById("name").value;
    let form_data = new FormData();
    form_data.append("name", name);
    form_data.append("file", $('#file').prop('files')[0]);
    if (name == "") {
        alert("Bạn chưa nhập tên sản phẩm!");
    }
    else if ($('#file').val() == "") {
        alert("Bạn chưa chọn ảnh sản phẩm!");
    }
    else {
        $.ajax({
            url: "http://localhost/quanlycuahang/api/addProduct",
            type: "post",
            contentType: false,
            processData: false,
            dataType: "json",
            data: form_data,
            success: function (result) {
                $("#product-container").prepend(`
                <div class="product" onclick="OpenDetailProductModal(event)">
                    <img src="http://localhost/quanlycuahang/`+ result.image + `" alt="image" />
                    <p>Mã: `+ result.id + `</p>
                    <p>`+ result.name + `</p>
                    <p>Chưa có giá</p>
                </div>
            `);
                CloseAddProductModal();
            }
        });
    }
}

function UpdateProduct() {
    let id = document.getElementById("id-update").value;
    let name = document.getElementById("name-update").value;
    let form_data = new FormData();
    form_data.append("id", id);
    form_data.append("name", name);
    form_data.append("file", $('#file-update').prop('files')[0]);
    if (name == "") {
        alert("Bạn chưa nhập tên sản phẩm!");
    }
    else {
        $.ajax({
            url: "http://localhost/quanlycuahang/api/updateProduct",
            type: "post",
            contentType: false,
            processData: false,
            dataType: "json",
            data: form_data,
            success: function (result) {
                console.log(result);
                CloseDetailProductModal();
                let product = document.getElementsByClassName("product");
                for (let i = 0; i < product.length; i++) {
                    if (product[i].children[1].innerHTML == "Mã:" + result.id) {
                        product[i].children[0].src = "http://localhost/quanlycuahang/" + result.image;
                        product[i].children[2].innerHTML = result.name;
                    }
                }
            }
        });
    }
}

function OpenAddPriceModal() {
    document.getElementById("add-price-container").style.display = "grid";
    $("#startDate").attr("min", new Date().toISOString().slice(0, 10));
    $("#endDate").attr("min", new Date().toISOString().slice(0, 10));
    $("#startDate").val(new Date().toISOString().slice(0, 10));
    $("#endDate").val(new Date().toISOString().slice(0, 10));
}

function CloseAddPriceModal() {
    document.getElementById("add-price-container").style.display = "none";
}

function AddPrice() {
    let idProduct = $("#idProduct").val();
    let price = $("#price").val();
    let startDate = $("#startDate").val();
    let endDate = $("#endDate").val();
    console.log(idProduct);
    if (price <= 0)
        alert("Giá sản phẩm phải lớn 0");
    else if (new Date(startDate).getTime() > new Date(endDate).getTime())
        alert("Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc!");
    else {
        let form_data = new FormData();
        form_data.append("idProduct", idProduct);
        form_data.append("price", price);
        form_data.append("startDate", startDate);
        form_data.append("endDate", endDate);
        $.ajax({
            url: "http://localhost/quanlycuahang/api/addPrice",
            type: "post",
            contentType: false,
            processData: false,
            dataType: "json",
            data: form_data,
            success: function (result) {
                if (result.result == 0)
                    alert("Thêm bảng giá không thành công vì bảng giá này đã tồn tại!");
                else {
                    alert("Thêm bảng giá thành công!");
                    $("#prices").append(`
                        <tr>
                            <td>`+ result.nameProduct + `</td>
                            <td>`+ result.price.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + "đ" + `</td>
                            <td>`+ result.startDate + `</td>
                            <td>`+ result.endDate + `</td>
                            <td style="text-align: center;">
                                <img onclick="OpenUpdatePriceModal(event)" src="https://cdn-icons-png.flaticon.com/512/875/875100.png" alt="image" />
                            </td>
                        </tr>
                    `);
                    CloseAddPriceModal();
                }
            }
        });
    }
}

function OpenUpdatePriceModal(e, id) {
    idProduct = id;
    document.getElementById("nameProductPriceUpdate").innerHTML = e.target.parentElement.parentElement.children[0].innerHTML;
    document.getElementById("priceUpdate").innerHTML = e.target.parentElement.parentElement.children[1].innerHTML;
    if (new Date(e.target.parentElement.parentElement.children[2].innerHTML).getTime() < new Date().getTime()) {
        document.getElementById("startDateUpdate").disabled = true;
    }
    else {
        document.getElementById("startDateUpdate").disabled = false;
        $("#endDateUpdate").attr("min", new Date().toISOString().slice(0, 10));
    }
    if (new Date(e.target.parentElement.parentElement.children[3].innerHTML).getTime() < new Date().getTime()) {
        document.getElementById("endDateUpdate").disabled = true;
        document.getElementById("update-price-btn").disabled = true;
    }
    else {
        document.getElementById("endDateUpdate").disabled = false;
        document.getElementById("update-price-btn").disabled = false;
        $("#startDateUpdate").attr("min", new Date().toISOString().slice(0, 10));
        $("#endDateUpdate").attr("min", new Date().toISOString().slice(0, 10));
    }
    document.getElementById("startDateUpdate").value = e.target.parentElement.parentElement.children[2].innerHTML;
    document.getElementById("endDateUpdate").value = e.target.parentElement.parentElement.children[3].innerHTML;
    document.getElementById("update-price-container").style.display = "grid";
}

function CloseUpdatePriceModal() {
    document.getElementById("update-price-container").style.display = "none";
}

function UpdatePrice() {
    let startDate = $("#startDateUpdate").val();
    let endDate = $("#endDateUpdate").val();
    console.log(startDate);
    console.log(endDate);
    if (new Date(startDate).getTime() > new Date(endDate).getTime())
        alert("Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc!");
    else {
        let form_data = new FormData();
        form_data.append("idProduct", idProduct);
        form_data.append("startDate", startDate);
        form_data.append("endDate", endDate);
        $.ajax({
            url: "http://localhost/quanlycuahang/api/updatePrice",
            type: "post",
            contentType: false,
            processData: false,
            dataType: "json",
            data: form_data,
            success: function (result) {
                alert("Cập nhật thành công!");
                console.log(result);
                CloseUpdatePriceModal();
            }
        });
    }
}

function AddProductToOrder(e, id) {
    let checkList = listIdProductInOrder.includes(id);
    if (!checkList)
        listIdProductInOrder.push(id);
    let nameProduct = document.getElementsByClassName("name-product");
    let quantityElement = document.getElementsByClassName("quantity");
    let name = e.target.children[1].innerHTML;
    let price = e.target.children[2].innerHTML;
    let check = true;
    if (price == "Chưa có giá")
        alert("Không thể thêm vào hóa đơn vì sản phẩm chưa có giá!");
    else {
        for (let i = 0; i < nameProduct.length; i++) {
            if (nameProduct[i].innerHTML == name) {
                check = false;
                quantityElement[i].value = Number(quantityElement[i].value) + 1;
                break;
            }
        }
        if (check) {
            $("#table-order").append(`
        <tr>
            <td class="name-product">`+ name + `</td>
            <td>`+ price + `</td>
            <td><input class="quantity" min="1" type="number" value="1" onchange="ChangeQuantity()"/></td>
            <td style="text-align: center;">
                <img onclick="RemoveProductFromOrder(event, `+ id + `)" src="https://icons-for-free.com/iconfiles/png/512/x-1321215629555778185.png" alt="image" />
            </td>
        </tr>
    `);
        }
        ChangeQuantity();
        console.log(listIdProductInOrder);
    }
}

function RemoveProductFromOrder(e, idRemove) {
    listIdProductInOrder = listIdProductInOrder.filter(id => id != idRemove);
    $(e.target.parentElement.parentElement).remove();
    let quantity = $("#quantity-in-order").text().slice(9);
    $("#quantity-in-order").text("Số lượng: " + (Number(quantity) - e.target.parentElement.parentElement.children[2].children[0].value));
}

function ChangeQuantity() {
    let quantityElement = document.getElementsByClassName("quantity");
    let total = 0;
    for (let i = 0; i < quantityElement.length; i++) {
        total += Number(quantityElement[i].value);
    }
    $("#quantity-in-order").text("Số lượng: " + total);
}

function Pay() {
    let listProductInOrder = new Array();
    let quantityElement = document.getElementsByClassName("quantity");
    for (let i = 0; i < quantityElement.length; i++) {
        listProductInOrder.push({ "id": listIdProductInOrder[i], "quantity": quantityElement[i].value });
    }
    if (quantityElement.length == 0)
        alert("Không tạo hóa đơn thành công vì hóa đơn chưa có sản phẩm!");
    else {
        $.ajax({
            url: "http://localhost/quanlycuahang/api/addBill",
            type: "post",
            dataType: "text",
            data: { "list": listProductInOrder },
            success: function (result) {
                alert("Thêm hóa đơn thành công!");
                let items = document.querySelectorAll("#table-order tr");
                var a = window.open('', '', 'height=500, width=500');
                a.document.write('<html>');
                a.document.write(`<body >
                        <p style="text-align: center">NTC MilkTea</p>
                        <p style="text-align: center; font-size: 0.7rem">Đ/c: 161 Phan Huy Ích, phường 12, quận Gò Vấp, TPHCM</p>
                        <p style="text-align: center; font-size: 0.7rem">Sđt: 0358698521</p>
                        <p>Mã hóa đơn: `+ result + `</p>
                        <p>Ngày tạo: `+ new Date().toLocaleString() + `</p>
                        <table style="border: 1px solid lightgray;width: 100%;text-align: left;">
                            <tr >
                                <th>Thức uống</th>
                                <th>ĐG</th>
                                <th>SL</th>
                                <th>T.Tiền</th>
                            </tr>
                    `);
                for (let i = 1; i < items.length; i++) {

                    let str1 = items[i].children[1].innerHTML.replace(",", "");
                    let str2 = str1.replace("đ", "");
                    let priceTotal = Number(str2) * items[i].children[2].children[0].value;
                    totalPay += priceTotal;
                    a.document.write(`<tr >
                            <td >`+ items[i].children[0].innerHTML + `</td >
                            <td>`+ items[i].children[1].innerHTML + `</td>
                            <td>`+ items[i].children[2].children[0].value + `</td>
                            <td>`+ priceTotal.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + "đ" + `</td>
                        </tr > `);
                }
                a.document.write(`<p>Tổng tiền: ` + totalPay.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + `đ</p>`);
                a.document.write('</table></body></html>');
                a.document.close();
                a.print();
                listIdProductInOrder = [];
                let tr = document.querySelectorAll("#table-order tr");
                for (let i = 1; i < tr.length; i++) {
                    tr[i].remove();
                }
                $("#quantity-in-order").text("Số lượng: 0");
            }
        });
    }
}

function SearchProductChoose() {
    document.getElementsByClassName("product-choose-body")[0].style.gridTemplateColumns = "repeat(5, 1fr)";
    let keyword = $("#keyword").val();
    let products = document.querySelectorAll("#containerChoose .product");
    if (keyword == "")
        alert("Bạn chưa nhập từ khóa!")
    else {
        for (let i = 0; i < products.length; i++) {
            products[i].remove();
        }
        if ($("#false"))
            $("#false").remove();
        $.ajax({
            url: "http://localhost/quanlycuahang/api/searchProduct",
            type: "post",
            dataType: "json",
            data: { "keyword": keyword },
            success: function (result) {
                if (result.length > 1) {
                    for (let i = 0; i < result.length; i++) {
                        if (result[i].price != null) {
                            $("#containerChoose").append(`
                            <div class="product" onclick="AddProductToOrder(event, `+ result[i].id + `)">
                                <img src="`+ result[i].image + `" alt="image" />
                                <p>`+ result[i].name + `</p>
                                <p>`+ result[i].price.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + `đ</p>
                            </div>
                        `);
                        }
                    }
                }
                else if (result.length == 1) {
                    if (result[0].price == null) {
                        document.getElementsByClassName("product-choose-body")[0].style.gridTemplateColumns = "repeat(1, 1fr)";
                        $("#containerChoose").append(`
                        <p id="false">Không tìm thấy sản phẩm!</p>`);
                    }
                    else {
                        $("#containerChoose").append(`
                        <div class="product" onclick="AddProductToOrder(event, `+ result[0].id + `)">
                            <img src="`+ result[0].image + `" alt="image" />
                            <p>`+ result[0].name + `</p>
                            <p>`+ result[0].price.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + `đ</p>
                        </div>`);
                    }
                }
                else {
                    document.getElementsByClassName("product-choose-body")[0].style.gridTemplateColumns = "repeat(1, 1fr)";
                    $("#containerChoose").append(`
                    <p id="false">Không tìm thấy sản phẩm!</p>
                `);
                }
            }
        });
    }
}

function RefreshProductChoose() {
    document.getElementsByClassName("product-choose-body")[0].style.gridTemplateColumns = "repeat(5, 1fr)";
    let products = document.querySelectorAll("#containerChoose .product");
    for (let i = 0; i < products.length; i++) {
        products[i].remove();
    }
    $("#false").remove();
    $.getJSON("http://localhost/quanlycuahang/api/getProducts", function (data, status) {
        for (let i = 0; i < data.length; i++) {
            if (data[i].price != "Chưa có giá") {
                $("#containerChoose").append(`
                    <div class= "product" onclick = "AddProductToOrder(event, `+ data[i].id + `)">
                        <img src="`+ data[i].image + `" alt="image" />
                        <p>`+ data[i].name + `</p>
                        <p>`+ data[i].price + `</p>
                    </div >
                    `);
            }
        }
    });
}

function SearchBill() {
    let keyword = $("#keywordBill").val();
    if (keyword == "")
        alert("Bạn chưa nhập mã hóa đơn!");
    else {
        $.ajax({
            type: "post",
            url: "http://localhost/quanlycuahang/api/searchBill",
            data: { keyword: keyword },
            dataType: "json",
            success: function (response) {
                if (response != null) {
                    let tr = document.querySelectorAll("#bill-table table tr");
                    for (let i = 1; i < tr.length; i++) {
                        tr[i].remove();
                    }
                    $("#bill-table table").append(`
                        <tr>
                            <td>`+ response.id + `</td>
                            <td>`+ response.quantity + `</td>
                            <td>`+ response.createDate + `</td>
                            <td>`+ response.total + `</td>
                            <td>`+ response.name + `</td>
                            <td style="text-align: center;">
                                <img onclick="OpenDetailOrderModal(event, `+ response.id + `)"
                                    src="https://cdn-icons-png.flaticon.com/512/4305/4305363.png" alt="image" />
                            </td>
                        </tr>
                    `);
                }
                else
                    alert("Không tìm thấy hóa đơn!");
            }
        });
    }
}

function RefreshBill() {
    let tr = document.querySelectorAll("#bill-table table tr");
    for (let i = 1; i < tr.length; i++) {
        tr[i].remove();
    }
    $.getJSON("http://localhost/quanlycuahang/api/getBills",
        function (data, textStatus, jqXHR) {
            for (let i = 0; i < data.length; i++) {
                $("#bill-table table").append(`
                        <tr>
                            <td>`+ data[i].id + `</td>
                            <td>`+ data[i].quantity + `</td>
                            <td>`+ data[i].createDate + `</td>
                            <td>`+ data[i].total + `</td>
                            <td>`+ data[i].name + `</td>
                            <td style="text-align: center;">
                                <img onclick="OpenDetailOrderModal(event, `+ data[i].id + `)"
                                    src="https://cdn-icons-png.flaticon.com/512/4305/4305363.png" alt="image" />
                            </td>
                        </tr>
                    `);
            }
        }
    );
}

function SearchProduct() {
    let keyword = $("#keywordProduct").val();
    if (keyword == "")
        alert("Bạn chưa nhập từ khóa!")
    else {
        $.ajax({
            url: "http://localhost/quanlycuahang/api/searchProduct",
            type: "post",
            dataType: "json",
            data: { "keyword": keyword },
            success: function (result) {
                if (result.length > 1) {
                    let products = document.querySelectorAll("#product-container .product");
                    for (let i = 0; i < products.length; i++) {
                        products[i].remove();
                    }
                    for (let i = 0; i < result.length; i++) {
                        if (result[i].price != null) {
                            $("#product-container").prepend(`
                                <div class="product" onclick="OpenDetailProductModal(event)">
                                    <img src="http://localhost/quanlycuahang/`+ result[i].image + `" alt="image" />
                                    <p>Mã: `+ result[i].id + `</p>
                                    <p>`+ result[i].name + `</p>
                                    <p>Chưa có giá</p>
                                </div>`);
                        }
                    }
                }
                else {
                    alert("Không tìm thấy sản phẩm!");
                }
            }
        });
    }
}

function RefreshProduct() {
    let products = document.querySelectorAll("#product-container .product");
    for (let i = 0; i < products.length; i++) {
        products[i].remove();
    }
    $.getJSON("http://localhost/quanlycuahang/api/getProducts", function (data, status) {
        for (let i = 0; i < data.length; i++) {
            $("#product-container").prepend(`
                <div class="product" onclick="OpenDetailProductModal(event)">
                    <img src="http://localhost/quanlycuahang/`+ data[i].image + `" alt="image" />
                    <p>Mã: `+ data[i].id + `</p>
                    <p>`+ data[i].name + `</p>
                    <p>Chưa có giá</p>
                </div>`);
        }
    });
}