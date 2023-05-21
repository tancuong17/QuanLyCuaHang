let check = 0;
let idPrice = 0;
let idProductChoose = 0;
let listIdProductInOrder = new Array();
let priceChoose = 0;
let dataExcel = new Array();
let checkExcel = 0;

if (JSON.parse(localStorage.getItem("user")).role == "0") {
    document.getElementById("export-excel").style.display = "block";
    document.getElementById("name").innerHTML = "Xin chào, Quản lý " + JSON.parse(localStorage.getItem("user")).name;
}
else {
    document.getElementById("export-excel").style.display = "none";
    document.getElementById("name").innerHTML = "Xin chào, Nhân viên  " + JSON.parse(localStorage.getItem("user")).name;
}

if (localStorage.getItem("tab") == null)
    localStorage.setItem("tab", 0);

OpenTab(Number(localStorage.getItem("tab")));


function Logout() {
    $.ajax({
        type: "get",
        url: "http://localhost/quanlycuahang/api/logout",
        dataType: "text",
        success: function (response) {
            localStorage.setItem("tab", 0);
            window.location.href = "http://localhost/quanlycuahang/";
        }
    });
}

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
function OpenTab(index) {
    localStorage.setItem("tab", index);
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
    if (index == 0) {
        RefreshProductChoose();
    }
    else if (index == 1) {
        RefreshBill();
    }
    else if (index == 2) {
        RefreshProduct();
        easyNumberSeparator({
            selector: '.number-separator',
            separator: ','
        });
        if (JSON.parse(localStorage.getItem("user")).role == "0") {
            document.getElementById("add-product-btn").style.display = "block";
            document.getElementById("add-product-excel-btn").style.display = "block";
            document.getElementById("update-product-btn").style.display = "block";
        }
        else {
            document.getElementById("add-product-btn").style.display = "none";
            document.getElementById("add-product-excel-btn").style.display = "none";
            document.getElementById("update-product-btn").style.display = "none";
        }
    }
    menuItem[index].style.background = "white";
    CloseMenu();
}

function OpenAddProductModal() {
    document.getElementById("add-product-container").style.display = "grid";
}

function CloseAddProductModal() {
    document.getElementById("add-product-container").style.display = "none";
}

function OpenAddProductExcelModal() {
    document.getElementById("add-product-excel-container").style.display = "grid";
}

function CloseAddProductExcelModal() {
    document.getElementById("add-product-excel-container").style.display = "none";
}


