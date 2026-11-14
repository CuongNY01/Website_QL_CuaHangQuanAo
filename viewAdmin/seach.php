<?php
$keyword = trim($_POST['filter'] ?? ($_GET['filter'] ?? ''));
$query = ($keyword != "") ? sanpham_seach($keyword) : [];
?>

<div class="admin-card">
    <div class="admin-card-header">
        <div class="admin-card-title-group">
            <h2><i class='bx bx-search' style="color: #3b82f6;"></i> Kết Quả Tìm Kiếm Sản Phẩm Trong Kho</h2>
            <p>Từ khóa tìm kiếm: "<b><?= htmlspecialchars($keyword) ?></b>" (Tìm thấy: <?= count($query) ?> sản phẩm)</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <form action="../controller/indexAdmin.php?act=layout_tim" method="POST" class="admin-search-box">
                <i class='bx bx-search' style="color: #94a3b8; font-size: 18px;"></i>
                <input type="text" name="filter" placeholder="Tìm theo tên sản phẩm..." value="<?= htmlspecialchars($keyword) ?>" required>
                <button type="submit" name="timkiem">Tìm</button>
            </form>
            <a href="../controller/indexAdmin.php?act=sanpham" class="btn-action btn-secondary">
                <i class='bx bx-arrow-back'></i> Tất Cả Sản Phẩm
            </a>
        </div>
    </div>

    <div class="admin-card-body" style="padding: 0;">
        <?php if (!empty($query)): ?>
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
                        <?php foreach ($query as $row): 
                            $tendanhmuc = !empty($row['tendanhmuc']) ? $row['tendanhmuc'] : ('ID: ' . $row['iddanhmuc']);
                        ?>
                            <tr>
                                <td style="text-align: center;">
                                    <span class="badge-pill badge-neutral">#<?= $row['id'] ?></span>
                                </td>
                                <td style="text-align: center;">
                                    <img src="../view/images/<?= htmlspecialchars($row['hinh']) ?>" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
                                </td>
                                <td>
                                    <strong style="color: #0f172a;"><?= htmlspecialchars($row['tensp']) ?></strong>
                                </td>
                                <td style="text-align: right;">
                                    <span style="color: #ef4444; font-weight: 700;"><?= number_format($row['gia'], 0, ',', '.') ?> đ</span>
                                </td>
                                <td>
                                    <span class="badge-pill badge-info">
                                        <i class='bx bx-tag-alt'></i> <?= htmlspecialchars($tendanhmuc) ?>
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: inline-flex; gap: 8px; justify-content: center;">
                                        <a href="../controller/indexAdmin.php?act=suasanpham&id=<?= $row['id'] ?>" class="btn-action btn-edit" title="Sửa">
                                            <i class='bx bx-edit-alt'></i> Sửa
                                        </a>
                                        <a onclick="return Del('<?= htmlspecialchars(addslashes($row['tensp'])) ?>')" href="../controller/indexAdmin.php?act=sanpham&id=<?= $row['id'] ?>" class="btn-action btn-delete" title="Xóa">
                                            <i class='bx bx-trash'></i> Xóa
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 60px 20px; color: #64748b;">
                <i class='bx bx-search-alt' style="font-size: 50px; color: #cbd5e1; display: block; margin-bottom: 12px;"></i>
                <h3 style="font-size: 17px; color: #334155; margin-bottom: 6px;">Không tìm thấy sản phẩm nào khớp với từ khóa "<?= htmlspecialchars($keyword) ?>"</h3>
                <p style="font-size: 13px; color: #94a3b8;">Vui lòng thử lại với tên khác như: Sơ mi, Váy, Jean, Bomber, Real Madrid...</p>
            </div>
        <?php endif; ?>
    </div>
</div>
