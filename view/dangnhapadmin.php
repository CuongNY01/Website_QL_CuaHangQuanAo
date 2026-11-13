<link rel="stylesheet" href="../view/css/ad.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
if (isset($_POST['login'])) {
    $user = trim($_POST['username'] ?? '');
    $pass = trim($_POST['password'] ?? '');
    if ($user != '' && $pass != '') {
        $login = admin_query($user);
        $found = false;
        if (!empty($login)) {
            foreach ($login as $row) {
                if ($row['password'] == $pass) {
                    $found = true;
                    $_SESSION['idAdmin'] = $row['id'];
                    $_SESSION['userAd'] = $row['username'];
                    echo "<script>alert('Xin chào " . addslashes($row['username']) . ". Bạn đã đăng nhập quyền Quản trị thành công.'); window.location.href='../controller/indexAdmin.php?act=userAd';</script>";
                    exit;
                }
            }
        }
        if (!$found) {
            echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu quản trị!');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu!');</script>";
    }
}

if (isset($_SESSION['idAdmin'])) {
    echo "<script>window.location.href='../controller/indexAdmin.php?act=userAd';</script>";
    exit;
}
?>

<div class="main" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 40px 15px;">
    <form action="" method="POST" class="sua" style="width: 100%; max-width: 420px; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="../view/images/logo.jpg" alt="Logo Admin" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
            <h3 style="color: #2c3e50; font-weight: 700; font-size: 22px;">HỆ THỐNG QUẢN TRỊ</h3>
            <p style="color: #7f8c8d; font-size: 13px;">Website Quản Lý Bán Quần Áo - 24/7</p>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: 600; font-size: 14px; color: #333; margin-bottom: 5px; display: block;">Tài khoản Admin:</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Tên đăng nhập quản trị" name="username" required autofocus style="height: 42px;">
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: 600; font-size: 14px; color: #333; margin-bottom: 5px; display: block;">Mật khẩu:</label>
            <div class="input-group">
                <input type="password" class="form-control" placeholder="Mật khẩu" name="password" required style="height: 42px;">
            </div>
        </div>

        <button type="submit" name="login" class="btn btn-danger btn-block" style="height: 44px; font-weight: 700; font-size: 15px; border-radius: 6px; background: #e74c3c; border: none;">
            <i class="fa fa-sign-in"></i> ĐĂNG NHẬP ADMIN
        </button>

        <div style="text-align: center; margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee;">
            <a href="../controller/index.php" style="color: #007bff; font-size: 13px; text-decoration: none;">
                <i class="fa fa-arrow-left"></i> Quay lại trang chủ bán hàng
            </a>
        </div>
    </form>
</div>
