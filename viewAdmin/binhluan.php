<?php
if (isset($_GET['id'])) {
    binhluan_delete($_GET['id']);
    echo "<script>alert('Xoá Bình luận thành công!'); window.location.href='../controller/indexAdmin.php?act=binhluan';</script>";
    exit;
}
$list_binhluan = binhluan_showall();
?>

<div class="admin-card">
    <div class="admin-card-header">
        <div class="admin-card-title-group">
            <h2><i class='bx bx-comment-detail' style="color: #f59e0b;"></i> Kiểm Duyệt & Quản Lý Bình Luận</h2>
            <p>Kiểm duyệt các đánh giá, nhận xét của khách hàng về các sản phẩm thời trang</p>
        </div>
        <div>
            <span class="badge-pill badge-neutral" style="font-size: 13px; padding: 6px 14px;">
                <i class='bx bx-message-square-detail'></i> Tổng: <?= count($list_binhluan) ?> bình luận
            </span>
        </div>
    </div>

    <div class="admin-card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 70px; text-align: center;">Mã</th>
                        <th style="width: 200px;">Khách Hàng</th>
                        <th style="width: 220px;">Sản Phẩm Đánh Giá</th>
                        <th>Nội Dung Nhận Xét</th>
                        <th style="width: 140px; text-align: center;">Thời Gian</th>
                        <th style="width: 120px; text-align: center;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list_binhluan)): ?>
                        <?php foreach ($list_binhluan as $row): 
                            $id = $row['id'];
                            $name = $row['name'];
                            $hinh = !empty($row['hinh']) ? $row['hinh'] : 'iconUser.png';
                            $idsp = $row['idsp'];
                            $tensp = !empty($row['tensp']) ? $row['tensp'] : ('Sản phẩm #' . $idsp);
                            $noidung = $row['noidung'];
                            $postdate = $row['postdate'];
                            $dellink = "../controller/indexAdmin.php?act=binhluan&id=" . $id;
                        ?>
                            <tr>
                                <td style="text-align: center;">
                                    <span class="badge-pill badge-neutral">#<?= $id ?></span>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <img src="../view/images/<?= htmlspecialchars($hinh) ?>" alt="" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 1px solid #e2e8f0;">
                                        <strong style="color: #1e293b;"><?= htmlspecialchars($name) ?></strong>
                                    </div>
                                </td>
                                <td>
                                    <a href="../controller/index.php?act=chitietsp&idsanpham=<?= $idsp ?>" target="_blank" style="color: #3b82f6; text-decoration: none; font-weight: 500; font-size: 13px;">
                                        <?= htmlspecialchars($tensp) ?> <i class='bx bx-link-external' style="font-size: 11px;"></i>
                                    </a>
                                </td>
                                <td>
                                    <div style="background: #f8fafc; border: 1px solid #f1f5f9; padding: 8px 12px; border-radius: 6px; font-style: italic; color: #334155;">
                                        "<?= htmlspecialchars($noidung) ?>"
                                    </div>
                                </td>
                                <td style="text-align: center; color: #64748b; font-size: 13px;">
                                    <?= htmlspecialchars($postdate) ?>
                                </td>
                                <td style="text-align: center;">
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này?')" href="<?= $dellink ?>" class="btn-action btn-delete" title="Xóa bình luận vi phạm">
                                        <i class='bx bx-trash'></i> Xóa
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #94a3b8;">
                                <i class='bx bx-comment-x' style="font-size: 36px; display: block; margin-bottom: 8px;"></i>
                                Chưa có bình luận nào trên hệ thống.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
