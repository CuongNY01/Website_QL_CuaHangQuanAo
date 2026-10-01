-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 29, 2022 lúc 02:16 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duanmau`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET armscii8 NOT NULL,
  `password` varchar(255) CHARACTER SET armscii8 NOT NULL,
  `email` varchar(225) CHARACTER SET armscii8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', '12345', 'nguyendoantung12345@gmail.com'),
(2, 'admin1', '123', 'nguyendoantung12345@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `id` int(11) NOT NULL,
  `hinh` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `iduser` int(11) NOT NULL,
  `idsp` int(11) NOT NULL,
  `noidung` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `postdate` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`id`, `hinh`, `iduser`, `idsp`, `noidung`, `postdate`, `name`) VALUES
(17, 'Anh_the.jpg', 38, 12, 'sản phẩm rất tốt\r\n', '17/11/2022', 'Nguyễn Doãn Tùng'),
(18, '242211632_618878339098973_5621219576916657100_n.jpg', 39, 12, 'kajksjkakjd', '24/11/2022', 'huyen');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `iddanhmuc` int(11) NOT NULL,
  `tendanhmuc` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`iddanhmuc`, `tendanhmuc`) VALUES
(1, 'La Liga'),
(2, 'Ngoại hạng Anh'),
(3, 'V-League');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `hinh` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci NOT NULL,
  `tensp` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci NOT NULL,
  `gia` int(11) NOT NULL,
  `iddanhmuc` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `hinh`, `tensp`, `gia`, `iddanhmuc`) VALUES
(1, 'Real.jpg', 'Áo Đấu Real Madrid Màu Trắng Mùa Giải 24/25', 880000, 1),
(2, 'Atletico.jpg', 'Áo Atlentico Madrid', 179000, 1),
(3, 'Bacar1.jpg', 'Áo Barcelona 2022/23 Sân Khách Màu Vàng', 173000, 1),
(4, 'Barca2.jpg', 'Áo Đấu Barca 2021/2022 Sân Khách Màu Tím', 150000, 1),
(5, 'valencia.jpg', 'Áo CLB Valencia Sân Nhà 24/25 Trắng', 129000, 1),
(6, 'Real2.jpg', 'Áo Đấu Real Madrid Màu Cam Mùa Giải 24/25', 184000, 1),
(7, 'real3.png', 'ÁO REAL MADRID SÂN KHÁCH 2023 - 2024 MÀU ĐEN', 142000, 1),
(8, 'real4.jpg', 'ÁO ĐẤU REAL MADRID SÂN NHÀ 24/25 TRẮNG', 148000, 1),
(9, 'atlentico2.jpg', 'Áo Atletico Madrid Sân Nhà 23/24', 145000, 1),
(10, 'barca4.png', 'Áo Đá Banh Barca Sân Khách 2023 - 2024 Trắng', 178000, 1),
(11, 'real5.png', 'ÁO REAL MADRID 2023 - 2024 SÂN KHÁCH TÍM ĐEN', 180000, 1),
(12, '84.png', 'Áo Bacar', 168000, 1),
(13, 'MC.jpg', 'Áo Manchester City 2022/2023 Sân Nhà Xanh Ngọc', 210000, 2),
(14, 'Arsenal.jpg', 'Áo Bóng Đá Arsenal Sân Nhà 24/25 Đỏ', 115000, 2),
(15, 'chelsea.jpg', 'Áo Bóng Đá Câu Lạc Bộ Chelsea Đen 2024-2025', 156000, 2),
(16, 'tot.jpg', 'Áo Bóng Đá Câu Lạc Bộ Tottenham Xanh Rêu 2024-2025', 165000, 2),
(17, 'mu.jpeg', 'Áo Bóng Đá Câu Lạc Bộ Manchester United Đen Rồng 2...', 260000, 2),
(18, 'Becamex.jpg', 'Áo Đá Banh Becamex Bình Dương Xám Xanh', 200000, 3),
(19, 'HP.jpg', 'Áo Hải Phòng Chính Hãng Mùa Giải 2017 – 2018', 200000, 3),
(20, 'CAHN.jpg', 'Áo Đá Banh Công An Hà Nội Sân Nhà 23/24 Màu Đỏ', 270000, 3),
(21, 'CAHN2.jpg', 'Áo Đấu Công An Hà Nội Sân Khách 23/24 Màu Trắng', 900000, 3),
(22, 'SLNA.JPG', 'Áo Đá Banh Sông Lam Nghệ An Sân Nhà 24/25 Màu Vàng', 800000, 3),
(23, 'Thepxanh.png', 'ÁO CLB THÉP XANH NAM ĐỊNH SÂN KHÁCH 2023 - 2024', 300000, 3),
(24, 'HAGL.JPG', 'Áo CLB Hoàng Anh Gia Lai Màu Đỏ Mùa Giải 2018-2019', 250000, 3),
(65, 'HAGL2.jpg', 'Áo Đấu Hoàng Anh Gia Lai Màu Trắng Mùa Giải 2022 -...', 247000, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci NOT NULL,
  `name` varchar(225) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci NOT NULL,
  `avata` varchar(225) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `email`, `avata`) VALUES
(39, 'huyen', '123', 'huyen', 'nguyendoantung12345@gmail.com', '242211632_618878339098973_5621219576916657100_n.jpg'),
(38, 'tung112003', '123', 'Nguyễn Doãn Tùng', 'nguyendoantung12345@gmail.com', '204447345_518176125969474_2025131023540390899_n.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`iddanhmuc`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `iddanhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
