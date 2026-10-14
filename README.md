# ⚽ Website Bán Đồ Thể Thao & Áo Đấu Bóng Đá (Football Store 24/7)

> **Dự án Bài tập lớn / Dự án 1** - Xây dựng website thương mại điện tử chuyên kinh doanh áo thi đấu câu lạc bộ bóng đá (La Liga, Premier League, V-League) và phụ kiện thể thao, ứng dụng kiến trúc **MVC thuần (PHP & MySQL)**.

---

## 📌 Mục lục
- [Giới thiệu](#-giới-thiệu)
- [Công nghệ sử dụng](#-công-nghệ-sử-dụng)
- [Kiến trúc dự án (MVC)](#-kiến-trúc-dự-án-mvc)
- [Tính năng chính](#-tính-năng-chính)
- [Hướng dẫn cài đặt & Khởi chạy](#-hướng-dẫn-cài-đặt--khởi-chạy)
- [Tài khoản demo kiểm thử](#-tài-khoản-demo-kiểm-thử)
- [Cấu trúc thư mục](#-cấu-trúc-thư-mục)
- [Lịch sử lộ trình phát triển (Git Workflow)](#-lịch-sử-lộ-trình-phát-triển-git-workflow)

---

## 📖 Giới thiệu
Hệ thống **Football Store 24/7** cung cấp nền tảng mua sắm trực tuyến cho người hâm mộ thể thao với giao diện hiện đại, thân thiện trên đa thiết bị (Responsive Mobile & Desktop), kết hợp hệ thống quản trị nội dung (CMS/Admin Panel) mạnh mẽ giúp quản lý sản phẩm, danh mục, đơn hàng và tương tác của khách hàng.

---

## 💻 Công nghệ sử dụng
- **Backend:** PHP 7.4+ / PHP 8.x (Hướng thủ tục kết hợp hướng đối tượng qua thư viện `PDO`)
- **Database:** MySQL / MariaDB (Chuẩn mã hóa `utf8_unicode_ci` / `utf8mb4`)
- **Frontend:** HTML5, CSS3 (Vanilla CSS, Flexbox, Grid), JavaScript (ES6, jQuery)
- **Thư viện giao diện & Icons:** 
  - Font Awesome 6.1.1 & Boxicons
  - Slick Carousel (Slider sản phẩm nổi bật & ưu đãi)
- **Công cụ hỗ trợ:** XAMPP, phpMyAdmin, Draw.io (sơ đồ ERD)

---

## 🏗️ Kiến trúc dự án (MVC)
Dự án được tổ chức theo mô hình **Model - View - Controller (MVC)** phân tách rõ ràng:
- **`model/`:** Chịu trách nhiệm tương tác cơ sở dữ liệu qua các hàm PDO dùng chung (`config.php`, `sanpham.php`, `danhmuc.php`, `user.php`,...).
- **`view/` & `viewAdmin/`:** Chứa giao diện hiển thị cho khách hàng và ban quản trị, tách biệt Header/Footer dùng chung.
- **`controller/`:** Đóng vai trò Front Controller tiếp nhận request (`index.php`, `indexAdmin.php`), điều hướng xử lý và nạp view tương ứng.

---

## ✨ Tính năng chính

### 1. Phân hệ Khách hàng (Client Portal)
- 🏠 **Trang chủ:** Banner chuyển động, hiển thị danh sách sản phẩm nổi bật & ưu đãi theo giải đấu.
- 📂 **Danh mục giải đấu:** Lọc áo đấu theo La Liga, Ngoại hạng Anh, V-League.
- 🔍 **Chi tiết sản phẩm:** Xem hình ảnh, giá bán, tình trạng kho, số lượng mua và địa chỉ cửa hàng.
- 💬 **Bình luận & Đánh giá:** Gửi bình luận và xem các nhận xét của khách hàng khác về sản phẩm.
- 🔎 **Tìm kiếm sản phẩm:** Tìm kiếm nhanh theo tên sản phẩm với gợi ý từ khóa.
- 🛒 **Giỏ hàng & Thanh toán:**
  - Thêm sản phẩm vào giỏ, điều chỉnh số lượng, xóa từng món hoặc toàn bộ giỏ hàng (sử dụng PHP Session an toàn).
  - Giao diện giỏ hàng tối ưu riêng cho cả máy tính và điện thoại di động.
  - Hỗ trợ nhập mã giảm giá (voucher) và chọn các phương thức thanh toán phổ biến (COD, MoMo, ZaloPay, Viettel Money).
- 👤 **Tài khoản người dùng:** Đăng ký tài khoản mới kèm tải ảnh đại diện, đăng nhập bảo mật và cập nhật thông tin cá nhân.
- ℹ️ **Trang tĩnh:** Giới thiệu thương hiệu (`about.php`), Liên hệ & Bản đồ cửa hàng (`contac.php`).

### 2. Phân hệ Quản trị (Admin Dashboard)
- 🔐 **Bảo mật truy cập:** Hệ thống Session Guard bảo vệ khu vực quản trị, yêu cầu đăng nhập tài khoản quyền Admin.
- 🔑 **Tài khoản quản trị:** Bảng điều khiển cá nhân, hỗ trợ đổi tên đăng nhập và mật khẩu quản trị.
- 📁 **Quản lý Danh mục (CRUD):** Thêm mới danh mục giải đấu, chỉnh sửa tên và xóa danh mục.
- 👕 **Quản lý Sản phẩm (CRUD):** 
  - Thêm mới sản phẩm có tính năng tải lên hình ảnh đại diện vào hệ thống.
  - Chỉnh sửa thông tin, giá bán, phân loại và cập nhật lại hình ảnh.
  - Tìm kiếm sản phẩm trong kho và xóa sản phẩm không còn kinh doanh.
- 👥 **Quản lý Người dùng:** Xem danh sách khách hàng đã đăng ký, thêm mới tài khoản hoặc xóa tài khoản vi phạm.
- 💬 **Kiểm duyệt Bình luận:** Theo dõi và xóa các đánh giá không phù hợp trên từng sản phẩm.

---

## 🚀 Hướng dẫn cài đặt & Khởi chạy

### Yêu cầu tiên quyết
- Cài đặt gói **XAMPP** (đã bao gồm Apache, MySQL/MariaDB và PHP >= 7.4).

### Các bước cài đặt
1. **Tải mã nguồn:**
   ```bash
   git clone https://github.com/<your-username>/<repo-name>.git
   ```
   *(Sao chép thư mục dự án vào thư mục `htdocs` của XAMPP, ví dụ: `C:/xampp/htdocs/BTL_HungPham`)*

2. **Khởi động dịch vụ:**
   - Mở ứng dụng **XAMPP Control Panel**.
   - Bấm **Start** ở cả 2 module: **Apache** và **MySQL**.

3. **Cài đặt Cơ sở dữ liệu:**
   - Truy cập vào trang quản lý CSDL: `http://localhost/phpmyadmin/`.
   - Tạo một cơ sở dữ liệu mới với tên: `duanmau` (Bảng mã: `utf8_unicode_ci` hoặc `utf8mb4_general_ci`).
   - Nhấn vào tab **Import** (Nhập) &rarr; Chọn file `duan1.sql` trong thư mục gốc dự án &rarr; Nhấn **Import** (Thực hiện).

4. **Kiểm tra cấu hình kết nối:**
   - Mở file `model/config.php` và kiểm tra thông tin kết nối CSDL:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = ""; // Mặc định trên XAMPP để trống
     // CSDL: duanmau
     ```

5. **Truy cập ứng dụng:**
   - 🌐 **Giao diện người dùng:** `http://localhost/BTL_HungPham/` (hoặc `http://localhost:8000/`)
   - ⚙️ **Giao diện quản trị Admin:** `http://localhost/BTL_HungPham/controller/indexAdmin.php`

---

## 🔑 Tài khoản demo kiểm thử

| Phân hệ | Tên đăng nhập | Mật khẩu | Quyền hạn |
| :--- | :--- | :--- | :--- |
| **Quản trị viên (Admin)** | `admin` | `12345` | Toàn quyền quản trị hệ thống |
| **Quản trị viên phụ** | `admin1` | `123` | Quản trị hệ thống |
| **Khách hàng mẫu 1** | `tung112003` | `123` | Tài khoản khách hàng mẫu |
| **Khách hàng mẫu 2** | `huyen` | `123` | Tài khoản khách hàng mẫu |

---

## 📂 Cấu trúc thư mục

```text
BTL_HungPham/
│
├── controller/            # Bộ điều hướng trung tâm
│   ├── index.php          # Điều hướng giao diện khách hàng
│   ├── indexAdmin.php     # Điều hướng giao diện quản trị viên
│   ├── about.php          # Điều hướng trang giới thiệu
│   ├── contac.php         # Điều hướng trang liên hệ
│   ├── thanhtoan.php      # Điều hướng trang thanh toán
│   └── binhluan.php       # Controller nạp widget bình luận
│
├── model/                 # Tầng xử lý logic & cơ sở dữ liệu (PDO)
│   ├── config.php         # Kết nối CSDL PDO & các hàm query chung
│   ├── sanpham.php        # Model thao tác bảng `sanpham`
│   ├── danhmuc.php        # Model thao tác bảng `danhmuc`
│   ├── user.php           # Model thao tác bảng `user`
│   ├── admin.php          # Model thao tác bảng `admin`
│   ├── binhluan.php       # Model thao tác bảng `binhluan`
│   ├── login_submit.php   # Xử lý đăng nhập
│   └── register_submit.php# Xử lý đăng ký
│
├── view/                  # Giao diện hiển thị phía khách hàng
│   ├── header.php         # Thanh điều hướng & menu đầu trang
│   ├── footer.php         # Chân trang & liên kết hỗ trợ
│   ├── home.php           # Giao diện trang chủ
│   ├── sanpham.php        # Giao diện danh mục sản phẩm
│   ├── chitietsp.php      # Giao diện chi tiết sản phẩm
│   ├── cart.php           # Giao diện giỏ hàng
│   ├── thanhtoan.php      # Giao diện đặt hàng & thanh toán
│   ├── login.php          # Giao diện đăng nhập khách hàng
│   ├── register.php       # Giao diện đăng ký khách hàng
│   ├── suauser.php        # Giao diện đổi thông tin cá nhân
│   ├── css/               # Định kiểu giao diện CSS
│   ├── js/                # Các tập lệnh kiểm tra dữ liệu JS
│   └── images/            # Thư mục chứa hình ảnh sản phẩm & banner
│
├── viewAdmin/             # Giao diện hiển thị phía quản trị viên
│   ├── header.php         # Header trang quản trị
│   ├── footer.php         # Footer trang quản trị
│   ├── admin.php          # Quản lý danh sách người dùng
│   ├── userAd.php         # Bảng thông tin & đổi pass Admin
│   ├── sanpham.php        # Bảng danh sách sản phẩm
│   ├── themsp.php         # Form thêm mới sản phẩm
│   ├── suasp.php          # Form chỉnh sửa sản phẩm
│   ├── danhmuc.php        # Bảng danh sách danh mục
│   ├── themdanhmuc.php    # Form thêm mới danh mục
│   ├── suadanhmuc.php     # Form chỉnh sửa danh mục
│   ├── binhluan.php       # Bảng kiểm duyệt bình luận
│   ├── layout_tim.php     # Tìm kiếm sản phẩm trong Admin
│   └── suauserAd.php      # Form chỉnh sửa tài khoản người dùng
│
├── duan1.sql              # Bản sao lưu cấu trúc và dữ liệu mẫu CSDL
├── erd.drawio             # Sơ đồ thiết kế thực thể mối quan hệ (ERD)
├── index.php              # Điểm truy cập gốc (chuyển hướng vào controller)
├── .gitignore             # Các tệp loại trừ không đưa lên Git
└── README.md              # Tài liệu hướng dẫn dự án
```

---

## 📈 Lịch sử lộ trình phát triển (Git Workflow)
Dự án được xây dựng và đẩy lên GitHub theo 9 bước phát triển tiêu chuẩn:
1. `chore: initialize project MVC structure and static assets`
2. `feat(db): add database schema duan1.sql and PDO connection helper`
3. `feat(core): setup application entrypoint and main controller router`
4. `feat(ui): implement responsive header, footer, about and contact views`
5. `feat(catalog): display featured products and filter by category on client`
6. `feat(product): implement product detail view with image gallery`
7. `feat(auth): implement user authentication, registration and profile view`
8. `feat(cart): implement shopping cart session management and checkout`
9. `feat(admin): implement admin dashboard and full CRUD management`
10. `fix(security): resolve password verification, cart index warnings and delete IDs`
11. `docs: add comprehensive README.md with installation guide`
