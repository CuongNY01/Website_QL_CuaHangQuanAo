<?php
if (isset($_GET['iddanhmuc'])) {
    $del_id = $_GET['iddanhmuc'];
    $count = danhmuc_count_sanpham($del_id);
    if ($count > 0) {
        echo "<script>alert('Không thể xóa danh mục này do đang có sản phẩm liên kết! Vui lòng chuyển sản phẩm sang danh mục khác trước.'); window.location.href='../controller/indexAdmin.php?act=danhmuc';</script>";
        exit;
    } else {
        danhmuc_delete($del_id);
        echo "<script>alert('Xoá Danh mục thành công'); window.location.href='../controller/indexAdmin.php?act=danhmuc';</script>";
        exit;
    }
}
?>
<div class="main">
    <main>
        <h2 style="text-align: center; margin-bottom: 20px;">Danh Sách Danh Mục</h2>
        <table>
            <tr>
                <td class="an" colspan="3"></td>
                <td class="them" colspan="2">
                    <a href="../controller/indexAdmin.php?act=themdanhmuc"><i class="bx bx-import"></i> Thêm mới</a>
                </td>
            </tr>
            <tr>
                <th style="width: 80px;">Mã ID</th>
                <th colspan="2">Tên Danh Mục Thời Trang / Giải Đấu</th>
                <th colspan="2" style="width: 150px;">Tính Năng</th>
            </tr>
            <?php
            $query = danhmuc_showAll();
            foreach ($query as $row) {
                $iddanhmuc = $row['iddanhmuc'];
                $tendanhmuc = $row['tendanhmuc'];
                $dellink = "../controller/indexAdmin.php?act=danhmuc&iddanhmuc=" . $iddanhmuc;
                echo '
                <tr>
                    <td>' . $iddanhmuc . '</td>
                    <td colspan="2" style="font-weight: 600;">' . htmlspecialchars($tendanhmuc) . '</td>
                    <td class="ac"><a href="../controller/indexAdmin.php?act=suadanhmuc&id=' . $iddanhmuc . '" title="Chỉnh sửa"><i class="bx bx-edit"></i> Sửa</a></td>
                    <td class="ad"><a onclick="return Del(\'' . htmlspecialchars($tendanhmuc) . '\')" href="' . $dellink . '" title="Xóa danh mục"><i class="bx bx-message-square-minus"></i> Xóa</a></td>
                </tr>
                ';
            }
            ?>
        </table>
    </main>
</div>
