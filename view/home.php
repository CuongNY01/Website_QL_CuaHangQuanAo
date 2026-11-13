<link rel="stylesheet" href="../view/css/index.css">
<link rel="stylesheet" href="../view/css/products.css">

<div class="banner">
     <img src="../view/images/banner4.png" alt="Banner Thời Trang Thể Thao 24/7">
</div>

<div class="product">
    <!-- Khối 1: Áo đấu La Liga (Sản phẩm nổi bật) -->
    <div class="balo" style="max-width: 1424px;">
        <div class="tille">
            <h3><i class='bx bxs-hot' style="color: #e74c3c;"></i> Sản Phẩm Nổi Bật - Giải La Liga</h3>
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
                                <nav style="background: #fff; margin: 1rem 0.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 10px;">
                                    <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '">
                                        <img src="../view/images/' . htmlspecialchars($row['hinh']) . '" alt="" style="width: 100%; height: 220px; object-fit: contain;">
                                    </a>
                                    <div class="content">   
                                        <h3 class="tensp" style="font-size: 15px; font-weight: 600; min-height: 40px; margin: 10px 0;">
                                            <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '" style="color: #333; text-decoration: none;">' . htmlspecialchars(substr($row['tensp'], 0, 50)) . '</a>
                                        </h3>
                                        <p style="color: #e74c3c; font-weight: 700; font-size: 16px;">' . $gia_vnd . '</p>
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

    <!-- Khối 2: Áo đấu Ngoại Hạng Anh (Sản phẩm ưu đãi) -->
    <div class="vali" style="margin-top: 50px;">
        <div class="tille">
            <h3><i class='bx bxs-badge-check' style="color: #007bff;"></i> Sản Phẩm Ưu Đãi - Ngoại Hạng Anh</h3>
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
                                <nav style="background: #fff; margin: 1rem 0.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 10px;">
                                    <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '">
                                        <img src="../view/images/' . htmlspecialchars($row['hinh']) . '" alt="" style="width: 100%; height: 220px; object-fit: contain;">
                                    </a>
                                    <div class="content">   
                                        <h3 class="tensp" style="font-size: 15px; font-weight: 600; min-height: 40px; margin: 10px 0;">
                                            <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '" style="color: #333; text-decoration: none;">' . htmlspecialchars(substr($row['tensp'], 0, 50)) . '</a>
                                        </h3>
                                        <p style="color: #e74c3c; font-weight: 700; font-size: 16px;">' . $gia_vnd . '</p>
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

    <!-- Khối 3: V-League & Thời trang thể thao khác -->
    <div class="cap" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="tille">
            <h3><i class='bx bxs-star' style="color: #f39c12;"></i> Trang Phục Thi Đấu - Giải V-League & CLB</h3>
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
                                <nav style="background: #fff; margin: 1rem 0.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 10px;">
                                    <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '">
                                        <img src="../view/images/' . htmlspecialchars($row['hinh']) . '" alt="" style="width: 100%; height: 220px; object-fit: contain;">
                                    </a>
                                    <div class="content">   
                                        <h3 class="tensp" style="font-size: 15px; font-weight: 600; min-height: 40px; margin: 10px 0;">
                                            <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '" style="color: #333; text-decoration: none;">' . htmlspecialchars(substr($row['tensp'], 0, 50)) . '</a>
                                        </h3>
                                        <p style="color: #e74c3c; font-weight: 700; font-size: 16px;">' . $gia_vnd . '</p>
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
