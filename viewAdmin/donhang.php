<?php
include_once "../model/donhang.php";

// Xử lý xóa đơn hàng
if (isset($_GET['xoa'])) {
    $del_id = (int)$_GET['xoa'];
    donhang_delete($del_id);
    echo "<script>alert('Xoá đơn hàng thành công!'); window.location.href='../controller/indexAdmin.php?act=donhang';</script>";
    exit;
}

// Xử lý cập nhật nhanh trạng thái đơn hàng
if (isset($_POST['update_status'])) {
    $order_id = (int)($_POST['order_id'] ?? 0);
    $new_status = trim($_POST['status'] ?? '');
    if ($order_id > 0 && $new_status != '') {
        donhang_update_trangthai($order_id, $new_status);
        echo "<script>alert('Cập nhật trạng thái đơn hàng thành công!'); window.location.href='../controller/indexAdmin.php?act=donhang';</script>";
        exit;
    }
}

// Lọc theo trạng thái
$filter_status = $_GET['status'] ?? 'all';
if ($filter_status != 'all' && $filter_status != '') {
    $list_donhang = donhang_show_by_status($filter_status);
} else {
    $list_donhang = donhang_showAll();
}

$pending_count = donhang_count_pending();
$total_revenue = donhang_tong_doanhthu();
?>

