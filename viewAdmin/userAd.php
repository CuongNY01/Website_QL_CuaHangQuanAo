<?php
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
?>

<!-- 4 STAT METRICS CARDS -->
<div class="admin-stats-grid">
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
        <div class="stat-icon amber">
            <i class='bx bx-comment-dots'></i>
        </div>
    </div>
</div>

<!-- PROFILE & PASSWORD FORM CARD -->
<div class="admin-form-container">
    <div style="text-align: center; margin-bottom: 25px;">
        <img src="../view/images/logo.jpg" alt="Admin" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-bottom: 12px; border: 3px solid #eff6ff;">
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
