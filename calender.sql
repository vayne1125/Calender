-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-12-29 18:41:55
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

DELIMITER $$
--
-- 函式
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getId` () RETURNS INT(8)  BEGIN
  DECLARE cnt int(8);
  SELECT count(*) into cnt
  from user;
  RETURN cnt;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `event`
--

CREATE TABLE `event` (
  `event_id` bigint(20) NOT NULL,
  `item` varchar(20) NOT NULL,
  `start_time` time NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `type` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `event`
--

INSERT INTO `event` (`event_id`, `item`, `start_time`, `status`, `type`) VALUES
(1672332323691, '娛樂', '00:45:00', 0, '工作'),
(1672335196858, '活動', '01:33:00', 0, '工作'),
(1672335583182, '活動', '01:39:00', 0, '工作'),
(1672335648299, '活動', '01:40:48', 0, '娛樂');

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
CREATE TRIGGER `setInsertEventType_trigger` BEFORE INSERT ON `event` FOR EACH ROW BEGIN
	IF NEW.type = '' THEN
    SET NEW.type = '其他';
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
DELIMITER $$
CREATE TRIGGER `setUpdateEventType_trigger` BEFORE UPDATE ON `event` FOR EACH ROW BEGIN
	IF NEW.type = '' THEN
    SET NEW.type = '其他';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `funview`
-- (請參考以下實際畫面)
--
CREATE TABLE `funview` (
`item` varchar(20)
,`start_time` time
,`status` tinyint(1)
,`user_id` int(8)
,`event_id` bigint(20)
,`type` varchar(2)
,`date` date
);

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
(1672332323691, '2022-12-29', 4),
(1672335196858, '2022-12-29', 4),
(1672335583182, '2022-12-29', 4),
(1672335648299, '2022-12-29', 4);

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `undoitemview`
-- (請參考以下實際畫面)
--
CREATE TABLE `undoitemview` (
`user_id` int(8)
,`date` date
,`item` varchar(20)
,`start_time` time
,`type` varchar(2)
);

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
('1', '1', 3),
('kao', 'pupu', 4),
('061944', '88', 5),
('0619441', '1', 6);

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `workview`
-- (請參考以下實際畫面)
--
CREATE TABLE `workview` (
`item` varchar(20)
,`start_time` time
,`status` tinyint(1)
,`user_id` int(8)
,`event_id` bigint(20)
,`type` varchar(2)
,`date` date
);

-- --------------------------------------------------------

--
-- 檢視表結構 `funview`
--
DROP TABLE IF EXISTS `funview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `funview`  AS SELECT `event`.`item` AS `item`, `event`.`start_time` AS `start_time`, `event`.`status` AS `status`, `total`.`user_id` AS `user_id`, `event`.`event_id` AS `event_id`, `event`.`type` AS `type`, `total`.`date` AS `date` FROM (`event` join `total`) WHERE `event`.`event_id` = `total`.`event_id` AND `event`.`type` = '娛樂'  ;

-- --------------------------------------------------------

--
-- 檢視表結構 `undoitemview`
--
DROP TABLE IF EXISTS `undoitemview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `undoitemview`  AS SELECT `total`.`user_id` AS `user_id`, `total`.`date` AS `date`, `event`.`item` AS `item`, `event`.`start_time` AS `start_time`, `event`.`type` AS `type` FROM (`total` join `event`) WHERE `event`.`status` = 0 AND `total`.`event_id` = `event`.`event_id`  ;

-- --------------------------------------------------------

--
-- 檢視表結構 `workview`
--
DROP TABLE IF EXISTS `workview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `workview`  AS SELECT `event`.`item` AS `item`, `event`.`start_time` AS `start_time`, `event`.`status` AS `status`, `total`.`user_id` AS `user_id`, `event`.`event_id` AS `event_id`, `event`.`type` AS `type`, `total`.`date` AS `date` FROM (`event` join `total`) WHERE `event`.`event_id` = `total`.`event_id` AND `event`.`type` = '工作'  ;

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
