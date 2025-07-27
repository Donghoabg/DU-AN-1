-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 24, 2025 at 09:20 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duanmau`
--

-- --------------------------------------------------------

--
-- Table structure for table `binh_luans`
--

CREATE TABLE `binh_luans` (
  `id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `tai_khoan_id` int NOT NULL,
  `noi_dung` text NOT NULL,
  `ngay_dang` date NOT NULL,
  `trang_thai` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `binh_luans`
--

INSERT INTO `binh_luans` (`id`, `san_pham_id`, `tai_khoan_id`, `noi_dung`, `ngay_dang`, `trang_thai`) VALUES
(59, 46, 2, 'áds', '2024-12-12', 1),
(60, 50, 2, 'âcc', '2025-06-08', 1),
(62, 49, 2, 'hẹ hẹ', '2025-06-21', 1),
(63, 48, 1, 'hehee', '2025-06-21', 1),
(64, 47, 2, 'đẹp', '2025-06-21', 1),
(65, 48, 1, 'hẹ hẹ', '2025-06-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hangs`
--

CREATE TABLE `chi_tiet_don_hangs` (
  `id` int NOT NULL,
  `don_hang_id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `don_gia` decimal(10,2) NOT NULL,
  `so_luong` int NOT NULL,
  `thanh_tien` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chi_tiet_don_hangs`
--

INSERT INTO `chi_tiet_don_hangs` (`id`, `don_hang_id`, `san_pham_id`, `don_gia`, `so_luong`, `thanh_tien`) VALUES
(30, 14, 26, '150.00', 1, '150.00'),
(31, 14, 27, '200.00', 3, '600.00'),
(32, 15, 19, '990.00', 1, '990.00'),
(33, 15, 26, '150.00', 1, '150.00'),
(34, 15, 27, '200.00', 3, '600.00'),
(35, 16, 19, '990.00', 1, '990.00'),
(36, 16, 26, '150.00', 1, '150.00'),
(37, 16, 27, '200.00', 3, '600.00'),
(38, 17, 19, '990.00', 1, '990.00'),
(39, 17, 26, '150.00', 1, '150.00'),
(40, 17, 27, '200.00', 3, '600.00'),
(41, 18, 19, '990.00', 1, '990.00'),
(42, 18, 26, '150.00', 1, '150.00'),
(43, 18, 27, '200.00', 3, '600.00'),
(44, 19, 19, '990.00', 1, '990.00'),
(45, 19, 26, '150.00', 1, '150.00'),
(46, 19, 27, '200.00', 3, '600.00'),
(47, 20, 19, '990.00', 1, '990.00'),
(48, 20, 26, '150.00', 1, '150.00'),
(49, 20, 27, '200.00', 3, '600.00'),
(50, 21, 19, '990.00', 1, '990.00'),
(51, 21, 27, '200.00', 1, '200.00'),
(52, 22, 27, '200.00', 1, '200.00'),
(53, 23, 19, '990.00', 1, '990.00'),
(54, 23, 27, '200.00', 2, '400.00'),
(55, 24, 19, '990.00', 4, '3960.00'),
(56, 24, 27, '200.00', 2, '400.00'),
(57, 25, 19, '990.00', 4, '3960.00'),
(58, 25, 27, '200.00', 2, '400.00'),
(59, 25, 17, '75.00', 1, '75.00'),
(60, 26, 19, '990.00', 4, '3960.00'),
(61, 26, 27, '200.00', 6, '1200.00'),
(62, 26, 17, '75.00', 1, '75.00'),
(63, 26, 26, '150.00', 3, '450.00'),
(64, 27, 19, '990.00', 4, '3960.00'),
(65, 27, 27, '200.00', 6, '1200.00'),
(66, 27, 17, '75.00', 1, '75.00'),
(67, 27, 26, '150.00', 3, '450.00'),
(68, 28, 26, '150.00', 3, '450.00'),
(69, 29, 26, '150.00', 6, '900.00'),
(70, 29, 19, '990.00', 6, '5940.00'),
(71, 30, 27, '200.00', 1, '200.00'),
(72, 31, 27, '200.00', 1, '200.00'),
(73, 31, 26, '150.00', 1, '150.00'),
(74, 32, 27, '200.00', 1, '200.00'),
(75, 32, 26, '150.00', 1, '150.00'),
(76, 33, 29, '140.00', 2, '280.00'),
(77, 34, 29, '140.00', 2, '280.00'),
(78, 34, 37, '99.00', 1, '99.00'),
(79, 35, 29, '140.00', 7, '980.00'),
(80, 35, 37, '99.00', 1, '99.00'),
(81, 35, 36, '499.00', 3, '1497.00'),
(82, 36, 39, '12.00', 1, '12.00'),
(83, 37, 49, '78000.00', 1, '78000.00'),
(84, 38, 47, '100000.00', 1, '100000.00'),
(85, 40, 46, '125000.00', 1, '125000.00'),
(86, 40, 48, '89000.00', 1, '89000.00'),
(87, 40, 45, '45000.00', 1, '45000.00'),
(88, 41, 48, '89000.00', 1, '89000.00'),
(89, 41, 47, '100000.00', 1, '100000.00'),
(90, 42, 46, '125000.00', 1, '125000.00'),
(91, 43, 50, '350000.00', 1, '350000.00'),
(92, 43, 49, '78000.00', 1, '78000.00'),
(93, 43, 48, '89000.00', 1, '89000.00'),
(94, 44, 50, '350000.00', 1, '350000.00'),
(95, 45, 50, '350000.00', 1, '350000.00'),
(96, 46, 46, '125000.00', 1, '125000.00'),
(120, 47, 44, '30000.00', 1, '30000.00'),
(121, 48, 49, '78000.00', 1, '78000.00'),
(122, 49, 51, '10000.00', 1, '10000.00'),
(123, 50, 50, '350000.00', 2, '700000.00');

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_gio_hangs`
--

CREATE TABLE `chi_tiet_gio_hangs` (
  `id` int NOT NULL,
  `gio_hang_id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `so_luong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chi_tiet_gio_hangs`
--

INSERT INTO `chi_tiet_gio_hangs` (`id`, `gio_hang_id`, `san_pham_id`, `so_luong`) VALUES
(1, 1, 10, 1),
(2, 1, 17, 1),
(3, 1, 13, 1),
(23, 4, 27, 1),
(27, 3, 26, 6),
(29, 3, 19, 6),
(30, 3, 17, 1),
(31, 5, 27, 1),
(32, 5, 26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chuc_vus`
--

CREATE TABLE `chuc_vus` (
  `id` int NOT NULL,
  `ten_chuc_vu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chuc_vus`
--

INSERT INTO `chuc_vus` (`id`, `ten_chuc_vu`) VALUES
(1, 'admin'),
(2, 'khach_hang');

-- --------------------------------------------------------

--
-- Table structure for table `danh_mucs`
--

CREATE TABLE `danh_mucs` (
  `id` int NOT NULL,
  `ten_danh_muc` varchar(255) NOT NULL,
  `mo_ta` text,
  `trang_thai` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `danh_mucs`
--

INSERT INTO `danh_mucs` (`id`, `ten_danh_muc`, `mo_ta`, `trang_thai`) VALUES
(38, 'Áo thu đông', 'Áo thu đông', 1),
(39, 'Quần dài', 'Quần dài', 1),
(40, 'Mũ lông', 'Mũ lông', 1),
(42, 'Áo dài ', 'Áo dài ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `don_hangs`
--

CREATE TABLE `don_hangs` (
  `id` int NOT NULL,
  `ma_don_hang` varchar(50) NOT NULL,
  `tai_khoan_id` int NOT NULL,
  `ten_nguoi_nhan` varchar(255) NOT NULL,
  `email_nguoi_nhan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sdt_nguoi_nhan` varchar(15) NOT NULL,
  `dia_chi_nguoi_nhan` text NOT NULL,
  `ngay_dat` date NOT NULL,
  `tong_tien` decimal(10,0) NOT NULL,
  `ghi_chu` text,
  `phuong_thuc_thanh_toan_id` int NOT NULL,
  `trang_thai_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `don_hangs`
--

INSERT INTO `don_hangs` (`id`, `ma_don_hang`, `tai_khoan_id`, `ten_nguoi_nhan`, `email_nguoi_nhan`, `sdt_nguoi_nhan`, `dia_chi_nguoi_nhan`, `ngay_dat`, `tong_tien`, `ghi_chu`, `phuong_thuc_thanh_toan_id`, `trang_thai_id`) VALUES
(45, 'DH-9306', 2, 'adc', 'minh@gmail.com', '1234567899', 'hanoi', '2025-06-01', '380000', '', 1, 12),
(46, 'DH-3105', 2, 'adc', 'minh@gmail.com', '1234567899', 'hanoi', '2025-06-08', '155000', '', 1, 12),
(47, 'DH-8812', 1, 'abc', 'anh@gmail.com', '0123456789', 'adc', '2025-06-20', '60000', '', 1, 10),
(48, 'DH-8576', 2, 'Minh', 'minh@gmail.com', '1234567899', 'hanoi', '2025-06-21', '108000', '', 1, 13),
(49, 'DH-8770', 1, 'Đức', 'anh@gmail.com', '0123456789', 'adc', '2025-06-21', '40000', '', 1, 10),
(50, 'DH-7226', 1, 'Đức', 'anh@gmail.com', '0123456789', 'adc', '2025-06-24', '730000', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gio_hangs`
--

CREATE TABLE `gio_hangs` (
  `id` int NOT NULL,
  `tai_khoan_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gio_hangs`
--

INSERT INTO `gio_hangs` (`id`, `tai_khoan_id`) VALUES
(1, 7),
(3, 14),
(4, 15),
(5, 13),
(6, 23),
(7, 2),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hinh_anh_san_phams`
--

CREATE TABLE `hinh_anh_san_phams` (
  `id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `link_hinh_anh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hinh_anh_san_phams`
--

INSERT INTO `hinh_anh_san_phams` (`id`, `san_pham_id`, `link_hinh_anh`) VALUES
(67, 40, './uploads/1733937316áo khoác 1.jpeg'),
(68, 41, './uploads/1733937370mũ lưỡi trai.jpg'),
(69, 42, './uploads/1733937408mũ bucket.jpg'),
(70, 43, './uploads/1733937442mũ lông.jpg'),
(71, 44, './uploads/1733937495mũ len.jpg'),
(72, 45, './uploads/1733937535quần jean.jpeg'),
(73, 46, './uploads/1733937575quần âu.jpeg'),
(74, 47, './uploads/1733937643quần bò.jpeg'),
(75, 48, './uploads/1733937729quần kaki.jpeg'),
(76, 49, './uploads/1733937773áo len.jpeg'),
(77, 50, './uploads/1733937857áo phao 2.jpeg'),
(78, 51, './uploads/17505118701731392843avatar5.png');

-- --------------------------------------------------------

--
-- Table structure for table `phuong_thuc_thanh_toans`
--

CREATE TABLE `phuong_thuc_thanh_toans` (
  `id` int NOT NULL,
  `ten_phuong_thuc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `phuong_thuc_thanh_toans`
--

INSERT INTO `phuong_thuc_thanh_toans` (`id`, `ten_phuong_thuc`) VALUES
(1, 'COD'),
(2, 'Thanh Toán online'),
(3, 'COD'),
(4, 'Thanh Toán online');

-- --------------------------------------------------------

--
-- Table structure for table `san_phams`
--

CREATE TABLE `san_phams` (
  `id` int NOT NULL,
  `ten_san_pham` varchar(255) NOT NULL,
  `gia_san_pham` decimal(10,2) NOT NULL,
  `gia_khuyen_mai` decimal(10,2) DEFAULT NULL,
  `hinh_anh` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `so_luong` int NOT NULL,
  `luot_xem` int DEFAULT '0',
  `ngay_nhap` date NOT NULL,
  `mo_ta` text,
  `danh_muc_id` int NOT NULL,
  `trang_thai` tinyint NOT NULL DEFAULT '1',
  `is_hidden` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `san_phams`
--

INSERT INTO `san_phams` (`id`, `ten_san_pham`, `gia_san_pham`, `gia_khuyen_mai`, `hinh_anh`, `so_luong`, `luot_xem`, `ngay_nhap`, `mo_ta`, `danh_muc_id`, `trang_thai`, `is_hidden`) VALUES
(40, 'Áo  khoác', '1000000.00', '10000.00', './uploads/1733937316áo khoác 1.jpeg', 100, 0, '2024-12-06', 'Áo khoác', 38, 1, 0),
(41, 'Mũ Lưỡi Trai', '200000.00', '18000.00', './uploads/1733937370mũ lưỡi trai.jpg', 200, 0, '2024-11-30', 'Mũ', 40, 1, 0),
(42, 'Mũ Bucket', '180000.00', '160000.00', './uploads/1733937408mũ bucket.jpg', 56, 0, '2024-12-06', 'Mũ', 40, 1, 0),
(45, 'Quần jean', '90000.00', '45000.00', './uploads/1733937535quần jean.jpeg', 67, 0, '2024-12-07', '', 39, 1, 0),
(46, 'Quần âu', '179000.00', '125000.00', './uploads/1733937575quần âu.jpeg', 89, 0, '2024-12-04', '', 39, 1, 0),
(47, 'Quần bò', '160000.00', '100000.00', './uploads/1733937643quần bò.jpeg', 47, 0, '2024-12-07', '', 39, 1, 0),
(48, 'Quần kika', '150000.00', '89000.00', './uploads/1733937729quần kaki.jpeg', 46, 0, '2024-12-08', '', 39, 1, 0),
(49, 'Áo len', '187000.00', '78000.00', './uploads/1733937773áo len.jpeg', 45, 0, '2024-12-08', '', 38, 1, 0),
(50, 'Áo phao', '450000.00', '350000.00', './uploads/1733937857áo phao 2.jpeg', 234, 0, '2024-12-07', '', 38, 1, 0),
(51, 'Áo ba lỗ ', '100000.00', '10000.00', './uploads/175051187017323771361731319674user3-128x128.jpg', 12, 0, '2004-12-12', 'áo đẹp', 38, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tai_khoans`
--

CREATE TABLE `tai_khoans` (
  `id` int NOT NULL,
  `ho_ten` varchar(255) DEFAULT NULL,
  `anh_dai_dien` varchar(255) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `gioi_tinh` tinyint DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `mat_khau` varchar(255) DEFAULT NULL,
  `chuc_vu_id` int DEFAULT NULL,
  `trang_thai` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tai_khoans`
--

INSERT INTO `tai_khoans` (`id`, `ho_ten`, `anh_dai_dien`, `ngay_sinh`, `email`, `so_dien_thoai`, `gioi_tinh`, `dia_chi`, `mat_khau`, `chuc_vu_id`, `trang_thai`) VALUES
(1, 'Đức', './uploads/1750513854images.jpg', '2025-05-14', 'anh@gmail.com', '0123456789', 1, 'adc', '123', 2, 1),
(2, 'Minh', './uploads/17505138461731392843avatar4.png', '2004-11-10', 'minh@gmail.com', '1234567899', 1, 'hanoi', '123', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tin_tucs`
--

CREATE TABLE `tin_tucs` (
  `id` int NOT NULL,
  `tuc_tuc_id` int NOT NULL,
  `noi_dung` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `anh_tin_tuc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ngay_dang` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tin_tucs`
--

INSERT INTO `tin_tucs` (`id`, `tuc_tuc_id`, `noi_dung`, `anh_tin_tuc`, `ngay_dang`) VALUES
(1, 1, 'Áo mùa đông ấm áp', 'https://tse1.mm.bing.net/th?id=OIP.nGJ2DJd7iDuU7guMy3BfngHaHa&pid=Api&P=0&h=180', '2024-11-23');

-- --------------------------------------------------------

--
-- Table structure for table `trang_thai_don_hangs`
--

CREATE TABLE `trang_thai_don_hangs` (
  `id` int NOT NULL,
  `ten_trang_thai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trang_thai_don_hangs`
--

INSERT INTO `trang_thai_don_hangs` (`id`, `ten_trang_thai`) VALUES
(1, 'Chưa Xác Nhận'),
(2, 'Đã Xác Nhận'),
(6, 'Chưa Thanh Toán'),
(7, 'Đã Thanh Toán'),
(8, 'Đang chuẩn bị hàng'),
(9, 'Đang giao'),
(10, 'Đã Giao'),
(11, 'Đã Nhận'),
(12, 'Thành Công'),
(13, 'Hoàn Hàng'),
(14, 'Đã Xác Nhận'),
(15, 'đã hủy');

-- --------------------------------------------------------

--
-- Table structure for table `trang_thai_thanh_toan`
--

CREATE TABLE `trang_thai_thanh_toan` (
  `id` int NOT NULL,
  `ten_trang_thai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trang_thai_thanh_toan`
--

INSERT INTO `trang_thai_thanh_toan` (`id`, `ten_trang_thai`) VALUES
(1, 'Chưa thanh toán'),
(2, 'Đã Thanh toán');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binh_luans`
--
ALTER TABLE `binh_luans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_binhluan_sanpham` (`san_pham_id`),
  ADD KEY `fk_binhluan_taikhoan` (`tai_khoan_id`);

--
-- Indexes for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chuc_vus`
--
ALTER TABLE `chuc_vus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_donhang_taikhoan` (`tai_khoan_id`),
  ADD KEY `fk_donhang_pttt` (`phuong_thuc_thanh_toan_id`),
  ADD KEY `fk_donhang_trangthai` (`trang_thai_id`);

--
-- Indexes for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phuong_thuc_thanh_toans`
--
ALTER TABLE `phuong_thuc_thanh_toans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `san_phams`
--
ALTER TABLE `san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sanpham_danhmuc` (`danh_muc_id`);

--
-- Indexes for table `tai_khoans`
--
ALTER TABLE `tai_khoans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chuc_vu_id` (`chuc_vu_id`);

--
-- Indexes for table `tin_tucs`
--
ALTER TABLE `tin_tucs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trang_thai_don_hangs`
--
ALTER TABLE `trang_thai_don_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trang_thai_thanh_toan`
--
ALTER TABLE `trang_thai_thanh_toan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binh_luans`
--
ALTER TABLE `binh_luans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `phuong_thuc_thanh_toans`
--
ALTER TABLE `phuong_thuc_thanh_toans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tai_khoans`
--
ALTER TABLE `tai_khoans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trang_thai_don_hangs`
--
ALTER TABLE `trang_thai_don_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binh_luans`
--
ALTER TABLE `binh_luans`
  ADD CONSTRAINT `fk_binhluan_sanpham` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`),
  ADD CONSTRAINT `fk_binhluan_taikhoan` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoans` (`id`);

--
-- Constraints for table `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD CONSTRAINT `fk_donhang_pttt` FOREIGN KEY (`phuong_thuc_thanh_toan_id`) REFERENCES `phuong_thuc_thanh_toans` (`id`),
  ADD CONSTRAINT `fk_donhang_taikhoan` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoans` (`id`),
  ADD CONSTRAINT `fk_donhang_trangthai` FOREIGN KEY (`trang_thai_id`) REFERENCES `trang_thai_don_hangs` (`id`);

--
-- Constraints for table `san_phams`
--
ALTER TABLE `san_phams`
  ADD CONSTRAINT `fk_sanpham_danhmuc` FOREIGN KEY (`danh_muc_id`) REFERENCES `danh_mucs` (`id`);

--
-- Constraints for table `tai_khoans`
--
ALTER TABLE `tai_khoans`
  ADD CONSTRAINT `fk_taikhoan_chucvu` FOREIGN KEY (`chuc_vu_id`) REFERENCES `chuc_vus` (`id`),
  ADD CONSTRAINT `tai_khoans_ibfk_1` FOREIGN KEY (`chuc_vu_id`) REFERENCES `chuc_vus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
