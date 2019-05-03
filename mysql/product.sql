-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2019-05-03 16:07:10
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `qdb`
--

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `產品名稱` varchar(30) DEFAULT NULL,
  `產品代號` varchar(10) DEFAULT NULL,
  `單價` int(5) DEFAULT NULL,
  `成本` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`產品名稱`, `產品代號`, `單價`, `成本`) VALUES
('486主機板VL slot *3 16MB RAM', 'MB486V3R16', 13500, 8100),
('486主機板VL slot *3 32MB RAM', 'MB486V3R32', 24600, 14500),
('486主機板PCI slot *3 16MB RAM', 'MB486P3R16', 15200, 8400),
('486主機板PCI slot *3 32MB RAM', 'MB486P3R32', 26000, 16700),
('585主機板PCI slot *3 32MB RAM', 'MB586P3R32', 32000, 19200),
('586主機板PCI slot *3 16MB RAM', 'MB586P3R16', 15500, 9200),
('586主機板VL slot *3 32MB RAM', 'MB586V3R32', 36500, 22000),
('586主機板VL slot *3 16MB RAM', 'MB586V3R16', 15200, 8780),
('586主機板EISA slot *3 32MB RAM', 'MB586E3R32', 41200, 24300),
('586主機板EISA slot *3 16MB RAM', 'MB586E3R16', 18800, 9900),
('586主機板EISA slot *7 32MB RAM', 'MB586E7R32', 42300, 24950),
('586主機板EISA slot *7 16MB RAM', 'MB586E7R16', 21500, 12000),
('SuperVGA 1280*1024 VL BUS 1MB', 'SVGAV1M', 3850, 2400),
('SuperVGA 1280*1024 VL BUS 2MB', 'SVGAV2M', 4680, 2850),
('SuperVGA 1280*1024 PCI BUS 1MB', 'SVGAP1M', 4120, 2450),
('SuperVGA 1280*1024 PCI BUS 2MB', 'SVGAP2M', 4950, 2900),
('SCSIcard PCI BUS', 'SCSIPB', 2200, 1300),
('SCSIcard VL BUS', 'SCSIVB', 1950, 1240),
('EnhanceIDE PCI BUS', 'EIDE1RP', 2200, 1250),
('EnhanceIDE VL BUS', 'EIDE2RP', 1560, 990);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;