<link rel="stylesheet" href="../view/css/products.css">
<link rel="stylesheet" href="../view/css/chitietsp.css">

<?php
$id = $_GET['idsp'] ?? ($_GET['id'] ?? 1);
$idsp = sanpham_showChiTiet($id);

if (!$idsp) {
    echo '<div style="text-align: center; padding: 50px;"><h3>Không tìm thấy sản phẩm yêu cầu</h3><a href="../controller/index.php">Quay lại trang chủ</a></div>';
} else {
    extract($idsp);
    $gia_vnd = number_format($gia, 0, ',', '.') . ' VNĐ';
    $tendanhmuc = !empty($tendanhmuc) ? $tendanhmuc : 'Thời trang';
?>

<div class="ten" style="display: flex; align-items: center; gap: 8px; margin: 15px 40px; font-size: 15px;">
    <a href="../controller/index.php" style="text-decoration: none; color: #555;">Trang chủ</a>
    <i class="fa-solid fa-caret-right" style="color: #999;"></i>
    <a href="../controller/index.php?act=sanpham&id=<?= $iddanhmuc ?>" style="text-decoration: none; color: #555;"><?= htmlspecialchars($tendanhmuc) ?></a>
    <i class="fa-solid fa-caret-right" style="color: #999;"></i>
    <span style="font-weight: bold; color: #000;"><?= htmlspecialchars($tensp) ?></span>
</div>

<div class="chitiet" style="display: flex; gap: 40px; padding: 20px 40px; max-width: 1300px; margin: 0 auto; flex-wrap: wrap;">
    <div class="chitiet_trai" style="flex: 1; min-width: 350px;">
        <div class="main-image" style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #eee; text-align: center;">
            <img src="../view/images/<?= htmlspecialchars($hinh) ?>" alt="<?= htmlspecialchars($tensp) ?>" style="max-width: 100%; max-height: 420px; object-fit: contain;">
        </div>
        <div class="slideshow" style="display: flex; gap: 10px; margin-top: 15px; justify-content: center;">
            <img src="../view/images/<?= htmlspecialchars($hinh) ?>" alt="" style="width: 70px; height: 70px; object-fit: contain; border: 1px solid #ddd; border-radius: 4px; padding: 4px; cursor: pointer;">
            <img src="../view/images/<?= htmlspecialchars($hinh) ?>" alt="" style="width: 70px; height: 70px; object-fit: contain; border: 1px solid #ddd; border-radius: 4px; padding: 4px; cursor: pointer;">
            <img src="../view/images/<?= htmlspecialchars($hinh) ?>" alt="" style="width: 70px; height: 70px; object-fit: contain; border: 1px solid #ddd; border-radius: 4px; padding: 4px; cursor: pointer;">
        </div>
    </div>

    <div class="chitiet_phai" style="flex: 1; min-width: 350px;">
        <form method="POST" action="../controller/index.php?act=cart">
            <h2 style="font-size: 24px; color: #2c3e50; margin-bottom: 10px;"><?= htmlspecialchars($tensp) ?></h2>
            <hr style="border: none; border-top: 1px solid #eee; margin: 15px 0;">
            <div class="giasp" style="margin-bottom: 15px;">
                <span style="font-size: 26px; color: #e74c3c; font-weight: 700;"><?= $gia_vnd ?></span>
            </div>
            
            <p style="margin: 8px 0; color: #555;"><b>Mã sản phẩm:</b> #<?= $id ?></p>
            <p style="margin: 8px 0; color: #555;"><b>Danh mục:</b> <?= htmlspecialchars($tendanhmuc) ?></p>
            <p style="margin: 8px 0; color: #27ae60;"><b>Tình trạng:</b> <i class="fa fa-check-circle"></i> Còn hàng trong kho (Sẵn sàng giao)</p>
            
            <!-- Chọn Kích cỡ thời trang -->
            <div style="margin: 15px 0;">
                <p style="margin-bottom: 8px;"><b>Chọn Kích cỡ (Size):</b></p>
                <div style="display: flex; gap: 10px;">
                    <label style="border: 1px solid #ccc; padding: 6px 14px; border-radius: 4px; cursor: pointer; font-weight: 600;">
                        <input type="radio" name="size" value="S" style="display: none;"> S
                    </label>
                    <label style="border: 1px solid #ccc; padding: 6px 14px; border-radius: 4px; cursor: pointer; font-weight: 600;">
                        <input type="radio" name="size" value="M" style="display: none;"> M
                    </label>
                    <label style="border: 1px solid #ccc; padding: 6px 14px; border-radius: 4px; cursor: pointer; font-weight: 600; background: #2c3e50; color: #fff;">
                        <input type="radio" name="size" value="L" style="display: none;" checked> L
                    </label>
                    <label style="border: 1px solid #ccc; padding: 6px 14px; border-radius: 4px; cursor: pointer; font-weight: 600;">
                        <input type="radio" name="size" value="XL" style="display: none;"> XL
                    </label>
                    <label style="border: 1px solid #ccc; padding: 6px 14px; border-radius: 4px; cursor: pointer; font-weight: 600;">
                        <input type="radio" name="size" value="XXL" style="display: none;"> XXL
                    </label>
                </div>
            </div>

            <input type="hidden" name="hinh" value="<?= htmlspecialchars($hinh) ?>"/>
            <input type="hidden" name="tensp" value="<?= htmlspecialchars($tensp) ?>"/>
            <input type="hidden" name="gia" value="<?= $gia ?>"/>
            
            <p style="margin: 15px 0;">
                <b>Số Lượng:</b> 
                <input type="number" name="soluong" value="1" min="1" max="99" style="text-align: center; width: 80px; height: 35px; border: 1px solid #ccc; border-radius: 4px; font-size: 15px; margin-left: 10px;"/>
            </p>

            <div class="buy" style="margin: 20px 0;">
                <input class="add" type="submit" value="Thêm Vào Giỏ Hàng" name="addcart" style="width: 220px; height: 45px; background: #e74c3c; color: white; border: none; border-radius: 5px; font-weight: 700; font-size: 15px; cursor: pointer;">
            </div>

            <!-- Cam kết chất lượng thời trang -->
            <div style="background: #f8f9fa; border-radius: 6px; padding: 15px; margin-top: 20px; border-left: 4px solid #007bff; font-size: 13px; line-height: 1.6; color: #555;">
                <p><b><i class="fa fa-shield"></i> Cam kết chất lượng:</b> Vải may cao cấp (Cotton, Linen, Kaki, mè thể thao), đường may tỉ mỉ chuẩn xuất khẩu.</p>
                <p><b><i class="fa fa-refresh"></i> Đổi trả dễ dàng:</b> Hỗ trợ thử đồ và đổi size miễn phí trong vòng 7 ngày kể từ khi nhận hàng.</p>
                <p><b><i class="fa fa-truck"></i> Giao hàng:</b> Giao hàng tận nơi toàn quốc, kiểm tra hàng trước khi thanh toán (COD).</p>
            </div>

            <div style="margin-top: 20px; font-size: 13px; color: #666;">
                <h4 style="margin-bottom: 5px; color: #333;">ĐỊA CHỈ SHOWROOM THỜI TRANG</h4>
                <p><i class="fa-solid fa-store" style="color: #e74c3c;"></i> Đường Trịnh Văn Bô, Nam Từ Liêm, TP. Hà Nội</p>
                <p style="margin-top: 5px;">Hotline tư vấn và đặt may: <span style="color: #e74c3c; font-weight: 700;">024.2236.5888</span></p>
            </div>
        </form>
    </div>
</div>

<div class="binhluan" style="max-width: 1300px; margin: 40px auto; padding: 0 40px;">
    <h3 style="border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px; color: #2c3e50;">BÌNH LUẬN & ĐÁNH GIÁ CỦA KHÁCH HÀNG</h3>
    <iframe src="../controller/binhluan.php?idsp=<?= $id ?>" frameborder="0" style="width: 100%; min-height: 400px; border-radius: 8px; border: 1px solid #eee;"></iframe>
</div>

<?php } ?>
