<?php
if (isset($_GET['iddanhmuc'])) {
    $del_id = $_GET['iddanhmuc'];
    $count = danhmuc_count_sanpham($del_id);
    if ($count > 0) {
        echo "<script>alert('Không thể xóa danh mục này do đang có " . $count . " sản phẩm liên kết! Vui lòng chuyển hoặc xóa sản phẩm trước.'); window.location.href='../controller/indexAdmin.php?act=danhmuc';</script>";
        exit;
    } else {
        danhmuc_delete($del_id);
        echo "<script>alert('Xoá Danh mục thành công!'); window.location.href='../controller/indexAdmin.php?act=danhmuc';</script>";
        exit;
    }
}
$list_danhmuc = danhmuc_showAll();
?>

<div class="admin-card">
    <div class="admin-card-header">
        <div class="admin-card-title-group">
            <h2><i class='bx bx-category' style="color: #3b82f6;"></i> Quản Lý Danh Mục Thời Trang</h2>
            <p>Phân loại và quản trị các nhóm hàng thời trang nam, nữ, phụ kiện và thể thao</p>
        </div>
        <div>
            <a href="../controller/indexAdmin.php?act=themdanhmuc" class="btn-action btn-add">
                <i class='bx bx-plus-circle'></i> Thêm Danh Mục Mới
            </a>
        </div>
    </div>

    <div class="admin-card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 80px; text-align: center;">Mã ID</th>
                        <th>Tên Danh Mục Thời Trang</th>
                        <th style="width: 200px; text-align: center;">Số Lượng Sản Phẩm</th>
                        <th style="width: 160px; text-align: center;">Trạng Thái</th>
                        <th style="width: 180px; text-align: center;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list_danhmuc)): ?>
                        <?php foreach ($list_danhmuc as $row): 
                            $iddanhmuc = $row['iddanhmuc'];
                            $tendanhmuc = $row['tendanhmuc'];
                            $count = danhmuc_count_sanpham($iddanhmuc);
                            $dellink = "../controller/indexAdmin.php?act=danhmuc&iddanhmuc=" . $iddanhmuc;
                        ?>
                            <tr>
                                <td style="text-align: center;">
                                    <span class="badge-pill badge-neutral">#<?= $iddanhmuc ?></span>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div style="width: 36px; height: 36px; border-radius: 8px; background: #eff6ff; display: flex; align-items: center; justify-content: center; color: #3b82f6; font-size: 18px;">
                                            <i class='bx bx-purchase-tag'></i>
                                        </div>
                                        <div>
                                            <strong style="color: #1e293b; font-size: 15px;"><?= htmlspecialchars($tendanhmuc) ?></strong>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    <span class="badge-pill badge-info">
                                        <i class='bx bx-package'></i> <?= $count ?> sản phẩm
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <span class="badge-pill badge-success">
                                        <i class='bx bx-check-circle'></i> Đang hiển thị
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: inline-flex; gap: 8px; justify-content: center;">
                                        <a href="../controller/indexAdmin.php?act=suadanhmuc&id=<?= $iddanhmuc ?>" class="btn-action btn-edit" title="Chỉnh sửa danh mục">
                                            <i class='bx bx-edit-alt'></i> Sửa
                                        </a>
                                        <a onclick="return Del('<?= htmlspecialchars(addslashes($tendanhmuc)) ?>')" href="<?= $dellink ?>" class="btn-action btn-delete" title="Xóa danh mục">
                                            <i class='bx bx-trash'></i> Xóa
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: #94a3b8;">
                                <i class='bx bx-folder-open' style="font-size: 36px; display: block; margin-bottom: 8px;"></i>
                                Chưa có danh mục nào trên hệ thống.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
