<div class="main">
    <main>
        <?php
        $list_dm = danhmuc_showAll();

        if (isset($_POST['them'])) {
            $tensp = trim($_POST['tensp'] ?? '');
            $gia = trim($_POST['gia'] ?? '');
            $danhmuc = trim($_POST['danhmuc'] ?? '');
            $avata = (!empty($_FILES['hinh']['name'])) ? basename($_FILES['hinh']['name']) : '';

            if ($tensp != "" && $gia != "" && $danhmuc != "") {
                if ($avata != "") {
                    $target = "../view/images/";
                    $target_file = $target . $avata;
                    move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file);
                } else {
                    $avata = "logo.jpg";
                }
                sanpham_insert($tensp, $avata, $gia, $danhmuc);
                echo "<script>alert('Thêm sản phẩm thành công'); window.location.href='../controller/indexAdmin.php?act=sanpham';</script>";
                exit;
            } else {
                echo "<script>alert('Vui lòng nhập đầy đủ các trường dữ liệu bắt buộc!');</script>";
            }
        }
        ?>
        <form action="" method="POST" class="sua" enctype="multipart/form-data" style="width:480px; height:auto; padding: 25px; margin: 30px auto; text-align: left; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.08);">
            <h2 style="text-align: center; margin-bottom: 20px;">Thêm Mới Sản Phẩm</h2>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Tên sản phẩm áo đấu / thời trang:</label>
                <input type="text" id="tensp" placeholder="Ví dụ: Áo Real Madrid Sân Nhà 24/25..." name="tensp" required style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Đơn giá bán (VNĐ):</label>
                <input type="number" id="gia" placeholder="Ví dụ: 180000" name="gia" required style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Danh mục giải đấu / thời trang:</label>
                <select name="danhmuc" required style="width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px; background: #fff;">
                    <option value="">-- Chọn danh mục --</option>
                    <?php
                    foreach ($list_dm as $dm) {
                        echo '<option value="' . $dm['iddanhmuc'] . '">' . htmlspecialchars($dm['tendanhmuc']) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Hình ảnh đại diện:</label>
                <input type="file" id="hinh" name="hinh" accept="image/*" style="border: none; padding-top: 5px;">
            </div>

            <div style="display: flex; justify-content: space-between; gap: 10px; margin-top: 20px;">
                <input type="submit" value="Lưu lại" name="them" style="flex: 1; height: 38px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;">
                <a href="../controller/indexAdmin.php?act=sanpham" style="flex: 1; height: 38px; line-height: 38px; text-align: center; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-weight: 600;">Hủy bỏ</a>
            </div>
        </form>
    </main>
</div>
