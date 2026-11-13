<div class="main">
    <main>
        <?php
        if (isset($_POST['them'])) {
            $name = trim($_POST['name'] ?? '');
            $iddanhmuc = trim($_POST['iddanhmuc'] ?? '');

            if ($name != "") {
                danhmuc_insert($iddanhmuc, $name);
                echo "<script>alert('Thêm danh mục thành công'); window.location.href='../controller/indexAdmin.php?act=danhmuc';</script>";
                exit;
            } else {
                echo "<script>alert('Vui lòng nhập tên danh mục');</script>";
            }
        }
        ?>
        <form action="" method="POST" class="sua" style="width:420px; height:auto; padding: 25px; margin: 30px auto; text-align: center; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.08);">
            <h2>Thêm Danh Mục Mới</h2><br>
            <div style="text-align: left; margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Mã danh mục (tùy chọn):</label>
                <input type="number" placeholder="Để trống để tự động tăng" name="iddanhmuc" style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="text-align: left; margin-bottom: 20px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Tên danh mục thời trang / giải đấu:</label>
                <input type="text" placeholder="Ví dụ: La Liga, Quần Áo Đấu Mùa 24/25..." name="name" required style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="display: flex; justify-content: space-between; gap: 10px;">
                <input type="submit" value="Thêm mới" name="them" style="flex: 1; height: 38px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;">
                <a href="../controller/indexAdmin.php?act=danhmuc" style="flex: 1; height: 38px; line-height: 38px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-weight: 600;">Hủy</a>
            </div>
        </form>
    </main>
</div>
