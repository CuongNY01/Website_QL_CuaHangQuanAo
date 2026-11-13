<link rel="stylesheet" href="../view/css/lo_re.css">
<link rel="stylesheet" href="../view/css/products.css">

<?php
if (isset($_POST["dk"])) {
    $user = trim($_POST['username'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $repassword = trim($_POST['repassword'] ?? '');

    if ($user != '' && $email != '' && $name != '' && $password != '' && $repassword != '') {
        $avata = (!empty($_FILES['hinh']['name'])) ? basename($_FILES['hinh']['name']) : 'iconUser.png';
        $target = "../view/images/";
        $target_file = $target . $avata;

        $user_query = regiter_query($user);

        if (!empty($user_query)) {
            echo "<script>alert('Tên đăng nhập đã tồn tại, vui lòng chọn tên khác!');</script>";
        } else if ($password != $repassword) {
            echo "<script>alert('Mật khẩu nhập lại không trùng khớp!');</script>";
        } else {
            regiter_add($user, $password, $name, $email, $avata);
            if (!empty($_FILES['hinh']['tmp_name'])) {
                move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file);
            }
            echo "<script>alert('Đăng ký tài khoản thành viên thành công! Vui lòng đăng nhập.'); window.location.href='../controller/index.php?act=login';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ các thông tin bắt buộc!');</script>";
    }
}
?>

<div class="main" style="max-width: 500px; margin: 40px auto; padding: 0 20px;">
    <div class="dangky" style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
        <form action="../controller/index.php?act=register" method="post" enctype="multipart/form-data">
            <h2 style="text-align: center; color: #2c3e50; margin-bottom: 25px;">ĐĂNG KÝ THÀNH VIÊN</h2>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Tên đăng nhập: <span style="color:red;">*</span></label>
                <input type="text" placeholder="Username (viết liền không dấu)" name="username" required style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Họ và tên: <span style="color:red;">*</span></label>
                <input type="text" placeholder="Nguyễn Văn A" name="name" required style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Email: <span style="color:red;">*</span></label>
                <input type="email" placeholder="example@email.com" name="email" required style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Mật khẩu: <span style="color:red;">*</span></label>
                <input type="password" placeholder="Tối thiểu 6 ký tự" name="password" required style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Nhập lại mật khẩu: <span style="color:red;">*</span></label>
                <input type="password" placeholder="Nhập lại mật khẩu vừa nhập" name="repassword" required style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Ảnh đại diện (tùy chọn):</label>
                <input type="file" name="hinh" accept="image/*" style="border: none;">
            </div>

            <input type="submit" name="dk" value="Hoàn Tất Đăng Ký" style="width: 100%; height: 42px; background: #28a745; color: white; border: none; border-radius: 4px; font-weight: 600; font-size: 15px; cursor: pointer; margin-bottom: 15px;">

            <div style="text-align: center; font-size: 14px;">
                <span>Đã có tài khoản?</span> 
                <a href="../controller/index.php?act=login" style="color: #007bff; text-decoration: none; font-weight: 600;">Đăng nhập ngay</a>
            </div>
        </form>
    </div>
</div>
