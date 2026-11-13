<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Trị - Football Store 24/7</title>
    <link rel="icon" href="../view/images/logo.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../view/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="../view/css/admin.css">
    <link rel="stylesheet" href="../view/css/index.css">
    <style>
        .header-menu ul.responsive-sub-menu li a.active {
            color: #007bff;
            font-weight: 600;
        }
        .header .logo img {
            object-fit: contain;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <a href="../controller/indexAdmin.php?act=userAd">
                <img src="../view/images/logo3.png" style="width: 55px; height: 55px; margin-left: 4rem; object-fit: contain;" alt="Logo Admin">
            </a>
        </div>

        <div class="header-menu">
            <div class="responsive-menu"><i class="fa fa-bars"></i></div>
            <ul class="responsive-sub-menu">
                <li><a href="../controller/indexAdmin.php?act=userAd" title="Trang tổng quan Admin"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
                <li><a href="../controller/indexAdmin.php?act=sanpham"><i class='bx bx-closet'></i> Sản Phẩm</a></li>
                <li><a href="../controller/indexAdmin.php?act=danhmuc"><i class='bx bx-category'></i> Danh Mục</a></li>
                <li><a href="../controller/indexAdmin.php?act=admin"><i class='bx bx-group'></i> Khách Hàng</a></li>
                <li><a href="../controller/indexAdmin.php?act=binhluan"><i class='bx bx-comment-detail'></i> Bình Luận</a></li>
                <li><a href="../controller/index.php" target="_blank" title="Xem trang bán hàng (Client)"><i class='bx bx-store'></i> Xem Website</a></li>
                <li><a href="../controller/indexAdmin.php?act=userAd" class="menu-active menu-user" title="Tài khoản Admin"><i class='bx bx-user'></i></a></li>
                <li><a href="../viewAdmin/logout.php" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất trang quản trị?');" class="menu-active menu-user" title="Đăng xuất"><i class='bx bx-log-out'></i></a></li>
            </ul>
        </div>

        <div class="head-social-link">
        </div>
    </div>
    <div class="container-admin" style="max-width: 1300px; margin: 0 auto; padding: 20px;">
