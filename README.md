# 👗 Website Quản Lý Bán Quần Áo - Fashion Store 24/7

> **Học phần:** Chuyên đề tốt nghiệp 1 - Trường Đại học Công nghệ Đông Á (EAUT)  
> **Sinh viên thực hiện:** Dương Bá Công (MSV: `20220385` - Lớp `DCCNTT13.10.2`)  
> **Giảng viên hướng dẫn:** ThS. Hà Trọng Thắng  
> **Đề tài:** Website thương mại điện tử kinh doanh thời trang đa dạng (Thời trang Nam, Thời trang Nữ & Váy đầm, Quần Jean & Quần Tây, Áo Khoác & Hoodie, Quần Áo Thể Thao), ứng dụng kiến trúc **MVC thuần (PHP & MySQL PDO)**.

---

## 📌 Mục lục
- [Giới thiệu](#-giới-thiệu)
- [Công nghệ sử dụng](#-công-nghệ-sử-dụng)
- [Kiến trúc dự án (MVC)](#-kiến-trúc-dự-án-mvc)
- [Tính năng chính](#-tính-năng-chính)
- [Cơ sở dữ liệu (7 bảng)](#-cơ-sở-dữ-liệu-7-bảng)
- [Hướng dẫn cài đặt & Khởi chạy](#-hướng-dẫn-cài-đặt--khởi-chạy)
- [Tài khoản demo kiểm thử](#-tài-khoản-demo-kiểm-thử)
- [Cấu trúc thư mục](#-cấu-trúc-thư-mục)

---

## 📖 Giới thiệu
Hệ thống **Fashion Store 24/7** cung cấp nền tảng mua sắm thời trang trực tuyến đa dạng cho cả nam và nữ với giao diện hiện đại, thanh điều hướng gọn gàng, hỗ trợ đa thiết bị (Responsive Mobile & Desktop). Song song đó là phân hệ **Quản trị viên (Admin Panel)** đầy đủ nghiệp vụ giúp quản lý danh mục, kho sản phẩm, tài khoản khách hàng, kiểm duyệt bình luận, xử lý đơn hàng và thống kê doanh thu trực quan.

---

## 💻 Công nghệ sử dụng
- **Backend:** PHP 7.4+ / PHP 8.x (Kiến trúc MVC kết hợp thư viện **PDO Prepared Statements** chống SQL Injection)
- **Database:** MySQL / MariaDB (Bảng mã `utf8_unicode_ci` / `utf8mb4`)
- **Frontend:** HTML5, CSS3 (Flexbox, CSS Grid), JavaScript (ES6, jQuery)
- **Thư viện & Tiện ích:**
  - Font Awesome 6.1.1 & Boxicons
  - Slick Carousel (Slider sản phẩm nổi bật)
  - **VietQR QuickLink API** (Sinh mã QR chuyển khoản tự động điền số tiền & nội dung)
- **Công cụ thiết kế & phát triển:** XAMPP, phpMyAdmin, VS Code, Draw.io

---

## 🏗️ Kiến trúc dự án (MVC)
Dự án được tổ chức theo mô hình **Model - View - Controller (MVC)** phân tách rõ ràng 3 tầng:
- **`model/`:** Kết nối CSDL qua PDO (`config.php`) và xử lý nghiệp vụ truy vấn dữ liệu cho từng bảng (`danhmuc.php`, `sanpham.php`, `donhang.php`, `user.php`, `admin.php`, `binhluan.php`).
- **`view/` & `viewAdmin/`:** Tách biệt hoàn toàn giao diện Khách hàng và Quản trị viên, tái sử dụng `header.php` / `footer.php`.
- **`controller/`:** Đóng vai trò Front Controller (`index.php`, `indexAdmin.php`) tiếp nhận tham số `?act=` để điều phối xử lý và nạp view tương ứng.

---

## ✨ Tính năng chính

### 1. Phân hệ Khách hàng (Client Portal)
- 🏠 **Trang chủ hiện đại:** Taskbar tinh gọn tích hợp dropdown *Danh mục sản phẩm*, thanh thông báo ưu đãi, banner thời trang và slider sản phẩm theo nhóm.
- 📂 **5 Danh mục thời trang đa dạng (85+ sản phẩm):**
  1. *Áo Nam & Sơ Mi* (Sơ mi Oxford, Polo, Áo thun, Áo len...)
  2. *Thời Trang Nữ & Váy* (Đầm Maxi, Váy công sở, Đầm dự tiệc, Chân váy, Áo Blouse...)
  3. *Quần Jean & Quần Tây* (Jean ống suông, Baggy, Quần tây âu, Culottes, Short Kaki, Jogger...)
  4. *Áo Khoác & Hoodie* (Bomber, Khoác Jean, Blazer, Áo dạ Tweed, Hoodie nỉ, Cardigan...)
  5. *Quần Áo Thể Thao* (Trang phục thi đấu CLB quốc tế, V-League, đồ tập Gym)
- 🔍 **Chi tiết sản phẩm & Chọn Size:** Chọn kích cỡ (`S`, `M`, `L`, `XL`, `XXL`), số lượng mua, xem cam kết đổi trả và đánh giá từ người mua.
- 💬 **Bình luận & Đánh giá:** Thành viên đăng nhập có thể gửi nhận xét thực tế về chất liệu, form dáng sản phẩm.
- 🔎 **Tìm kiếm thông minh:** Tìm nhanh sản phẩm theo từ khóa tên trang phục trên thanh header.
- 🛒 **Giỏ hàng & Thanh toán đa kênh:**
  - Phân tách sản phẩm trong giỏ theo **tên sản phẩm + kích cỡ (Size)**, cập nhật số lượng, xóa từng món hoặc xóa toàn bộ.
  - Hỗ trợ mã giảm giá (`GIAM10` giảm 10%, `FREESHIP` miễn phí vận chuyển, tự động miễn phí ship từ 500.000đ).
  - Hỗ trợ **COD**, **Ví điện tử (MoMo, ZaloPay)** và **Chuyển khoản Ngân hàng VietQR 24/7** (tự động tạo mã QR theo số tiền & mã đơn hàng, sao chép nhanh STK/nội dung và nút *"Tôi đã chuyển khoản xong"*).
- 📦 **Tra cứu & Lịch sử đơn hàng:** Tra cứu tiến độ xử lý đơn bằng **Mã đơn hàng (`DH...`)** hoặc **Số điện thoại**; thành viên đã đăng nhập xem được toàn bộ lịch sử đơn hàng cá nhân.
- 👤 **Tài khoản khách hàng:** Đăng ký (hỗ trợ upload ảnh đại diện), đăng nhập, xem và cập nhật hồ sơ cá nhân.
- 📰 **Trang nội dung:** Tin tức xu hướng & Bảng quy chuẩn chọn Size (`baiviet.php`), Giới thiệu thương hiệu (`about.php`), Liên hệ & Tư vấn (`contac.php`).

### 2. Phân hệ Quản trị (Admin Dashboard)
- 🔐 **Bảo mật truy cập:** Session Guard (`$_SESSION['idAdmin']`) bảo vệ toàn bộ trang quản trị.
- 📊 **Dashboard Thống kê:** Hiển thị 6 chỉ số KPI trực quan (*Tổng sản phẩm, Danh mục, Tổng đơn hàng, Doanh thu cửa hàng, Khách hàng, Bình luận*) cùng bảng *Đơn hàng mới nhất*.
- 🧾 **Quản lý Đơn hàng & Hóa đơn:**
  - Badge đếm số đơn chờ duyệt ngay trên thanh điều hướng.
  - Lọc đơn hàng theo trạng thái (`Chờ xác nhận`, `Chờ xác nhận (Đã CK)`, `Đang chuẩn bị hàng`, `Đang giao hàng`, `Giao thành công`, `Đã hủy`).
  - Xem chi tiết hóa đơn (người nhận, sản phẩm, Size, đơn giá, ghi chú), cập nhật trạng thái giao hàng nhanh và **In hóa đơn**.
- 📁 **Quản lý Danh mục (CRUD):** Thêm, sửa, xóa danh mục (tự động chặn xóa nếu danh mục đang có sản phẩm liên kết).
- 👕 **Quản lý Sản phẩm (CRUD):** Thêm/sửa/xóa sản phẩm kèm upload hình ảnh và tìm kiếm sản phẩm trong kho.
- 👥 **Quản lý Khách hàng & Kiểm duyệt Bình luận:** Quản lý tài khoản thành viên và xóa các bình luận không phù hợp.

---

## 🗄️ Cơ sở dữ liệu (7 bảng)
Tệp `duan1.sql` bao gồm đầy đủ cấu trúc và dữ liệu mẫu của 7 bảng:
1. `danhmuc` – Nhóm danh mục thời trang
2. `sanpham` – Danh sách sản phẩm thời trang
3. `user` – Tài khoản khách hàng
4. `admin` – Tài khoản quản trị viên
5. `binhluan` – Đánh giá & nhận xét sản phẩm
6. `donhang` – Thông tin đơn đặt hàng, người nhận, tổng tiền, trạng thái xử lý
7. `donhang_chitiet` – Chi tiết từng sản phẩm, kích cỡ (Size), số lượng và thành tiền theo đơn

---

## 🚀 Hướng dẫn cài đặt & Khởi chạy

### Yêu cầu tiên quyết
- Cài đặt **XAMPP** (Apache, MySQL/MariaDB và PHP >= 7.4).

### Các bước cài đặt
1. **Clone mã nguồn:**
   ```bash
   git clone https://github.com/CuongNY01/Website_QL_CuaHangQuanAo.git
   ```
   *(Hoặc giải nén vào thư mục dự án, ví dụ `C:/xampp/htdocs/Website_quanlybanQA`)*

2. **Khởi động dịch vụ:**
   - Mở **XAMPP Control Panel** và bấm **Start** cho cả **Apache** và **MySQL**.

3. **Import Cơ sở dữ liệu:**
   - Truy cập `http://localhost/phpmyadmin/`.
   - Tạo cơ sở dữ liệu mới tên `duanmau` (bảng mã `utf8_unicode_ci` hoặc `utf8mb4_general_ci`).
   - Chọn tab **Import** &rarr; Chọn file `duan1.sql` ở thư mục gốc dự án &rarr; Nhấn **Import**.

4. **Kiểm tra kết nối (`model/config.php`):**
   ```php
   $servername = "127.0.0.1";
   $username   = "root";
   $password   = ""; // Mặc định XAMPP để trống
   // Hỗ trợ tự động kết nối CSDL `duanmau` hoặc `duan1`
   ```

5. **Khởi chạy & Truy cập:**
   - Nếu chạy bằng PHP Built-in Server: `php -S localhost:8000`
   - 🌐 **Trang bán hàng (Client):** `http://localhost:8000/controller/index.php` *(hoặc `http://localhost/Website_quanlybanQA/`)*
   - ⚙️ **Trang quản trị (Admin):** `http://localhost:8000/controller/indexAdmin.php`

---

## 🔑 Tài khoản demo kiểm thử

| Phân hệ | Tên đăng nhập | Mật khẩu | Ghi chú |
| :--- | :--- | :--- | :--- |
| **Quản trị viên (Admin)** | `admin` | `123456` | Toàn quyền quản trị hệ thống |
| **Quản trị viên phụ** | `admin1` | `123123` | Quản trị hệ thống |
| **Khách hàng mẫu 1** | `tung112003` | `123` | Tài khoản khách hàng |
| **Khách hàng mẫu 2** | `huyen` | `123` | Tài khoản khách hàng |

---

## 📂 Cấu trúc thư mục

```text
Website_quanlybanQA/
│
├── controller/                  # Tầng điều phối (Front Controllers)
│   ├── index.php                # Điều phối luồng khách hàng (?act=...)
│   ├── indexAdmin.php           # Điều phối luồng quản trị viên (kèm Session Guard)
│   ├── about.php                # Trang giới thiệu thương hiệu
│   ├── contac.php               # Trang liên hệ tư vấn
│   ├── thanhtoan.php            # Trang thanh toán độc lập
│   └── binhluan.php             # Xử lý gửi & hiển thị bình luận sản phẩm
│
├── model/                       # Tầng xử lý dữ liệu (PDO)
│   ├── config.php               # Kết nối MySQL PDO & hàm query dùng chung
│   ├── danhmuc.php              # CRUD danh mục & đếm sản phẩm
│   ├── sanpham.php              # CRUD sản phẩm, lọc danh mục, tìm kiếm
│   ├── donhang.php              # Đặt hàng, chi tiết đơn, cập nhật trạng thái & doanh thu
│   ├── user.php                 # Quản lý tài khoản khách hàng
│   ├── admin.php                # Xác thực & cập nhật tài khoản Admin
│   ├── binhluan.php             # Quản lý bình luận
│   ├── login_submit.php         # Hỗ trợ truy vấn đăng nhập
│   ├── register_submit.php      # Hỗ trợ truy vấn đăng ký
│   └── seach.php                # Hiển thị kết quả tìm kiếm sản phẩm
│
├── view/                        # Giao diện Khách hàng (Client UI)
│   ├── header.php / footer.php  # Khung giao diện chung & thanh taskbar gọn gàng
│   ├── home.php                 # Trang chủ & Slider sản phẩm
│   ├── sanpham.php              # Trang danh mục sản phẩm (Banner riêng theo nhóm)
│   ├── chitietsp.php            # Chi tiết sản phẩm & chọn Size (S–XXL)
│   ├── cart.php                 # Giỏ hàng theo Size
│   ├── thanhtoan.php            # Đặt hàng, Voucher & Thanh toán VietQR 24/7
│   ├── lichsudonhang.php        # Tra cứu đơn hàng (Mã đơn/SĐT) & Lịch sử đơn
│   ├── baiviet.php              # Tin tức thời trang & Bảng quy chuẩn Size
│   ├── about.php / contac.php   # Giới thiệu & Liên hệ
│   ├── login.php / register.php / suauser.php
│   ├── dangnhapadmin.php        # Giao diện đăng nhập Admin
│   ├── css/                     # Tệp định kiểu giao diện
│   ├── js/                      # Tập lệnh kiểm tra dữ liệu JS
│   └── images/                  # Hình ảnh sản phẩm, logo & banner
│
├── viewAdmin/                   # Giao diện Quản trị viên (Admin UI)
│   ├── header.php / footer.php  # Thanh điều hướng Admin & Badge đơn mới
│   ├── userAd.php               # Dashboard thống kê 6 KPI & Đổi mật khẩu Admin
│   ├── donhang.php              # Danh sách đơn hàng & Lọc trạng thái
│   ├── chitietdonhang.php       # Chi tiết hóa đơn & In đơn hàng
│   ├── danhmuc.php / themdanhmuc.php / suadanhmuc.php
│   ├── sanpham.php / themsp.php / suasp.php / layout_tim.php / seach.php
│   ├── admin.php / themuser.php / suauserAd.php
│   └── binhluan.php             # Kiểm duyệt bình luận
│
├── duan1.sql                    # Tệp sao lưu CSDL MySQL (7 bảng & 85+ sản phẩm)
├── erd.drawio                   # Sơ đồ thực thể quan hệ (ERD)
├── index.php                    # Điểm truy cập gốc (chuyển hướng sang controller/index.php)
├── .gitignore                   # Danh sách tệp loại trừ khỏi Git
└── README.md                    # Tài liệu hướng dẫn dự án
```
