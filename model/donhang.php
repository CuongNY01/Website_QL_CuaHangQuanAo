<?php
/**
 * Model Quản lý Đơn hàng & Chi tiết Đơn hàng
 * Website Quản Lý Bán Quần Áo - Chuyên đề tốt nghiệp 1
 */

// Thêm mới đơn hàng, trả về id vừa tạo
function donhang_insert($madh, $iduser, $hoten, $sdt, $email, $diachi, $pttt, $ghichu, $tongtien, $trangthai = 'Chờ xác nhận') {
    $conn = pdo_con();
    if ($conn === null) return 0;
    
    $sql = "INSERT INTO donhang (madh, iduser, hoten, sdt, email, diachi, pttt, ghichu, tongtien, trangthai, ngaydathang) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$madh, $iduser, $hoten, $sdt, $email, $diachi, $pttt, $ghichu, $tongtien, $trangthai]);
        return (int)$conn->lastInsertId();
    } catch (PDOException $e) {
        return 0;
    }
}

// Thêm chi tiết từng sản phẩm trong đơn hàng
function donhang_chitiet_insert($iddonhang, $idsp, $tensp, $hinh, $size, $dongia, $soluong, $thanhtien) {
    $sql = "INSERT INTO donhang_chitiet (iddonhang, idsp, tensp, hinh, size, dongia, soluong, thanhtien) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    return pdo_execute($sql, $iddonhang, $idsp, $tensp, $hinh, $size, $dongia, $soluong, $thanhtien);
}

// Lấy toàn bộ danh sách đơn hàng cho Admin
function donhang_showAll() {
    $sql = "SELECT * FROM donhang ORDER BY id DESC";
    return pdo_query($sql);
}

// Lấy danh sách đơn hàng theo trạng thái
function donhang_show_by_status($trangthai) {
    $sql = "SELECT * FROM donhang WHERE trangthai = ? ORDER BY id DESC";
    return pdo_query($sql, $trangthai);
}

// Lấy danh sách đơn hàng của một người dùng
function donhang_showAll_by_user($iduser) {
    $sql = "SELECT * FROM donhang WHERE iduser = ? ORDER BY id DESC";
    return pdo_query($sql, $iduser);
}

// Lấy thông tin 1 đơn hàng theo ID
function donhang_showId($id) {
    $sql = "SELECT * FROM donhang WHERE id = ?";
    return pdo_query_one($sql, $id);
}

// Lấy thông tin 1 đơn hàng theo Mã Đơn Hàng (Tra cứu đơn hàng)
function donhang_showByMa($madh) {
    $sql = "SELECT * FROM donhang WHERE madh = ?";
    return pdo_query_one($sql, $madh);
}

// Lấy danh sách sản phẩm chi tiết của 1 đơn hàng
function donhang_chitiet_show($iddonhang) {
    $sql = "SELECT * FROM donhang_chitiet WHERE iddonhang = ? ORDER BY id ASC";
    return pdo_query($sql, $iddonhang);
}

// Cập nhật trạng thái đơn hàng
function donhang_update_trangthai($id, $trangthai) {
    $sql = "UPDATE donhang SET trangthai = ? WHERE id = ?";
    return pdo_execute($sql, $trangthai, $id);
}

// Xóa đơn hàng và các chi tiết đơn hàng liên quan
function donhang_delete($id) {
    $sql1 = "DELETE FROM donhang_chitiet WHERE iddonhang = ?";
    pdo_execute($sql1, $id);
    $sql2 = "DELETE FROM donhang WHERE id = ?";
    return pdo_execute($sql2, $id);
}

// Đếm số lượng đơn hàng đang chờ duyệt
function donhang_count_pending() {
    $sql = "SELECT COUNT(*) FROM donhang WHERE trangthai = 'Chờ xác nhận'";
    return (int)pdo_query_value($sql);
}

// Tính tổng doanh thu của toàn bộ đơn hàng thành công (hoặc chưa bị hủy)
function donhang_tong_doanhthu() {
    $sql = "SELECT SUM(tongtien) FROM donhang WHERE trangthai != 'Đã hủy'";
    $val = pdo_query_value($sql);
    return $val ? (int)$val : 0;
}
?>