function OpenDetailOrderModal(e, idBill) {
    let totalMoney = 0;
    let tr = document.querySelectorAll("#table-product-in-bill tr");
    for (let j = 1; j < tr.length; j++) {
        tr[j].remove();
    }
    document.getElementById("detail-order-container").style.display = "grid";
    document.getElementById("idBill").innerHTML = "Mã hóa đơn: " + e.target.parentElement.parentElement.children[0].innerHTML;
    document.getElementById("quantityInOrder").innerHTML = "Số lượng đồ uống: " + e.target.parentElement.parentElement.children[1].innerHTML;
    document.getElementById("createDate").innerHTML = "Ngày mua: " + e.target.parentElement.parentElement.children[2].innerHTML;
    document.getElementById("manSell").innerHTML = "Người bán: " + e.target.parentElement.parentElement.children[3].innerHTML;
    $.ajax({
        url: "http://localhost/quanlycuahang/api/getBill",
        type: "post",
        dataType: "json",
        data: { "id": idBill },
        success: function (result) {
            for (let i = 0; i < result.length; i++) {
                console.log(result[i].price);
                totalMoney += Number(result[i].price);
                $("#table-product-in-bill").append(`
                <tr>
                    <td>`+ result[i].name + `</td>
                    <td>`+ result[i].quantity + `</td>
                    <td>`+ result[i].price.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + "đ" + `</td>
                    <td>`+ (result[i].price * result[i].quantity).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + "đ" + `</td>
                </tr>
            `);
            document.getElementById("totalPrice").innerHTML = "Tổng tiền: " + totalMoney.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + "đ";
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
    document.getElementById("price-update").value = e.target.children[3].innerHTML.split('đ').join('');
    document.getElementById("update-product-container").style.display = "grid";
    document.getElementById("history-price-container").replaceChildren();
    $.ajax({
        url: "http://localhost/quanlycuahang/api/getHistoryPrice",
        type: "post",
        dataType: "json",
        data: { "idProduct": e.target.children[1].innerHTML.slice(3) },
        success: function (result) {
            for (let i = 0; i < result.length; i++) {
                $("#history-price-container").append(`
                <div class="history-price">
                    <p>`+ result[i].price +`</p>
                    <p>`+ new Date(result[i].startDate).toLocaleString() + " - " + new Date(result[i].endDate).toLocaleString() +`</p>
                </div>
            `);
            }
        }
    });
}

function CloseDetailProductModal() {
    document.getElementById("update-product-container").style.display = "none";
}

function UploadImage(element, fileChoose) {
    let file = document.getElementById(fileChoose);
    let fr = new FileReader();
    fr.readAsDataURL(file.files[0]);
    fr.addEventListener('load', () => {
        const url = fr.result;
        document.getElementById(element).src = url;
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

function getDataExcel() {
    let form_data = new FormData();
    form_data.append("file", $('#file-excel').prop('files')[0]);
    if ($('#file-excel').val() == "") {
        alert("Bạn chưa chọn file!");
    }
    else if (!(/\.(xlsx|xls|xlsm)$/i).test($('#file-excel').val())) {
        alert("File của bạn không phải là Excel!");
    }
    else {
        $.ajax({
            url: "http://localhost/quanlycuahang/api/getDataExcel",
            type: "post",
            contentType: false,
            processData: false,
            dataType: "json",
            data: form_data,
            success: function (result) {
                let childrens = document.querySelectorAll("#product-excel-container div");
                for (let i = 0; i < childrens.length; i++) {
                    childrens[i].remove();
                }
                for (let i = 0; i < result.length; i++) {
                    $("#product-excel-container").append(`
                        <div style="height: max-content; border: 1px solid lightGray; padding: 0.5rem; display: flex; flex-direction: column; gap: 0.5rem; border-radius: 0.3rem">
                            <label for="image-product-`+ i + `">
                                <img id="image-excel-`+ i + `" style="width: 100%; height: 8rem; object-fit: cover; border-radius: 0.3rem;" src="https://static.thenounproject.com/png/3322766-200.png" alt="image" />
                            </label>
                            <input class="image-product-excel" onchange="UploadImage('image-excel-`+ i + `', 'image-product-` + i + `')" id="image-product-` + i + `" type="file" style="width: 0;  position: absolute; height: 0;"/>
                            <p class="name-product-excel">` + result[i][0] + `</p>
                            <input type="text" min="0" class="price-product-excel number-separator" placeholder="Giá sản phẩm"/>
                        </div>
                `);
                }
                easyNumberSeparator({
                    selector: '.number-separator',
                    separator: ','
                });
            }
        });
    }
}

function AddProductExcel() {
    let nameList = document.querySelectorAll(".name-product-excel");
    let priceList = document.querySelectorAll(".price-product-excel");
    for (let i = 0; i < nameList.length; i++) {
        let form_data = new FormData();
        form_data.append("name", nameList[i].innerHTML);
        form_data.append("price", Number(priceList[i].value.split(',').join('')));
        form_data.append("file", $('#image-product-' + i).prop('files')[0]);
        $.ajax({
            url: "http://localhost/quanlycuahang/api/addProduct",
            type: "post",
            contentType: false,
            processData: false,
            dataType: "json",
            data: form_data,
            success: function (result) {
                easyNumberSeparator({
                    selector: '.number-separator-excel',
                    separator: ','
                })
                $("#product-container").prepend(`
                <div class="product" onclick="OpenDetailProductModal(event)">
                    <img src="http://localhost/quanlycuahang/`+ result.image + `" alt="image" />
                    <p>Mã: `+ result.id + `</p>
                    <p>`+ result.name + `</p>
                    <p>`+ result.price.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + `đ</p>
                </div>
                `);
            }
        });
    }
    alert("Thêm sản phẩm thành công!");
    CloseAddProductExcelModal();
}

function AddProduct() {
    let name = document.getElementById("name-product").value;
    let price = document.getElementById("price-product").value;
    let form_data = new FormData();
    const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/jpg'];
    const fileType = $('#file').prop('files')[0]['type'];
    form_data.append("name", name);
    form_data.append("price", Number(price.split(',').join('')));
    form_data.append("file", $('#file').prop('files')[0]);
    if ($('#file').val() == "") {
        alert("Bạn chưa chọn ảnh sản phẩm!");
    }
    else if (name == "") {
        alert("Bạn chưa nhập tên sản phẩm!");
    }
    else if ($('#price').val() == "") {
        alert("Bạn chưa nhập số tiền!");
    }
    else if ($('#price').val() < 0) {
        alert("Số tiền không được nhỏ hơn 0");
    }
    else if (!validImageTypes.includes(fileType)) {
        alert("File của bạn không phải là hình ảnh! File ảnh phải có đuôi gif, jpeg, png, jpg");
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
                console.log(result);
                $("#product-container").prepend(`
                <div class="product" onclick="OpenDetailProductModal(event)">
                    <img src="http://localhost/quanlycuahang/`+ result.image + `" alt="image" />
                    <p>Mã: `+ result.id + `</p>
                    <p>`+ result.name + `</p>
                    <p>`+ result.price.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") +`đ</p>
                </div>
            `);
                alert("Thêm sản phẩm thành công!");
                CloseAddProductModal();
            }
        });
    }
}

function UpdateProduct() {
    let id = document.getElementById("id-update").value;
    let name = document.getElementById("name-update").value;
    let price = document.getElementById("price-update").value;
    let form_data = new FormData();
    form_data.append("id", id);
    form_data.append("name", name);
    form_data.append("price", Number(price.split(',').join('')));
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
            dataType: "text",
            data: form_data,
            success: function (result) {
                document.getElementById("update-product-container").style.display = "none";
                RefreshProduct();
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
    let totalPay = 0;
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
                        <p>Ngày mua: `+ new Date().toLocaleString() + `</p>
                        <p>Người bán: Nguyễn Tấn Cường</p>
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
    let keyword = $("#keyword").val();
    let products = document.querySelectorAll("#containerChoose .product");
    if (keyword == "")
        alert("Bạn chưa nhập từ khóa!")
    else {
        document.getElementById("load-product").style.display = "flex";
        document.getElementById("no-result-product").style.display = "none";
        for (let i = 0; i < products.length; i++) {
            products[i].remove();
        }
        $.ajax({
            url: "http://localhost/quanlycuahang/api/searchProduct",
            type: "post",
            dataType: "json",
            data: { "keyword": keyword },
            success: function (result) {
                document.getElementById("load-product").style.display = "none";
                if (result.length != 0) {
                    for (let i = 0; i < result.length; i++) {
                        if (result[i].price != "Chưa có giá") {
                            $("#containerChoose").append(`
                            <div class="product" onclick="AddProductToOrder(event, `+ result[i].id + `)">
                                <img src="http://localhost/quanlycuahang/`+ result[i].image + `" alt="image" />
                                <p>`+ result[i].name + `</p>
                                <p>`+ result[i].price.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + `</p>
                            </div>
                        `);
                        }
                    }
                }
                else {
                    document.getElementById("no-result-product").style.display = "flex";
                }
            }
        });
    }
}

document.getElementById("keyword").addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        SearchProductChoose();
    }
});

function RefreshProductChoose() {
    $("#keyword").val("");
    document.getElementById("no-result-product").style.display = "none";
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
                        <img src="http://localhost/quanlycuahang/`+ data[i].image + `" alt="image" />
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

document.getElementById("keywordBill").addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        SearchBill();
    }
});

function RefreshBill() {
    $("#keywordBill").val("");
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
                if (result.length != 0) {
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
                                    <p>`+ result[i].price + `</p>
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

document.getElementById("keywordProduct").addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        SearchProduct();
    }
});

function RefreshProduct() {
    $("#keywordProduct").val("");
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
                    <p>`+ data[i].price + `</p>
                </div>`);
        }
    });
}

function Statistical() {
    let startDate = $("#startDateSearch").val();
    let endDate = $("#endDateSearch").val();
    if (startDate == "")
        alert("Bạn chưa chọn ngày bắt đầu!");
    else if (endDate == "")
        alert("Bạn chưa chọn ngày kết thúc!");
    else if (new Date(startDate).getTime() > new Date(endDate).getTime())
        alert("Ngày bắt đầu không được lớn hơn ngày kết thúc!");
    else {
        document.getElementById("no-result").style.display = "none";
        document.getElementById("note").style.display = "none";
        document.getElementById("load").style.display = "flex";
        let tr = document.querySelectorAll("#statistical tr");
        for (let j = 1; j < tr.length; j++) {
            tr[j].remove();
        }
        $.ajax({
            type: "post",
            url: "http://localhost/quanlycuahang/api/getStatistical",
            data: { startDate: startDate, endDate: endDate },
            dataType: "json",
            success: function (response) {
                $("#startDateStatistical").val(startDate);
                $("#endDateStatistical").val(endDate);
                checkExcel = 1;
                dataExcel = response;
                document.getElementById("load").style.display = "none";
                if (response.length == 0)
                    document.getElementById("no-result").style.display = "flex";
                else {
                    for (let i = 0; i < response.length; i++) {
                        $("#statistical").append(`
                        <tr>
                            <td>`+ Number(i + 1) + `</td>
                            <td>`+ response[i].id + `</td>
                            <td>`+ response[i].name + `</td>
                            <td>`+ response[i].quantity + `</td>
                            <td>`+ response[i].price.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + `đ</td>
                            <td>`+ response[i].total.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + `đ</td>
                        </tr>
                    `);
                    }
                }
            }
        });
    }
}

document.getElementById("startDateSearch").addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        Statistical();
    }
});

document.getElementById("endDateSearch").addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        Statistical();
    }
});