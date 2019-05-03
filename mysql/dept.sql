-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2019-05-03 16:07:35
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
-- 資料表結構 `dept`
--

CREATE TABLE `dept` (
  `部門名稱` varchar(4) DEFAULT NULL,
  `部門代號` varchar(3) DEFAULT NULL,
  `主管姓名` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `dept`
--

INSERT INTO `dept` (`部門名稱`, `部門代號`, `主管姓名`) VALUES
('董事長室', 'A01', '林政賢'),
('總經理室', 'B01', '何茂宗'),
('研發一課', 'C01', '徐煥坤'),
('研發二課', 'C02', '江正維'),
('研發三課', 'C03', '易君揚'),
('業務一課', 'D01', '陳曉蘭'),
('業務二課', 'D02', '陳雅賢'),
('業務三課', 'D03', '朱金倉'),
('業務四課', 'D04', '林鵬翔'),
('採購部', 'E01', '黃大倫'),
('維修部', 'F01', '劉柏村'),
('資訊部', 'G01', '林朝財'),
('企劃部', 'H01', '程光民'),
('人事部', 'I01', '楊習仁'),
('行政部', 'J01', '許進發'),
('會計部', 'K01', '胡富傑'),
('圖書室', 'L01', '洪惠芬');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
