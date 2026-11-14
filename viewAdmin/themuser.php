<?php
if (isset($_POST['them'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $avata = (!empty($_FILES['hinh']['name'])) ? basename($_FILES['hinh']['name']) : 'iconUser.png';

    if ($username != "" && $password != "" && $name != "" && $email != "") {
        if (!empty($_FILES['hinh']['name'])) {
            $target = "../view/images/";
            $target_file = $target . $avata;
            move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file);
        }
        add_user($username, $password, $name, $email, $avata);
        echo "<script>alert('Thêm Thành viên mới thành công!'); window.location.href='../controller/indexAdmin.php?act=admin';</script>";
        exit;
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ các thông tin bắt buộc!');</script>";
    }
}
?>

<div class="admin-form-container">
    <div style="margin-bottom: 25px; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px;">
        <h2 style="font-size: 19px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 8px;">
            <i class='bx bx-user-plus' style="color: #a855f7;"></i> Thêm Mới Tài Khoản Khách Hàng
        </h2>
        <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Cấp tài khoản khách hàng mới để đăng nhập mua sắm</p>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tên Đăng Nhập (*):</label>
            <input type="text" class="form-control-custom" placeholder="Ví dụ: nguyenvana" name="username" id="username" required autofocus>
        </div>

        <div class="form-group">
            <label>Mật Khẩu (*):</label>
            <input type="password" class="form-control-custom" placeholder="Nhập mật khẩu cho tài khoản" name="password" id="password" required>
        </div>

        <div class="form-group">
            <label>Họ và Tên (*):</label>
            <input type="text" class="form-control-custom" placeholder="Ví dụ: Nguyễn Văn A" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label>Email (*):</label>
            <input type="email" class="form-control-custom" placeholder="example@gmail.com" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label>Ảnh Đại Diện:</label>
            <input type="file" class="form-control-custom" id="hinh" name="hinh" accept="image/*" style="padding-top: 6px;">
        </div>

        <div class="form-actions">
            <button type="submit" name="them" class="btn-action btn-add" style="flex: 1; justify-content: center; height: 42px;">
                <i class='bx bx-save'></i> Lưu Tài Khoản
            </button>
            <a href="../controller/indexAdmin.php?act=admin" class="btn-action btn-secondary" style="flex: 1; justify-content: center; height: 42px;">
                <i class='bx bx-arrow-back'></i> Hủy Bỏ
            </a>
        </div>
    </form>
</div>
