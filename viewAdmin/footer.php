    </div>
    <footer style="text-align: center; padding: 25px 0; color: #7f8c8d; font-size: 13px; border-top: 1px solid #eee; margin-top: 40px;">
        <p>© 2026 Hệ thống Quản trị Website Bán Quần Áo - Chuyên đề tốt nghiệp 1 - Dương Bá Công (Đại học Công nghệ Đông Á)</p>
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
    return confirm("Bạn có chắc chắn muốn xóa " + username + "?");
}
</script>
