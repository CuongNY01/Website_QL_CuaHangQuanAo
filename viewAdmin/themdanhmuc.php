<?php
if (isset($_POST['them'])) {
    $name = trim($_POST['name'] ?? '');
    $iddanhmuc = trim($_POST['iddanhmuc'] ?? '');

    if ($name != "") {
        danhmuc_insert($iddanhmuc, $name);
        echo "<script>alert('Thêm danh mục thành công!'); window.location.href='../controller/indexAdmin.php?act=danhmuc';</script>";
        exit;
    } else {
        echo "<script>alert('Vui lòng nhập tên danh mục!');</script>";
    }
}
?>

<div class="admin-form-container">
    <div style="margin-bottom: 25px; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px;">
        <h2 style="font-size: 19px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 8px;">
            <i class='bx bx-folder-plus' style="color: #10b981;"></i> Thêm Danh Mục Thời Trang Mới
        </h2>
        <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Tạo nhóm phân loại mới cho các dòng sản phẩm của cửa hàng</p>
    </div>

    <form action="" method="POST">
        <div class="form-group">
            <label>Mã ID Danh Mục (Tùy chọn):</label>
            <input type="number" class="form-control-custom" placeholder="Để trống để hệ thống tự động tăng (1, 2, 3...)" name="iddanhmuc">
        </div>

        <div class="form-group">
            <label>Tên Danh Mục Thời Trang (*):</label>
            <input type="text" class="form-control-custom" placeholder="Ví dụ: Áo Nam & Sơ Mi, Thời Trang Nữ, Quần Jean..." name="name" required autofocus>
        </div>

        <div class="form-actions">
            <button type="submit" name="them" class="btn-action btn-add" style="flex: 1; justify-content: center; height: 42px;">
                <i class='bx bx-check-circle'></i> Thêm Danh Mục
            </button>
            <a href="../controller/indexAdmin.php?act=danhmuc" class="btn-action btn-secondary" style="flex: 1; justify-content: center; height: 42px;">
                <i class='bx bx-arrow-back'></i> Hủy Bỏ
            </a>
        </div>
    </form>
</div>
