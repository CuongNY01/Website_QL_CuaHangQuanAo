<div class="main">
    <main>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 0;
        }
        $rows = sanpham_showChiTiet($id);
        if (!$rows) {
            echo "<script>alert('Không tìm thấy sản phẩm'); window.location.href='../controller/indexAdmin.php?act=sanpham';</script>";
            exit;
        }

        if (isset($_POST['sua'])) {
            $tensp = trim($_POST['tensp'] ?? '');
            $gia = trim($_POST['gia'] ?? '');
            $danhmuc = trim($_POST['danhmuc'] ?? '');
            $hinh = $rows['hinh'];

            if (!empty($_FILES["hinh"]["name"])) {
                $file_name = basename($_FILES["hinh"]["name"]);
                $target_file = "../view/images/" . $file_name;
                if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                    $hinh = $file_name;
                }
            }

            if ($tensp != "" && $gia != "" && $danhmuc != "") {
                sanpham_update($tensp, $hinh, $gia, $danhmuc, $id);
                echo "<script>alert('Sửa sản phẩm thành công'); window.location.href='../controller/indexAdmin.php?act=sanpham';</script>";
                exit;
            }
        }
        ?>

        <form action="" method="POST" class="sua" enctype="multipart/form-data"
            style="width:400px; height:auto; padding-bottom: 10%; margin-left: 0;margin-top: 0;text-align: center;">
            <h2>Sửa sản phẩm</h2>
            <br>
            <input type="text" placeholder="Tên Sản Phẩm" name="tensp" required value="<?php echo $rows['tensp'] ?>">
            <br><br>
            <input type="text" placeholder="Giá Sản Phẩm" name="gia" required
                value="<?php echo $rows['gia'] ?>"><br><br>
            <input type="text" placeholder="Id danh mục" name="danhmuc" required
                value="<?php echo $rows['iddanhmuc'] ?>"><br><br>
            <input type="file" name="hinh" value="<?php echo $rows['hinh'] ?>" style="border:none;"> <br>
            <input type="submit" value="Sủa" name="sua" style="width: 150px;">
        </form>
    </main>