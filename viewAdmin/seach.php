<link rel="stylesheet" href="../view/css/ad_seach.css">
<?php
$keyword = $_POST['filter'] ?? '';
?>
<h2>Từ khóa tìm kiếm: <?php echo htmlspecialchars($keyword); ?></h2>
<form action="" id="tim" method="POST">
    <div class="tim">
        <input type="text" name="filter" placeholder="Tìm Kiếm sản phẩm" value="<?php echo htmlspecialchars($keyword); ?>">
        <input id="timkiem" type="submit" name="timkiem" value="Tìm kiếm">
        <br>
    </div>
</form>
<ul>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $keyword != "") {
        $query = sanpham_seach($keyword);

        if (!empty($query)) {
            echo "<h3 class=ketqua>Kết quả tìm kiếm: " . htmlspecialchars($keyword) . "</h3>";
            echo "<table>";
            echo '<tr>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th colspan="3">Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Danh mục</th>
                    <th colspan="2">Tính năng</th>
                  </tr>';
            foreach ($query as $row) {
                echo '
                <tr>
                    <td>' . $row['id'] . '</td>
                    <td><img src="../view/images/' . $row['hinh'] . '" alt=""></td>
                    <td colspan="3" class="tensp">' . $row['tensp'] . '</td>
                    <td>' . $row['gia'] . 'đ</td>
                    <td>' . $row['iddanhmuc'] . '</td>
                    <td class="ad"><a href="../controller/indexAdmin.php?act=suasanpham&id=' . $row['id'] . '"> <i class="bx bx-edit"></i> </a></td>
                    <td class="ad"><a onclick="return Del()" href="../controller/indexAdmin.php?act=sanpham&id=' . $row['id'] . '"> <i class="bx bx-message-square-minus"></i> </a></td>
                </tr>
                ';
            }
            echo "</table>";
        } else {
            echo "<h3 style='margin-left:30px;'>Không tìm thấy kết quả: " . htmlspecialchars($keyword) . " </h3>";
        }
    }
    ?>
</ul>
</div>