<div class="main">
    <main>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 0;
        }

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
            $avata = isset($_FILES['hinh']['name']) && $_FILES['hinh']['name'] != '' ? basename($_FILES['hinh']['name']) : '';
            $target = "../view/images/";
            $target_file = $target . $avata;

            if ($user != "" && $pass != "" && $name != "" && $email != "") {
                if ($avata != "") {
                    update_user_avata($user, $pass, $name, $avata, $email, $id);
                    if (isset($_FILES['hinh']['tmp_name'])) {
                        move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file);
                    }
                } else {
                    update_user($user, $pass, $name, $email, $id);
                }
                echo "<script>alert('Sửa User thành công'); window.location.href='../controller/indexAdmin.php?act=admin';</script>";
                exit;
            } else {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin');</script>";
            }
        }
        ?>

        <form action="" method="POST" class="sua" enctype="multipart/form-data" style="width:400px; height:auto; padding-bottom: 10%; margin-left: 0;margin-top: 0;text-align: center;">
            <h2>Sửa User</h2><br>
            <label for="">User name</label><br>
            <input type="text" placeholder="User name" name="user" required value="<?php echo htmlspecialchars($rows['username']); ?>"> <br><br>
            <label for="">Password</label> <br>
            <input type="text" placeholder="Password" name="pass" required value="<?php echo htmlspecialchars($rows['password']); ?>"><br> <br>
            <label for="">Họ và tên</label><br>
            <input type="text" placeholder="Họ và tên" name="name" required value="<?php echo htmlspecialchars($rows['name']); ?>"> <br><br>
            <label for="">Email</label><br>
            <input type="email" placeholder="Email" name="email" required value="<?php echo htmlspecialchars($rows['email']); ?>"> <br><br>
            <label for="">Hình ảnh hiện tại: <?php echo htmlspecialchars($rows['avata']); ?></label><br>
            <input type="file" name="hinh" style="border:none;"> <br>
            <input type="submit" value="Cập Nhật" name="sua" style="width: 150px;">
        </form>

    </main>
</div>
