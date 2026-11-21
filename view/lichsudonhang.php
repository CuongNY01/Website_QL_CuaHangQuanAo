<link rel="stylesheet" href="../view/css/products.css">

<?php
include_once "../model/donhang.php";

$user_id = $_SESSION['id'] ?? null;
$searched_order = null;
$search_query = trim($_POST['search_order'] ?? ($_GET['madh'] ?? ''));

// Nếu có tìm kiếm mã đơn hoặc số điện thoại
if ($search_query !== '') {
    $searched_order = donhang_showByMa($search_query);
    if (!$searched_order && is_numeric($search_query)) {
        // Tìm theo số điện thoại
        $sql_phone = "SELECT * FROM donhang WHERE sdt = ? ORDER BY id DESC LIMIT 1";
        $searched_order = pdo_query_one($sql_phone, $search_query);
    }
}

// Lấy danh sách đơn của user đã đăng nhập
$user_orders = [];
if ($user_id) {
    $user_orders = donhang_showAll_by_user($user_id);
}
?>

<div class="banner">
    <img src="../view/images/banner_home_fashion.jpg" alt="Đơn Hàng" height="240px" style="object-fit: cover; width: 100%;">
</div>

<div class="main" style="max-width: 1200px; margin: 35px auto; padding: 0 20px; font-family: 'Plus Jakarta Sans', sans-serif;">
    <!-- Tiêu đề trang & Thanh tra cứu nhanh -->
    <div style="background: #fff; padding: 25px 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; margin-bottom: 30px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
            <div>
                <h2 style="font-size: 22px; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <i class='bx bx-package' style="color: #3b82f6;"></i> Quản Lý & Tra Cứu Đơn Hàng
                </h2>
                <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Theo dõi tiến độ giao hàng và xem lại lịch sử các sản phẩm bạn đã đặt</p>
            </div>

            <!-- Form tra cứu theo mã đơn hàng hoặc SĐT -->
            <form action="../controller/index.php?act=tracuudonhang" method="POST" style="display: flex; gap: 8px; flex-wrap: wrap;">
                <input type="text" name="search_order" value="<?= htmlspecialchars($search_query) ?>" placeholder="Nhập mã đơn (VD: DH2026...) hoặc SĐT" required style="padding: 9px 14px; border: 1px solid #cbd5e1; border-radius: 8px; width: 280px; font-size: 13px; outline: none;">
                <button type="submit" style="padding: 9px 18px; background: #0f172a; color: #fff; border: none; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; display: flex; align-items: center; gap: 5px;">
                    <i class='bx bx-search'></i> Tra Cứu
                </button>
            </form>
        </div>
    </div>

    <!-- NẾU CÓ KẾT QUẢ TÌM KIẾM CHI TIẾT 1 ĐƠN HÀNG -->
    <?php if ($searched_order): 
        $details = donhang_chitiet_show($searched_order['id']);
        $stt = $searched_order['trangthai'];
        $badge_color = "#f59e0b"; // Chờ xác nhận
        $badge_bg = "#fef3c7";
        if ($stt === 'Đang giao hàng' || $stt === 'Đang chuẩn bị hàng') {
            $badge_color = "#0284c7";
            $badge_bg = "#e0f2fe";
        } else if ($stt === 'Giao thành công') {
            $badge_color = "#16a34a";
            $badge_bg = "#dcfce7";
        } else if ($stt === 'Đã hủy') {
            $badge_color = "#dc2626";
            $badge_bg = "#fee2e2";
        }
    ?>
        <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; margin-bottom: 35px;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
                <div>
                    <span style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase;">Kết quả tra cứu đơn hàng:</span>
                    <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 4px 0 0 0;">
                        Mã đơn: <span style="color: #ef4444;"><?= $searched_order['madh'] ?></span>
                    </h3>
                </div>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <span style="font-size: 13px; color: #64748b;">Ngày đặt: <b><?= date("d/m/Y H:i", strtotime($searched_order['ngaydathang'])) ?></b></span>
                    <span style="background: <?= $badge_bg ?>; color: <?= $badge_color ?>; font-weight: 700; padding: 6px 14px; border-radius: 20px; font-size: 13px;">
                        <?= htmlspecialchars($stt) ?>
                    </span>
                </div>
            </div>

            <!-- Bảng danh sách sản phẩm trong đơn -->
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 14px;">
                <thead>
                    <tr style="background: #f8fafc; color: #475569; font-size: 12px; text-transform: uppercase; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 12px 15px; text-align: left;">Sản phẩm</th>
                        <th style="padding: 12px 15px; text-align: center;">Size</th>
                        <th style="padding: 12px 15px; text-align: right;">Đơn giá</th>
                        <th style="padding: 12px 15px; text-align: center;">Số lượng</th>
                        <th style="padding: 12px 15px; text-align: right;">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($details as $d): ?>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 12px 15px; display: flex; align-items: center; gap: 12px;">
                                <img src="../view/images/<?= htmlspecialchars($d['hinh']) ?>" alt="" style="width: 48px; height: 48px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                                <strong style="color: #1e293b;"><?= htmlspecialchars($d['tensp']) ?></strong>
                            </td>
                            <td style="padding: 12px 15px; text-align: center;">
                                <span style="background: #f1f5f9; padding: 3px 8px; border-radius: 4px; font-weight: 700; font-size: 13px;"><?= htmlspecialchars($d['size']) ?></span>
                            </td>
                            <td style="padding: 12px 15px; text-align: right; color: #64748b;"><?= number_format($d['dongia'], 0, ',', '.') ?> đ</td>
                            <td style="padding: 12px 15px; text-align: center; font-weight: 700;"><?= $d['soluong'] ?></td>
                            <td style="padding: 12px 15px; text-align: right; font-weight: 700; color: #0f172a;"><?= number_format($d['thanhtien'], 0, ',', '.') ?> đ</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Thông tin người nhận và tổng tiền -->
            <div style="background: #f8fafc; border-radius: 8px; padding: 18px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; font-size: 14px;">
                <div style="line-height: 1.6;">
                    <p><b>Người nhận:</b> <?= htmlspecialchars($searched_order['hoten']) ?> - <b>SĐT:</b> <?= htmlspecialchars($searched_order['sdt']) ?></p>
                    <p><b>Địa chỉ:</b> <?= htmlspecialchars($searched_order['diachi']) ?></p>
                    <p><b>Hình thức:</b> <?= htmlspecialchars($searched_order['pttt']) ?> <?php if ($searched_order['ghichu']): ?>| <i>Ghi chú: <?= htmlspecialchars($searched_order['ghichu']) ?></i><?php endif; ?></p>
                </div>
                <div style="text-align: right;">
                    <span style="font-size: 13px; color: #64748b;">Tổng tiền thanh toán:</span>
                    <h3 style="font-size: 22px; font-weight: 800; color: #ef4444; margin: 4px 0 0 0;">
                        <?= number_format($searched_order['tongtien'], 0, ',', '.') ?> VNĐ
                    </h3>
                </div>
            </div>
        </div>
    <?php elseif ($search_query !== ''): ?>
        <div style="background: #fff; padding: 40px 20px; text-align: center; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 35px;">
            <i class='bx bx-search-alt' style="font-size: 48px; color: #cbd5e1; display: block; margin-bottom: 10px;"></i>
            <h4 style="font-size: 16px; color: #334155; margin-bottom: 5px;">Không tìm thấy đơn hàng nào khớp với "<b><?= htmlspecialchars($search_query) ?></b>"</h4>
            <p style="font-size: 13px; color: #94a3b8;">Vui lòng kiểm tra lại mã đơn hàng hoặc số điện thoại người nhận đã đặt.</p>
        </div>
    <?php endif; ?>

    <!-- DANH SÁCH LỊCH SỬ ĐƠN HÀNG CỦA USER ĐÃ ĐĂNG NHẬP -->
    <?php if ($user_id): ?>
        <div style="background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.05); overflow: hidden;">
            <div style="padding: 18px 24px; border-bottom: 1px solid #e2e8f0; background: #fafafa; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="font-size: 17px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <i class='bx bx-history' style="color: #3b82f6;"></i> Lịch Sử Đơn Hàng Của Bạn (<?= count($user_orders) ?> đơn)
                </h3>
            </div>

            <?php if (!empty($user_orders)): ?>
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <thead>
                        <tr style="background: #f8fafc; color: #64748b; font-size: 12px; text-transform: uppercase; border-bottom: 1px solid #e2e8f0;">
                            <th style="padding: 12px 18px; text-align: left;">Mã đơn</th>
                            <th style="padding: 12px 18px; text-align: left;">Ngày đặt</th>
                            <th style="padding: 12px 18px; text-align: left;">Địa chỉ nhận</th>
                            <th style="padding: 12px 18px; text-align: right;">Tổng tiền</th>
                            <th style="padding: 12px 18px; text-align: center;">Trạng thái</th>
                            <th style="padding: 12px 18px; text-align: center;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user_orders as $uo): 
                            $stt = $uo['trangthai'];
                            $badge_color = "#f59e0b";
                            $badge_bg = "#fef3c7";
                            if ($stt === 'Đang giao hàng' || $stt === 'Đang chuẩn bị hàng') {
                                $badge_color = "#0284c7";
                                $badge_bg = "#e0f2fe";
                            } else if ($stt === 'Giao thành công') {
                                $badge_color = "#16a34a";
                                $badge_bg = "#dcfce7";
                            } else if ($stt === 'Đã hủy') {
                                $badge_color = "#dc2626";
                                $badge_bg = "#fee2e2";
                            }
                        ?>
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 14px 18px; font-weight: 700; color: #0f172a;">
                                    #<?= htmlspecialchars($uo['madh']) ?>
                                </td>
                                <td style="padding: 14px 18px; color: #64748b; font-size: 13px;">
                                    <?= date("d/m/Y H:i", strtotime($uo['ngaydathang'])) ?>
                                </td>
                                <td style="padding: 14px 18px; color: #334155; max-width: 280px;">
                                    <?= htmlspecialchars(substr($uo['diachi'], 0, 45)) ?>...
                                </td>
                                <td style="padding: 14px 18px; text-align: right; font-weight: 700; color: #ef4444;">
                                    <?= number_format($uo['tongtien'], 0, ',', '.') ?> đ
                                </td>
                                <td style="padding: 14px 18px; text-align: center;">
                                    <span style="background: <?= $badge_bg ?>; color: <?= $badge_color ?>; font-weight: 700; padding: 4px 12px; border-radius: 20px; font-size: 12px; display: inline-block;">
                                        <?= htmlspecialchars($stt) ?>
                                    </span>
                                </td>
                                <td style="padding: 14px 18px; text-align: center;">
                                    <a href="../controller/index.php?act=tracuudonhang&madh=<?= $uo['madh'] ?>" style="display: inline-flex; align-items: center; gap: 4px; padding: 6px 14px; background: #eff6ff; color: #2563eb; text-decoration: none; border-radius: 6px; font-size: 12px; font-weight: 600; border: 1px solid #bfdbfe;">
                                        <i class='bx bx-show'></i> Chi tiết
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div style="padding: 50px 20px; text-align: center; color: #64748b;">
                    <i class='bx bx-shopping-bag' style="font-size: 44px; color: #cbd5e1; display: block; margin-bottom: 8px;"></i>
                    <p style="margin: 0; font-size: 15px;">Bạn chưa có đơn hàng nào tại cửa hàng.</p>
                    <a href="../controller/index.php" style="display: inline-block; margin-top: 15px; padding: 8px 20px; background: #0f172a; color: #fff; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 600;">
                        Mua sắm ngay
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