<div class="admin-card">
    <div class="admin-card-header">
        <div class="admin-card-title-group">
            <h2><i class='bx bx-receipt' style="color: #3b82f6;"></i> Quản Lý Đơn Hàng</h2>
            <p>Kiểm soát quy trình xử lý, xác nhận và giao nhận các đơn đặt hàng từ khách hàng</p>
        </div>
        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
            <div style="background: #ecfdf5; border: 1px solid #a7f3d0; padding: 6px 16px; border-radius: 8px; font-size: 13px; color: #065f46;">
                Doanh thu: <b style="font-size: 15px; color: #047857;"><?= number_format($total_revenue, 0, ',', '.') ?> đ</b>
            </div>
            <div style="background: #fef3c7; border: 1px solid #fde68a; padding: 6px 16px; border-radius: 8px; font-size: 13px; color: #92400e;">
                Chờ xác nhận: <b style="font-size: 15px; color: #b45309;"><?= $pending_count ?></b> đơn
            </div>
        </div>
    </div>

    <!-- THANH LỌC TRẠNG THÁI ĐƠN HÀNG -->
    <div style="padding: 16px 24px; background: #f8fafc; border-bottom: 1px solid var(--admin-border); display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">
        <span style="font-size: 13px; font-weight: 700; color: #475569; margin-right: 6px;">Lọc trạng thái:</span>
        <a href="../controller/indexAdmin.php?act=donhang&status=all" class="badge-pill <?= ($filter_status == 'all') ? 'badge-info' : 'badge-neutral' ?>" style="text-decoration: none; padding: 6px 14px; font-size: 13px;">
            Tất cả
        </a>
        <a href="../controller/indexAdmin.php?act=donhang&status=Chờ xác nhận" class="badge-pill <?= ($filter_status == 'Chờ xác nhận') ? 'badge-warning' : 'badge-neutral' ?>" style="text-decoration: none; padding: 6px 14px; font-size: 13px;">
            Chờ xác nhận (<?= $pending_count ?>)
        </a>
        <a href="../controller/indexAdmin.php?act=donhang&status=Đang chuẩn bị hàng" class="badge-pill <?= ($filter_status == 'Đang chuẩn bị hàng') ? 'badge-info' : 'badge-neutral' ?>" style="text-decoration: none; padding: 6px 14px; font-size: 13px;">
            Đang chuẩn bị hàng
        </a>
        <a href="../controller/indexAdmin.php?act=donhang&status=Đang giao hàng" class="badge-pill <?= ($filter_status == 'Đang giao hàng') ? 'badge-info' : 'badge-neutral' ?>" style="text-decoration: none; padding: 6px 14px; font-size: 13px;">
            Đang giao hàng
        </a>
        <a href="../controller/indexAdmin.php?act=donhang&status=Giao thành công" class="badge-pill <?= ($filter_status == 'Giao thành công') ? 'badge-success' : 'badge-neutral' ?>" style="text-decoration: none; padding: 6px 14px; font-size: 13px;">
            Giao thành công
        </a>
        <a href="../controller/indexAdmin.php?act=donhang&status=Đã hủy" class="badge-pill <?= ($filter_status == 'Đã hủy') ? 'badge-danger' : 'badge-neutral' ?>" style="text-decoration: none; padding: 6px 14px; font-size: 13px;">
            Đã hủy
        </a>
    </div>

    <div class="admin-card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 130px;">Mã Đơn</th>
                        <th>Khách Hàng / SĐT</th>
                        <th style="width: 140px;">Ngày Đặt</th>
                        <th style="width: 150px; text-align: right;">Tổng Tiền</th>
                        <th style="width: 130px; text-align: center;">Hình Thức</th>
                        <th style="width: 170px; text-align: center;">Trạng Thái</th>
                        <th style="width: 180px; text-align: center;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list_donhang)): ?>
                        <?php foreach ($list_donhang as $row): 
                            $id = $row['id'];
                            $madh = $row['madh'];
                            $hoten = $row['hoten'];
                            $sdt = $row['sdt'];
                            $tongtien = number_format($row['tongtien'], 0, ',', '.') . ' đ';
                            $ngaydat = date("d/m/Y H:i", strtotime($row['ngaydathang']));
                            $pttt = $row['pttt'];
                            $stt = $row['trangthai'];

                            $badge_class = "badge-warning";
                            if ($stt === 'Đang giao hàng' || $stt === 'Đang chuẩn bị hàng') {
                                $badge_class = "badge-info";
                            } else if ($stt === 'Giao thành công') {
                                $badge_class = "badge-success";
                            } else if ($stt === 'Đã hủy') {
                                $badge_class = "badge-danger";
                            }
                        ?>
                            <tr>
                                <td>
                                    <strong style="color: #0f172a; font-size: 13px;">#<?= htmlspecialchars($madh) ?></strong>
                                </td>
                                <td>
                                    <strong style="color: #1e293b;"><?= htmlspecialchars($hoten) ?></strong>
                                    <div style="font-size: 12px; color: #64748b; margin-top: 2px;">
                                        <i class='bx bx-phone'></i> <?= htmlspecialchars($sdt) ?>
                                    </div>
                                </td>
                                <td style="color: #64748b; font-size: 13px;">
                                    <?= $ngaydat ?>
                                </td>
                                <td style="text-align: right;">
                                    <span style="color: #ef4444; font-weight: 700; font-size: 14px;"><?= $tongtien ?></span>
                                </td>
                                <td style="text-align: center;">
                                    <span class="badge-pill badge-neutral" style="font-size: 12px;">
                                        <?= htmlspecialchars($pttt) ?>
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <form action="../controller/indexAdmin.php?act=donhang" method="POST" style="margin: 0;">
                                        <input type="hidden" name="order_id" value="<?= $id ?>">
                                        <input type="hidden" name="update_status" value="1">
                                        <select name="status" onchange="this.form.submit()" style="padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; border: 1px solid var(--admin-border); background: #fff;">
                                            <option value="Chờ xác nhận" <?= ($stt == 'Chờ xác nhận') ? 'selected' : '' ?>>⏳ Chờ xác nhận</option>
                                            <option value="Đang chuẩn bị hàng" <?= ($stt == 'Đang chuẩn bị hàng') ? 'selected' : '' ?>>📦 Đang chuẩn bị</option>
                                            <option value="Đang giao hàng" <?= ($stt == 'Đang giao hàng') ? 'selected' : '' ?>>🚚 Đang giao hàng</option>
                                            <option value="Giao thành công" <?= ($stt == 'Giao thành công') ? 'selected' : '' ?>>✅ Giao thành công</option>
                                            <option value="Đã hủy" <?= ($stt == 'Đã hủy') ? 'selected' : '' ?>>❌ Đã hủy</option>
                                        </select>
                                    </form>
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: inline-flex; gap: 6px; justify-content: center;">
                                        <a href="../controller/indexAdmin.php?act=chitietdonhang&id=<?= $id ?>" class="btn-action btn-edit" title="Xem hóa đơn chi tiết">
                                            <i class='bx bx-show'></i> Chi tiết
                                        </a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng #<?= $madh ?>?')" href="../controller/indexAdmin.php?act=donhang&xoa=<?= $id ?>" class="btn-action btn-delete" title="Xóa đơn hàng">
                                            <i class='bx bx-trash'></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 50px 20px; color: #94a3b8;">
                                <i class='bx bx-receipt' style="font-size: 40px; display: block; margin-bottom: 8px;"></i>
                                Không có đơn hàng nào trong danh sách.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
