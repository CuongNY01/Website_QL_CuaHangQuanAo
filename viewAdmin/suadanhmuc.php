<div class="main">
    <main>
        <?php
        $id = $_GET['id'] ?? 0;
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
                echo "<script>alert('Cập nhật danh mục thành công'); window.location.href='../controller/indexAdmin.php?act=danhmuc';</script>";
                exit;
            } else {
                echo "<script>alert('Vui lòng nhập tên danh mục');</script>";
            }
        }
        ?>

        <form action="" method="POST" class="sua" style="width:420px; height:auto; padding: 25px; margin: 30px auto; text-align: center; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.08);">
            <h2>Chỉnh Sửa Danh Mục</h2><br>
            <div style="text-align: left; margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Mã danh mục:</label>
                <input type="text" value="<?php echo $id; ?>" disabled style="width: 100%; height: 38px; padding: 5px 10px; background: #f0f0f0; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="text-align: left; margin-bottom: 20px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Tên danh mục:</label>
                <input type="text" placeholder="Nhập tên danh mục thời trang" name="name" required value="<?php echo htmlspecialchars($tendanhmuc); ?>" style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="display: flex; justify-content: space-between; gap: 10px;">
                <input type="submit" value="Cập nhật" name="sua" style="flex: 1; height: 38px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;">
                <a href="../controller/indexAdmin.php?act=danhmuc" style="flex: 1; height: 38px; line-height: 38px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-weight: 600;">Quay lại</a>
            </div>
        </form>
    </main>
</div>
