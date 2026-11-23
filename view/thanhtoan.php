<link rel="stylesheet" href="../view/css/carts.css">
<link rel="stylesheet" href="../view/css/products.css">

<?php
include_once "../model/donhang.php";

if (!isset($_SESSION['giohang'])) {
    $_SESSION['giohang'] = [];
}

$order_success = false;
$order_info = [];
$transfer_confirmed = false;

// Xử lý xác nhận đã chuyển khoản cho đơn vừa đặt
if (isset($_POST['confirm_transfer']) && !empty($_SESSION['last_order_info'])) {
    $order_info = $_SESSION['last_order_info'];
    $db_id = (int)($order_info['db_id'] ?? 0);
    if ($db_id > 0) {
        donhang_update_trangthai($db_id, 'Chờ xác nhận (Đã CK)');
        $order_info['status'] = 'Chờ xác nhận (Đã CK)';
        $_SESSION['last_order_info'] = $order_info;
    }
    $order_success = true;
    $transfer_confirmed = true;
}

// Xử lý mã giảm giá
$discount_amount = 0;
$voucher_code = '';
$voucher_msg = '';

if (isset($_POST['apply_voucher'])) {
    $voucher_code = strtoupper(trim($_POST['voucher'] ?? ''));
    if ($voucher_code === 'GIAM10' || $voucher_code === 'SALE10') {
        $_SESSION['voucher_discount'] = 10; // Giảm 10%
        $voucher_msg = "<span style='color: #27ae60;'><i class='fa fa-check'></i> Áp dụng thành công mã giảm 10%!</span>";
    } else if ($voucher_code === 'FREESHIP') {
        $_SESSION['voucher_discount'] = 'freeship';
        $voucher_msg = "<span style='color: #27ae60;'><i class='fa fa-check'></i> Áp dụng thành công miễn phí vận chuyển!</span>";
    } else if (!empty($voucher_code)) {
        $voucher_msg = "<span style='color: #e74c3c;'><i class='fa fa-times'></i> Mã giảm giá không hợp lệ!</span>";
    }
}

// Tính tổng tiền giỏ hàng
$tong_tien = 0;
foreach ($_SESSION['giohang'] as $item) {
    $tong_tien += ($item[2] * $item[3]);
}

$phi_ship = ($tong_tien >= 500000 || ($_SESSION['voucher_discount'] ?? '') === 'freeship' || $tong_tien == 0) ? 0 : 30000;

if (isset($_SESSION['voucher_discount']) && is_numeric($_SESSION['voucher_discount'])) {
    $discount_amount = ($tong_tien * $_SESSION['voucher_discount']) / 100;
}

$thanh_toan = max(0, $tong_tien - $discount_amount + $phi_ship);

