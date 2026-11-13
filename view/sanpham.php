<link rel="stylesheet" href="../view/css/products.css">

<?php
$id = $_GET['id'] ?? 1;
$dsdanhmmuc = danhmuc_showId($id);
$tendanhmuc = $dsdanhmmuc['tendanhmuc'] ?? 'Tất cả sản phẩm';

// Choose suitable local banner for each category
$banner_img = "banner4.png";
if ($id == 1) {
    $banner_img = "bannerlaliga.jpeg";
} else if ($id == 2) {
    $banner_img = "bannerNHA.jpeg";
} else if ($id == 3) {
    $banner_img = "bannervl.jpeg";
}
?>

<div class="banner">
    <img src="../view/images/<?= $banner_img ?>" alt="<?= htmlspecialchars($tendanhmuc) ?>">
</div>

<div class="product" style="margin-top: 30px; margin-bottom: 3rem;">
    <div class="ten" style="display: flex; align-items: center; gap: 8px; margin: 15px 40px; font-size: 15px;">
        <a href="../controller/index.php" style="text-decoration: none; color: #555;">Trang chủ</a>
        <i class="fa-solid fa-caret-right" style="color: #999;"></i>
        <a href="../controller/index.php?act=sanpham&id=<?= $id ?>" style="text-decoration: none; color: #000; font-weight: bold;"><?= htmlspecialchars($tendanhmuc) ?></a>
    </div>

    <div class="sanpham" style="display: flex; flex-wrap: wrap; justify-content: flex-start; gap: 20px; padding: 0 40px;">
        <?php
        $iddanhmuc = sanpham_showId($id);

        if (!empty($iddanhmuc)) {
            foreach ($iddanhmuc as $row) {
                $gia_vnd = number_format($row['gia'], 0, ',', '.') . ' VNĐ';
                echo '
                <div class="sanpham1" style="width: calc(25% - 20px); min-width: 250px;">
                    <form method="POST" action="../controller/index.php?act=cart">
                        <nav style="background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 15px; margin-bottom: 20px;">
                            <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '">
                                <img src="../view/images/' . htmlspecialchars($row['hinh']) . '" alt="" style="width: 100%; height: 220px; object-fit: contain;">
                            </a>
                            <div class="content" style="margin-top: 10px;">   
                                <h3 class="tensp" style="font-size: 15px; font-weight: 600; min-height: 42px; margin: 8px 0;">
                                    <a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '" style="color: #333; text-decoration: none;">' . htmlspecialchars(substr($row['tensp'], 0, 50)) . '</a>
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
        } else {
            echo '<div style="width: 100%; text-align: center; padding: 60px 0;">';
            echo '<p style="font-size: 18px; color: #888;">Hiện tại chưa có mẫu áo nào trong danh mục này.</p>';
            echo '<a href="../controller/index.php" style="display: inline-block; margin-top: 15px; padding: 8px 20px; background: #007bff; color: #fff; text-decoration: none; border-radius: 4px;">Xem sản phẩm khác</a>';
            echo '</div>';
        }
        ?>
    </div>
</div>
