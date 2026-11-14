<?php
$id = $_GET['id'] ?? 0;
$danhmuc = danhmuc_showId($id);
if (!$danhmuc) {
    echo "<script>alert('Không tìm thấy danh mục!'); window.location.href='../controller/indexAdmin.php?act=danhmuc';</script>";
    exit;
}
$tendanhmuc = $danhmuc['tendanhmuc'];

if (isset($_POST['sua'])) {
    $tendanhmuc_new = trim($_POST['name'] ?? '');
    if ($tendanhmuc_new != '') {
        danhmuc_update($tendanhmuc_new, $id);
        echo "<script>alert('Cập nhật danh mục thành công!'); window.location.href='../controller/indexAdmin.php?act=danhmuc';</script>";
        exit;
    } else {
        echo "<script>alert('Vui lòng nhập tên danh mục!');</script>";
    }
}
?>

<div class="admin-form-container">
    <div style="margin-bottom: 25px; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px;">
        <h2 style="font-size: 19px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 8px;">
            <i class='bx bx-edit' style="color: #3b82f6;"></i> Chỉnh Sửa Danh Mục Thời Trang
        </h2>
        <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Cập nhật lại tên nhóm phân loại trên hệ thống</p>
    </div>

    <form action="" method="POST">
        <div class="form-group">
            <label>Mã ID Danh Mục:</label>
            <input type="text" class="form-control-custom" value="#<?= $id ?>" disabled>
        </div>

        <div class="form-group">
            <label>Tên Danh Mục Thời Trang (*):</label>
            <input type="text" class="form-control-custom" placeholder="Nhập tên danh mục thời trang mới" name="name" required value="<?= htmlspecialchars($tendanhmuc) ?>">
        </div>

        <div class="form-actions">
            <button type="submit" name="sua" class="btn-action btn-primary" style="flex: 1; justify-content: center; height: 42px;">
                <i class='bx bx-save'></i> Cập Nhật
            </button>
            <a href="../controller/indexAdmin.php?act=danhmuc" class="btn-action btn-secondary" style="flex: 1; justify-content: center; height: 42px;">
                <i class='bx bx-arrow-back'></i> Quay Lại
            </a>
        </div>
    </form>
</div>
