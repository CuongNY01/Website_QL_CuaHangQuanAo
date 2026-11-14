<link rel="stylesheet" href="../view/css/index.css">
<link rel="stylesheet" href="../view/css/products.css">

<style>
    .cat-nav-bar {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin: 25px auto;
        flex-wrap: wrap;
        max-width: 1200px;
        padding: 0 15px;
    }
    .cat-nav-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 22px;
        background: #fff;
        border: 1px solid #e1e8ed;
        border-radius: 30px;
        color: #2c3e50;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        transition: all 0.25s ease;
    }
    .cat-nav-pill:hover {
        background: #2c3e50;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }
    .cat-nav-pill i {
        font-size: 18px;
    }
    .section-title-wrap {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        border-bottom: 2px solid #f1f2f6;
        padding-bottom: 12px;
    }
    .section-title-wrap h3 {
        font-size: 20px;
        color: #2c3e50;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .view-more-link {
        font-size: 14px;
        color: #007bff;
        text-decoration: none;
        font-weight: 600;
    }
    .view-more-link:hover {
        text-decoration: underline;
    }
</style>

<div class="banner">
     <img src="../view/images/banner_home_fashion.jpg" alt="Bộ Sưu Tập Thời Trang Đa Dạng 2026" style="width: 100%; max-height: 400px; object-fit: cover; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
</div>

<!-- Thanh điều hướng danh mục nhanh -->
<div class="cat-nav-bar">
    <a href="../controller/index.php?act=sanpham&id=1" class="cat-nav-pill">
        <i class='bx bx-male'></i> Áo Nam & Sơ Mi
    </a>
    <a href="../controller/index.php?act=sanpham&id=2" class="cat-nav-pill">
        <i class='bx bx-female'></i> Thời Trang Nữ & Váy
    </a>
    <a href="../controller/index.php?act=sanpham&id=3" class="cat-nav-pill">
        <i class='bx bx-closet'></i> Quần Jean & Quần Tây
    </a>
    <a href="../controller/index.php?act=sanpham&id=4" class="cat-nav-pill">
        <i class='bx bxs-t-shirt'></i> Áo Khoác & Hoodie
    </a>
    <a href="../controller/index.php?act=sanpham&id=5" class="cat-nav-pill">
        <i class='bx bx-football'></i> Quần Áo Thể Thao
    </a>
</div>

<div class="product" style="max-width: 1424px; margin: 0 auto; padding: 0 20px;">
    <!-- Khối 1: Áo Nam & Sơ Mi -->
    <div style="margin-top: 30px;">
        <div class="section-title-wrap">
            <h3><i class='bx bxs-hot' style="color: #e74c3c;"></i> Thời Trang Nam & Áo Sơ Mi Hot</h3>
            <a href="../controller/index.php?act=sanpham&id=1" class="view-more-link">Xem tất cả <i class="fa fa-angle-right"></i></a>
        </div>
        <div class="sanpham responsive">
            <?php
            $dssanpham = sanpham_showId_1();
            if (!empty($dssanpham)) {
                foreach ($dssanpham as $row) {
                    $gia_vnd = number_format($row['gia'], 0, ',', '.') . ' VNĐ';
                    echo '
                        <div class="sanpham1">
                            <form method="POST" action="../controller/index.php?act=cart">
                                <nav style="background: #fff; margin: 0.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 12px;">
                                    <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '">
                                        <img src="../view/images/' . htmlspecialchars($row['hinh']) . '" alt="" style="width: 100%; height: 230px; object-fit: cover; border-radius: 8px;">
                                    </a>
                                    <div class="content" style="margin-top: 10px;">   
                                        <h3 class="tensp" style="font-size: 15px; font-weight: 600; min-height: 42px; margin: 8px 0;">
                                            <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '" style="color: #333; text-decoration: none;">' . htmlspecialchars(substr($row['tensp'], 0, 48)) . '</a>
                                        </h3>
                                        <p style="color: #e74c3c; font-weight: 700; font-size: 16px; margin: 8px 0;">' . $gia_vnd . '</p>
                                        <input type="hidden" name="hinh" value="' . htmlspecialchars($row['hinh']) . '"/>
                                        <input type="hidden" name="gia" value="' . $row['gia'] . '"/>
                                        <input type="hidden" name="tensp" value="' . htmlspecialchars($row['tensp']) . '"/>
                                        <input type="hidden" name="soluong" value="1">
                                        <div class="buy" style="display: flex; gap: 8px; margin-top: 10px;">
                                            <button type="button" style="flex: 1;"><a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '" style="text-decoration: none; color: inherit;">Chi tiết</a></button>
                                            <input type="submit" value="Mua Ngay" name="addcart" style="flex: 1; cursor: pointer;">
                                        </div>
                                    </div>  
                                </nav>
                            </form>
                        </div>
                    ';
                }
            }
            ?>
        </div>
    </div>

    <!-- Khối 2: Thời Trang Nữ & Váy Đầm -->
    <div style="margin-top: 50px;">
        <div class="section-title-wrap">
            <h3><i class='bx bxs-heart' style="color: #e84393;"></i> Bộ Sưu Tập Thời Trang Nữ & Váy Đầm</h3>
            <a href="../controller/index.php?act=sanpham&id=2" class="view-more-link">Xem tất cả <i class="fa fa-angle-right"></i></a>
        </div>
        <div class="sanpham responsive">
            <?php
            $dssanpham = sanpham_showId_2();
            if (!empty($dssanpham)) {
                foreach ($dssanpham as $row) {
                    $gia_vnd = number_format($row['gia'], 0, ',', '.') . ' VNĐ';
                    echo '
                        <div class="sanpham1">
                            <form method="POST" action="../controller/index.php?act=cart">
                                <nav style="background: #fff; margin: 0.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 12px;">
                                    <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '">
                                        <img src="../view/images/' . htmlspecialchars($row['hinh']) . '" alt="" style="width: 100%; height: 230px; object-fit: cover; border-radius: 8px;">
                                    </a>
                                    <div class="content" style="margin-top: 10px;">   
                                        <h3 class="tensp" style="font-size: 15px; font-weight: 600; min-height: 42px; margin: 8px 0;">
                                            <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '" style="color: #333; text-decoration: none;">' . htmlspecialchars(substr($row['tensp'], 0, 48)) . '</a>
                                        </h3>
                                        <p style="color: #e74c3c; font-weight: 700; font-size: 16px; margin: 8px 0;">' . $gia_vnd . '</p>
                                        <input type="hidden" name="hinh" value="' . htmlspecialchars($row['hinh']) . '"/>
                                        <input type="hidden" name="gia" value="' . $row['gia'] . '"/>
                                        <input type="hidden" name="tensp" value="' . htmlspecialchars($row['tensp']) . '"/>
                                        <input type="hidden" name="soluong" value="1">
                                        <div class="buy" style="display: flex; gap: 8px; margin-top: 10px;">
                                            <button type="button" style="flex: 1;"><a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '" style="text-decoration: none; color: inherit;">Chi tiết</a></button>
                                            <input type="submit" value="Mua Ngay" name="addcart" style="flex: 1; cursor: pointer;">
                                        </div>
                                    </div>  
                                </nav>
                            </form>
                        </div>
                    ';
                }
            }
            ?>
        </div>
    </div>

    <!-- Khối 3: Quần Jean & Quần Tây -->
    <div style="margin-top: 50px;">
        <div class="section-title-wrap">
            <h3><i class='bx bxs-badge-check' style="color: #007bff;"></i> Quần Jean & Quần Tây Công Sở</h3>
            <a href="../controller/index.php?act=sanpham&id=3" class="view-more-link">Xem tất cả <i class="fa fa-angle-right"></i></a>
        </div>
        <div class="sanpham responsive">
            <?php
            $dssanpham = sanpham_showId_3();
            if (!empty($dssanpham)) {
                foreach ($dssanpham as $row) {
                    $gia_vnd = number_format($row['gia'], 0, ',', '.') . ' VNĐ';
                    echo '
                        <div class="sanpham1">
                            <form method="POST" action="../controller/index.php?act=cart">
                                <nav style="background: #fff; margin: 0.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 12px;">
                                    <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '">
                                        <img src="../view/images/' . htmlspecialchars($row['hinh']) . '" alt="" style="width: 100%; height: 230px; object-fit: cover; border-radius: 8px;">
                                    </a>
                                    <div class="content" style="margin-top: 10px;">   
                                        <h3 class="tensp" style="font-size: 15px; font-weight: 600; min-height: 42px; margin: 8px 0;">
                                            <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '" style="color: #333; text-decoration: none;">' . htmlspecialchars(substr($row['tensp'], 0, 48)) . '</a>
                                        </h3>
                                        <p style="color: #e74c3c; font-weight: 700; font-size: 16px; margin: 8px 0;">' . $gia_vnd . '</p>
                                        <input type="hidden" name="hinh" value="' . htmlspecialchars($row['hinh']) . '"/>
                                        <input type="hidden" name="gia" value="' . $row['gia'] . '"/>
                                        <input type="hidden" name="tensp" value="' . htmlspecialchars($row['tensp']) . '"/>
                                        <input type="hidden" name="soluong" value="1">
                                        <div class="buy" style="display: flex; gap: 8px; margin-top: 10px;">
                                            <button type="button" style="flex: 1;"><a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '" style="text-decoration: none; color: inherit;">Chi tiết</a></button>
                                            <input type="submit" value="Mua Ngay" name="addcart" style="flex: 1; cursor: pointer;">
                                        </div>
                                    </div>  
                                </nav>
                            </form>
                        </div>
                    ';
                }
            }
            ?>
        </div>
    </div>

    <!-- Khối 4: Áo Khoác, Hoodie & Đồ Thể Thao -->
    <div style="margin-top: 50px; margin-bottom: 50px;">
        <div class="section-title-wrap">
            <h3><i class='bx bxs-star' style="color: #f39c12;"></i> Áo Khoác, Hoodie & Đồ Thể Thao</h3>
            <a href="../controller/index.php?act=sanpham&id=4" class="view-more-link">Xem tất cả <i class="fa fa-angle-right"></i></a>
        </div>
        <div class="sanpham responsive">
            <?php
            $dssanpham = array_merge(sanpham_showId_4(), sanpham_showId_5());
            if (!empty($dssanpham)) {
                foreach ($dssanpham as $row) {
                    $gia_vnd = number_format($row['gia'], 0, ',', '.') . ' VNĐ';
                    echo '
                        <div class="sanpham1">
                            <form method="POST" action="../controller/index.php?act=cart">
                                <nav style="background: #fff; margin: 0.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 12px;">
                                    <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '">
                                        <img src="../view/images/' . htmlspecialchars($row['hinh']) . '" alt="" style="width: 100%; height: 230px; object-fit: cover; border-radius: 8px;">
                                    </a>
                                    <div class="content" style="margin-top: 10px;">   
                                        <h3 class="tensp" style="font-size: 15px; font-weight: 600; min-height: 42px; margin: 8px 0;">
                                            <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '" style="color: #333; text-decoration: none;">' . htmlspecialchars(substr($row['tensp'], 0, 48)) . '</a>
                                        </h3>
                                        <p style="color: #e74c3c; font-weight: 700; font-size: 16px; margin: 8px 0;">' . $gia_vnd . '</p>
                                        <input type="hidden" name="hinh" value="' . htmlspecialchars($row['hinh']) . '"/>
                                        <input type="hidden" name="gia" value="' . $row['gia'] . '"/>
                                        <input type="hidden" name="tensp" value="' . htmlspecialchars($row['tensp']) . '"/>
                                        <input type="hidden" name="soluong" value="1">
                                        <div class="buy" style="display: flex; gap: 8px; margin-top: 10px;">
                                            <button type="button" style="flex: 1;"><a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '" style="text-decoration: none; color: inherit;">Chi tiết</a></button>
                                            <input type="submit" value="Mua Ngay" name="addcart" style="flex: 1; cursor: pointer;">
                                        </div>
                                    </div>  
                                </nav>
                            </form>
                        </div>
                    ';
                }
            }
            ?>
        </div>
    </div>
</div>
