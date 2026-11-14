<link rel="stylesheet" href="../view/css/products.css">

<?php
$id = $_GET['id'] ?? 1;
$dsdanhmmuc = danhmuc_showId($id);
$tendanhmuc = $dsdanhmmuc['tendanhmuc'] ?? 'Thời Trang Tổng Hợp';

// Gán banner chính xác và phong cách cho từng danh mục thời trang
$banner_img = "banner_home_fashion.jpg";
switch ((int)$id) {
    case 1:
        $banner_img = "banner_cat1_aonam.jpg";
        $cat_subtitle = "Bộ sưu tập sơ mi Oxford, áo polo cao cấp, áo thun oversize chất vải thoáng mát";
        break;
    case 2:
        $banner_img = "banner_cat2_thoitrangnu.jpg";
        $cat_subtitle = "Tỏa sáng duyên dáng với đầm maxi hoa nhí, váy xoè công sở và áo kiểu thời thượng";
        break;
    case 3:
        $banner_img = "banner_cat3_quanjean.jpg";
        $cat_subtitle = "Đa dạng phong cách từ quần jean ống suông cá tính đến quần tây âu slimfit lịch lãm";
        break;
    case 4:
        $banner_img = "banner_cat4_aokhoac.jpg";
        $cat_subtitle = "Bộ sưu tập áo khoác bomber thể thao, hoodie nỉ bông và cardigan len ấm áp";
        break;
    case 5:
        $banner_img = "banner_cat5_thethao.jpg";
        $cat_subtitle = "Đầy đủ các mẫu áo đấu bóng đá CLB hàng đầu châu Âu và trang phục tập gym, chạy bộ";
        break;
    default:
        $banner_img = "banner_home_fashion.jpg";
        $cat_subtitle = "Khám phá phong cách thời trang hiện đại cùng Fashion Store 24/7";
        break;
}

$all_categories = danhmuc_showAll();
$products_in_cat = sanpham_showId($id);
?>

