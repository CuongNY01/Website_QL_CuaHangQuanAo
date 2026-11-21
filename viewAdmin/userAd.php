<?php
include_once "../model/donhang.php";

$id = $_SESSION['idAdmin'] ?? 1;
$admin = show_admin_id_one($id);
if (!$admin) {
    echo "<script>alert('Không tìm thấy tài khoản admin'); window.location.href='../controller/indexAdmin.php';</script>";
    exit;
}

$current_user = $admin['username'];
$current_pass = $admin['password'];
$current_email = $admin['email'] ?? '';

if (isset($_POST['doipass'])) {
    $new_user = trim($_POST['user'] ?? '');
    $old_pass = trim($_POST['old_pass'] ?? '');
    $new_pass = trim($_POST['new_pass'] ?? '');
    $renew_pass = trim($_POST['renew_pass'] ?? '');

    // Update username if changed
    if ($new_user != "" && $new_user != $current_user) {
        update_admin_user($id, $new_user);
        $_SESSION['userAd'] = $new_user;
        $current_user = $new_user;
        echo "<script>alert('Cập nhật tên đăng nhập Admin thành công!');</script>";
    }

    // Update password if entered
    if ($new_pass != "") {
        if ($old_pass != $current_pass) {
            echo "<script>alert('Mật khẩu cũ không chính xác!');</script>";
        } else if ($new_pass != $renew_pass) {
            echo "<script>alert('Mật khẩu mới nhập lại không khớp!');</script>";
        } else {
            update_admin_pass($id, $new_pass);
            $current_pass = $new_pass;
            echo "<script>alert('Đổi mật khẩu quản trị viên thành công!');</script>";
        }
    }
}

// Thống kê số lượng
$total_sp = count(sanpham_showAll());
$total_dm = count(danhmuc_showAll());
$total_user = count(show_user());
$total_bl = count(binhluan_showall());
$all_orders = donhang_showAll();
$total_dh = count($all_orders);
$pending_dh = donhang_count_pending();
$total_rev = donhang_tong_doanhthu();
$recent_orders = array_slice($all_orders, 0, 5);
?>

<!-- 6 STAT METRICS CARDS -->
<div class="admin-stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));">
    <div class="stat-card">
        <div class="stat-info">
            <p>Tổng Sản Phẩm</p>
            <h3><?= $total_sp ?></h3>
        </div>
        <div class="stat-icon emerald">
            <i class='bx bx-closet'></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <p>Danh Mục Hàng</p>
            <h3><?= $total_dm ?></h3>
        </div>
        <div class="stat-icon blue">
            <i class='bx bx-category'></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <p>Tổng Đơn Hàng</p>
            <h3><?= $total_dh ?> <span style="font-size: 13px; font-weight: 600; color: #f59e0b;">(<?= $pending_dh ?> mới)</span></h3>
        </div>
        <div class="stat-icon amber">
            <i class='bx bx-receipt'></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <p>Doanh Thu Shop</p>
            <h3 style="font-size: 22px; color: #10b981;"><?= number_format($total_rev, 0, ',', '.') ?>đ</h3>
        </div>
        <div class="stat-icon emerald">
            <i class='bx bx-dollar-circle'></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <p>Khách Hàng</p>
            <h3><?= $total_user ?></h3>
        </div>
        <div class="stat-icon purple">
            <i class='bx bx-group'></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <p>Đánh Giá & Review</p>
            <h3><?= $total_bl ?></h3>
        </div>
        <div class="stat-icon blue">
            <i class='bx bx-comment-dots'></i>
        </div>
    </div>
</div>

