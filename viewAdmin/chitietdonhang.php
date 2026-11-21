<?php
include_once "../model/donhang.php";

$id = (int)($_GET['id'] ?? 0);
$order = donhang_showId($id);

if (!$order) {
    echo "<script>alert('Không tìm thấy thông tin đơn hàng!'); window.location.href='../controller/indexAdmin.php?act=donhang';</script>";
    exit;
}

// Cập nhật trạng thái
if (isset($_POST['capnhat_trangthai'])) {
    $new_status = trim($_POST['trangthai'] ?? '');
    if ($new_status != '') {
        donhang_update_trangthai($id, $new_status);
        $order['trangthai'] = $new_status;
        echo "<script>alert('Cập nhật trạng thái đơn hàng thành công!');</script>";
    }
}

$items = donhang_chitiet_show($id);
$stt = $order['trangthai'];

$badge_class = "badge-warning";
if ($stt === 'Đang giao hàng' || $stt === 'Đang chuẩn bị hàng') {
    $badge_class = "badge-info";
} else if ($stt === 'Giao thành công') {
    $badge_class = "badge-success";
} else if ($stt === 'Đã hủy') {
    $badge_class = "badge-danger";
}
?>

<div class="admin-card">
    <div class="admin-card-header">
        <div class="admin-card-title-group">
            <h2><i class='bx bx-file' style="color: #3b82f6;"></i> Chi Tiết Đơn Hàng #<?= htmlspecialchars($order['madh']) ?></h2>
            <p>Ngày đặt: <?= date("d/m/Y - H:i:s", strtotime($order['ngaydathang'])) ?></p>
        </div>
        <div style="display: flex; gap: 10px;">
            <button onclick="window.print()" class="btn-action btn-secondary" style="background: #fff; cursor: pointer;">
                <i class='bx bx-printer'></i> In Đơn Hàng
            </button>
            <a href="../controller/indexAdmin.php?act=donhang" class="btn-action btn-secondary">
                <i class='bx bx-arrow-back'></i> Quay Lại
            </a>
        </div>
    </div>

    <div class="admin-card-body">
        <!-- Form cập nhật trạng thái đơn hàng -->
        <div style="background: #f8fafc; border: 1px solid var(--admin-border); border-radius: 10px; padding: 18px 24px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
            <div>
                <span style="font-size: 13px; color: #64748b; font-weight: 600; text-transform: uppercase;">Trạng thái hiện tại:</span>
                <div style="margin-top: 4px;">
                    <span class="badge-pill <?= $badge_class ?>" style="font-size: 14px; padding: 6px 16px;">
                        <?= htmlspecialchars($stt) ?>
                    </span>
                </div>
            </div>

            <form action="" method="POST" style="display: flex; gap: 10px; align-items: center; margin: 0;">
                <label style="font-size: 13px; font-weight: 700; color: #334155;">Chuyển trạng thái:</label>
                <select name="trangthai" class="form-control-custom" style="width: 200px; height: 38px;">
                    <option value="Chờ xác nhận" <?= ($stt == 'Chờ xác nhận') ? 'selected' : '' ?>>⏳ Chờ xác nhận</option>
                    <option value="Đang chuẩn bị hàng" <?= ($stt == 'Đang chuẩn bị hàng') ? 'selected' : '' ?>>📦 Đang chuẩn bị hàng</option>
                    <option value="Đang giao hàng" <?= ($stt == 'Đang giao hàng') ? 'selected' : '' ?>>🚚 Đang giao hàng</option>
                    <option value="Giao thành công" <?= ($stt == 'Giao thành công') ? 'selected' : '' ?>>✅ Giao thành công</option>
                    <option value="Đã hủy" <?= ($stt == 'Đã hủy') ? 'selected' : '' ?>>❌ Đã hủy</option>
                </select>
                <button type="submit" name="capnhat_trangthai" class="btn-action btn-primary" style="height: 38px; padding: 0 16px;">
                    <i class='bx bx-check'></i> Cập Nhật
                </button>
            </form>
        </div>

        <!-- 2 Cột thông tin: Khách hàng & Thanh toán -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px; margin-bottom: 25px;">
            <div style="border: 1px solid var(--admin-border); border-radius: 10px; padding: 20px; background: #fff;">
                <h4 style="font-size: 15px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                    <i class='bx bx-user' style="color: #3b82f6;"></i> Thông Tin Khách Hàng
                </h4>
                <p style="margin-bottom: 8px; font-size: 14px;"><b>Họ và tên:</b> <?= htmlspecialchars($order['hoten']) ?></p>
                <p style="margin-bottom: 8px; font-size: 14px;"><b>Số điện thoại:</b> <a href="tel:<?= htmlspecialchars($order['sdt']) ?>" style="color: #3b82f6;"><?= htmlspecialchars($order['sdt']) ?></a></p>
                <p style="margin-bottom: 8px; font-size: 14px;"><b>Email:</b> <?= htmlspecialchars($order['email'] ?: 'Chưa cung cấp') ?></p>
                <p style="margin-bottom: 8px; font-size: 14px;"><b>Địa chỉ giao:</b> <?= htmlspecialchars($order['diachi']) ?></p>
            </div>

            <div style="border: 1px solid var(--admin-border); border-radius: 10px; padding: 20px; background: #fff;">
                <h4 style="font-size: 15px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                    <i class='bx bx-credit-card' style="color: #10b981;"></i> Thông Tin Thanh Toán
                </h4>
                <p style="margin-bottom: 8px; font-size: 14px;"><b>Phương thức:</b> <span style="color: #3b82f6; font-weight: 600;"><?= htmlspecialchars($order['pttt']) ?></span></p>
                <p style="margin-bottom: 8px; font-size: 14px;"><b>Ghi chú đơn hàng:</b> <?= htmlspecialchars($order['ghichu'] ?: 'Không có ghi chú') ?></p>
                <p style="margin-bottom: 8px; font-size: 14px;">
                    <b>Tổng tiền thanh toán:</b> 
                    <span style="font-size: 18px; font-weight: 800; color: #ef4444;"><?= number_format($order['tongtien'], 0, ',', '.') ?> VNĐ</span>
                </p>
            </div>
        </div>

        <!-- Bảng danh sách sản phẩm trong đơn -->
        <h4 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 14px; display: flex; align-items: center; gap: 6px;">
            <i class='bx bx-closet' style="color: #a855f7;"></i> Danh Sách Trang Phục Trong Đơn Hàng (<?= count($items) ?> sản phẩm)
        </h4>

        <div class="table-responsive" style="border: 1px solid var(--admin-border); border-radius: 10px; overflow: hidden;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 70px; text-align: center;">STT</th>
                        <th style="width: 80px; text-align: center;">Ảnh</th>
                        <th>Tên Sản Phẩm Thời Trang</th>
                        <th style="width: 100px; text-align: center;">Size</th>
                        <th style="width: 140px; text-align: right;">Đơn Giá</th>
                        <th style="width: 100px; text-align: center;">Số Lượng</th>
                        <th style="width: 160px; text-align: right;">Thành Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $stt_idx = 1;
                    $tong_tam = 0;
                    foreach ($items as $it): 
                        $tong_tam += (int)$it['thanhtien'];
                    ?>
                        <tr>
                            <td style="text-align: center; color: #64748b;"><?= $stt_idx++ ?></td>
                            <td style="text-align: center;">
                                <img src="../view/images/<?= htmlspecialchars($it['hinh']) ?>" alt="" style="width: 48px; height: 48px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
                            </td>
                            <td>
                                <strong style="color: #0f172a; font-size: 14px;"><?= htmlspecialchars($it['tensp']) ?></strong>
                            </td>
                            <td style="text-align: center;">
                                <span class="badge-pill badge-neutral" style="font-weight: 700;"><?= htmlspecialchars($it['size']) ?></span>
                            </td>
                            <td style="text-align: right; color: #64748b;">
                                <?= number_format($it['dongia'], 0, ',', '.') ?> đ
                            </td>
                            <td style="text-align: center; font-weight: 700; color: #1e293b;">
                                <?= $it['soluong'] ?>
                            </td>
                            <td style="text-align: right; font-weight: 800; color: #0f172a;">
                                <?= number_format($it['thanhtien'], 0, ',', '.') ?> đ
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr style="background: #f8fafc; font-weight: 700;">
                        <td colspan="6" style="text-align: right; padding: 16px; font-size: 15px; color: #334155;">
                            Tổng thanh toán đơn hàng:
                        </td>
                        <td style="text-align: right; padding: 16px; font-size: 18px; color: #ef4444; font-weight: 800;">
                            <?= number_format($order['tongtien'], 0, ',', '.') ?> VNĐ
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
