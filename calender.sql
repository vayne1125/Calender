-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-12-27 12:49:37
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `calender`
--

-- --------------------------------------------------------

--
-- 資料表結構 `event`
--

CREATE TABLE `event` (
  `event_id` bigint(20) NOT NULL,
  `item` varchar(20) NOT NULL,
  `start_time` time NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `event`
--

INSERT INTO `event` (`event_id`, `item`, `start_time`, `status`) VALUES
(1670592011167, '唱歌', '12:00:00', 0),
(1670592018772, '吃飯', '00:00:00', 0),
(1670592031140, '出去玩', '11:00:00', 0),
(1672061069404, '', '00:00:00', 0),
(1672062630086, '', '00:00:00', 0),
(1672062632007, '', '00:00:00', 0),
(1672137391770, '活動', '18:36:31', 0),
(1672137429007, '活動', '18:37:09', 0);

--
-- 觸發器 `event`
--
DELIMITER $$
CREATE TRIGGER `setInsertEventItem_trigger` BEFORE INSERT ON `event` FOR EACH ROW BEGIN
	IF NEW.item = '' THEN
    SET NEW.item = '活動';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `setInsertEventTime_trigger` BEFORE INSERT ON `event` FOR EACH ROW BEGIN
	IF NEW.start_time = '' THEN
    SET NEW.start_time =  CURTIME();
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `setUpdateEventItem_trigger` BEFORE UPDATE ON `event` FOR EACH ROW BEGIN
	IF NEW.item = '' THEN
    SET NEW.item = '活動';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `setUpdateEventTime_trigger` BEFORE UPDATE ON `event` FOR EACH ROW BEGIN
	IF NEW.start_time = '' THEN
    SET NEW.start_time =  CURTIME();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `pk_table`
--

CREATE TABLE `pk_table` (
  `pk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `pk_table`
--

INSERT INTO `pk_table` (`pk`) VALUES
(1),
(2),
(3),
(4);

-- --------------------------------------------------------

--
-- 資料表結構 `total`
--

CREATE TABLE `total` (
  `event_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `total`
--

INSERT INTO `total` (`event_id`, `date`, `user_id`) VALUES
(1670592011167, '2022-12-07', 1),
(1670592018772, '2022-12-07', 1),
(1670592031140, '2022-12-07', 1),
(1672061069404, '2022-12-26', 1),
(1672062630086, '2022-12-26', 0),
(1672062632007, '2022-12-26', 0),
(1672137391770, '2022-12-27', 1),
(1672137429007, '2022-12-27', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `account` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`account`, `password`, `user_id`) VALUES
('123', '123', 0),
('1234', '1', 1),
('qq', 'q', 2),
('1', '1', 3);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- 資料表索引 `pk_table`
--
ALTER TABLE `pk_table`
  ADD PRIMARY KEY (`pk`);

--
-- 資料表索引 `total`
--
ALTER TABLE `total`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `total_ibfk_2` (`user_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `total`
--
ALTER TABLE `total`
  ADD CONSTRAINT `total_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `total_ibfk_3` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
