<link rel="stylesheet" href="../view/css/lo_re.css">
<link rel="stylesheet" href="../view/css/products.css">

<?php
if (isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username != '' && $password != '') {
        $login = login($username);
        $found = false;
        if (!empty($login)) {
            foreach ($login as $row) {
                if ($row['password'] == $password) {
                    $found = true;
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['avata'] = $row['avata'];
                    $_SESSION['password'] = $row['password'];
                    echo "<script>alert('Đăng nhập thành công! Xin chào " . addslashes($row['name']) . "'); window.location.href='../controller/index.php';</script>";
                    exit;
                }
            }
        }
        if (!$found) {
            echo "<script>alert('Tài khoản hoặc mật khẩu không chính xác, vui lòng thử lại!');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu!');</script>";
    }
}
?>

<div class="main" style="max-width: 600px; margin: 40px auto; padding: 0 20px;">
    <?php if (isset($_SESSION['name'])): ?>
        <div class="userlogin" style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); text-align: center;">
            <img src="../view/images/<?= !empty($_SESSION['avata']) ? htmlspecialchars($_SESSION['avata']) : 'iconUser.png' ?>" alt="Avatar" style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 2px solid #007bff; margin-bottom: 15px;">
            <h2 style="color: #2c3e50; margin-bottom: 5px;">Xin Chào: <span style="color: #007bff;"><?= htmlspecialchars($_SESSION['name']) ?></span></h2>
            <p style="color: #7f8c8d; font-size: 14px; margin-bottom: 25px;">Thành viên của Football Store 24/7</p>

            <table style="width: 100%; border-collapse: collapse; margin-bottom: 25px; text-align: left; font-size: 14px;">
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px 0; color: #7f8c8d; width: 140px;">Tên đăng nhập:</td>
                    <td style="padding: 10px 0; font-weight: 600;"><?= htmlspecialchars($_SESSION['username']) ?></td>
                </tr>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px 0; color: #7f8c8d;">Họ và tên:</td>
                    <td style="padding: 10px 0; font-weight: 600;"><?= htmlspecialchars($_SESSION['name']) ?></td>
                </tr>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px 0; color: #7f8c8d;">Email:</td>
                    <td style="padding: 10px 0;"><?= htmlspecialchars($_SESSION['email']) ?></td>
                </tr>
                <tr>
                    <td style="padding: 10px 0; color: #7f8c8d;">Mật khẩu:</td>
                    <td style="padding: 10px 0;">••••••••</td>
                </tr>
            </table>

            <div style="display: flex; gap: 15px; justify-content: center;">
                <a href="../controller/index.php?act=suauser" style="padding: 10px 25px; background: #007bff; color: #fff; text-decoration: none; border-radius: 4px; font-weight: 600;">
                    <i class="fa fa-edit"></i> Chỉnh sửa hồ sơ
                </a>
                <a href="../view/logout.php" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?');" style="padding: 10px 25px; background: #e74c3c; color: #fff; text-decoration: none; border-radius: 4px; font-weight: 600;">
                    <i class="fa fa-sign-out"></i> Đăng xuất
                </a>
            </div>
        </div>

    <?php else: ?>
        <div class="dangky" style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
            <form action="../controller/index.php?act=login" method="POST">
                <h2 style="text-align: center; color: #2c3e50; margin-bottom: 25px;">ĐĂNG NHẬP KHÁCH HÀNG</h2>
                
                <div style="margin-bottom: 15px;">
                    <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Tên đăng nhập:</label>
                    <input type="text" placeholder="Nhập tên đăng nhập" name="username" required style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Mật khẩu:</label>
                    <input type="password" placeholder="Nhập mật khẩu" name="password" required style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
                </div>

                <div style="margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; font-size: 13px;">
                    <label style="cursor: pointer;"><input type="checkbox" checked> Ghi nhớ đăng nhập</label>
                    <a href="../controller/index.php?act=register" style="color: #007bff; text-decoration: none;">Chưa có tài khoản? Đăng ký</a>
                </div>

                <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                    <input type="submit" value="Đăng nhập" name="login" class="dangnhap" style="flex: 1; height: 42px; background: #007bff; color: white; border: none; border-radius: 4px; font-weight: 600; cursor: pointer; font-size: 15px;">
                    <a href="../controller/index.php?act=register" style="flex: 1; height: 42px; line-height: 42px; text-align: center; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-weight: 600; font-size: 15px;">Đăng ký mới</a>
                </div>

                <div style="text-align: center; border-top: 1px solid #eee; padding-top: 15px;">
                    <p style="font-size: 13px; color: #7f8c8d; margin-bottom: 10px;">Bạn là ban quản trị cửa hàng?</p>
                    <a href="../controller/indexAdmin.php" style="display: inline-block; padding: 6px 18px; background: #2c3e50; color: #fff; text-decoration: none; border-radius: 4px; font-size: 13px;">
                        <i class="fa fa-lock"></i> Đăng nhập Admin
                    </a>
                </div>
            </form>
        </div>
    <?php endif; ?>
</div>
