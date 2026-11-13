<div class="main">
    <main>
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
                echo "<script>alert('Thêm User thành công'); window.location.href='../controller/indexAdmin.php?act=admin';</script>";
                exit;
            } else {
                echo "<script>alert('Vui lòng điền đầy đủ các thông tin bắt buộc');</script>";
            }
        }
        ?>
        <form action="" method="POST" class="sua" enctype="multipart/form-data" style="width:450px; height:auto; padding: 25px; margin: 30px auto; text-align: left; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.08);">
            <h2 style="text-align: center; margin-bottom: 20px;">Thêm Mới Khách Hàng</h2>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Tên đăng nhập:</label>
                <input type="text" placeholder="Username" name="username" id="username" required style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Mật khẩu:</label>
                <input type="password" placeholder="Password" name="password" id="password" required style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Họ và tên:</label>
                <input type="text" placeholder="Họ và tên hiển thị" name="name" id="name" required style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Email:</label>
                <input type="email" placeholder="example@email.com" name="email" id="email" required style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Ảnh đại diện (tùy chọn):</label>
                <input type="file" id="hinh" name="hinh" accept="image/*" style="border: none;">
            </div>

            <div style="display: flex; justify-content: space-between; gap: 10px; margin-top: 20px;">
                <input type="submit" value="Lưu tài khoản" name="them" style="flex: 1; height: 38px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;">
                <a href="../controller/indexAdmin.php?act=admin" style="flex: 1; height: 38px; line-height: 38px; text-align: center; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-weight: 600;">Hủy bỏ</a>
            </div>
        </form>
    </main>
</div>
