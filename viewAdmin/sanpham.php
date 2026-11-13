<?php
if (isset($_GET['id'])) {
    sanpham_delete($_GET['id']);
    echo "<script>alert('Xoá Sản phẩm thành công'); window.location.href='../controller/indexAdmin.php?act=sanpham';</script>";
    exit;
}
?>
<div class="main">
    <main>
        <h2 style="text-align: center; margin-bottom: 20px;">Danh Sách Sản Phẩm Áo Quần Thời Trang</h2>
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
            <form action="../controller/indexAdmin.php?act=layout_tim" id="tim" method="POST" style="display: flex; gap: 8px;">
                <input type="text" name="filter" placeholder="Tìm kiếm theo tên áo hoặc giải đấu..." style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px; width: 280px;">
                <input id="timkiem" type="submit" name="timkiem" value="Tìm kiếm" style="padding: 8px 16px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
            </form>

            <a href="../controller/indexAdmin.php?act=themsanpham" style="padding: 8px 16px; background: #28a745; color: white; text-decoration: none; border-radius: 4px; font-weight: 600; display: inline-flex; align-items: center; gap: 5px;">
                <i class="bx bx-import"></i> Thêm sản phẩm mới
            </a>
        </div>

        <table>
            <tr>
                <th style="width: 50px;">Mã</th>
                <th style="width: 90px;">Hình ảnh</th>
                <th colspan="3">Tên Sản Phẩm Thời Trang</th>
                <th colspan="2" style="width: 140px;">Đơn Giá</th>
                <th colspan="2" style="width: 160px;">Danh Mục</th>
                <th colspan="2" style="width: 130px;">Hành Động</th>
            </tr>
            <?php
            $query = sanpham_showAll();
            foreach ($query as $row) {
                $id = $row['id'];
                $hinh = $row['hinh'];
                $tensp = $row['tensp'];
                $gia = number_format($row['gia'], 0, ',', '.') . ' đ';
                $tendanhmuc = !empty($row['tendanhmuc']) ? $row['tendanhmuc'] : ('ID: ' . $row['iddanhmuc']);
                $dellink = "../controller/indexAdmin.php?act=sanpham&id=" . $id;

                echo '
                <tr>
                    <td>' . $id . '</td>
                    <td><img src="../view/images/' . htmlspecialchars($hinh) . '" alt="" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;"></td>
                    <td colspan="3" style="text-align: left; font-weight: 500;">' . htmlspecialchars($tensp) . '</td>
                    <td colspan="2" style="color: #e74c3c; font-weight: 600;">' . $gia . '</td>
                    <td colspan="2"><span style="background: #eef2f7; padding: 4px 8px; border-radius: 4px; font-size: 13px;">' . htmlspecialchars($tendanhmuc) . '</span></td>
                    <td class="ac"><a href="../controller/indexAdmin.php?act=suasanpham&id=' . $id . '" title="Chỉnh sửa"><i class="bx bx-edit"></i> Sửa</a></td>
                    <td class="ad"><a onclick="return Del(\'' . htmlspecialchars($tensp) . '\')" href="' . $dellink . '" title="Xóa sản phẩm"><i class="bx bx-message-square-minus"></i> Xóa</a></td>
                </tr>
                ';
            }
            ?>
        </table>
    </main>
</div>
