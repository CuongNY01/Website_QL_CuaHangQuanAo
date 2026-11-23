-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: duanmau
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `email` varchar(225) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','123456','duongbacong1201@gmail.com'),(2,'admin1','123123','duongbacong12345@gmail.com');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `binhluan`
--

DROP TABLE IF EXISTS `binhluan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `binhluan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hinh` varchar(225) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idsp` int(11) NOT NULL,
  `noidung` varchar(225) NOT NULL,
  `postdate` varchar(225) NOT NULL,
  `name` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `binhluan`
--

LOCK TABLES `binhluan` WRITE;
/*!40000 ALTER TABLE `binhluan` DISABLE KEYS */;
INSERT INTO `binhluan` VALUES (1,'204447345_518176125969474_2025131023540390899_n.jpg',38,1,'Chất vải sơ mi rất mịn và đứng form, giặt không bị nhăn, shop đóng gói cẩn thận!','14/11/2026 09:30','Nguyễn Doãn Tùng'),(2,'242211632_618878339098973_5621219576916657100_n.jpg',39,5,'Váy hoa maxi mặc đi biển cực kỳ xinh, vải mát và tôn dáng lắm nha mọi người!','14/11/2026 10:15','Thu Huyền'),(3,'iconUser.png',38,12,'Quần jean form suông mặc rất thoải mái, chuẩn màu như trên hình quảng cáo.','14/11/2026 10:45','Dương Bá Công');
/*!40000 ALTER TABLE `binhluan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `danhmuc`
--

DROP TABLE IF EXISTS `danhmuc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `danhmuc` (
  `iddanhmuc` int(11) NOT NULL AUTO_INCREMENT,
  `tendanhmuc` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci NOT NULL,
  PRIMARY KEY (`iddanhmuc`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `danhmuc`
--

LOCK TABLES `danhmuc` WRITE;
/*!40000 ALTER TABLE `danhmuc` DISABLE KEYS */;
INSERT INTO `danhmuc` VALUES (1,'Áo Nam & Sơ Mi'),(2,'Thời Trang Nữ & Váy'),(3,'Quần Jean & Quần Tây'),(4,'Áo Khoác & Hoodie'),(5,'Thể Thao'),(8,'Danh mục mới');
/*!40000 ALTER TABLE `danhmuc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donhang`
--

DROP TABLE IF EXISTS `donhang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donhang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `madh` varchar(30) NOT NULL,
  `iduser` int(11) DEFAULT NULL,
  `hoten` varchar(100) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `diachi` text NOT NULL,
  `pttt` varchar(50) DEFAULT 'COD',
  `ghichu` text DEFAULT NULL,
  `tongtien` int(11) NOT NULL DEFAULT 0,
  `trangthai` varchar(50) DEFAULT 'Chờ xác nhận',
  `ngaydathang` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `madh` (`madh`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donhang`
--

LOCK TABLES `donhang` WRITE;
/*!40000 ALTER TABLE `donhang` DISABLE KEYS */;
INSERT INTO `donhang` VALUES (1,'DH20261120001',1,'Nguyễn Văn An','0912345678','an.nguyen@gmail.com','Số 15 Cầu Giấy, Hà Nội','COD','Giao giờ hành chính',580000,'Giao thành công','2026-11-20 09:30:00'),(2,'DH20261121002',2,'Trần Thị Mai','0987654321','mai.tran@gmail.com','24 Lê Lợi, Phường Bến Nghé, Quận 1, TP.HCM','Ví MoMo','Gọi trước khi giao',450000,'Đang giao hàng','2026-11-21 10:15:00'),(3,'DH20261121003',NULL,'Lê Hoàng Long','0905112233','long.le@gmail.com','88 Trần Phú, Quận Hải Châu, Đà Nẵng','COD','Đóng gói cẩn thận giúp shop',350000,'Đang giao hàng','2026-11-21 14:00:00'),(4,'DH20261121090826',1,'Nguyễn Khách Test','0911223344','test@gmail.com','123 Đường Thời Trang, Hà Nội','COD','Đơn hàng test tự động',490000,'Giao thành công','2026-11-21 15:08:26'),(5,'DH20261121091846',41,'Duong Bá Công','0332437382','20220385@eaut.edu.vn','Hà Nội','Ví điện tử MoMo','',350000,'Đang giao hàng','2026-11-21 15:18:46');
/*!40000 ALTER TABLE `donhang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donhang_chitiet`
--

DROP TABLE IF EXISTS `donhang_chitiet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donhang_chitiet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iddonhang` int(11) NOT NULL,
  `idsp` int(11) DEFAULT 0,
  `tensp` varchar(255) NOT NULL,
  `hinh` varchar(255) DEFAULT NULL,
  `size` varchar(10) DEFAULT 'M',
  `dongia` int(11) NOT NULL DEFAULT 0,
  `soluong` int(11) NOT NULL DEFAULT 1,
  `thanhtien` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `iddonhang` (`iddonhang`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donhang_chitiet`
--

LOCK TABLES `donhang_chitiet` WRITE;
/*!40000 ALTER TABLE `donhang_chitiet` DISABLE KEYS */;
INSERT INTO `donhang_chitiet` VALUES (1,1,1,'Áo Sơ Mi Oxford Trắng Dài Tay','ao_so_mi_nam.jpg','L',260000,1,260000),(2,1,10,'Quần Tây Âu Nam Slimfit Cao Cấp','quan_tay_au.jpg','31',320000,1,320000),(3,2,5,'Đầm Maxi Hoa Nhí Dáng Dài Vintage','dam_maxi_hoa.jpg','M',450000,1,450000),(4,3,15,'Áo Khoác Bomber Kaki Nam Nữ Form Rộng','ao_khoac_bomber.jpg','XL',350000,1,350000),(5,4,1,'Áo Sơ Mi Oxford Slimfit','ao_so_mi_nam.jpg','L',260000,1,260000),(6,4,8,'Chân Váy Chữ A Công Sở','chan_vay_chu_a.jpg','M',230000,1,230000),(7,5,0,'Áo Len Dệt Kim Nam Phong Cách Hàn Quốc','ao_len_mua_dong.jpg','L',320000,1,320000);
/*!40000 ALTER TABLE `donhang_chitiet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hinh` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci NOT NULL,
  `tensp` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci NOT NULL,
  `gia` int(11) NOT NULL,
  `iddanhmuc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sanpham`
--

LOCK TABLES `sanpham` WRITE;
/*!40000 ALTER TABLE `sanpham` DISABLE KEYS */;
INSERT INTO `sanpham` VALUES (1,'ao_so_mi_nam.jpg','Áo Sơ Mi Nam Công Sở Oxford Trắng Cổ Điển',280000,1),(2,'ao_polo_nam.jpg','Áo Polo Nam Cổ Bẻ Pique Thoáng Khí Cao Cấp',220000,1),(3,'ao_thun_oversize.jpg','Áo Thun Nam Cổ Tròn Cotton 100% Co Giãn',180000,1),(4,'ao_len_mua_dong.jpg','Áo Len Dệt Kim Nam Phong Cách Hàn Quốc',320000,1),(5,'dam_maxi_hoa.jpg','Váy Đầm Maxi Nữ Hoa Nhí Dáng Dài Vintage',350000,2),(6,'vay_xoe_cong_so.jpg','Váy Xòe Nữ Công Sở Dáng Chữ A Thanh Lịch',320000,2),(7,'dam_du_tiec_sang_trong.jpg','Đầm Dự Tiệc Nữ Thiết Kế Ôm Body Sang Trọng',480000,2),(8,'ao_croptop_nu.jpg','Áo Croptop Nữ Tay Ngắn Năng Động Dạo Phố',195000,2),(9,'chan_vay_chu_a.jpg','Chân Váy Chữ A Lưng Cao Tôn Dáng Phối Đồ',210000,2),(10,'ao_blouse_nu.jpg','Áo Blouse Nữ Công Sở Cổ Bèo Tay Bồng Duyên Dáng',240000,2),(11,'set_do_nu_mua_he.jpg','Set Đồ Bộ Nữ Linen Mùa Hè Thoáng Mát Thời Trang',290000,2),(12,'quan_jean_ong_suong.jpg','Quần Jean Nam Ống Suông Retro Bền Đẹp',360000,3),(13,'quan_tay_au.jpg','Quần Tây Âu Nam Co Giãn Chống Nhăn Dáng Slimfit',340000,3),(14,'quan_short_kaki.jpg','Quần Short Kaki Nam Túi Hộp Năng Động Trẻ Trung',185000,3),(15,'quan_culottes_nu.jpg','Quần Ống Rộng Culottes Nữ Lưng Thun Tôn Dáng',270000,3),(16,'quan_jogger_the_thao.jpg','Quần Jogger Kaki Co Giãn 4 Chiều Unisex',250000,3),(17,'ao_khoac_bomber.jpg','Áo Khoác Bomber Kaki Hai Lớp Chống Gió Thời Trang',420000,4),(18,'ao_hoodie_ni.jpg','Áo Hoodie Nỉ Bông Unisex Form Rộng Mùa Thu Đông',310000,4),(19,'ao_cardigan_nu.jpg','Áo Cardigan Nữ Dệt Kim Mềm Mại Phối Nút Hàn Quốc',260000,4),(20,'set_vest_nu.jpg','Set Áo Vest Nữ Kèm Chân Váy Công Sở Cao Cấp',550000,4),(21,'Real.jpg','Áo Đấu Real Madrid Mùa Giải 24/25 Màu Trắng',250000,5),(22,'MC.jpg','Áo Manchester City Sân Nhà Xanh Ngọc Mùa Giải Mới',240000,5),(23,'Arsenal.jpg','Áo Bóng Đá Arsenal Sân Nhà Đỏ Truyền Thống',220000,5),(24,'84.png','Bộ Quần Áo Thể Thao Tập Gym & Chạy Bộ Thoáng Khí',290000,5),(66,'caso4.jpg','Áo Sơ Mi',123243,8),(67,'ao_so_mi_nam.jpg','Áo Sơ Mi Nam Oxford Xanh Pastel Dáng Slimfit',295000,1),(68,'ao_so_mi_nam.jpg','Áo Sơ Mi Linen Nam Cổ Tàu Thoáng Mát Mùa Hè',310000,1),(69,'ao_so_mi_nam.jpg','Áo Sơ Mi Nam Dài Tay Bamboo Chống Nhăn Cao Cấp',340000,1),(70,'ao_so_mi_nam.jpg','Áo Sơ Mi Nam Ngắn Tay Kẻ Sọc Công Sở Thanh Lịch',265000,1),(71,'ao_polo_nam.jpg','Áo Polo Nam Phối Cổ Dệt Kim Sang Trọng',245000,1),(72,'ao_polo_nam.jpg','Áo Polo Nam Thể Thao Vải Cá Sấu Poly Co Giãn',215000,1),(73,'ao_polo_nam.jpg','Áo Polo Nam Dáng Regular Fit Màu Đen Lịch Lãm',230000,1),(74,'ao_thun_oversize.jpg','Áo Thun Nam Cổ Tròn Cotton Compact Form Rộng',195000,1),(75,'ao_thun_oversize.jpg','Áo Thun Nam In Họa Tiết Streetwear Cá Tính',210000,1),(76,'ao_thun_oversize.jpg','Áo Thun Nam Tay Lỡ Unisex Vải Cotton 2 Chiều',175000,1),(77,'ao_len_mua_dong.jpg','Áo Len Cổ Lọ Nam Giữ Nhiệt Mùa Đông Cao Cấp',350000,1),(78,'ao_len_mua_dong.jpg','Áo Len Cardigan Nam Dệt Thừng Cổ Chữ V',380000,1),(79,'ao_len_mua_dong.jpg','Áo Sweater Nam Nỉ Da Cá Trơn Basic Trẻ Trung',275000,1),(80,'dam_maxi_hoa.jpg','Đầm Maxi Đi Biển Hai Dây Họa Tiết Hoa Nhí',370000,2),(81,'vay_dam_nu.jpg','Váy Đầm Voan Tơ Nữ Xếp Ly Dáng Dài Duyên Dáng',410000,2),(82,'vay_xoe_cong_so.jpg','Đầm Công Sở Nữ Cổ Vuông Phối Đai Eo Thanh Lịch',345000,2),(83,'dam_du_tiec_sang_trong.jpg','Đầm Xòe Dự Tiệc Trễ Vai Tiểu Thư Sang Chảnh',520000,2),(84,'chan_vay_chu_a.jpg','Chân Váy Xếp Ly Dài Qua Gối Phong Cách Hàn Quốc',235000,2),(85,'chan_vay_chu_a.jpg','Chân Váy Jean Nữ Dáng Chữ A Xẻ Tà Năng Động',250000,2),(86,'ao_kieu_nu.jpg','Áo Kiểu Nữ Tay Phồng Cổ Tim Chất Lụa Mềm Mại',260000,2),(87,'ao_blouse_nu.jpg','Áo Sơ Mi Blouse Nữ Voan Tơ Công Sở Cao Cấp',275000,2),(88,'ao_croptop_nu.jpg','Áo Croptop Nữ Ôm Body Gân Tăm Tôn Dáng',180000,2),(89,'set_do_nu_mua_he.jpg','Set Bộ Đồ Nữ Áo Kiểu Kèm Quần Short Mùa Hè',315000,2),(90,'quan_jean_ong_suong.jpg','Quần Jean Nam Xanh Đậm Ống Đứng Classic Fit',380000,3),(91,'quan_jean_ong_suong.jpg','Quần Jean Nam Đen Rách Gối Phong Cách Bụi Bặm',395000,3),(92,'quan_jean_ong_suong.jpg','Quần Jean Nữ Ống Rộng Cạp Cao Hack Dáng',350000,3),(93,'quan_jean_ong_suong.jpg','Quần Baggy Jean Unisex Wash Xám Hiện Đại',340000,3),(94,'quan_tay_au.jpg','Quần Tây Âu Nam Ống Côn Xám Tro Công Sở',360000,3),(95,'quan_tay_au.jpg','Quần Tây Nam Lưng Thun Co Giãn Dáng Hàn Quốc',330000,3),(96,'quan_culottes_nu.jpg','Quần Tây Nữ Ống Suông Cạp Cao Thanh Lịch',310000,3),(97,'quan_culottes_nu.jpg','Quần Culottes Nữ Vải Đũi Mát Mẻ Dạo Phố',245000,3),(98,'quan_tay_au.jpg','Quần Kaki Nam Dáng Slimfit Màu Be Cao Cấp',295000,3),(99,'quan_short_kaki.jpg','Quần Short Jean Nam Lưng Thun Thoải Mái',210000,3),(100,'quan_short_kaki.jpg','Quần Short Kaki Nữ Cạp Cao Phong Cách Trẻ Trung',195000,3),(101,'quan_jogger_the_thao.jpg','Quần Jogger Nỉ Túi Hộp Streetwear Unisex',275000,3),(102,'ao_khoac_bomber.jpg','Áo Khoác Bomber Da Lộn Nam Lót Lông Ấm Áp',490000,4),(103,'ao_khoac_bomber.jpg','Áo Khoác Dù Chống Nắng Chống Nước Hai Lớp',320000,4),(104,'ao_khoac_bomber.jpg','Áo Khoác Jean Denim Nam Nữ Form Rộng Cổ Điển',450000,4),(105,'set_vest_nu.jpg','Áo Khoác Blazer Nữ Công Sở Hai Hàng Khuy',520000,4),(106,'set_vest_nu.jpg','Áo Khoác Dạ Tweed Nữ Sang Trọng Dự Tiệc',620000,4),(107,'ao_hoodie_ni.jpg','Áo Hoodie Zip Khóa Kéo Nỉ Bông Unisex Dày Dặn',345000,4),(108,'ao_hoodie_ni.jpg','Áo Hoodie In Chữ Nổi Phong Cách Đường Phố',330000,4),(109,'ao_hoodie_ni.jpg','Áo Hoodie Nỉ Ngoại Oversize Màu Xám Tiêu',315000,4),(110,'ao_cardigan_nu.jpg','Áo Cardigan Len Mỏng Nữ Chống Nắng Mùa Thu',240000,4),(111,'ao_cardigan_nu.jpg','Áo Cardigan Len Dày Phối Túi Phong Cách Vintage',295000,4),(112,'ao_khoac_bomber.jpg','Áo Khoác Phao Siêu Nhẹ Giữ Ấm Mùa Đông',540000,4),(113,'ao_khoac_bomber.jpg','Áo Khoác Kaki Nam Cổ Bẻ Túi Hộp Lịch Lãm',410000,4),(114,'set_vest_nu.jpg','Set Áo Vest Blazer Nữ Kèm Quần Tây Đồng Bộ',650000,4),(115,'Bacar1.jpg','Áo Bóng Đá Barcelona Sân Nhà Đỏ Xanh Truyền Thống',240000,5),(116,'chelsea.jpg','Áo Đấu Chelsea Sân Nhà Xanh Hoàng Gia Mùa Mới',240000,5),(117,'mu.jpeg','Áo Bóng Đá Manchester United Đỏ Sân Nhà 2026',250000,5),(118,'tot.jpg','Áo Đấu Tottenham Hotspur Trắng Sân Nhà',230000,5),(119,'Atletico.jpg','Áo Đấu Atletico Madrid Sọc Đỏ Trắng La Liga',235000,5),(120,'Real2.jpg','Áo Đấu Real Madrid Sân Khách Phiên Bản Đặc Biệt',260000,5),(121,'Barca2.jpg','Áo Bóng Đá Barcelona Sân Khách Màu Đen Vàng',245000,5),(122,'valencia.jpg','Áo Bóng Đá Valencia CF Sân Nhà Trắng Đen',220000,5),(123,'CAHN.jpg','Áo Đấu CLB Công An Hà Nội (CAHN) V-League',210000,5),(124,'HAGL.jpg','Áo Đấu CLB Hoàng Anh Gia Lai (HAGL) Sân Nhà',210000,5),(125,'SLNA.jpg','Áo Đấu CLB Sông Lam Nghệ An (SLNA) Vàng Truyền Thống',200000,5),(126,'Thepxanh.png','Áo Đấu CLB Thép Xanh Nam Định V-League',215000,5),(127,'HP.jpg','Áo Đấu CLB Hải Phòng FC Đỏ Rực Cháy',205000,5);
/*!40000 ALTER TABLE `sanpham` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci NOT NULL,
  `name` varchar(225) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci NOT NULL,
  `avata` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (39,'huyen','123','huyen','nguyendoantung12345@gmail.com','242211632_618878339098973_5621219576916657100_n.jpg'),(38,'tung112003','123','Nguyễn Doãn Tùng','nguyendoantung12345@gmail.com','204447345_518176125969474_2025131023540390899_n.jpg'),(41,'Cong','Cong123','Duong Bá Công','20220385@eaut.edu.vn','bang.jpg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-23  7:57:09
