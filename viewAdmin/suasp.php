<?php
$id = $_GET['id'] ?? 0;
$rows = sanpham_showChiTiet($id);
if (!$rows) {
    echo "<script>alert('Không tìm thấy sản phẩm!'); window.location.href='../controller/indexAdmin.php?act=sanpham';</script>";
    exit;
}

$list_dm = danhmuc_showAll();

if (isset($_POST['sua'])) {
    $tensp = trim($_POST['tensp'] ?? '');
    $gia = trim($_POST['gia'] ?? '');
    $danhmuc = trim($_POST['danhmuc'] ?? '');
    $hinh = $rows['hinh'];

    if (!empty($_FILES["hinh"]["name"])) {
        $file_name = basename($_FILES["hinh"]["name"]);
        $target_file = "../view/images/" . $file_name;
        if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
            $hinh = $file_name;
        }
    }

    if ($tensp != "" && $gia != "" && $danhmuc != "") {
        sanpham_update($tensp, $hinh, $gia, $danhmuc, $id);
        echo "<script>alert('Cập nhật sản phẩm thành công!'); window.location.href='../controller/indexAdmin.php?act=sanpham';</script>";
        exit;
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ các trường dữ liệu bắt buộc!');</script>";
    }
}
?>

<div class="admin-form-container">
    <div style="margin-bottom: 25px; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px;">
        <h2 style="font-size: 19px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 8px;">
            <i class='bx bx-edit' style="color: #3b82f6;"></i> Chỉnh Sửa Thông Tin Sản Phẩm
        </h2>
        <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Mã sản phẩm: <b>#<?= $rows['id'] ?></b></p>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tên Sản Phẩm Thời Trang (*):</label>
            <input type="text" class="form-control-custom" name="tensp" required value="<?= htmlspecialchars($rows['tensp']) ?>">
        </div>

        <div class="form-group">
            <label>Đơn Giá (VNĐ) (*):</label>
            <input type="number" class="form-control-custom" name="gia" required min="1000" value="<?= htmlspecialchars($rows['gia']) ?>">
        </div>

        <div class="form-group">
            <label>Danh Mục Phân Loại (*):</label>
            <select name="danhmuc" class="form-control-custom" required>
                <?php
                foreach ($list_dm as $dm) {
                    $selected = ($dm['iddanhmuc'] == $rows['iddanhmuc']) ? 'selected' : '';
                    echo '<option value="' . $dm['iddanhmuc'] . '" ' . $selected . '>' . htmlspecialchars($dm['tendanhmuc']) . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Hình Ảnh Minh Họa:</label>
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 8px;">
                <img src="../view/images/<?= htmlspecialchars($rows['hinh']) ?>" alt="" style="width: 58px; height: 58px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
                <span style="font-size: 13px; color: #64748b;">Ảnh hiện tại: <i><?= htmlspecialchars($rows['hinh']) ?></i></span>
            </div>
            <input type="file" class="form-control-custom" name="hinh" accept="image/*" style="padding-top: 6px;">
            <small style="color: #94a3b8; font-size: 12px; display: block; margin-top: 4px;">Chọn ảnh mới nếu muốn thay đổi</small>
        </div>

        <div class="form-actions">
            <button type="submit" name="sua" class="btn-action btn-primary" style="flex: 1; justify-content: center; height: 42px;">
                <i class='bx bx-save'></i> Cập Nhật Sản Phẩm
            </button>
            <a href="../controller/indexAdmin.php?act=sanpham" class="btn-action btn-secondary" style="flex: 1; justify-content: center; height: 42px;">
                <i class='bx bx-arrow-back'></i> Hủy Bỏ
            </a>
        </div>
    </form>
</div>
