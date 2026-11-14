<?php
if (isset($_GET['id'])) {
    sanpham_delete($_GET['id']);
    echo "<script>alert('Xoá Sản phẩm thành công!'); window.location.href='../controller/indexAdmin.php?act=sanpham';</script>";
    exit;
}
$list_sanpham = sanpham_showAll();
?>

<div class="admin-card">
    <div class="admin-card-header">
        <div class="admin-card-title-group">
            <h2><i class='bx bx-closet' style="color: #10b981;"></i> Quản Lý Sản Phẩm Thời Trang</h2>
            <p>Danh sách toàn bộ các sản phẩm quần áo, đầm váy, áo khoác đang kinh doanh (Tổng: <?= count($list_sanpham) ?> sản phẩm)</p>
        </div>
        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
            <form action="../controller/indexAdmin.php?act=layout_tim" id="tim" method="POST" class="admin-search-box">
                <i class='bx bx-search' style="color: #94a3b8; font-size: 18px;"></i>
                <input type="text" name="filter" placeholder="Tìm theo tên áo, quần, váy..." required>
                <button type="submit" name="timkiem">Tìm</button>
            </form>

            <a href="../controller/indexAdmin.php?act=themsanpham" class="btn-action btn-add">
                <i class='bx bx-plus-circle'></i> Thêm Sản Phẩm Mới
            </a>
        </div>
    </div>

    <div class="admin-card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 70px; text-align: center;">Mã</th>
                        <th style="width: 80px; text-align: center;">Ảnh</th>
                        <th>Tên Sản Phẩm Thời Trang</th>
                        <th style="width: 150px; text-align: right;">Đơn Giá</th>
                        <th style="width: 200px;">Danh Mục</th>
                        <th style="width: 170px; text-align: center;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list_sanpham)): ?>
                        <?php foreach ($list_sanpham as $row): 
                            $id = $row['id'];
                            $hinh = $row['hinh'];
                            $tensp = $row['tensp'];
                            $gia = number_format($row['gia'], 0, ',', '.') . ' đ';
                            $tendanhmuc = !empty($row['tendanhmuc']) ? $row['tendanhmuc'] : ('ID: ' . $row['iddanhmuc']);
                            $dellink = "../controller/indexAdmin.php?act=sanpham&id=" . $id;
                        ?>
                            <tr>
                                <td style="text-align: center;">
                                    <span class="badge-pill badge-neutral">#<?= $id ?></span>
                                </td>
                                <td style="text-align: center;">
                                    <img src="../view/images/<?= htmlspecialchars($hinh) ?>" alt="" style="width: 52px; height: 52px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
                                </td>
                                <td>
                                    <strong style="color: #0f172a; font-size: 14px;"><?= htmlspecialchars($tensp) ?></strong>
                                </td>
                                <td style="text-align: right;">
                                    <span style="color: #ef4444; font-weight: 700; font-size: 14px;"><?= $gia ?></span>
                                </td>
                                <td>
                                    <span class="badge-pill badge-info">
                                        <i class='bx bx-tag-alt'></i> <?= htmlspecialchars($tendanhmuc) ?>
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: inline-flex; gap: 8px; justify-content: center;">
                                        <a href="../controller/indexAdmin.php?act=suasanpham&id=<?= $id ?>" class="btn-action btn-edit" title="Chỉnh sửa sản phẩm">
                                            <i class='bx bx-edit-alt'></i> Sửa
                                        </a>
                                        <a onclick="return Del('<?= htmlspecialchars(addslashes($tensp)) ?>')" href="<?= $dellink ?>" class="btn-action btn-delete" title="Xóa sản phẩm">
                                            <i class='bx bx-trash'></i> Xóa
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #94a3b8;">
                                <i class='bx bx-box' style="font-size: 36px; display: block; margin-bottom: 8px;"></i>
                                Chưa có sản phẩm nào trên hệ thống.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
