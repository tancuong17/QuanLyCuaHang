if (window.location.pathname == "/quanlycuahang/") {
    $.ajax({
        url: "http://localhost/quanlycuahang/api/authentication",
        type: "get",
        dataType: "text",
        success: function (result) {
            console.log(result);
            if (result == "1")
                window.location.href = "http://localhost/quanlycuahang/admin";
        }
    });
}
function Login() {
    let phonenumber = $("#phonenumber").val();
    let password = $("#password").val();
    $.ajax({
        type: "post",
        url: "http://localhost/quanlycuahang/api/checkAccount",
        data: { phonenumber: phonenumber, password: password },
        dataType: "text",
        success: function (response) {
            if (response == 0)
                alert("Tài khoản hoặc mật khẩu không chính xác!");
            else
                window.location.href = "http://localhost/quanlycuahang/admin";
        }
    });
}