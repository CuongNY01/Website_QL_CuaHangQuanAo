<div class="main">
    <main>
        <?php
        $id = $_GET['id'] ?? 0;
        $rows = show_user_id($id);
        if (!$rows) {
            echo "<script>alert('Không tìm thấy người dùng'); window.location.href='../controller/indexAdmin.php?act=admin';</script>";
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
                echo "<script>alert('Cập nhật tài khoản thành công'); window.location.href='../controller/indexAdmin.php?act=admin';</script>";
                exit;
            } else {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin');</script>";
            }
        }
        ?>

        <form action="" method="POST" class="sua" enctype="multipart/form-data" style="width:450px; height:auto; padding: 25px; margin: 30px auto; text-align: left; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.08);">
            <h2 style="text-align: center; margin-bottom: 20px;">Sửa Thông Tin Khách Hàng</h2>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Mã người dùng:</label>
                <input type="text" value="<?php echo $rows['id']; ?>" disabled style="width: 100%; height: 38px; padding: 5px 10px; background: #f0f0f0; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Tên đăng nhập:</label>
                <input type="text" placeholder="Username" name="user" required value="<?php echo htmlspecialchars($rows['username']); ?>" style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Mật khẩu:</label>
                <input type="text" placeholder="Password" name="pass" required value="<?php echo htmlspecialchars($rows['password']); ?>" style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Họ và tên:</label>
                <input type="text" placeholder="Họ và tên" name="name" required value="<?php echo htmlspecialchars($rows['name']); ?>" style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Email:</label>
                <input type="email" placeholder="Email" name="email" required value="<?php echo htmlspecialchars($rows['email']); ?>" style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Ảnh đại diện:</label>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <img src="../view/images/<?php echo !empty($rows['avata']) ? htmlspecialchars($rows['avata']) : 'iconUser.png'; ?>" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; border: 1px solid #ddd;">
                    <input type="file" name="hinh" accept="image/*" style="border:none;">
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; gap: 10px; margin-top: 20px;">
                <input type="submit" value="Cập Nhật" name="sua" style="flex: 1; height: 38px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;">
                <a href="../controller/indexAdmin.php?act=admin" style="flex: 1; height: 38px; line-height: 38px; text-align: center; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-weight: 600;">Hủy bỏ</a>
            </div>
        </form>
    </main>
</div>
