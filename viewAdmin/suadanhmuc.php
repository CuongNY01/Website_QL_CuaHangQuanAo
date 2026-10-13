
<div class="main">
    <main>

        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 0;
        }
        $danhmuc = danhmuc_showId($id);
        if (!$danhmuc) {
            echo "<script>alert('Không tìm thấy danh mục'); window.location.href='../controller/indexAdmin.php?act=danhmuc';</script>";
            exit;
        }
        $tendanhmuc = $danhmuc['tendanhmuc'];

        if (isset($_POST['sua'])) {
            $tendanhmuc_new = trim($_POST['name'] ?? '');
            if ($tendanhmuc_new != '') {
                danhmuc_update($tendanhmuc_new, $id);
                echo "<script>alert('Sửa danh mục thành công'); window.location.href='../controller/indexAdmin.php?act=danhmuc';</script>";
                exit;
            }
        }
        ?>

        <form action="" method="POST" style="width:400px; height:auto; padding-bottom: 10%; margin-left: 0;margin-top: 0;text-align: center;">
            <h2 style="text-align: center;">Sửa Danh Mục</h2><br>
            <label for="">Tên Danh Mục</label><br>
            <input type="text" placeholder="User name" name="name" required value="<?php echo $tendanhmuc ?>"> <br><br>
            <input type="submit" value="Cập Nhập" name="sua" style="width: 150px;">
        </form>

    </main>
