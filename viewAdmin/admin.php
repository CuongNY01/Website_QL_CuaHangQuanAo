<?php
if (isset($_GET['id'])) {
    delete_user($_GET['id']);
    echo "<script>alert('Xoá Tài khoản người dùng thành công'); window.location.href='../controller/indexAdmin.php?act=admin';</script>";
    exit;
}
?>
<div class="main">
    <main>
        <h2 style="text-align: center; margin-bottom: 20px;">Danh Sách Tài Khoản Khách Hàng</h2>
        <table>
            <tr>
                <td class="an" colspan="6"></td>
                <td class="them" colspan="2">
                    <a href="../controller/indexAdmin.php?act=themuser"><i class="bx bx-edit" style="margin-right: 5px;"></i> Thêm thành viên</a>
                </td>
            </tr>
            <tr>
                <th style="width: 50px;">Mã</th>
                <th>Tên Đăng Nhập</th>
                <th>Mật Khẩu</th>
                <th colspan="2">Họ và Tên</th>
                <th colspan="2">Email</th>
                <th>Ảnh Đại Diện</th>
                <th style="width: 130px;">Tính Năng</th>
            </tr>
            <?php
            $query = show_user();
            foreach ($query as $row) {
                $id = $row['id'];
                $username = $row['username'];
                $password = $row['password'];
                $name = $row['name'];
                $email = $row['email'];
                $avata = !empty($row['avata']) ? $row['avata'] : 'iconUser.png';
                $dellink = "../controller/indexAdmin.php?act=admin&id=" . $id;

                echo '
                <tr>
                    <td>' . $id . '</td>
                    <td style="font-weight: 600;">' . htmlspecialchars($username) . '</td>
                    <td>••••••</td>
                    <td colspan="2">' . htmlspecialchars($name) . '</td>
                    <td colspan="2">' . htmlspecialchars($email) . '</td>
                    <td><img src="../view/images/' . htmlspecialchars($avata) . '" alt="" style="width: 45px; height: 45px; object-fit: cover; border-radius: 50%; border: 1px solid #ddd;"></td>
                    <td class="ad">
                        <a href="../controller/indexAdmin.php?act=suauser&id=' . $id . '" title="Sửa"><i class="bx bx-edit"></i> Sửa</a>
                        <a onclick="return confirm(\'Bạn có chắc chắn muốn xóa tài khoản ' . htmlspecialchars($username) . '?\')" href="' . $dellink . '" title="Xóa"><i class="bx bx-message-square-minus"></i> Xóa</a>
                    </td>
                </tr>
                ';
            }
            ?>
        </table>
    </main>
</div>
