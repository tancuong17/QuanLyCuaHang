if (window.location.pathname == "/quanlycuahang/") {
    $.ajax({
        url: "http://localhost/quanlycuahang/api/authentication",
        type: "get",
        dataType: "text",
        success: function (result) {
            if (result == 1)
                window.location.href = "http://localhost/quanlycuahang/admin";
        }
    });
}
if (window.location.pathname == "/quanlycuahang/admin") {
    $.ajax({
        url: "http://localhost/quanlycuahang/api/authentication",
        type: "get",
        dataType: "text",
        success: function (result) {
            if (result == 0)
                window.location.href = "http://localhost/quanlycuahang/";
        }
    });
}