<!-- KHỐI 5 ĐƠN HÀNG GẦN ĐÂY CẦN XỬ LÝ -->
<div class="admin-card" style="margin-bottom: 30px;">
    <div class="admin-card-header">
        <div class="admin-card-title-group">
            <h2><i class='bx bx-time-five' style="color: #3b82f6;"></i> Đơn Hàng Mới Nhất</h2>
            <p>Các đơn đặt hàng vừa được khách đặt cần kiểm tra và xử lý vận chuyển</p>
        </div>
        <div>
            <a href="../controller/indexAdmin.php?act=donhang" class="btn-action btn-secondary" style="font-size: 13px;">
                Xem tất cả đơn hàng <i class='bx bx-chevron-right'></i>
            </a>
        </div>
    </div>
    <div class="admin-card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Mã Đơn</th>
                        <th>Khách Hàng / SĐT</th>
                        <th>Ngày Đặt</th>
                        <th style="text-align: right;">Tổng Tiền</th>
                        <th style="text-align: center;">Trạng Thái</th>
                        <th style="text-align: center;">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recent_orders)): ?>
                        <?php foreach ($recent_orders as $ro): 
                            $stt = $ro['trangthai'];
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
                                <td><strong style="color: #0f172a;">#<?= htmlspecialchars($ro['madh']) ?></strong></td>
                                <td>
                                    <strong><?= htmlspecialchars($ro['hoten']) ?></strong>
                                    <div style="font-size: 12px; color: #64748b;"><?= htmlspecialchars($ro['sdt']) ?></div>
                                </td>
                                <td style="color: #64748b; font-size: 13px;"><?= date("d/m/Y H:i", strtotime($ro['ngaydathang'])) ?></td>
                                <td style="text-align: right; font-weight: 700; color: #ef4444;"><?= number_format($ro['tongtien'], 0, ',', '.') ?> đ</td>
                                <td style="text-align: center;">
                                    <span class="badge-pill <?= $badge_class ?>"><?= htmlspecialchars($stt) ?></span>
                                </td>
                                <td style="text-align: center;">
                                    <a href="../controller/indexAdmin.php?act=chitietdonhang&id=<?= $ro['id'] ?>" class="btn-action btn-edit" style="padding: 5px 12px;">
                                        <i class='bx bx-show'></i> Xem chi tiết
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align: center; padding: 30px; color: #94a3b8;">Chưa có đơn hàng nào.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- PROFILE & PASSWORD FORM CARD -->
<div class="admin-form-container">
    <div style="text-align: center; margin-bottom: 25px;">
        <img src="../view/images/logo_fashion.png" alt="Admin" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-bottom: 12px; border: 3px solid #eff6ff;">
        <h2 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0;">Hồ Sơ Quản Trị Viên</h2>
        <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Xin chào, <b><?= htmlspecialchars($current_user) ?></b> (Quyền: Administrator)</p>
    </div>

    <form action="../controller/indexAdmin.php?act=userAd" method="POST">
        <div class="form-group">
            <label>Tên đăng nhập Admin:</label>
            <input type="text" class="form-control-custom" name="user" value="<?= htmlspecialchars($current_user) ?>" required>
        </div>

        <div class="form-group">
            <label>Email liên hệ:</label>
            <input type="email" class="form-control-custom" value="<?= htmlspecialchars($current_email) ?>" disabled>
        </div>

        <div style="border-top: 1px solid #e2e8f0; margin: 24px 0 20px 0; padding-top: 16px;">
            <h4 style="font-size: 15px; font-weight: 700; color: #334155; margin-bottom: 6px;">
                <i class='bx bx-lock-alt' style="color: #3b82f6;"></i> Đổi Mật Khẩu Quản Trị
            </h4>
            <p style="font-size: 12px; color: #94a3b8; margin-bottom: 16px;">Để trống các ô bên dưới nếu bạn không muốn đổi mật khẩu</p>

            <div class="form-group">
                <label>Mật khẩu hiện tại:</label>
                <input type="password" class="form-control-custom" name="old_pass" placeholder="Nhập mật khẩu hiện tại">
            </div>

            <div class="form-group">
                <label>Mật khẩu mới:</label>
                <input type="password" class="form-control-custom" name="new_pass" placeholder="Mật khẩu mới">
            </div>

            <div class="form-group">
                <label>Nhập lại mật khẩu mới:</label>
                <input type="password" class="form-control-custom" name="renew_pass" placeholder="Xác nhận lại mật khẩu mới">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" name="doipass" class="btn-action btn-primary">
                <i class='bx bx-save'></i> Lưu Thay Đổi
            </button>
        </div>
    </form>
</div>
