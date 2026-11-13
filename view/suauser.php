<link rel="stylesheet" href="../view/css/lo_re.css">
<link rel="stylesheet" href="../view/css/products.css">

<?php
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Vui lòng đăng nhập để chỉnh sửa thông tin!'); window.location.href='../controller/index.php?act=login';</script>";
    exit;
}

$id = $_SESSION['id'];
$query = show_user_id($id);

if ($query) {
    extract($query);
} else {
    echo "<script>alert('Không tìm thấy tài khoản'); window.location.href='../controller/index.php?act=login';</script>";
    exit;
}

if (isset($_POST['sua'])) {
    $username = trim($_POST['user'] ?? '');
    $password = trim($_POST['pass'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $new_avata = (!empty($_FILES['hinh']['name'])) ? basename($_FILES['hinh']['name']) : '';

    if ($username != "" && $password != "" && $name != "" && $email != "") {
        if ($new_avata != "") {
            $target = "../view/images/";
            $target_file = $target . $new_avata;
            move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file);
            update_user_avata($username, $password, $name, $new_avata, $email, $id);
            $_SESSION['avata'] = $new_avata;
        } else {
            update_user($username, $password, $name, $email, $id);
        }

        // Cập nhật session tức thì
        $_SESSION['name'] = $name;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

        echo "<script>alert('Cập nhật hồ sơ tài khoản thành công!'); window.location.href='../controller/index.php?act=login';</script>";
        exit;
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ các thông tin bắt buộc!');</script>";
    }
}
?>

<div class="main" style="max-width: 500px; margin: 40px auto; padding: 0 20px;">
    <div class="dangky" style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
        <form action="../controller/index.php?act=suauser" method="post" enctype="multipart/form-data">
            <h2 style="text-align: center; color: #2c3e50; margin-bottom: 25px;">CHỈNH SỬA THÔNG TIN CÁ NHÂN</h2>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Tên đăng nhập:</label>
                <input type="text" name="user" required value="<?= htmlspecialchars($username) ?>" style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Họ và tên hiển thị:</label>
                <input type="text" name="name" required value="<?= htmlspecialchars($name) ?>" style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Email liên hệ:</label>
                <input type="email" name="email" required value="<?= htmlspecialchars($email) ?>" style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Mật khẩu mới:</label>
                <input type="text" name="pass" required value="<?= htmlspecialchars($password) ?>" style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Ảnh đại diện:</label>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <img src="../view/images/<?= !empty($avata) ? htmlspecialchars($avata) : 'iconUser.png' ?>" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 1px solid #ddd;">
                    <input type="file" name="hinh" accept="image/*" style="border: none;">
                </div>
            </div>

            <div style="display: flex; gap: 10px;">
                <input type="submit" name="sua" value="Lưu Thay Đổi" style="flex: 1; height: 42px; background: #007bff; color: white; border: none; border-radius: 4px; font-weight: 600; font-size: 15px; cursor: pointer;">
                <a href="../controller/index.php?act=login" style="flex: 1; height: 42px; line-height: 42px; text-align: center; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-weight: 600; font-size: 15px;">Quay lại</a>
            </div>
        </form>
    </div>
</div>
