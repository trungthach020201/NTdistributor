-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th5 08, 2021 lúc 03:47 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `NTdistributor`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `Username` varchar(30) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Cusname` varchar(50) NOT NULL,
  `Gender` int(11) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Telephone` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Cusdate` int(11) NOT NULL,
  `Cusmonth` int(11) NOT NULL,
  `Cusyear` int(11) NOT NULL,
  `SSN` varchar(10) DEFAULT NULL,
  `Activecode` varchar(100) DEFAULT NULL,
  `State` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`Username`, `Password`, `Cusname`, `Gender`, `Address`, `Telephone`, `Email`, `Cusdate`, `Cusmonth`, `Cusyear`, `SSN`, `Activecode`, `State`) VALUES
('admin1', '0192023a7bbd73250516f069df18b500', 'Thach Ngoc Trung', 0, 'Trà Vinh', 865894853, 'trungtngcc19009@fpt.edu.vn', 2, 2, 2001, '', '', 1),
('dat1', 'd91cad4f4e6aa68de540297107dc7bdb', 'Nguyễn Thành Đạt', 0, 'Cầu kè', 987654321, 'dat@1234.com', 8, 9, 1981, '', '', 0),
('ngoctrung', '5923f33de279fed8e31358d923a53a29', 'thach ngoc trung', 0, 'Trà Vinh', 987654322, 'trung@gmail.com', 2, 2, 1991, '', '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `IDCate` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `NameCate` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `DesCate` varchar(1000) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`IDCate`, `NameCate`, `DesCate`) VALUES
('F01', 'Fruit', ''),
('T01', 'Tubers', ''),
('V01', 'Vegetable', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `IDCate` varchar(10) NOT NULL,
  `productID` varchar(10) NOT NULL,
  `productName` varchar(30) NOT NULL,
  `price` varchar(30) NOT NULL,
  `productImage` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`IDCate`, `productID`, `productName`, `price`, `productImage`) VALUES
('F01', 'F01', 'Hamimelon', '15.000', 'hamimelon.png'),
('F01', 'F02', 'Viet Mango', '10.000', 'vmango.png'),
('F01', 'F03', 'thai grapefruit', '40.000', 'thaibuoi.png'),
('F01', 'F04', 'Viet grapfruit', '20.000', 'vbuoi.png'),
('F01', 'F05', 'Us Cherry', '120.000', 'cherry.png'),
('F01', 'F06', 'Thai lychee', '40.000', 'thailychee.png'),
('F01', 'F07', 'AUS mango', '140.000', 'umango.png'),
('F01', 'F505', 'ChinaHami', '20.000', 'hamimelon.png'),
('T01', 'T01', 'Dalat potato', '20.000', 'dalatpotato.png'),
('T01', 'T02', 'Turnip', '20.000', 'turnip.png'),
('T01', 'T03', 'China Carrot', '20.000', 'carot.png'),
('T01', 'T04', 'Sweet raddish', '20.000', 'sweetraddish.png'),
('T01', 'T05', 'purple onion', '35.000', 'purple onion.png'),
('V01', 'V01', 'Tomato', '5.000', 'vtomato.png'),
('V01', 'V02', 'Scallion', '18.000', 'scallion.png'),
('V01', 'V03', 'Cabbage', '25.000', 'cabbage.png'),
('V01', 'V04', 'White broccoli', '20.000', 'vnbroccoli.png'),
('V01', 'V05', 'Salad', '35.000', 'salad.png'),
('V01', 'V06', 'Green peas', '25.000', 'greenpeas.png');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Username`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`IDCate`),
  ADD KEY `IDCate` (`IDCate`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `IDCate` (`IDCate`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`IDCate`) REFERENCES `category` (`IDCate`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