// Xử lý xác nhận đặt hàng
if (isset($_POST['confirm_order'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $pttt = $_POST['pttt'] ?? 'COD';
    $note = trim($_POST['note'] ?? '');

    if ($name != "" && $phone != "" && $address != "" && !empty($_SESSION['giohang'])) {
        $order_id = "DH" . date("YmdHis");
        $iduser = isset($_SESSION['id']) ? (int)$_SESSION['id'] : null;

        // Lưu đơn hàng vào cơ sở dữ liệu
        $inserted_id = donhang_insert($order_id, $iduser, $name, $phone, $email, $address, $pttt, $note, $thanh_toan, 'Chờ xác nhận');
        
        $saved_items = $_SESSION['giohang'];
        if ($inserted_id > 0) {
            foreach ($saved_items as $item) {
                $hinh = $item[0] ?? '';
                $tensp = $item[1] ?? 'Trang phục thời trang';
                $dongia = (int)($item[2] ?? 0);
                $soluong = (int)($item[3] ?? 1);
                $size = $item[4] ?? 'M';
                $idsp = isset($item[5]) ? (int)$item[5] : 0;
                $thanhtien = $dongia * $soluong;

                donhang_chitiet_insert($inserted_id, $idsp, $tensp, $hinh, $size, $dongia, $soluong, $thanhtien);
            }
        }

        $order_info = [
            'id' => $order_id,
            'db_id' => $inserted_id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'pttt' => $pttt,
            'note' => $note,
            'items' => $saved_items,
            'subtotal' => $tong_tien,
            'discount' => $discount_amount,
            'shipping' => $phi_ship,
            'total' => $thanh_toan,
            'status' => 'Chờ xác nhận',
            'date' => date("d/m/Y H:i:s")
        ];
        $_SESSION['last_order_info'] = $order_info;

        // Giải phóng giỏ hàng theo đúng đặc tả Use Case Bảng 1.4
        $_SESSION['giohang'] = [];
        unset($_SESSION['voucher_discount']);
        $order_success = true;
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ họ tên, số điện thoại và địa chỉ giao hàng!');</script>";
    }
}

// Prefill thông tin nếu đã đăng nhập
$pre_name = $_SESSION['name'] ?? '';
$pre_email = $_SESSION['email'] ?? '';
?>

<div class="banner">
    <img src="../view/images/banner_home_fashion.jpg" alt="Thanh Toán" height="240px" style="object-fit: cover; width: 100%;">
</div>

<div class="main" style="max-width: 1200px; margin: 30px auto; padding: 0 20px;">
    <?php if ($order_success): ?>
        <!-- Giao diện thông báo Đặt hàng thành công & Hóa đơn chi tiết -->
        <div style="text-align: center; padding: 45px 30px; background: #fff; border-radius: 12px; box-shadow: 0 6px 25px rgba(0,0,0,0.08); margin: 30px auto; max-width: 850px; border: 1px solid #e2e8f0;">
            <i class='bx bx-check-circle' style="font-size: 85px; color: #10b981;"></i>
            <h2 style="color: #0f172a; margin: 15px 0 8px 0; font-weight: 800;">ĐẶT HÀNG THÀNH CÔNG!</h2>
            <p style="font-size: 15px; color: #64748b; margin-bottom: 20px;">
                Cảm ơn quý khách <b><?= htmlspecialchars($order_info['name']) ?></b> đã đặt mua quần áo thời trang tại <b>Fashion Store 24/7</b>.
            </p>
            <div style="display: inline-block; background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 8px 20px; font-size: 15px; color: #1e40af; margin-bottom: 25px;">
                Mã đơn hàng: <b style="color: #ef4444; font-size: 17px;"><?= $order_info['id'] ?></b> | Ngày đặt: <?= $order_info['date'] ?>
            </div>

            <?php
            $is_bank_transfer = (stripos($order_info['pttt'] ?? '', 'COD') === false);
            $qr_amount = (int)($order_info['total'] ?? 0);
            $qr_note = "THANHTOAN " . ($order_info['id'] ?? '');
            $vietqr_url = "https://img.vietqr.io/image/MB-0348008939-compact2.png?amount=" . $qr_amount . "&addInfo=" . urlencode($qr_note) . "&accountName=" . urlencode("DUONG BA CONG");
            ?>

            <?php if ($is_bank_transfer): ?>
                <!-- CỔNG THANH TOÁN CHUYỂN KHOẢN VIETQR -->
                <div style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); border: 1px solid #bae6fd; border-radius: 12px; padding: 24px; margin-bottom: 25px; text-align: left;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 16px; border-bottom: 1px solid #bae6fd; padding-bottom: 12px;">
                        <h3 style="margin: 0; font-size: 17px; color: #0369a1; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                            <i class='bx bx-qr-scan' style="font-size: 22px;"></i> THANH TOÁN CHUYỂN KHOẢN (VIETQR 24/7)
                        </h3>
                        <?php if ($transfer_confirmed || ($order_info['status'] ?? '') === 'Chờ xác nhận (Đã CK)'): ?>
                            <span style="background: #10b981; color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">
                                <i class='bx bx-check-double'></i> Đã báo chuyển khoản
                            </span>
                        <?php else: ?>
                            <span style="background: #f59e0b; color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">
                                <i class='bx bx-time'></i> Chờ thanh toán
                            </span>
                        <?php endif; ?>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 22px; align-items: center;">
                        <div style="text-align: center; background: #fff; padding: 14px; border-radius: 10px; border: 1px solid #cbd5e1; box-shadow: 0 2px 10px rgba(0,0,0,0.04);">
                            <img src="<?= htmlspecialchars($vietqr_url) ?>" alt="Mã QR Chuyển Khoản VietQR" style="max-width: 220px; width: 100%; border-radius: 6px;">
                            <p style="margin: 8px 0 0 0; font-size: 12px; color: #475569;">Quét bằng app Ngân hàng, MoMo hoặc ZaloPay</p>
                        </div>

                        <div style="font-size: 14px; color: #1e293b; line-height: 1.9;">
                            <p style="margin: 0 0 8px 0;"><b>Ngân hàng:</b> MB Bank (TMCP Quân Đội)</p>
                            <p style="margin: 0 0 8px 0; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                <b>Số tài khoản:</b> 
                                <span style="font-family: monospace; font-size: 16px; font-weight: 800; color: #0f172a; background: #fff; padding: 2px 8px; border-radius: 4px; border: 1px solid #cbd5e1;">0348008939</span>
                                <button type="button" onclick="copyText('0348008939', this)" style="padding: 3px 10px; font-size: 12px; background: #0284c7; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Sao chép</button>
                            </p>
                            <p style="margin: 0 0 8px 0;"><b>Chủ tài khoản:</b> DUONG BA CONG</p>
                            <p style="margin: 0 0 8px 0; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                <b>Số tiền:</b> 
                                <span style="font-size: 16px; font-weight: 800; color: #ef4444;"><?= number_format($qr_amount, 0, ',', '.') ?> VNĐ</span>
                                <button type="button" onclick="copyText('<?= $qr_amount ?>', this)" style="padding: 3px 10px; font-size: 12px; background: #0284c7; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Sao chép</button>
                            </p>
                            <p style="margin: 0 0 14px 0; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                <b>Nội dung CK:</b> 
                                <span style="font-family: monospace; font-size: 14px; font-weight: 800; color: #b91c1c; background: #fef2f2; padding: 2px 8px; border-radius: 4px; border: 1px solid #fecaca;"><?= htmlspecialchars($qr_note) ?></span>
                                <button type="button" onclick="copyText('<?= htmlspecialchars($qr_note) ?>', this)" style="padding: 3px 10px; font-size: 12px; background: #0284c7; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Sao chép</button>
                            </p>

                            <?php if ($transfer_confirmed || ($order_info['status'] ?? '') === 'Chờ xác nhận (Đã CK)'): ?>
                                <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 10px 14px; border-radius: 8px; font-size: 13px; font-weight: 600;">
                                    <i class='bx bx-check-circle'></i> Đã ghi nhận thông báo chuyển khoản! Nhân viên sẽ đối soát và xác nhận đơn hàng cho bạn ngay.
                                </div>
                            <?php else: ?>
                                <form method="POST" action="" style="margin: 0;">
                                    <button type="submit" name="confirm_transfer" style="width: 100%; padding: 11px 16px; background: #10b981; color: #fff; border: none; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; box-shadow: 0 4px 10px rgba(16,185,129,0.25);">
                                        <i class='bx bx-check-shield' style="font-size: 18px;"></i> TÔI ĐÃ CHUYỂN KHOẢN XONG
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Bảng danh sách sản phẩm đã đặt -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden; margin-bottom: 25px; text-align: left;">
                <div style="background: #f8fafc; padding: 12px 18px; border-bottom: 1px solid #e2e8f0; font-weight: 700; color: #334155;">
                    <i class='bx bx-shopping-bag'></i> Danh Sách Sản Phẩm Đã Mua
                </div>
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <thead>
                        <tr style="border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 12px; text-transform: uppercase;">
                            <th style="padding: 10px 15px; text-align: left;">Sản phẩm</th>
                            <th style="padding: 10px 15px; text-align: center;">Size</th>
                            <th style="padding: 10px 15px; text-align: right;">Đơn giá</th>
                            <th style="padding: 10px 15px; text-align: center;">SL</th>
                            <th style="padding: 10px 15px; text-align: right;">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_info['items'] as $it): 
                            $it_sub = (int)$it[2] * (int)$it[3];
                        ?>
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 10px 15px; display: flex; align-items: center; gap: 10px;">
                                    <img src="../view/images/<?= htmlspecialchars($it[0]) ?>" alt="" style="width: 44px; height: 44px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                                    <span style="font-weight: 600; color: #1e293b;"><?= htmlspecialchars($it[1]) ?></span>
                                </td>
                                <td style="padding: 10px 15px; text-align: center;">
                                    <span style="background: #f1f5f9; padding: 2px 8px; border-radius: 4px; font-weight: 600;"><?= htmlspecialchars($it[4] ?? 'M') ?></span>
                                </td>
                                <td style="padding: 10px 15px; text-align: right; color: #64748b;"><?= number_format($it[2], 0, ',', '.') ?> đ</td>
                                <td style="padding: 10px 15px; text-align: center; font-weight: 600;"><?= $it[3] ?></td>
                                <td style="padding: 10px 15px; text-align: right; font-weight: 700; color: #0f172a;"><?= number_format($it_sub, 0, ',', '.') ?> đ</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Thông tin giao nhận hàng -->
            <div style="background: #f8fafc; border-radius: 10px; padding: 20px; margin-bottom: 25px; text-align: left; font-size: 14px; border: 1px solid #e2e8f0;">
                <h4 style="margin-bottom: 12px; color: #0f172a; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px; font-weight: 700;">
                    <i class='bx bx-map-pin' style="color: #ef4444;"></i> Thông Tin Giao Nhận Hàng
                </h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 10px; line-height: 1.7;">
                    <div>
                        <p><b>Người nhận:</b> <?= htmlspecialchars($order_info['name']) ?></p>
                        <p><b>Số điện thoại:</b> <?= htmlspecialchars($order_info['phone']) ?></p>
                        <p><b>Email:</b> <?= htmlspecialchars($order_info['email'] ?: 'Chưa cung cấp') ?></p>
                    </div>
                    <div>
                        <p><b>Địa chỉ nhận hàng:</b> <?= htmlspecialchars($order_info['address']) ?></p>
                        <p><b>Hình thức thanh toán:</b> <span style="color: #3b82f6; font-weight: 600;"><?= htmlspecialchars($order_info['pttt']) ?></span></p>
                        <?php if (!empty($order_info['note'])): ?>
                            <p><b>Ghi chú:</b> <i><?= htmlspecialchars($order_info['note']) ?></i></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div style="margin-top: 15px; padding-top: 12px; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                    <span style="color: #64748b;">Trạng thái đơn hàng: <b style="color: <?= ($order_info['status'] ?? '') === 'Chờ xác nhận (Đã CK)' ? '#10b981' : '#f59e0b' ?>;"><?= htmlspecialchars($order_info['status'] ?? 'Chờ xác nhận') ?></b></span>
                    <span style="font-size: 18px; font-weight: 800; color: #ef4444;">
                        Tổng thanh toán: <?= number_format($order_info['total'], 0, ',', '.') ?> VNĐ
                    </span>
                </div>
            </div>

            <p style="color: #64748b; font-size: 13px; margin-bottom: 25px;">
                Đơn hàng của bạn đã được lưu vào hệ thống. Shop sẽ liên hệ qua số điện thoại để xác nhận đơn hàng trước khi gửi.
            </p>

            <!-- Nút hành động sau khi đặt -->
            <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                <a href="../controller/index.php?act=tracuudonhang&madh=<?= $order_info['id'] ?>" style="display: inline-flex; align-items: center; gap: 6px; padding: 11px 24px; background: #0f172a; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px;">
                    <i class='bx bx-search'></i> Theo dõi đơn hàng
                </a>
                <?php if (isset($_SESSION['id'])): ?>
                    <a href="../controller/index.php?act=lichsudonhang" style="display: inline-flex; align-items: center; gap: 6px; padding: 11px 24px; background: #eff6ff; color: #3b82f6; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; border: 1px solid #bfdbfe;">
                        <i class='bx bx-history'></i> Lịch sử đơn hàng
                    </a>
                <?php endif; ?>
                <a href="../controller/index.php" style="display: inline-flex; align-items: center; gap: 6px; padding: 11px 24px; background: #f1f5f9; color: #334155; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; border: 1px solid #cbd5e1;">
                    <i class='bx bx-store'></i> Tiếp tục mua sắm
                </a>
            </div>
        </div>

    <?php elseif (empty($_SESSION['giohang'])): ?>
        <!-- Luồng giỏ hàng trống -->
        <div style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin: 30px auto;">
            <i class='bx bx-cart-alt' style="font-size: 72px; color: #bdc3c7;"></i>
            <h3 style="color: #7f8c8d; margin: 15px 0;">Giỏ hàng của bạn đang trống!</h3>
            <p style="color: #95a5a6; margin-bottom: 25px;">Vui lòng thêm sản phẩm vào giỏ trước khi tiến hành thanh toán.</p>
            <a href="../controller/index.php" style="display: inline-block; padding: 12px 30px; background: #e74c3c; color: #fff; text-decoration: none; border-radius: 25px; font-weight: 600;">
                <i class="fa fa-arrow-left"></i> Xem sản phẩm
            </a>
        </div>

    <?php else: ?>
        <h2 style="text-align: center; color: #2c3e50; margin-bottom: 25px;">TIẾN HÀNH THANH TOÁN & ĐẶT HÀNG</h2>

        <div style="display: flex; gap: 30px; flex-wrap: wrap;">
            <!-- Cột trái: Thông tin giao nhận hàng -->
            <div style="flex: 1.2; min-width: 350px; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <h3 style="color: #2c3e50; margin-bottom: 20px; font-size: 18px; border-bottom: 2px solid #007bff; padding-bottom: 8px;">
                    <i class="fa fa-map-marker" style="color: #e74c3c;"></i> Thông Tin Giao Hàng
                </h3>

                <form action="" method="POST" id="checkout-form">
                    <div style="margin-bottom: 15px;">
                        <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Họ và tên người nhận <span style="color:red;">*</span></label>
                        <input type="text" name="name" required value="<?= htmlspecialchars($pre_name) ?>" placeholder="Nguyễn Văn A" style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
                    </div>

                    <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                        <div style="flex: 1;">
                            <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Số điện thoại <span style="color:red;">*</span></label>
                            <input type="text" name="phone" required placeholder="0987xxxxxx" style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
                        </div>
                        <div style="flex: 1;">
                            <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Email</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($pre_email) ?>" placeholder="email@domain.com" style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
                        </div>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Địa chỉ nhận hàng chi tiết <span style="color:red;">*</span></label>
                        <input type="text" name="address" required placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/TP" style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Phương thức thanh toán <span style="color:red;">*</span></label>
                        <select name="pttt" id="pttt-select" onchange="toggleBankPreview()" style="width: 100%; height: 42px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; background: #fff;">
                            <option value="COD - Trả tiền khi nhận hàng (Thanh toán tại nhà)">COD - Thanh toán tiền mặt khi nhận hàng (Khuyên dùng)</option>
                            <option value="Chuyển khoản ATM / Mobile Banking (VietQR)">Chuyển khoản Ngân hàng (Quét mã VietQR 24/7)</option>
                            <option value="Ví điện tử MoMo">Thanh toán qua Ví điện tử MoMo</option>
                            <option value="Ví điện tử ZaloPay">Thanh toán qua Ví ZaloPay</option>
                        </select>

                        <!-- Khung hướng dẫn chuyển khoản xem trước -->
                        <div id="bank-preview-box" style="display: none; margin-top: 12px; background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 8px; padding: 14px 16px; font-size: 13px; color: #0c4a6e; line-height: 1.6;">
                            <div style="font-weight: 700; margin-bottom: 6px; color: #0369a1; display: flex; align-items: center; gap: 6px;">
                                <i class='bx bx-info-circle' style="font-size: 17px;"></i> Thông tin chuyển khoản Fashion Store 24/7
                            </div>
                            <p style="margin: 2px 0;">• <b>Ngân hàng:</b> MB Bank — <b>STK:</b> <code>0348008939</code> — <b>Chủ TK:</b> DUONG BA CONG</p>
                            <p style="margin: 2px 0;">• <b>Số tiền thanh toán:</b> <b style="color: #ef4444;"><?= number_format($thanh_toan, 0, ',', '.') ?> VNĐ</b></p>
                            <p style="margin: 4px 0 0 0; font-style: italic; color: #0284c7;">Sau khi nhấn "Xác nhận đặt hàng", mã <b>QR VietQR</b> tự động điền sẵn số tiền và nội dung sẽ hiển thị để bạn quét nhanh.</p>
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Ghi chú giao hàng (Size, thời gian nhận...):</label>
                        <textarea name="note" rows="3" placeholder="Ghi chú thêm cho người giao hàng..." style="width: 100%; padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;"></textarea>
                    </div>

                    <input type="submit" name="confirm_order" value="XÁC NHẬN ĐẶT HÀNG" style="width: 100%; height: 48px; background: #e74c3c; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: 700; cursor: pointer; letter-spacing: 0.5px; box-shadow: 0 4px 12px rgba(231,76,60,0.3);">
                </form>
            </div>

            <!-- Cột phải: Tóm tắt đơn hàng & Áp dụng voucher -->
            <div style="flex: 1; min-width: 320px;">
                <!-- Box voucher -->
                <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
                    <h4 style="color: #2c3e50; margin-bottom: 12px; font-size: 16px;"><i class="fa fa-tag" style="color: #f39c12;"></i> Mã Giảm Giá / Voucher</h4>
                    <form method="POST" action="../controller/thanhtoan.php" style="display: flex; gap: 8px;">
                        <input type="text" name="voucher" placeholder="Nhập mã (VD: GIAM10, FREESHIP)" style="flex: 1; height: 38px; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 13px;">
                        <input type="submit" name="apply_voucher" value="Áp Dụng" style="padding: 0 16px; height: 38px; background: #2c3e50; color: #fff; border: none; border-radius: 4px; font-weight: 600; cursor: pointer;">
                    </form>
                    <?php if (!empty($voucher_msg)): ?>
                        <div style="margin-top: 8px; font-size: 13px;"><?= $voucher_msg ?></div>
                    <?php endif; ?>
                </div>

                <!-- Box tóm tắt đơn hàng -->
                <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                    <h4 style="color: #2c3e50; margin-bottom: 15px; font-size: 16px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                        Đơn Hàng Của Bạn (<?= count($_SESSION['giohang']) ?> món)
                    </h4>

                    <div style="max-height: 250px; overflow-y: auto; margin-bottom: 15px;">
                        <?php foreach ($_SESSION['giohang'] as $item): ?>
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px; border-bottom: 1px dashed #f0f0f0; padding-bottom: 8px;">
                                <img src="../view/images/<?= htmlspecialchars($item[0]) ?>" alt="" style="width: 45px; height: 45px; object-fit: contain; border: 1px solid #eee; border-radius: 4px;">
                                <div style="flex: 1;">
                                    <p style="margin: 0; font-size: 13px; font-weight: 600; color: #333;"><?= htmlspecialchars($item[1]) ?></p>
                                    <span style="font-size: 12px; color: #888;">Size: <b><?= htmlspecialchars($item[4] ?? 'M') ?></b> | Số lượng: <?= $item[3] ?></span>
                                </div>
                                <span style="font-size: 13px; font-weight: 600; color: #e74c3c;">
                                    <?= number_format($item[2] * $item[3], 0, ',', '.') ?> đ
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div style="border-top: 1px solid #eee; padding-top: 10px; font-size: 14px; line-height: 1.8;">
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: #666;">Tạm tính:</span>
                            <span style="font-weight: 600;"><?= number_format($tong_tien, 0, ',', '.') ?> VNĐ</span>
                        </div>
                        <?php if ($discount_amount > 0): ?>
                        <div style="display: flex; justify-content: space-between; color: #27ae60;">
                            <span>Giảm giá:</span>
                            <span>-<?= number_format($discount_amount, 0, ',', '.') ?> VNĐ</span>
                        </div>
                        <?php endif; ?>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: #666;">Phí vận chuyển:</span>
                            <span style="font-weight: 600;">
                                <?= $phi_ship == 0 ? '<span style="color:#27ae60;">Miễn phí</span>' : number_format($phi_ship, 0, ',', '.') . ' VNĐ' ?>
                            </span>
                        </div>
                        <hr style="margin: 10px 0; border: none; border-top: 1px solid #eee;">
                        <div style="display: flex; justify-content: space-between; font-size: 17px; font-weight: 700; color: #e74c3c;">
                            <span>Tổng thanh toán:</span>
                            <span><?= number_format($thanh_toan, 0, ',', '.') ?> VNĐ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<section>
    <div class="box-policy" style="display: flex; justify-content: center; align-items: center; margin: 40px auto; gap: 20px; flex-wrap: wrap;">
        <div class="iteam" style="width: 220px; text-align: center; background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <div class="logo">
                <img src="../view/images/icons8_Hotline_100px_2 1.png" alt="" style="height: 60px; width: 60px;">
            </div>
            <div class="content" style="margin-top: 10px;">
                <div class="title" style="font-size: 16px; font-weight: 600;">Hỗ trợ 24/7</div>
                <div style="font-size: 13px; color: #888;">Hotline: 024.2236.5888</div>
            </div>
        </div>
        <div class="iteam" style="width: 220px; text-align: center; background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <div class="logo">
                <img src="../view/images/icons8_online_shopping_240px 1.png" alt="" style="height: 60px; width: 60px;">
            </div>
            <div class="content" style="margin-top: 10px;">
                <div class="title" style="font-size: 16px; font-weight: 600;">Mua sắm tiện lợi</div>
                <div style="font-size: 13px; color: #888;">Giao hàng tận nơi</div>
            </div>
        </div>
        <div class="iteam" style="width: 220px; text-align: center; background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <div class="logo">
                <img src="../view/images/icons8_card_payment_240px 1.png" alt="" style="height: 60px; width: 60px;">
            </div>
            <div class="content" style="margin-top: 10px;">
                <div class="title" style="font-size: 16px; font-weight: 600;">Đa dạng thanh toán</div>
                <div style="font-size: 13px; color: #888;">COD, Ví MoMo, ZaloPay</div>
            </div>
        </div>
        <div class="iteam" style="width: 220px; text-align: center; background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <div class="logo">
                <img src="../view/images/icons8_shipped_100px 1.png" alt="" style="height: 60px; width: 60px;">
            </div>
            <div class="content" style="margin-top: 10px;">
                <div class="title" style="font-size: 16px; font-weight: 600;">Đổi trả linh hoạt</div>
                <div style="font-size: 13px; color: #888;">Đổi size trong 7 ngày</div>
            </div>
        </div>
    </div>
</section>

<script>
function toggleBankPreview() {
    var sel = document.getElementById('pttt-select');
    var box = document.getElementById('bank-preview-box');
    if (!sel || !box) return;
    if (sel.value.indexOf('COD') === -1) {
        box.style.display = 'block';
    } else {
        box.style.display = 'none';
    }
}

function copyText(text, btn) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(function() {
            var old = btn.innerText;
            btn.innerText = 'Đã chép!';
            btn.style.background = '#10b981';
            setTimeout(function() {
                btn.innerText = old;
                btn.style.background = '#0284c7';
            }, 1500);
        });
    }
}
</script>
