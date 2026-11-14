<link rel="stylesheet" href="../view/css/ad_seach.css">
<?php
$keyword = trim($_POST['filter'] ?? ($_GET['filter'] ?? ''));
?>
<div class="main">
    <main>
        <h2 style="text-align: center; margin-bottom: 20px;">Tìm Kiếm Sản Phẩm Trong Kho</h2>
        <form action="../controller/indexAdmin.php?act=layout_tim" id="tim" method="POST" style="display: flex; justify-content: center; gap: 10px; margin-bottom: 25px;">
            <input type="text" name="filter" placeholder="Nhập tên sản phẩm áo, quần, váy hoặc danh mục..." value="<?php echo htmlspecialchars($keyword); ?>" style="width: 380px; height: 38px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px;">
            <input id="timkiem" type="submit" name="timkiem" value="Tìm kiếm" style="padding: 0 20px; height: 38px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;">
        </form>

        <?php
        if ($keyword != "") {
            $query = sanpham_seach($keyword);

            if (!empty($query)) {
                echo "<h3 style='margin-bottom: 15px; color: #2c3e50;'>Kết quả tìm kiếm cho: '<span style=\"color:#e74c3c;\">" . htmlspecialchars($keyword) . "</span>' (" . count($query) . " sản phẩm)</h3>";
                echo "<table>";
                echo '<tr>
                        <th style="width: 50px;">Mã</th>
                        <th style="width: 80px;">Hình ảnh</th>
                        <th colspan="3">Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Danh mục</th>
                        <th colspan="2" style="width: 140px;">Tính năng</th>
                      </tr>';
                foreach ($query as $row) {
                    $tendanhmuc = !empty($row['tendanhmuc']) ? $row['tendanhmuc'] : ('ID: ' . $row['iddanhmuc']);
                    echo '
                    <tr>
                        <td>' . $row['id'] . '</td>
                        <td><img src="../view/images/' . htmlspecialchars($row['hinh']) . '" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;"></td>
                        <td colspan="3" class="tensp" style="text-align: left; font-weight: 500;">' . htmlspecialchars($row['tensp']) . '</td>
                        <td style="color: #e74c3c; font-weight: 600;">' . number_format($row['gia'], 0, ',', '.') . ' đ</td>
                        <td>' . htmlspecialchars($tendanhmuc) . '</td>
                        <td class="ac"><a href="../controller/indexAdmin.php?act=suasanpham&id=' . $row['id'] . '"><i class="bx bx-edit"></i> Sửa</a></td>
                        <td class="ad"><a onclick="return Del(\'' . htmlspecialchars($row['tensp']) . '\')" href="../controller/indexAdmin.php?act=sanpham&id=' . $row['id'] . '"><i class="bx bx-message-square-minus"></i> Xóa</a></td>
                    </tr>
                    ';
                }
                echo "</table>";
            } else {
                echo "<div style='text-align: center; padding: 40px; background: #fff; border-radius: 8px;'>";
                echo "<i class='bx bx-search' style='font-size: 48px; color: #ccc;'></i>";
                echo "<h3 style='color: #7f8c8d; margin-top: 10px;'>Rất tiếc, không tìm thấy sản phẩm nào khớp với: '<span style=\"color:#e74c3c;\">" . htmlspecialchars($keyword) . "</span>'</h3>";
                echo "<p style='color: #95a5a6;'>Vui lòng thử lại với từ khóa khác như: Real, Barca, Arsenal, Ngoại Hạng Anh...</p>";
                echo "</div>";
            }
        }
        ?>
    </main>
</div>
