<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../view/images/logo.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../view/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Website Quản Lý Bán Quần Áo - Football Store 24/7</title>
    <style>
        .header-search-form {
            display: inline-flex;
            align-items: center;
            background: #f1f2f6;
            border-radius: 20px;
            padding: 2px 10px;
            margin: 0 10px;
        }
        .header-search-form input {
            border: none;
            background: transparent;
            padding: 6px 10px;
            font-size: 13px;
            outline: none;
            width: 170px;
            color: #333;
        }
        .header-search-form button {
            border: none;
            background: transparent;
            cursor: pointer;
            color: #555;
            padding: 4px;
        }
        .header-search-form button:hover {
            color: #000;
        }
        .cart-badge {
            background: #e74c3c;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            border-radius: 50%;
            padding: 2px 6px;
            position: relative;
            top: -10px;
            left: -5px;
        }
        .user-greeting {
            font-size: 13px;
            color: #333;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">

            <div class="logo">
                <a href="../controller/index.php">
                    <img src="../view/images/logo3.png" style="width: 60px; height: 60px; margin-left: 2rem; object-fit: contain;" alt="Football Store 24/7">
                </a>
            </div>

            <div class="header-menu">
                <div class="responsive-menu"><i class="fa fa-bars"></i></div>
                <ul class="responsive-sub-menu">
                    <li><a href="../controller/index.php" class="menu-active" title="Trang chủ"><i class="fa fa-home"></i></a></li>
                    <li><a href="../controller/index.php">Trang Chủ</a></li>
                    <li><a href="../controller/about.php">Giới Thiệu</a></li>
                    <?php 
                        $dsdanhmmuc = danhmuc_showAll();
                        if (!empty($dsdanhmmuc)) {
                            foreach($dsdanhmmuc as $row){
                                echo '<li><a href="../controller/index.php?act=sanpham&id=' . $row['iddanhmuc'] . '">' . htmlspecialchars($row['tendanhmuc']) . '</a></li>';
                            }
                        }
                    ?>
                    <li><a href="../controller/index.php?act=baiviet">Tin Tức</a></li>
                    <li><a href="../controller/contac.php">Liên Hệ</a></li>

                    <!-- Header Search Bar -->
                    <li>
                        <form action="../controller/index.php?act=seach" method="POST" class="header-search-form">
                            <input type="text" name="filter" placeholder="Tìm áo, quần, váy, đầm..." required>
                            <button type="submit" title="Tìm kiếm"><i class="fa fa-search"></i></button>
                        </form>
                    </li>

                    <!-- User Account Status -->
                    <?php if (isset($_SESSION['name'])): ?>
                        <li>
                            <a href="../controller/index.php?act=login" class="user-greeting" title="Quản lý tài khoản">
                                <?php if (!empty($_SESSION['avata'])): ?>
                                    <img src="../view/images/<?= htmlspecialchars($_SESSION['avata']) ?>" style="width: 26px; height: 26px; border-radius: 50%; object-fit: cover;" alt="">
                                <?php else: ?>
                                    <i class='bx bx-user-check' style="font-size: 18px; color: #27ae60;"></i>
                                <?php endif; ?>
                                <span><?= htmlspecialchars($_SESSION['name']) ?></span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="../controller/index.php?act=login" class="menu-active menu-user" title="Đăng nhập / Đăng ký">
                                <i class='bx bx-user'></i>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Shopping Cart Icon with Count -->
                    <?php
                        $cart_items_count = 0;
                        if (isset($_SESSION['giohang']) && is_array($_SESSION['giohang'])) {
                            foreach ($_SESSION['giohang'] as $item) {
                                $cart_items_count += (int)($item[3] ?? 1);
                            }
                        }
                    ?>
                    <li>
                        <a href="../controller/index.php?act=cart" class="menu-active menu-user" title="Xem giỏ hàng" style="position: relative;">
                            <i class='bx bx-cart'></i>
                            <?php if ($cart_items_count > 0): ?>
                                <span class="cart-badge"><?= $cart_items_count ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="head-social-link">
            </div>
        </div>
    </div>
