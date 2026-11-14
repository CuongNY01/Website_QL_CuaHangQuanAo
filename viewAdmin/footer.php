    </main>
    <footer class="admin-footer">
        <p>© 2026 <b>Hệ thống Quản trị Bán Hàng Thời Trang</b> | Đề tài Chuyên đề tốt nghiệp 1: <i>Website Quản Lý Bán Quần Áo</i></p>
        <p style="margin-top: 4px; font-size: 12px; color: #94a3b8;">Sinh viên thực hiện: <b>Dương Bá Công</b> - Lớp CNTT | Giảng viên hướng dẫn: <b>Hà Trọng Thắng</b> | ĐH Công Nghệ Đông Á</p>
    </footer>
</body>
</html>

<script src="../view/js/kiemtra.js"></script>
<script src="../view/js/batloiadd.js"></script>
<script src="../view/js/xoa.js"></script>
<script>
function Del(name) {
    if (!name) name = "mục này";
    return confirm("Bạn có chắc chắn muốn xóa: " + name + "? Thao tác này không thể hoàn tác!");
}
function Deluser(username) {
    if (!username) username = "tài khoản này";
    return confirm("Bạn có chắc chắn muốn xóa tài khoản: " + username + "?");
}
</script>
