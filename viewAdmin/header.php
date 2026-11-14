<?php
if (!isset($_SESSION)) {
    session_start();
}
$act = $_GET['act'] ?? 'userAd';
$admin_name = $_SESSION['userAd'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Trị - Fashion Store 24/7</title>
    <link rel="icon" href="../view/images/logo.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../view/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="../view/css/admin.css">
</head>

<body class="admin-body">
    <!-- TOP NAVIGATION BAR -->
    <header class="admin-navbar">
        <a href="../controller/indexAdmin.php?act=userAd" class="admin-navbar-brand">
            <img src="../view/images/logo3.png" alt="Logo Fashion Store">
            <div class="admin-brand-info">
                <h1>FASHION STORE</h1>
                <span>Quản trị hệ thống</span>
            </div>
        </a>

        <ul class="admin-nav-links">
            <li>
                <a href="../controller/indexAdmin.php?act=userAd" class="<?= ($act == 'userAd' || empty($act)) ? 'active' : '' ?>">
                    <i class='bx bxs-dashboard'></i> Dashboard
                </a>
            </li>
            <li>
                <a href="../controller/indexAdmin.php?act=danhmuc" class="<?= (in_array($act, ['danhmuc', 'themdanhmuc', 'suadanhmuc'])) ? 'active' : '' ?>">
                    <i class='bx bx-category'></i> Danh Mục
                </a>
            </li>
            <li>
                <a href="../controller/indexAdmin.php?act=sanpham" class="<?= (in_array($act, ['sanpham', 'themsanpham', 'suasanpham', 'layout_tim'])) ? 'active' : '' ?>">
                    <i class='bx bx-closet'></i> Sản Phẩm
                </a>
            </li>
            <li>
                <a href="../controller/indexAdmin.php?act=admin" class="<?= (in_array($act, ['admin', 'themuser', 'suauser'])) ? 'active' : '' ?>">
                    <i class='bx bx-group'></i> Khách Hàng
                </a>
            </li>
            <li>
                <a href="../controller/indexAdmin.php?act=binhluan" class="<?= ($act == 'binhluan') ? 'active' : '' ?>">
                    <i class='bx bx-comment-detail'></i> Bình Luận
                </a>
            </li>
        </ul>

        <div class="admin-user-pill">
            <a href="../controller/index.php" target="_blank" class="admin-view-site-btn" title="Mở trang bán hàng phía người dùng">
                <i class='bx bx-store-alt'></i> Xem Website
            </a>
            <a href="../controller/indexAdmin.php?act=userAd" class="admin-profile-badge" title="Hồ sơ quản trị viên">
                <img src="../view/images/logo.jpg" alt="Admin">
                <span><?= htmlspecialchars($admin_name) ?></span>
            </a>
            <a href="../viewAdmin/logout.php" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất tài khoản quản trị?');" class="admin-logout-btn" title="Đăng xuất">
                <i class='bx bx-log-out'></i>
            </a>
        </div>
    </header>

    <!-- MAIN ADMIN CONTENT CONTAINER -->
    <main class="admin-container">
