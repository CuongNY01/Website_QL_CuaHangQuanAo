<link rel="stylesheet" href="../view/css/products.css">

<style>
  .about-wrapper {
    max-width: 1100px;
    margin: 35px auto 60px auto;
    background: #fff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    border: 1px solid #e2e8f0;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }
  .about-header-tag {
    display: inline-block;
    background: #eff6ff;
    color: #3b82f6;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    padding: 4px 14px;
    border-radius: 20px;
    letter-spacing: 0.5px;
    margin-bottom: 12px;
  }
  .about-title {
    color: #0f172a;
    font-size: 28px;
    font-weight: 800;
    margin-bottom: 15px;
    line-height: 1.3;
  }
  .about-lead {
    font-size: 16px;
    line-height: 1.8;
    color: #475569;
    margin-bottom: 25px;
  }
  .about-grid-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    margin: 30px 0;
  }
  .about-feature-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 22px 20px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .about-feature-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.06);
  }
  .about-feature-icon {
    width: 46px;
    height: 46px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    margin-bottom: 14px;
  }
  .about-showcase {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin: 30px 0;
  }
  .about-showcase-item {
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    background: #fafafa;
    text-align: center;
  }
  .about-showcase-item img {
    width: 100%;
    height: 240px;
    object-fit: cover;
    display: block;
  }
  .about-showcase-caption {
    padding: 12px 15px;
    font-size: 14px;
    font-weight: 600;
    color: #1e293b;
  }
  .about-commitments {
    background: #f1f5f9;
    border-left: 4px solid #3b82f6;
    border-radius: 0 10px 10px 0;
    padding: 20px 25px;
    margin: 25px 0;
  }
  .about-commitments li {
    margin-bottom: 10px;
    line-height: 1.7;
    color: #334155;
    font-size: 15px;
  }
  .about-contact-box {
    margin-top: 35px;
    padding: 25px;
    background: #0f172a;
    color: #fff;
    border-radius: 10px;
  }
</style>

<div class="banner">
  <img src="../view/images/banner_home_fashion.jpg" alt="Về Chúng Tôi - Fashion Store 24/7" style="width: 100%; height: 280px; object-fit: cover;">
</div>

