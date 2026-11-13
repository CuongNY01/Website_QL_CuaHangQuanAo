<?php
if (isset($_GET['id'])) {
    binhluan_delete($_GET['id']);
    echo "<script>alert('Xoá Bình luận thành công'); window.location.href='../controller/indexAdmin.php?act=binhluan';</script>";
    exit;
}
?>
<div class="main">
    <main>
        <h2 style="text-align: center; margin-bottom: 20px;">Kiểm Duyệt & Quản Lý Bình Luận Khách Hàng</h2>
        <table>
            <tr>
                <th style="width: 50px;">Mã</th>
                <th>Người Đánh Giá</th>
                <th style="width: 80px;">Mã SP</th>
                <th>Sản Phẩm</th>
                <th colspan="3">Nội Dung Nhận Xét</th>
                <th style="width: 120px;">Ngày Đăng</th>
                <th style="width: 100px;">Hành Động</th>
            </tr>
            <?php
            $query = binhluan_showall();
            if (!empty($query)) {
                foreach ($query as $row) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $hinh = !empty($row['hinh']) ? $row['hinh'] : 'iconUser.png';
                    $idsp = $row['idsp'];
                    $tensp = !empty($row['tensp']) ? $row['tensp'] : ('Sản phẩm #' . $idsp);
                    $noidung = $row['noidung'];
                    $postdate = $row['postdate'];
                    $dellink = "../controller/indexAdmin.php?act=binhluan&id=" . $id;

                    echo '
                    <tr>
                        <td>' . $id . '</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 8px; justify-content: center;">
                                <img src="../view/images/' . htmlspecialchars($hinh) . '" alt="" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;">
                                <span>' . htmlspecialchars($name) . '</span>
                            </div>
                        </td>
                        <td>#' . $idsp . '</td>
                        <td style="text-align: left; font-size: 13px; max-width: 200px;">' . htmlspecialchars($tensp) . '</td>
                        <td colspan="3" style="text-align: left; font-style: italic;">"' . htmlspecialchars($noidung) . '"</td>
                        <td>' . htmlspecialchars($postdate) . '</td>
                        <td class="ad">
                            <a onclick="return confirm(\'Bạn có chắc chắn muốn xóa bình luận này?\')" href="' . $dellink . '" title="Xóa bình luận"><i class="bx bx-message-square-minus"></i> Xóa</a>
                        </td>
                    </tr>
                    ';
                }
            } else {
                echo '<tr><td colspan="9" style="text-align: center; padding: 20px;">Chưa có bình luận nào trên hệ thống.</td></tr>';
            }
            ?>
        </table>
    </main>
</div>
