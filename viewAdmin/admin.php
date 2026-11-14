<?php
if (isset($_GET['id'])) {
    delete_user($_GET['id']);
    echo "<script>alert('Xoá Tài khoản người dùng thành công!'); window.location.href='../controller/indexAdmin.php?act=admin';</script>";
    exit;
}
$list_users = show_user();
?>

<div class="admin-card">
    <div class="admin-card-header">
        <div class="admin-card-title-group">
            <h2><i class='bx bx-group' style="color: #a855f7;"></i> Quản Lý Tài Khoản Khách Hàng</h2>
            <p>Danh sách các tài khoản khách hàng đã đăng ký mua hàng trên hệ thống</p>
        </div>
        <div>
            <a href="../controller/indexAdmin.php?act=themuser" class="btn-action btn-add">
                <i class='bx bx-user-plus'></i> Thêm Thành Viên Mới
            </a>
        </div>
    </div>

    <div class="admin-card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 70px; text-align: center;">Mã ID</th>
                        <th style="width: 80px; text-align: center;">Avatar</th>
                        <th>Tên Đăng Nhập</th>
                        <th>Họ và Tên</th>
                        <th>Địa Chỉ Email</th>
                        <th style="width: 140px; text-align: center;">Trạng Thái</th>
                        <th style="width: 170px; text-align: center;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list_users)): ?>
                        <?php foreach ($list_users as $row): 
                            $id = $row['id'];
                            $username = $row['username'];
                            $name = $row['name'];
                            $email = $row['email'];
                            $avata = !empty($row['avata']) ? $row['avata'] : 'iconUser.png';
                            $dellink = "../controller/indexAdmin.php?act=admin&id=" . $id;
                        ?>
                            <tr>
                                <td style="text-align: center;">
                                    <span class="badge-pill badge-neutral">#<?= $id ?></span>
                                </td>
                                <td style="text-align: center;">
                                    <img src="../view/images/<?= htmlspecialchars($avata) ?>" alt="" style="width: 44px; height: 44px; object-fit: cover; border-radius: 50%; border: 2px solid #e2e8f0;">
                                </td>
                                <td>
                                    <strong style="color: #0f172a; font-size: 14px;"><?= htmlspecialchars($username) ?></strong>
                                </td>
                                <td>
                                    <span style="font-weight: 500; color: #334155;"><?= htmlspecialchars($name) ?></span>
                                </td>
                                <td>
                                    <span style="color: #64748b;"><?= htmlspecialchars($email) ?></span>
                                </td>
                                <td style="text-align: center;">
                                    <span class="badge-pill badge-success">
                                        <i class='bx bx-check'></i> Hoạt động
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: inline-flex; gap: 8px; justify-content: center;">
                                        <a href="../controller/indexAdmin.php?act=suauser&id=<?= $id ?>" class="btn-action btn-edit" title="Sửa thông tin">
                                            <i class='bx bx-edit-alt'></i> Sửa
                                        </a>
                                        <a onclick="return Deluser('<?= htmlspecialchars(addslashes($username)) ?>')" href="<?= $dellink ?>" class="btn-action btn-delete" title="Xóa tài khoản">
                                            <i class='bx bx-trash'></i> Xóa
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 40px; color: #94a3b8;">
                                <i class='bx bx-user-x' style="font-size: 36px; display: block; margin-bottom: 8px;"></i>
                                Chưa có tài khoản người dùng nào.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
