<div class="main">
    <main>
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
                echo "<script>alert('Cập nhật tên đăng nhập Admin thành công');</script>";
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
        ?>

        <div style="max-width: 500px; margin: 30px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.08);">
            <div style="text-align: center; margin-bottom: 25px;">
                <img src="../view/images/logo.jpg" alt="Admin" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 10px;">
                <h2 style="color: #2c3e50; font-size: 22px;">Hồ Sơ Quản Trị Viên</h2>
                <p style="color: #7f8c8d; font-size: 14px;">Xin chào, <b><?php echo htmlspecialchars($current_user); ?></b></p>
            </div>

            <form action="../controller/indexAdmin.php?act=userAd" method="POST">
                <div style="margin-bottom: 15px;">
                    <label style="font-weight: 600; display: block; margin-bottom: 5px;">Tên đăng nhập Admin:</label>
                    <input type="text" name="user" value="<?php echo htmlspecialchars($current_user); ?>" required style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="font-weight: 600; display: block; margin-bottom: 5px;">Email liên hệ:</label>
                    <input type="email" value="<?php echo htmlspecialchars($current_email); ?>" disabled style="width: 100%; height: 38px; padding: 5px 10px; background: #f5f5f5; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <hr style="margin: 20px 0; border: none; border-top: 1px solid #eee;">
                <h4 style="margin-bottom: 15px; color: #34495e;">Đổi Mật Khẩu Quản Trị</h4>

                <div style="margin-bottom: 15px;">
                    <label style="font-weight: 600; display: block; margin-bottom: 5px;">Mật khẩu hiện tại:</label>
                    <input type="password" name="old_pass" placeholder="Nhập mật khẩu hiện tại" style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="font-weight: 600; display: block; margin-bottom: 5px;">Mật khẩu mới:</label>
                    <input type="password" name="new_pass" placeholder="Để trống nếu không muốn đổi" style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; display: block; margin-bottom: 5px;">Nhập lại mật khẩu mới:</label>
                    <input type="password" name="renew_pass" placeholder="Xác nhận mật khẩu mới" style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <input type="submit" name="doipass" value="Lưu Thay Đổi" style="width: 100%; height: 42px; background: #007bff; color: white; border: none; border-radius: 4px; font-weight: 600; font-size: 15px; cursor: pointer;">
            </form>
        </div>
    </main>
</div>
