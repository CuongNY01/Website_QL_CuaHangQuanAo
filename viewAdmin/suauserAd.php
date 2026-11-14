<?php
$id = $_GET['id'] ?? 0;
$rows = show_user_id($id);
if (!$rows) {
    echo "<script>alert('Không tìm thấy người dùng!'); window.location.href='../controller/indexAdmin.php?act=admin';</script>";
    exit;
}

if (isset($_POST['sua'])) {
    $user = trim($_POST['user'] ?? '');
    $pass = trim($_POST['pass'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $avata = (!empty($_FILES['hinh']['name'])) ? basename($_FILES['hinh']['name']) : '';

    if ($user != "" && $pass != "" && $name != "" && $email != "") {
        if ($avata != "") {
            $target = "../view/images/";
            $target_file = $target . $avata;
            move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file);
            update_user_avata($user, $pass, $name, $avata, $email, $id);
        } else {
            update_user($user, $pass, $name, $email, $id);
        }
        echo "<script>alert('Cập nhật tài khoản thành công!'); window.location.href='../controller/indexAdmin.php?act=admin';</script>";
        exit;
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ các thông tin bắt buộc!');</script>";
    }
}
?>

<div class="admin-form-container">
    <div style="margin-bottom: 25px; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px;">
        <h2 style="font-size: 19px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 8px;">
            <i class='bx bx-edit' style="color: #3b82f6;"></i> Sửa Thông Tin Khách Hàng
        </h2>
        <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Tài khoản: <b><?= htmlspecialchars($rows['username']) ?></b> (#<?= $rows['id'] ?>)</p>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tên Đăng Nhập (*):</label>
            <input type="text" class="form-control-custom" name="user" required value="<?= htmlspecialchars($rows['username']) ?>">
        </div>

        <div class="form-group">
            <label>Mật Khẩu (*):</label>
            <input type="text" class="form-control-custom" name="pass" required value="<?= htmlspecialchars($rows['password']) ?>">
        </div>

        <div class="form-group">
            <label>Họ và Tên (*):</label>
            <input type="text" class="form-control-custom" name="name" required value="<?= htmlspecialchars($rows['name']) ?>">
        </div>

        <div class="form-group">
            <label>Email (*):</label>
            <input type="email" class="form-control-custom" name="email" required value="<?= htmlspecialchars($rows['email']) ?>">
        </div>

        <div class="form-group">
            <label>Ảnh Đại Diện Hiện Tại:</label>
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 8px;">
                <img src="../view/images/<?= htmlspecialchars($rows['avata'] ?? 'iconUser.png') ?>" alt="" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 1px solid #e2e8f0;">
                <span style="font-size: 13px; color: #64748b;">Ảnh: <i><?= htmlspecialchars($rows['avata'] ?? 'iconUser.png') ?></i></span>
            </div>
            <input type="file" class="form-control-custom" name="hinh" accept="image/*" style="padding-top: 6px;">
        </div>

        <div class="form-actions">
            <button type="submit" name="sua" class="btn-action btn-primary" style="flex: 1; justify-content: center; height: 42px;">
                <i class='bx bx-save'></i> Cập Nhật
            </button>
            <a href="../controller/indexAdmin.php?act=admin" class="btn-action btn-secondary" style="flex: 1; justify-content: center; height: 42px;">
                <i class='bx bx-arrow-back'></i> Quay Lại
            </a>
        </div>
    </form>
</div>
