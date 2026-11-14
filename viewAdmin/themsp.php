<?php
$list_dm = danhmuc_showAll();

if (isset($_POST['them'])) {
    $tensp = trim($_POST['tensp'] ?? '');
    $gia = trim($_POST['gia'] ?? '');
    $danhmuc = trim($_POST['danhmuc'] ?? '');
    $avata = (!empty($_FILES['hinh']['name'])) ? basename($_FILES['hinh']['name']) : '';

    if ($tensp != "" && $gia != "" && $danhmuc != "") {
        if ($avata != "") {
            $target = "../view/images/";
            $target_file = $target . $avata;
            move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file);
        } else {
            $avata = "ao_so_mi_nam.jpg";
        }
        sanpham_insert($tensp, $avata, $gia, $danhmuc);
        echo "<script>alert('Thêm sản phẩm mới thành công!'); window.location.href='../controller/indexAdmin.php?act=sanpham';</script>";
        exit;
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ các trường dữ liệu bắt buộc!');</script>";
    }
}
?>

<div class="admin-form-container">
    <div style="margin-bottom: 25px; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px;">
        <h2 style="font-size: 19px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 8px;">
            <i class='bx bx-plus-circle' style="color: #10b981;"></i> Thêm Mới Sản Phẩm Thời Trang
        </h2>
        <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Điền thông tin trang phục, hình ảnh và phân loại danh mục</p>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tên Sản Phẩm Thời Trang (*):</label>
            <input type="text" class="form-control-custom" id="tensp" placeholder="Ví dụ: Áo Sơ Mi Oxford Slimfit, Đầm Maxi Hoa Nhí, Quần Jean Ống Suông..." name="tensp" required autofocus>
        </div>

        <div class="form-group">
            <label>Đơn Giá Bán (VNĐ) (*):</label>
            <input type="number" class="form-control-custom" id="gia" placeholder="Ví dụ: 250000" name="gia" required min="1000">
        </div>

        <div class="form-group">
            <label>Danh Mục Phân Loại (*):</label>
            <select name="danhmuc" class="form-control-custom" required>
                <option value="">-- Chọn danh mục thời trang --</option>
                <?php
                foreach ($list_dm as $dm) {
                    echo '<option value="' . $dm['iddanhmuc'] . '">' . htmlspecialchars($dm['tendanhmuc']) . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Hình Ảnh Minh Họa (*):</label>
            <input type="file" class="form-control-custom" id="hinh" name="hinh" accept="image/*" style="padding-top: 6px;">
            <small style="color: #94a3b8; font-size: 12px; display: block; margin-top: 4px;">Định dạng hỗ trợ: JPG, PNG, WEBP</small>
        </div>

        <div class="form-actions">
            <button type="submit" name="them" class="btn-action btn-add" style="flex: 1; justify-content: center; height: 42px;">
                <i class='bx bx-check-circle'></i> Lưu Sản Phẩm
            </button>
            <a href="../controller/indexAdmin.php?act=sanpham" class="btn-action btn-secondary" style="flex: 1; justify-content: center; height: 42px;">
                <i class='bx bx-arrow-back'></i> Hủy Bỏ
            </a>
        </div>
    </form>
</div>
