<link rel="stylesheet" href="../view/css/carts.css">
<link rel="stylesheet" href="../view/css/products.css">

<?php
if (!isset($_SESSION['giohang'])) {
    $_SESSION['giohang'] = [];
}

// Xóa 1 món hàng
if (isset($_GET['delid']) && is_numeric($_GET['delid']) && isset($_SESSION['giohang'][$_GET['delid']])) {
    array_splice($_SESSION['giohang'], $_GET['delid'], 1);
    echo "<script>window.location.href='../controller/index.php?act=cart';</script>";
    exit;
}

// Xóa toàn bộ giỏ hàng
if (isset($_GET['clear']) && $_GET['clear'] == 1) {
    $_SESSION['giohang'] = [];
    echo "<script>window.location.href='../controller/index.php?act=cart';</script>";
    exit;
}

// Thêm vào giỏ hàng
if (isset($_POST['addcart'])) {
    $hinh = $_POST['hinh'] ?? '';
    $ten = $_POST['tensp'] ?? '';
    $gia = (int)($_POST['gia'] ?? 0);
    $soluong = (int)($_POST['soluong'] ?? 1);
    if ($soluong < 1) $soluong = 1;
    $size = $_POST['size'] ?? 'L';

    $found = false;
    for ($i = 0; $i < count($_SESSION['giohang']); $i++) {
        if ($_SESSION['giohang'][$i][1] == $ten) {
            $_SESSION['giohang'][$i][3] += $soluong;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $sp = [$hinh, $ten, $gia, $soluong, $size];
        $_SESSION['giohang'][] = $sp;
    }
    echo "<script>window.location.href='../controller/index.php?act=cart';</script>";
    exit;
}

// Cập nhật số lượng
if (isset($_POST['update_cart']) && isset($_POST['qty']) && is_array($_POST['qty'])) {
    foreach ($_POST['qty'] as $index => $qty) {
        $qty = (int)$qty;
        if (isset($_SESSION['giohang'][$index])) {
            if ($qty > 0) {
                $_SESSION['giohang'][$index][3] = $qty;
            } else {
                unset($_SESSION['giohang'][$index]);
            }
        }
    }
    $_SESSION['giohang'] = array_values($_SESSION['giohang']);
    echo "<script>window.location.href='../controller/index.php?act=cart';</script>";
    exit;
}
?>

<div class="banner">
    <img src="../view/images/bannerNHA.jpeg" alt="Giỏ Hàng" height="220px" style="object-fit: cover; width: 100%;">
</div>

<div class="main" style="max-width: 1200px; margin: 30px auto; padding: 0 20px;">
    <h2 style="text-align: center; color: #2c3e50; margin-bottom: 25px;">GIỎ HÀNG CỦA BẠN</h2>

    <?php if (empty($_SESSION['giohang'])): ?>
        <!-- Luồng thay thế: Giỏ hàng trống theo Use Case YC02 -->
        <div style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin: 30px auto;">
            <i class='bx bx-shopping-bag' style="font-size: 72px; color: #bdc3c7;"></i>
            <h3 style="color: #7f8c8d; margin: 15px 0;">Giỏ hàng của bạn đang trống!</h3>
            <p style="color: #95a5a6; margin-bottom: 25px;">Hãy khám phá các bộ sưu tập quần áo và trang phục thời trang mới nhất của chúng tôi.</p>
            <a href="../controller/index.php" style="display: inline-block; padding: 12px 30px; background: #0f172a; color: #fff; text-decoration: none; border-radius: 25px; font-weight: 600; font-size: 15px;">
                <i class="fa fa-arrow-left"></i> TIẾP TỤC MUA SẮM
            </a>
        </div>
    <?php else: ?>
        <form method="POST" action="../controller/index.php?act=cart">
            <table style="width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <thead>
                    <tr class="nen" style="background: #1e293b; color: #fff; text-align: center;">
                        <th style="padding: 12px; width: 50px;">STT</th>
                        <th style="width: 90px;">Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th style="width: 80px;">Size</th>
                        <th>Đơn giá</th>
                        <th style="width: 110px;">Số lượng</th>
                        <th>Thành tiền</th>
                        <th style="width: 70px;">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tong = 0;
                    foreach ($_SESSION['giohang'] as $i => $item):
                        $hinh = $item[0];
                        $ten = $item[1];
                        $gia = $item[2];
                        $soluong = $item[3];
                        $size = $item[4] ?? 'M';
                        $tt = $gia * $soluong;
                        $tong += $tt;
                    ?>
                    <tr style="border-bottom: 1px solid #eee; text-align: center;">
                        <td style="padding: 12px;"><?= ($i + 1) ?></td>
                        <td>
                            <img src="../view/images/<?= htmlspecialchars($hinh) ?>" alt="" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                        </td>
                        <td style="text-align: left; font-weight: 600; color: #333;">
                            <p style="margin: 0;"><?= htmlspecialchars($ten) ?></p>
                        </td>
                        <td>
                            <span style="background: #f1f5f9; padding: 3px 8px; border-radius: 4px; font-weight: 700; font-size: 13px; color: #334155;"><?= htmlspecialchars($size) ?></span>
                        </td>
                        <td style="color: #64748b; font-weight: 600;">
                            <?= number_format($gia, 0, ',', '.') ?> VNĐ
                        </td>
                        <td>
                            <input type="number" name="qty[<?= $i ?>]" value="<?= $soluong ?>" min="1" max="99" style="width: 55px; height: 32px; text-align: center; border: 1px solid #ccc; border-radius: 4px;">
                        </td>
                        <td style="color: #e74c3c; font-weight: 700;">
                            <?= number_format($tt, 0, ',', '.') ?> VNĐ
                        </td>
                        <td>
                            <a href="../controller/index.php?act=cart&delid=<?= $i ?>" onclick="return confirm('Bạn muốn xóa sản phẩm này khỏi giỏ hàng?');" style="color: #e74c3c; font-size: 18px;" title="Xóa món">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr style="background: #f8f9fa;">
                        <td colspan="5" style="text-align: right; padding: 15px; font-weight: 700; font-size: 16px;">Tổng Tiền Thanh Toán:</td>
                        <td colspan="3" style="text-align: left; padding: 15px; font-size: 20px; color: #e74c3c; font-weight: 700;">
                            <?= number_format($tong, 0, ',', '.') ?> VNĐ
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 25px; flex-wrap: wrap; gap: 15px;">
                <div>
                    <input type="submit" name="update_cart" value="Cập nhật giỏ hàng" style="padding: 10px 20px; background: #6c757d; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;">
                    <a href="../controller/index.php?act=cart&clear=1" onclick="return confirm('Bạn có chắc muốn làm trống giỏ hàng?');" style="margin-left: 10px; padding: 10px 20px; background: #e74c3c; color: #fff; text-decoration: none; border-radius: 4px; font-weight: 600; display: inline-block;">Xóa hết giỏ hàng</a>
                </div>
                <div style="display: flex; gap: 15px;">
                    <a href="../controller/index.php" style="padding: 12px 25px; background: #f1f2f6; color: #333; text-decoration: none; border-radius: 4px; font-weight: 600;">
                        <i class="fa fa-arrow-left"></i> Tiếp tục mua sắm
                    </a>
                    <a href="../controller/thanhtoan.php" style="padding: 12px 30px; background: #27ae60; color: #fff; text-decoration: none; border-radius: 4px; font-weight: 700; font-size: 15px; box-shadow: 0 4px 10px rgba(39,174,96,0.3);">
                        Tiến hành đặt hàng <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>
