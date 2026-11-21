<link rel="stylesheet" href="../view/css/products.css">
<link rel="stylesheet" href="../view/css/contac.css">

<?php
$contact_sent = false;
$name = '';
$phone = '';
if (isset($_POST['send_contact'])) {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name != "" && $phone != "") {
        $contact_sent = true;
    } else {
        echo "<script>alert('Vui lòng nhập họ tên và số điện thoại liên hệ!');</script>";
    }
}
?>

<div class="banner">
    <img src="../view/images/banner_home_fashion.jpg" alt="Liên hệ cửa hàng" style="width: 100%; height: 260px; object-fit: cover;">
</div>

<div class="main" style="max-width: 1100px; margin: 35px auto 60px auto; padding: 0 20px; font-family: 'Plus Jakarta Sans', sans-serif;">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px;">
        
        <!-- Cột 1: Thông tin liên hệ & Cam kết -->
        <div style="background: #0f172a; color: #fff; padding: 35px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <span style="display: inline-block; background: rgba(59, 130, 246, 0.2); color: #60a5fa; font-size: 12px; font-weight: 700; text-transform: uppercase; padding: 4px 12px; border-radius: 20px; margin-bottom: 15px;">Hỗ Trợ Khách Hàng 24/7</span>
                <h3 style="font-size: 24px; font-weight: 800; margin-bottom: 15px; color: #fff;">FASHION STORE 24/7</h3>
                <p style="color: #94a3b8; font-size: 14px; line-height: 1.7; margin-bottom: 25px;">
                    Đội ngũ chăm sóc khách hàng của Fashion Store luôn sẵn sàng lắng nghe và giải đáp mọi thắc mắc của bạn về sản phẩm, kích cỡ trang phục, chính sách bảo hành và giao nhận hàng.
                </p>

                <div style="display: flex; flex-direction: column; gap: 16px; font-size: 14px;">
                    <div style="display: flex; gap: 12px; align-items: flex-start;">
                        <i class='bx bx-map-pin' style="font-size: 22px; color: #ef4444; margin-top: 2px;"></i>
                        <div>
                            <strong style="display: block; color: #f1f5f9;">Địa chỉ showroom chính:</strong>
                            <span style="color: #94a3b8;">Đường Trịnh Văn Bô, Phường Phương Canh, Quận Nam Từ Liêm, TP. Hà Nội</span>
                        </div>
                    </div>

                    <div style="display: flex; gap: 12px; align-items: flex-start;">
                        <i class='bx bx-phone-call' style="font-size: 22px; color: #10b981; margin-top: 2px;"></i>
                        <div>
                            <strong style="display: block; color: #f1f5f9;">Hotline & Zalo tư vấn:</strong>
                            <span style="color: #94a3b8;">024.2236.5888 - 0348.008.939 (Tổng đài: 1900 6868)</span>
                        </div>
                    </div>

                    <div style="display: flex; gap: 12px; align-items: flex-start;">
                        <i class='bx bx-envelope' style="font-size: 22px; color: #3b82f6; margin-top: 2px;"></i>
                        <div>
                            <strong style="display: block; color: #f1f5f9;">Hộp thư điện tử (Email):</strong>
                            <span style="color: #94a3b8;">support@fashionstore247.vn</span>
                        </div>
                    </div>

                    <div style="display: flex; gap: 12px; align-items: flex-start;">
                        <i class='bx bx-time' style="font-size: 22px; color: #f59e0b; margin-top: 2px;"></i>
                        <div>
                            <strong style="display: block; color: #f1f5f9;">Thời gian mở cửa phục vụ:</strong>
                            <span style="color: #94a3b8;">8:30 - 21:30 hàng ngày (kể cả Thứ 7 & Chủ Nhật)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1); font-size: 13px; color: #94a3b8;">
                <i class='bx bx-check-double' style="color: #10b981;"></i> Cam kết phản hồi tư vấn trong vòng 15 - 30 phút.
            </div>
        </div>

        <!-- Cột 2: Form gửi lời nhắn liên hệ -->
        <div style="background: #fff; padding: 35px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
            <h2 style="color: #0f172a; font-size: 22px; font-weight: 800; margin-bottom: 8px;">GỬI TIN NHẮN TƯ VẤN</h2>
            <p style="color: #64748b; margin-bottom: 25px; font-size: 13px;">Nhập thông tin bên dưới, nhân viên tư vấn phong cách sẽ liên hệ hỗ trợ bạn nhanh chóng.</p>

            <?php if ($contact_sent): ?>
                <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 18px 20px; border-radius: 8px; text-align: center; margin-bottom: 25px;">
                    <i class='bx bx-check-circle' style="font-size: 38px; color: #10b981; margin-bottom: 8px; display: block;"></i>
                    <h4 style="margin: 0 0 6px 0; font-weight: 700;">Gửi tin nhắn liên hệ thành công!</h4>
                    <p style="margin: 0; font-size: 13px; line-height: 1.5;">
                        Cảm ơn bạn <b><?= htmlspecialchars($name) ?></b> đã liên hệ. Chuyên viên của Fashion Store 24/7 sẽ gọi điện hỗ trợ bạn qua số điện thoại <b><?= htmlspecialchars($phone) ?></b> trong thời gian sớm nhất.
                    </p>
                </div>
            <?php endif; ?>

            <form action="../controller/index.php?act=contac" method="POST">
                <div style="display: flex; gap: 15px; margin-bottom: 16px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 200px;">
                        <label style="font-weight: 600; display: block; margin-bottom: 6px; font-size: 13px; color: #334155;">Họ và tên <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="name" required placeholder="Nguyễn Văn A" style="width: 100%; height: 42px; padding: 5px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; outline: none; box-sizing: border-box;">
                    </div>
                    <div style="flex: 1; min-width: 200px;">
                        <label style="font-weight: 600; display: block; margin-bottom: 6px; font-size: 13px; color: #334155;">Số điện thoại <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="phone" required placeholder="0987xxxxxx" style="width: 100%; height: 42px; padding: 5px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; outline: none; box-sizing: border-box;">
                    </div>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="font-weight: 600; display: block; margin-bottom: 6px; font-size: 13px; color: #334155;">Địa chỉ Email (tùy chọn):</label>
                    <input type="email" name="email" placeholder="example@domain.com" style="width: 100%; height: 42px; padding: 5px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; outline: none; box-sizing: border-box;">
                </div>

                <div style="margin-bottom: 22px;">
                    <label style="font-weight: 600; display: block; margin-bottom: 6px; font-size: 13px; color: #334155;">Nội dung cần tư vấn / Đặt may theo yêu cầu: <span style="color:#ef4444;">*</span></label>
                    <textarea name="message" required rows="4" placeholder="Ví dụ: Tư vấn size cho người 1m70 65kg, hỏi tình trạng đầm maxi hoặc đặt hàng số lượng lớn..." style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; resize: vertical; outline: none; box-sizing: border-box;"></textarea>
                </div>

                <div>
                    <button type="submit" name="send_contact" style="width: 100%; height: 44px; background: #0f172a; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: background 0.2s ease;">
                        <i class='bx bx-send'></i> GỬI YÊU CẦU TƯ VẤN
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
