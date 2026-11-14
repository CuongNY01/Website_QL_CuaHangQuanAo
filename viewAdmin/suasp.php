<div class="main">
    <main>
        <?php
        $id = $_GET['id'] ?? 0;
        $rows = sanpham_showChiTiet($id);
        if (!$rows) {
            echo "<script>alert('Không tìm thấy sản phẩm'); window.location.href='../controller/indexAdmin.php?act=sanpham';</script>";
            exit;
        }

        $list_dm = danhmuc_showAll();

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
                echo "<script>alert('Cập nhật sản phẩm thành công'); window.location.href='../controller/indexAdmin.php?act=sanpham';</script>";
                exit;
            } else {
                echo "<script>alert('Vui lòng nhập đầy đủ các trường dữ liệu bắt buộc!');</script>";
            }
        }
        ?>

        <form action="" method="POST" class="sua" enctype="multipart/form-data" style="width:480px; height:auto; padding: 25px; margin: 30px auto; text-align: left; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.08);">
            <h2 style="text-align: center; margin-bottom: 20px;">Chỉnh Sửa Sản Phẩm</h2>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Mã sản phẩm:</label>
                <input type="text" value="<?php echo $rows['id']; ?>" disabled style="width: 100%; height: 38px; padding: 5px 10px; background: #f0f0f0; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Tên sản phẩm thời trang (Áo/Quần/Váy):</label>
                <input type="text" placeholder="Tên sản phẩm" name="tensp" required value="<?php echo htmlspecialchars($rows['tensp']); ?>" style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Đơn giá (VNĐ):</label>
                <input type="number" placeholder="Giá Sản Phẩm" name="gia" required value="<?php echo htmlspecialchars($rows['gia']); ?>" style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Danh mục giải đấu / thời trang:</label>
                <select name="danhmuc" required style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px; background: #fff;">
                    <?php
                    foreach ($list_dm as $dm) {
                        $selected = ($dm['iddanhmuc'] == $rows['iddanhmuc']) ? 'selected' : '';
                        echo '<option value="' . $dm['iddanhmuc'] . '" ' . $selected . '>' . htmlspecialchars($dm['tendanhmuc']) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Ảnh hiện tại:</label>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <img src="../view/images/<?php echo htmlspecialchars($rows['hinh']); ?>" alt="" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                    <input type="file" name="hinh" accept="image/*" style="border: none;">
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; gap: 10px; margin-top: 20px;">
                <input type="submit" value="Cập nhật" name="sua" style="flex: 1; height: 38px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;">
                <a href="../controller/indexAdmin.php?act=sanpham" style="flex: 1; height: 38px; line-height: 38px; text-align: center; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-weight: 600;">Hủy bỏ</a>
            </div>
        </form>
    </main>
</div>
