-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-10-20 14:52:47
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `phpbook`
--

-- --------------------------------------------------------

--
-- 資料表結構 `buy`
--

CREATE TABLE `buy` (
  `num` int(11) NOT NULL,
  `id` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `subtotal` varchar(20) NOT NULL,
  `rstate` varchar(20) NOT NULL,
  `img` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `buy`
--

INSERT INTO `buy` (`num`, `id`, `username`, `name`, `quantity`, `price`, `subtotal`, `rstate`, `img`) VALUES
(8, 'C556', '花', '純色正面鈕扣襯衫洋裝', '2', '509', '1018', '未出貨', 'images/F.jpg'),
(18, 'NOOO', '文欣', '對比色修邊紋織上衣', '3', '287', '861', '已出貨', 'images/C.jpg'),
(28, 'jungkook', '田柾國', '實色纜繩針織上衣', '3', '349', '1047', '未出貨', 'images/E.jpg'),
(29, 'A123', '林', '純色下肩雪花針織毛衣', '1', '634', '634', '未出貨', 'images/K.jpg'),
(30, 'A123', '林', '對比色修邊紋織上衣', '5', '287', '1435', '未出貨', 'images/C.jpg'),
(31, 'B222', '王', '實色纜繩針織上衣', '3', '349', '1047', '未出貨', 'images/E.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `num` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `img` varchar(50) NOT NULL,
  `state` varchar(20) NOT NULL,
  `subtotal` varchar(20) NOT NULL,
  `id` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `cart`
--

INSERT INTO `cart` (`num`, `name`, `price`, `quantity`, `img`, `state`, `subtotal`, `id`, `username`) VALUES
(155, '純色小高領', '450', '1', 'images/jpgB.jpg', '16', '450', 'C556', '花'),
(156, '實色纜繩針織上衣', '349', '2', 'images/E.jpg', '25', '698', 'C556', '花');

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `num` varchar(20) NOT NULL,
  `id` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `age` varchar(20) NOT NULL,
  `genfer` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `num` int(11) NOT NULL,
  `id` varchar(20) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `age` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`num`, `id`, `pwd`, `name`, `age`, `gender`) VALUES
(29, 'C556', '88167', '花', '13', 'female'),
(30, 'A123', '1234', '林', '40', 'male'),
(31, 'B222', '12222', '王', '32', 'male'),
(33, 'NOOO', '000000', '文欣', '25', 'female'),
(36, 'jungkook', '0901', '田柾國', '27', 'male');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `num` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `img` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`num`, `name`, `price`, `img`, `state`, `id`) VALUES
(1, '拉幾蘭袖V領毛衣', '394', 'images/A.jpg', '7', '1'),
(3, '對比色修邊紋織上衣', '287', 'images/C.jpg', '8', '1'),
(4, '純色鈕扣前雙口帶背心外套', '280', 'images/D.jpg', '12', '2'),
(5, '實色纜繩針織上衣', '349', 'images/E.jpg', '19', '2'),
(6, '純色正面鈕扣襯衫洋裝', '509', 'images/F.jpg', '20', '2'),
(7, '雙口袋單排釦西裝外套', '388', 'images/G.jpg', '11', '3'),
(8, '小香風外套', '620', 'images/H.jpg', '13', '3'),
(9, '純色下肩雪花針織毛衣', '634', 'images/K.jpg', '15', '3'),
(17, '純色小高領', '450', 'images/jpgB.jpg', '16', '1');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`num`);

--
-- 資料表索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`num`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`num`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`num`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `buy`
--
ALTER TABLE `buy`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cart`
--
ALTER TABLE `cart`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
