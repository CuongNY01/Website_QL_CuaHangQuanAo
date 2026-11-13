<link rel="stylesheet" href="../view/css/products.css">
<link rel="stylesheet" href="../view/css/contac.css">

<?php
$contact_sent = false;
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
    <img src="../view/images/banner8.jpeg" alt="Liên hệ cửa hàng" style="width: 100%; height: 260px; object-fit: cover;">
</div>

<div class="main" style="max-width: 900px; margin: 30px auto; padding: 0 20px;">
    <div style="background: #fff; padding: 35px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.06);">
        <h2 style="text-align: center; color: #2c3e50; margin-bottom: 10px;">LIÊN HỆ VỚI CHÚNG TÔI</h2>
        <p style="text-align: center; color: #7f8c8d; margin-bottom: 30px; font-size: 14px;">Mọi thắc mắc về đơn hàng, đặt áo cho đội bóng hoặc góp ý dịch vụ, vui lòng gửi tin nhắn cho chúng tôi.</p>

        <?php if ($contact_sent): ?>
            <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 20px; border-radius: 6px; text-align: center; margin-bottom: 25px;">
                <i class="fa fa-check-circle" style="font-size: 36px; margin-bottom: 10px;"></i>
                <h4 style="margin: 0 0 5px 0;">Gửi tin nhắn thành công!</h4>
                <p style="margin: 0; font-size: 14px;">Cảm ơn bạn <b><?= htmlspecialchars($name) ?></b> đã gửi thông tin. Đội ngũ tư vấn của Football Store 24/7 sẽ liên hệ với bạn trong thời gian sớm nhất qua số điện thoại <b><?= htmlspecialchars($phone) ?></b>.</p>
            </div>
        <?php endif; ?>

        <form action="../controller/contac.php" method="POST">
            <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                <div style="flex: 1;">
                    <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Họ và tên <span style="color:red;">*</span></label>
                    <input type="text" name="name" required placeholder="Nguyễn Văn A" style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
                </div>
                <div style="flex: 1;">
                    <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Số điện thoại <span style="color:red;">*</span></label>
                    <input type="text" name="phone" required placeholder="0987xxxxxx" style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Địa chỉ Email:</label>
                <input type="email" name="email" placeholder="email@domain.com" style="width: 100%; height: 40px; padding: 5px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px; font-size: 14px;">Nội dung tin nhắn / Yêu cầu đặt áo: <span style="color:red;">*</span></label>
                <textarea name="message" required rows="4" placeholder="Nhập câu hỏi hoặc nội dung bạn cần hỗ trợ..." style="width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; resize: vertical;"></textarea>
            </div>

            <div style="text-align: center;">
                <input type="submit" name="send_contact" value="Gửi Tin Nhắn Liên Hệ" style="padding: 12px 35px; background: #e74c3c; color: white; border: none; border-radius: 25px; font-size: 15px; font-weight: 600; cursor: pointer;">
            </div>
        </form>
    </div>
</div>
