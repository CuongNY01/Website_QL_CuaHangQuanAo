<link rel="stylesheet" href="../view/css/chitietsp.css">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #fff;
        margin: 0;
        padding: 10px;
    }
    .binhluan-box {
        background: #fafafa;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 25px;
    }
    .binhluan-item {
        display: flex;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .binhluan-item:last-child {
        border-bottom: none;
    }
    .binhluan-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #ddd;
    }
    .binhluan-content {
        flex: 1;
    }
    .bl-author {
        font-weight: 600;
        color: #2c3e50;
        font-size: 14px;
    }
    .bl-date {
        color: #95a5a6;
        font-size: 12px;
        margin-left: 8px;
    }
    .bl-text {
        margin-top: 6px;
        color: #555;
        font-size: 14px;
        line-height: 1.5;
    }
    .btn-submit-bl {
        padding: 8px 24px;
        background: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 10px;
    }
    .btn-submit-bl:hover {
        background: #0056b3;
    }
</style>

<?php
session_start();
include "../model/config.php";
include_once "../model/binhluan.php";

$idsp = $_GET['idsp'] ?? 1;

// Xử lý gửi bình luận
if (isset($_POST['gui'])) {
    if (isset($_SESSION['id'])) {
        $name = $_SESSION['name'] ?? 'Khách hàng';
        $iduser = $_SESSION['id'];
        $noidung = trim($_POST['noidung'] ?? '');
        $date = date("d/m/Y H:i");
        $hinh = !empty($_SESSION['avata']) ? $_SESSION['avata'] : 'iconUser.png';

        if (!empty($noidung)) {
            add_binhluan($iduser, $idsp, $noidung, $hinh, $date, $name);
            echo "<script>alert('Cảm ơn bạn đã gửi đánh giá về sản phẩm!'); window.location.href='binhluan.php?idsp=" . $idsp . "';</script>";
            exit;
        } else {
            echo "<script>alert('Vui lòng nhập nội dung đánh giá trước khi gửi!');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng đăng nhập tài khoản để bình luận!');</script>";
    }
}
?>

<div class="binhluan">
    <?php if (isset($_SESSION['id'])): 
        $user_avt = !empty($_SESSION['avata']) ? $_SESSION['avata'] : 'iconUser.png';
        $user_name = $_SESSION['name'] ?? 'Thành viên';
    ?>
        <div class="binhluan-box">
            <h4 style="margin: 0 0 15px 0; color: #2c3e50;">Viết Đánh Giá / Nhận Xét</h4>
            <form action="" method="POST">
                <div style="display: flex; gap: 15px; align-items: flex-start;">
                    <img src="../view/images/<?= htmlspecialchars($user_avt) ?>" alt="" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                    <div style="flex: 1;">
                        <span style="font-weight: 600; font-size: 14px; color: #333;"><?= htmlspecialchars($user_name) ?></span>
                        <textarea name="noidung" required placeholder="Chia sẻ cảm nhận của bạn về form dáng, chất liệu vải, độ hoàn thiện của sản phẩm..." style="width: 100%; height: 80px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 13px; margin-top: 8px; resize: vertical;"></textarea>
                        <input type="submit" value="Gửi Đánh Giá" name="gui" class="btn-submit-bl">
                    </div>
                </div>
            </form>
        </div>
    <?php else: ?>
        <div style="background: #eef2f7; padding: 15px 20px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; color: #555;">
            <i class="fa fa-info-circle" style="color: #007bff;"></i> Bạn cần 
            <a href="../controller/index.php?act=login" target="_parent" style="color: #007bff; font-weight: 600; text-decoration: underline;">Đăng nhập tài khoản</a> 
            để viết nhận xét và đánh giá về sản phẩm thời trang này.
        </div>
    <?php endif; ?>

    <!-- Danh sách bình luận đã có -->
    <h4 style="color: #2c3e50; margin: 20px 0 15px 0;">Đánh Giá Từ Khách Hàng (<?php 
        $showbinhluan = binhluan_showChiTiet($idsp);
        echo count($showbinhluan);
    ?>)</h4>

    <div class="list-binhluan">
        <?php
        if (!empty($showbinhluan)) {
            foreach ($showbinhluan as $row) {
                $avt_img = !empty($row['hinh']) ? $row['hinh'] : 'iconUser.png';
                echo '
                <div class="binhluan-item">
                    <img src="../view/images/' . htmlspecialchars($avt_img) . '" class="binhluan-avatar" alt="">
                    <div class="binhluan-content">
                        <div>
                            <span class="bl-author">' . htmlspecialchars($row['name']) . '</span>
                            <span class="bl-date"><i class="fa fa-clock-o"></i> ' . htmlspecialchars($row['postdate']) . '</span>
                        </div>
                        <div class="bl-text">' . nl2br(htmlspecialchars($row['noidung'])) . '</div>
                    </div>
                </div>
                ';
            }
        } else {
            echo '<p style="color: #888; font-style: italic; padding: 10px 0;">Chưa có nhận xét nào cho sản phẩm này. Hãy là người đầu tiên chia sẻ cảm nhận!</p>';
        }
        ?>
    </div>
</div>
