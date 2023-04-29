function Login() {
    const regexPhoneNumber = /(84|0[3|5|7|8|9])+([0-9]{8})\b/g;
    let phonenumber = $("#phonenumber").val();
    let password = $("#password").val();
    if(phonenumber.match(regexPhoneNumber))
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
    else
        alert("Tài khoản bạn nhập phải là số điện thoại!");
}