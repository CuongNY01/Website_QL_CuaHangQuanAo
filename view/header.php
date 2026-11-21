<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../view/images/logo_fashion.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../view/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Fashion Store 24/7 - Cửa Hàng Thời Trang Nam Nữ Cao Cấp</title>
    
    <style>
        :root {
            --nav-primary: #1e293b;
            --nav-accent: #3b82f6;
            --nav-gold: #f59e0b;
        }

        /* Top Notification Bar */
        .top-announce-bar {
            background: #0f172a;
            color: #94a3b8;
            font-size: 12px;
            padding: 6px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .top-announce-bar a {
            color: #fbbf24;
            text-decoration: none;
            font-weight: 600;
        }
        .top-announce-bar a:hover {
            text-decoration: underline;
        }

        /* Main Header Taskbar */
        .header {
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            background: #ffffff;
            transition: all 0.3s ease;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .header-brand img {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        }
        .header-brand-text h1 {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: #0f172a;
            margin: 0;
            line-height: 1.1;
        }
        .header-brand-text span {
            font-size: 11px;
            color: #d97706;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Taskbar Menu */
        .taskbar-nav {
            display: flex;
            align-items: center;
            gap: 4px;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .taskbar-nav > li {
            position: relative;
        }
        .taskbar-nav > li > a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 14px;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .taskbar-nav > li > a:hover {
            color: var(--nav-accent);
            background: #f8fafc;
        }
        .taskbar-nav > li > a.nav-active {
            color: var(--nav-accent);
            font-weight: 700;
        }

        /* Dropdown Menu */
        .nav-dropdown {
            position: relative;
        }
        .nav-dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 260px;
            background: #ffffff;
            box-shadow: 0 12px 28px rgba(0,0,0,0.12);
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 10px 0;
            z-index: 1050;
            animation: fadeInDrop 0.2s ease-in-out;
        }
        @keyframes fadeInDrop {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .nav-dropdown:hover .nav-dropdown-menu {
            display: block;
        }
        .nav-dropdown-menu li {
            list-style: none;
        }
        .nav-dropdown-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 20px;
            color: #334155;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.15s ease;
        }
        .nav-dropdown-menu li a:hover {
            background: #eff6ff;
            color: var(--nav-accent);
            padding-left: 24px;
        }
        .nav-dropdown-menu li a i {
            font-size: 18px;
            color: #64748b;
        }
        .nav-dropdown-menu li a:hover i {
            color: var(--nav-accent);
        }

        /* Search & Actions */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .header-search-form {
            display: inline-flex;
            align-items: center;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 25px;
            padding: 3px 12px;
            transition: all 0.2s ease;
        }
        .header-search-form:focus-within {
            background: #fff;
            border-color: var(--nav-accent);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        .header-search-form input {
            border: none;
            background: transparent;
            padding: 6px 8px;
            font-size: 13px;
            outline: none;
            width: 170px;
            color: #1e293b;
            font-family: inherit;
        }
        .header-search-form button {
            border: none;
            background: transparent;
            cursor: pointer;
            color: #64748b;
            padding: 4px;
            display: flex;
            align-items: center;
        }
        .header-search-form button:hover {
            color: var(--nav-accent);
        }

        /* Cart & User */
        .cart-action-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #1e293b;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 20px;
        }
        .cart-action-btn:hover {
            background: #eff6ff;
            color: var(--nav-accent);
            border-color: #bfdbfe;
        }
        .cart-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #ef4444;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            border-radius: 50%;
            padding: 2px 6px;
            box-shadow: 0 2px 6px rgba(239, 68, 68, 0.4);
            line-height: 1.2;
        }
        .user-greeting {
            font-size: 13px;
            color: #1e293b;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: #f8fafc;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .user-greeting:hover {
            background: #eff6ff;
            border-color: #bfdbfe;
        }

        @media (max-width: 1024px) {
            .header {
                padding: 0 15px;
            }
            .header-search-form input {
                width: 120px;
            }
        }
        @media (max-width: 860px) {
            .taskbar-nav {
                display: none;
            }
        }

        .mobile-quick-cats {
            display: none;
            overflow-x: auto;
            white-space: nowrap;
            background: #ffffff;
            padding: 8px 15px;
            border-bottom: 1px solid #e2e8f0;
            gap: 8px;
            -webkit-overflow-scrolling: touch;
        }
        .mobile-quick-cats::-webkit-scrollbar {
            display: none;
        }
        .mobile-cat-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
            background: #f1f5f9;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: #334155;
            text-decoration: none;
        }
        .mobile-cat-chip.active {
            background: #0f172a;
            color: #fff;
        }
        @media (max-width: 860px) {
            .mobile-quick-cats {
                display: flex;
            }
        }
    </style>
</head>

<?php
$cur_act = $_GET['act'] ?? '';
$cur_cat = (int)($_GET['id'] ?? 0);
?>
<body>
<div class="website-wrapper">
    <!-- TOP ANNOUNCEMENT BAR -->
    <div class="top-announce-bar">
        <div>
            <span>🔥 <b>Ưu đãi mùa mới:</b> Miễn phí vận chuyển toàn quốc cho đơn từ 500.000đ • Hỗ trợ đổi size 7 ngày</span>
        </div>
        <div style="display: flex; gap: 15px; align-items: center;">
            <a href="../controller/index.php?act=tracuudonhang" style="color: #cbd5e1; text-decoration: none;"><i class='bx bx-search'></i> Tra cứu đơn hàng</a>
            <span>Hotline: <b>1900 6868</b></span>
            <a href="../controller/indexAdmin.php" target="_blank"><i class='bx bx-lock-alt'></i> Quản trị Admin</a>
        </div>
    </div>

    <!-- MAIN TASKBAR HEADER -->
    <header class="header">
        <a href="../controller/index.php" class="header-brand">
            <img src="../view/images/logo_fashion.png" alt="Fashion Store 24/7">
            <div class="header-brand-text">
                <h1>FASHION STORE</h1>
                <span>Thời Trang & Phong Cách</span>
            </div>
        </a>

        <!-- GỌN GÀNG: MENU ĐIỀU HƯỚNG VỚI DROPDOWN DANH MỤC -->
        <ul class="taskbar-nav">
            <li>
                <a href="../controller/index.php" class="<?= (empty($cur_act)) ? 'nav-active' : '' ?>">
                    <i class='bx bx-home-alt'></i> Trang Chủ
                </a>
            </li>

            <!-- DROPDOWN 5 DANH MỤC SẢN PHẨM -->
            <li class="nav-dropdown">
                <a href="javascript:void(0)" class="<?= ($cur_act === 'sanpham') ? 'nav-active' : '' ?>" style="cursor: pointer;">
                    <i class='bx bx-category'></i> Danh Mục Sản Phẩm <i class='bx bx-chevron-down' style="font-size: 16px;"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    <li>
                        <a href="../controller/index.php?act=sanpham&id=1">
                            <i class='bx bx-male'></i> Áo Nam & Sơ Mi
                        </a>
                    </li>
                    <li>
                        <a href="../controller/index.php?act=sanpham&id=2">
                            <i class='bx bx-female'></i> Thời Trang Nữ & Váy Đầm
                        </a>
                    </li>
                    <li>
                        <a href="../controller/index.php?act=sanpham&id=3">
                            <i class='bx bx-closet'></i> Quần Jean & Quần Tây
                        </a>
                    </li>
                    <li>
                        <a href="../controller/index.php?act=sanpham&id=4">
                            <i class='bx bxs-t-shirt'></i> Áo Khoác & Hoodie
                        </a>
                    </li>
                    <li>
                        <a href="../controller/index.php?act=sanpham&id=5">
                            <i class='bx bx-football'></i> Quần Áo Thể Thao
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="../controller/index.php?act=sanpham&id=1" class="<?= ($cur_act === 'sanpham' && $cur_cat === 1) ? 'nav-active' : '' ?>">Thời Trang Nam</a>
            </li>
            <li>
                <a href="../controller/index.php?act=sanpham&id=2" class="<?= ($cur_act === 'sanpham' && $cur_cat === 2) ? 'nav-active' : '' ?>">Thời Trang Nữ</a>
            </li>
            <li>
                <a href="../controller/index.php?act=baiviet" class="<?= ($cur_act === 'baiviet') ? 'nav-active' : '' ?>">
                    <i class='bx bx-news'></i> Tin Tức
                </a>
            </li>
            <li>
                <a href="../controller/index.php?act=about" class="<?= ($cur_act === 'about') ? 'nav-active' : '' ?>">Giới Thiệu</a>
            </li>
            <li>
                <a href="../controller/index.php?act=contac" class="<?= ($cur_act === 'contac') ? 'nav-active' : '' ?>">Liên Hệ</a>
            </li>
        </ul>

        <!-- RIGHT ACTIONS: TÌM KIẾM, TÀI KHOẢN, GIỎ HÀNG -->
        <div class="header-actions">
            <form action="../controller/index.php?act=seach" method="POST" class="header-search-form">
                <input type="text" name="filter" placeholder="Tìm kiếm trang phục..." required>
                <button type="submit" title="Tìm kiếm"><i class="fa fa-search"></i></button>
            </form>

            <?php if (isset($_SESSION['name'])): ?>
                <a href="../controller/index.php?act=login" class="user-greeting" title="Tài khoản khách hàng">
                    <?php if (!empty($_SESSION['avata'])): ?>
                        <img src="../view/images/<?= htmlspecialchars($_SESSION['avata']) ?>" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover;" alt="">
                    <?php else: ?>
                        <i class='bx bx-user-check' style="font-size: 18px; color: #10b981;"></i>
                    <?php endif; ?>
                    <span><?= htmlspecialchars($_SESSION['name']) ?></span>
                </a>
            <?php else: ?>
                <a href="../controller/index.php?act=login" class="cart-action-btn" title="Đăng nhập / Đăng ký">
                    <i class='bx bx-user'></i>
                </a>
            <?php endif; ?>

            <?php
                $cart_items_count = 0;
                if (isset($_SESSION['giohang']) && is_array($_SESSION['giohang'])) {
                    foreach ($_SESSION['giohang'] as $item) {
                        $cart_items_count += (int)($item[3] ?? 1);
                    }
                }
            ?>
            <a href="../controller/index.php?act=cart" class="cart-action-btn" title="Xem giỏ hàng">
                <i class='bx bx-shopping-bag'></i>
                <?php if ($cart_items_count > 0): ?>
                    <span class="cart-badge"><?= $cart_items_count ?></span>
                <?php endif; ?>
            </a>
        </div>
    </header>

    <!-- MOBILE QUICK CATEGORIES BAR -->
    <div class="mobile-quick-cats">
        <a href="../controller/index.php" class="mobile-cat-chip <?= empty($cur_act) ? 'active' : '' ?>">Trang Chủ</a>
        <a href="../controller/index.php?act=sanpham&id=1" class="mobile-cat-chip <?= ($cur_act === 'sanpham' && $cur_cat === 1) ? 'active' : '' ?>">Áo Nam</a>
        <a href="../controller/index.php?act=sanpham&id=2" class="mobile-cat-chip <?= ($cur_act === 'sanpham' && $cur_cat === 2) ? 'active' : '' ?>">Thời Trang Nữ</a>
        <a href="../controller/index.php?act=sanpham&id=3" class="mobile-cat-chip <?= ($cur_act === 'sanpham' && $cur_cat === 3) ? 'active' : '' ?>">Quần Jean & Tây</a>
        <a href="../controller/index.php?act=sanpham&id=4" class="mobile-cat-chip <?= ($cur_act === 'sanpham' && $cur_cat === 4) ? 'active' : '' ?>">Áo Khoác</a>
        <a href="../controller/index.php?act=sanpham&id=5" class="mobile-cat-chip <?= ($cur_act === 'sanpham' && $cur_cat === 5) ? 'active' : '' ?>">Thể Thao</a>
        <a href="../controller/index.php?act=tracuudonhang" class="mobile-cat-chip <?= ($cur_act === 'tracuudonhang') ? 'active' : '' ?>">Tra Cứu Đơn</a>
    </div>

    <!-- MAIN PAGE CONTENT WRAPPER -->
    <main class="site-main">
