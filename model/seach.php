<link rel="stylesheet" href="../view/css/products.css">

<div class="banner">
    <img src="../view/images/banner4.png" alt="Tìm kiếm sản phẩm">
</div>

<div class="main" style="max-width: 1300px; margin: 30px auto; padding: 0 40px;">
    <?php
    $keyword = trim($_POST["filter"] ?? ($_GET["filter"] ?? ''));

    if ($keyword != "") {
        $query = sanpham_seach($keyword);

        if (!empty($query)) {
            echo "<h3 style='margin: 20px 0; color: #2c3e50;'>Kết quả tìm kiếm cho: '<span style=\"color:#e74c3c;\">" . htmlspecialchars($keyword) . "</span>' (" . count($query) . " sản phẩm)</h3>";
            echo "<div class='sanpham' style='display: flex; flex-wrap: wrap; gap: 20px;'>";
            
            foreach ($query as $row) {
                $id = $row['id'];
                $hinh = $row['hinh'];
                $tensp = $row['tensp'];
                $gia = $row['gia'];
                $gia_vnd = number_format($gia, 0, ',', '.') . ' VNĐ';

                echo '
                <div class="sanpham1" style="width: calc(25% - 20px); min-width: 250px;">
                    <form method="POST" action="../controller/index.php?act=cart">
                        <nav style="background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 15px; margin-bottom: 20px;">
                            <a href="../controller/index.php?act=chitiet&idsp=' . $id . '">
                                <img src="../view/images/' . htmlspecialchars($hinh) . '" alt="" style="width: 100%; height: 220px; object-fit: contain;">
                            </a>
                            <div class="content" style="margin-top: 10px;">
                                <h3 class="tensp" style="font-size: 15px; font-weight: 600; min-height: 42px; margin: 8px 0;">
                                    <a href="../controller/index.php?act=chitiet&idsp=' . $id . '" style="color: #333; text-decoration: none;">' . htmlspecialchars(substr($tensp, 0, 50)) . '</a>
                                </h3>
                                <p style="color: #e74c3c; font-weight: 700; font-size: 16px; margin: 8px 0;">' . $gia_vnd . '</p>
                                <input type="hidden" name="hinh" value="' . htmlspecialchars($hinh) . '"/>
                                <input type="hidden" name="tensp" value="' . htmlspecialchars($tensp) . '"/>
                                <input type="hidden" name="gia" value="' . $gia . '"/>
                                <input type="hidden" name="soluong" value="1"/>
                                <div class="buy" style="display: flex; gap: 8px; margin-top: 10px;">
                                    <button type="button" style="flex: 1;"><a href="../controller/index.php?act=chitiet&idsp=' . $id . '" style="text-decoration: none; color: inherit;">Chi tiết</a></button>
                                    <input type="submit" value="Cho vào giỏ" name="addcart" style="flex: 1; cursor: pointer;">
                                </div>
                            </div>
                        </nav>
                    </form>
                </div>
                ';
            }
            echo "</div>";
        } else {
            // Đúng theo Luồng sự kiện thay thế trong Use Case Bảng 1.3 của báo cáo
            echo "<div style='text-align: center; padding: 60px 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin: 30px auto;'>";
            echo "<i class='fa fa-search' style='font-size: 60px; color: #bdc3c7;'></i>";
            echo "<h3 style='color: #7f8c8d; margin: 15px 0;'>Rất tiếc, không tìm thấy sản phẩm nào phù hợp với từ khóa: '<span style=\"color:#e74c3c;\">" . htmlspecialchars($keyword) . "</span>'!</h3>";
            echo "<p style='color: #95a5a6; margin-bottom: 25px;'>Gợi ý: Thử tìm theo tên đội bóng như Real, Barca, Arsenal, Manchester City hoặc tên giải đấu La Liga, Ngoại hạng Anh...</p>";
            echo "<a href='../controller/index.php' style='display: inline-block; padding: 10px 25px; background: #007bff; color: #fff; text-decoration: none; border-radius: 20px; font-weight: 600;'>Quay lại trang chủ</a>";
            echo "</div>";
        }
    } else {
        echo "<div style='text-align: center; padding: 40px;'><h3>Vui lòng nhập từ khóa để tìm kiếm sản phẩm.</h3></div>";
    }
    ?>
</div>
