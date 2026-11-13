// Safe event listeners for toggle menu
document.addEventListener("DOMContentLoaded", function () {
    var hamburger = document.querySelector('#toggle');
    var navLink = document.querySelector('.menu1');
    var col = document.querySelector('.close');

    if (hamburger && navLink) {
        hamburger.addEventListener('click', () => {
            navLink.classList.toggle('hide');
        });
    }

    if (col && navLink) {
        col.addEventListener('click', () => {
            navLink.classList.toggle('hide');
        });
    }
});

function Del(name) {
    if (!name) name = "mục này";
    return confirm("Bạn có chắc chắn muốn xóa: " + name + "? Thao tác này không thể hoàn tác!");
}

function Deluser(name) {
    if (!name) name = "tài khoản này";
    return confirm("Bạn có chắc chắn muốn xóa " + name + "?");
}

function KiemTra() {
    var ten = document.getElementById("tensp");
    var gia = document.getElementById("gia");
    var hinh = document.getElementById("hinh");

    if (ten && ten.value.trim().length === 0) {
        alert("Tên sản phẩm không được để trống!");
        ten.focus();
        return false;
    }

    if (gia && (gia.value.trim().length === 0 || isNaN(gia.value))) {
        alert("Đơn giá sản phẩm phải là chữ số và không được để trống!");
        gia.focus();
        return false;
    }

    return true;
}

function KiemTraUser() {
    var username = document.getElementById("username");
    var password = document.getElementById("password");
    var repassword = document.getElementById("repassword");

    if (username && username.value.trim().length === 0) {
        alert("Tên đăng nhập không được để trống!");
        username.focus();
        return false;
    }

    if (password && password.value.trim().length < 3) {
        alert("Mật khẩu phải từ 3 ký tự trở lên!");
        password.focus();
        return false;
    }

    if (repassword && password && password.value !== repassword.value) {
        alert("Mật khẩu nhập lại không khớp!");
        repassword.focus();
        return false;
    }

    return true;
}

function KiemTradanhmuc() {
    var name = document.getElementById("username") || document.getElementById("tendanhmuc");
    if (name && name.value.trim().length === 0) {
        alert("Tên danh mục không được để trống!");
        name.focus();
        return false;
    }
    return true;
}