<style>
    .cat-page-container {
        max-width: 1380px;
        margin: 0 auto;
        padding: 0 20px 60px 20px;
    }
    
    .cat-hero-banner {
        width: 100%;
        max-height: 380px;
        overflow: hidden;
        border-radius: 14px;
        margin-top: 15px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }
    
    .cat-hero-banner img {
        width: 100%;
        height: 100%;
        max-height: 380px;
        object-fit: cover;
        display: block;
    }

    .cat-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 20px 0 10px 0;
        font-size: 14px;
        color: #64748b;
    }
    .cat-breadcrumb a {
        color: #64748b;
        text-decoration: none;
    }
    .cat-breadcrumb a:hover {
        color: #3b82f6;
    }
    .cat-breadcrumb .current {
        color: #0f172a;
        font-weight: 700;
    }

    /* Category switch tabs */
    .cat-switch-bar {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin: 20px 0 30px 0;
        padding-bottom: 18px;
        border-bottom: 1px solid #e2e8f0;
    }
    .cat-tab-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        border-radius: 20px;
        background: #fff;
        border: 1px solid #e2e8f0;
        color: #334155;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .cat-tab-pill:hover {
        border-color: #3b82f6;
        color: #3b82f6;
        background: #eff6ff;
    }
    .cat-tab-pill.active {
        background: #0f172a;
        color: #fff;
        border-color: #0f172a;
        box-shadow: 0 4px 10px rgba(15, 23, 42, 0.2);
    }

    /* Product Grid */
    .fashion-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
        gap: 25px;
    }

    .fashion-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        position: relative;
    }
    .fashion-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        border-color: #cbd5e1;
    }

    .fashion-card-thumb {
        width: 100%;
        height: 270px;
        position: relative;
        overflow: hidden;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .fashion-card-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .fashion-card:hover .fashion-card-thumb img {
        transform: scale(1.06);
    }

    .fashion-badge-tag {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(15, 23, 42, 0.85);
        backdrop-filter: blur(4px);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        z-index: 2;
    }

    .fashion-card-body {
        padding: 16px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .fashion-card-cat {
        font-size: 11px;
        text-transform: uppercase;
        color: #3b82f6;
        font-weight: 700;
        letter-spacing: 0.6px;
        margin-bottom: 6px;
    }
    .fashion-card-title {
        font-size: 15px;
        font-weight: 600;
        color: #0f172a;
        margin: 0 0 8px 0;
        line-height: 1.4;
        min-height: 42px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .fashion-card-title a {
        color: inherit;
        text-decoration: none;
    }
    .fashion-card-title a:hover {
        color: #3b82f6;
    }

    .fashion-rating {
        color: #f59e0b;
        font-size: 12px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .fashion-rating span {
        color: #94a3b8;
        font-size: 11px;
    }

    .fashion-card-price {
        font-size: 18px;
        font-weight: 800;
        color: #ef4444;
        margin-bottom: 14px;
        margin-top: auto;
    }

    .fashion-card-actions {
        display: flex;
        gap: 8px;
    }
    .btn-detail {
        flex: 1;
        padding: 9px 0;
        text-align: center;
        border-radius: 6px;
        background: #f1f5f9;
        color: #334155;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid #cbd5e1;
        transition: all 0.2s ease;
    }
    .btn-detail:hover {
        background: #e2e8f0;
        color: #0f172a;
    }
    .btn-addcart {
        flex: 1.2;
        padding: 9px 0;
        border-radius: 6px;
        background: #0f172a;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }
    .btn-addcart:hover {
        background: #3b82f6;
    }
</style>

<div class="cat-page-container">
    <!-- HERO BANNER TÙY BIẾN CHO TỪNG DANH MỤC -->
    <div class="cat-hero-banner">
        <img src="../view/images/<?= $banner_img ?>" alt="<?= htmlspecialchars($tendanhmuc) ?>">
    </div>

    <!-- BREADCRUMB -->
    <div class="cat-breadcrumb">
        <a href="../controller/index.php"><i class='bx bx-home-alt'></i> Trang Chủ</a>
        <i class='bx bx-chevron-right'></i>
        <span>Danh Mục Thời Trang</span>
        <i class='bx bx-chevron-right'></i>
        <span class="current"><?= htmlspecialchars($tendanhmuc) ?></span>
    </div>

    <!-- THANH CHUYỂN DANH MỤC NHANH (TASKBAR CON) -->
    <div class="cat-switch-bar">
        <span style="font-size: 13px; font-weight: 700; color: #475569; margin-right: 5px;">Chọn nhóm hàng:</span>
        <?php foreach ($all_categories as $cat_item): 
            $cat_id = $cat_item['iddanhmuc'];
            $is_active = ($cat_id == $id) ? 'active' : '';
        ?>
            <a href="../controller/index.php?act=sanpham&id=<?= $cat_id ?>" class="cat-tab-pill <?= $is_active ?>">
                <?= htmlspecialchars($cat_item['tendanhmuc']) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- TIÊU ĐỀ KHỐI VÀ SỐ LƯỢNG SẢN PHẨM -->
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
        <div>
            <h2 style="font-size: 22px; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 8px;">
                <i class='bx bx-closet' style="color: #3b82f6;"></i> <?= htmlspecialchars($tendanhmuc) ?>
            </h2>
            <p style="font-size: 13px; color: #64748b; margin-top: 4px;"><?= htmlspecialchars($cat_subtitle) ?></p>
        </div>
        <div>
            <span style="font-size: 13px; color: #64748b; background: #fff; padding: 6px 14px; border-radius: 20px; border: 1px solid #e2e8f0; font-weight: 600;">
                Hiển thị: <b><?= count($products_in_cat) ?></b> sản phẩm
            </span>
        </div>
    </div>

    <!-- DANH SÁCH SẢN PHẨM ĐƯỢC SẮP XẾP GỌN GÀNG THEO GRID -->
    <?php if (!empty($products_in_cat)): ?>
        <div class="fashion-grid">
            <?php foreach ($products_in_cat as $row): 
                $gia_vnd = number_format($row['gia'], 0, ',', '.') . ' VNĐ';
                $detail_url = "../controller/index.php?act=chitiet&idsp=" . $row['id'];
            ?>
                <div class="fashion-card">
                    <span class="fashion-badge-tag">Chính Hãng</span>
                    <a href="<?= $detail_url ?>" class="fashion-card-thumb">
                        <img src="../view/images/<?= htmlspecialchars($row['hinh']) ?>" alt="<?= htmlspecialchars($row['tensp']) ?>">
                    </a>
                    
                    <div class="fashion-card-body">
                        <span class="fashion-card-cat"><?= htmlspecialchars($tendanhmuc) ?></span>
                        <h3 class="fashion-card-title">
                            <a href="<?= $detail_url ?>" title="<?= htmlspecialchars($row['tensp']) ?>">
                                <?= htmlspecialchars($row['tensp']) ?>
                            </a>
                        </h3>

                        <div class="fashion-rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <span>(5.0)</span>
                        </div>

                        <div class="fashion-card-price">
                            <?= $gia_vnd ?>
                        </div>

                        <form method="POST" action="../controller/index.php?act=cart" class="fashion-card-actions">
                            <input type="hidden" name="hinh" value="<?= htmlspecialchars($row['hinh']) ?>"/>
                            <input type="hidden" name="gia" value="<?= $row['gia'] ?>"/>
                            <input type="hidden" name="tensp" value="<?= htmlspecialchars($row['tensp']) ?>"/>
                            <input type="hidden" name="soluong" value="1">
                            <input type="hidden" name="size" value="M">

                            <a href="<?= $detail_url ?>" class="btn-detail">Chi tiết</a>
                            <button type="submit" name="addcart" class="btn-addcart">
                                <i class='bx bx-cart-add'></i> Giỏ Hàng
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div style="text-align: center; padding: 70px 20px; background: #fff; border-radius: 12px; border: 1px solid #e2e8f0;">
            <i class='bx bx-shopping-bag' style="font-size: 50px; color: #cbd5e1; display: block; margin-bottom: 12px;"></i>
            <h3 style="font-size: 18px; color: #334155; margin-bottom: 6px;">Chưa có sản phẩm nào trong danh mục này</h3>
            <p style="font-size: 14px; color: #94a3b8; margin-bottom: 20px;">Vui lòng quay lại hoặc khám phá các nhóm hàng thời trang khác</p>
            <a href="../controller/index.php" style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 22px; background: #0f172a; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600;">
                <i class='bx bx-left-arrow-alt'></i> Quay lại Trang Chủ
            </a>
        </div>
    <?php endif; ?>
</div>