<div class="main">
  <div class="about-wrapper">
    <span class="about-header-tag"><i class='bx bx-award'></i> Giới Thiệu Thương Hiệu</span>
    <h1 class="about-title">FASHION STORE 24/7 - ĐỊNH HÌNH PHONG CÁCH THỜI TRANG HIỆN ĐẠI</h1>
    
    <p class="about-lead">
      Chào mừng bạn đến với <b>Fashion Store 24/7</b> - Hệ thống phân phối trang phục thời trang nam nữ cao cấp, đa dạng từ thời trang công sở thanh lịch, đầm váy dạo phố dự tiệc quyến rũ, phong cách Streetwear cá tính cho đến các bộ trang phục thể thao năng động.
    </p>

    <div class="about-grid-features">
      <div class="about-feature-card">
        <div class="about-feature-icon" style="background: #eff6ff; color: #3b82f6;">
          <i class='bx bx-male'></i>
        </div>
        <h4 style="margin: 0 0 6px 0; font-size: 16px; color: #0f172a;">Thời Trang Nam Lịch Lãm</h4>
        <p style="margin: 0; font-size: 13px; color: #64748b; line-height: 1.6;">Áo sơ mi Oxford, áo Polo dệt kim và quần tây âu tôn lên phong thái đĩnh đạc của phái mạnh.</p>
      </div>

      <div class="about-feature-card">
        <div class="about-feature-icon" style="background: #fdf2f8; color: #ec4899;">
          <i class='bx bx-female'></i>
        </div>
        <h4 style="margin: 0 0 6px 0; font-size: 16px; color: #0f172a;">Thời Trang Nữ & Váy Đầm</h4>
        <p style="margin: 0; font-size: 13px; color: #64748b; line-height: 1.6;">Các thiết kế đầm maxi hoa nhí, chân váy chữ A, áo blouse công sở tôn trọn nét duyên dáng.</p>
      </div>

      <div class="about-feature-card">
        <div class="about-feature-icon" style="background: #f0fdf4; color: #16a34a;">
          <i class='bx bx-closet'></i>
        </div>
        <h4 style="margin: 0 0 6px 0; font-size: 16px; color: #0f172a;">Quần Jean & Quần Tây</h4>
        <p style="margin: 0; font-size: 13px; color: #64748b; line-height: 1.6;">Đa dạng kiểu dáng từ jean ống suông cá tính, quần culottes đến quần tây dáng suông dễ phối đồ.</p>
      </div>

      <div class="about-feature-card">
        <div class="about-feature-icon" style="background: #fffbeb; color: #d97706;">
          <i class='bx bx-football'></i>
        </div>
        <h4 style="margin: 0 0 6px 0; font-size: 16px; color: #0f172a;">Áo Khoác & Đồ Thể Thao</h4>
        <p style="margin: 0; font-size: 13px; color: #64748b; line-height: 1.6;">Bomber 2 lớp, hoodie nỉ ấm áp cùng trang phục thi đấu thể thao co giãn 4 chiều siêu thoáng khí.</p>
      </div>
    </div>

    <!-- Hình ảnh tiêu biểu -->
    <h3 style="color: #0f172a; font-size: 20px; font-weight: 700; margin-top: 30px;"><i class='bx bx-camera'></i> Bộ Sưu Tập Thời Trang Tiêu Biểu</h3>
    <div class="about-showcase">
      <div class="about-showcase-item">
        <img src="../view/images/ao_so_mi_nam.jpg" alt="Áo sơ mi nam">
        <div class="about-showcase-caption">Áo Sơ Mi Nam Oxford Slim-fit</div>
      </div>
      <div class="about-showcase-item">
        <img src="../view/images/dam_maxi_hoa.jpg" alt="Đầm maxi nữ">
        <div class="about-showcase-caption">Đầm Maxi Hoa Nhí Dáng Dài</div>
      </div>
      <div class="about-showcase-item">
        <img src="../view/images/ao_khoac_bomber.jpg" alt="Áo khoác bomber">
        <div class="about-showcase-caption">Áo Khoác Bomber Kaki 2 Lớp</div>
      </div>
    </div>

    <h3 style="color: #0f172a; font-size: 20px; font-weight: 700; margin-top: 30px;"><i class='bx bx-check-shield' style="color: #10b981;"></i> Cam Kết Của Fashion Store 24/7</h3>
    <div class="about-commitments">
      <ul style="margin-left: 20px; padding: 0;">
        <li><b>Chất liệu cao cấp:</b> 100% tuyển chọn từ vải Cotton thoáng khí, Linen mát mẻ, Kaki bền màu và sợi mè thể thao chống nhăn co giãn 4 chiều.</li>
        <li><b>Đa dạng kích cỡ (Size S - XXL):</b> Bảng size tiêu chuẩn phù hợp người Việt, tôn dáng và mang lại cảm giác thoải mái nhất khi vận động.</li>
        <li><b>Chính sách đổi trả minh bạch:</b> Hỗ trợ kiểm tra hàng trước khi thanh toán (COD), đổi size hoàn toàn miễn phí trong vòng 7 ngày.</li>
        <li><b>Giao hàng siêu tốc:</b> Đóng gói cẩn thận, giao hàng tận tay khách hàng trên 63 tỉnh thành toàn quốc.</li>
      </ul>
    </div>

    <div class="about-contact-box">
      <h4 style="margin: 0 0 12px 0; color: #fbbf24; font-size: 16px;"><i class='bx bx-map-pin'></i> THÔNG TIN LIÊN HỆ & SHOWROOM TRƯNG BÀY</h4>
      <p style="margin: 6px 0; color: #e2e8f0; font-size: 14px;"><i class="fa fa-map-marker"></i> <b>Địa chỉ:</b> Đường Trịnh Văn Bô, Nam Từ Liêm, TP. Hà Nội</p>
      <p style="margin: 6px 0; color: #e2e8f0; font-size: 14px;"><i class="fa fa-phone"></i> <b>Hotline hỗ trợ:</b> 024.2236.5888 - 0348.008.939 | <b>Tổng đài:</b> 1900 6868</p>
      <p style="margin: 6px 0; color: #e2e8f0; font-size: 14px;"><i class="fa fa-envelope"></i> <b>Email:</b> cskh@fashionstore247.vn</p>
      <p style="margin: 6px 0; color: #e2e8f0; font-size: 14px;"><i class="fa fa-clock-o"></i> <b>Giờ phục vụ:</b> 8:30 - 21:30 (Mở cửa tất cả các ngày trong tuần)</p>
    </div>

    <div style="margin-top: 35px; text-align: center; display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
      <a href="../controller/index.php" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; background: #0f172a; color: #fff; text-decoration: none; border-radius: 25px; font-weight: 700; font-size: 14px;">
        <i class='bx bx-shopping-bag'></i> Khám Phá Sản Phẩm Ngay
      </a>
      <a href="../controller/index.php?act=baiviet" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; text-decoration: none; border-radius: 25px; font-weight: 700; font-size: 14px;">
        <i class='bx bx-news'></i> Xem Cẩm Nang Phối Đồ
      </a>
    </div>
  </div>
</div>
