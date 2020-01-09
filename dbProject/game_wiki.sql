-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018 年 12 月 11 日 17:07
-- 伺服器版本: 10.1.37-MariaDB
-- PHP 版本： 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `game_wiki`
--

-- --------------------------------------------------------

--
-- 資料表結構 `card`
--

CREATE TABLE `card` (
  `Name` varchar(50) NOT NULL,
  `Website` varchar(50) NOT NULL,
  `URL` varchar(255) NOT NULL,
  `Resource` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `card`
--

INSERT INTO `card` (`Name`, `Website`, `URL`, `Resource`) VALUES
('Hearthstone', 'T客邦', 'http://gametsg.techbang.com/hs/index.php?view=deck&type=new_standard', '牌組資料庫、競技場評鑑、戰績統計、牌組製作、改版');

-- --------------------------------------------------------

--
-- 資料表結構 `fps`
--

CREATE TABLE `fps` (
  `Name` varchar(50) NOT NULL,
  `Website` varchar(50) NOT NULL,
  `URL` varchar(255) NOT NULL,
  `Resource` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fps`
--

INSERT INTO `fps` (`Name`, `Website`, `URL`, `Resource`) VALUES
('Rainbow Six', 'gamepressure', 'https://guides.gamepressure.com/tom-clancys-rainbow-six-siege/', 'Basic,Gameplay,\r\nCharacteristics of operator,Game modes\r\n');

-- --------------------------------------------------------

--
-- 資料表結構 `game`
--

CREATE TABLE `game` (
  `Name` varchar(50) NOT NULL,
  `Type` varchar(4) NOT NULL,
  `Rating` int(11) NOT NULL,
  `Resource_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `game`
--

INSERT INTO `game` (`Name`, `Type`, `Rating`, `Resource_num`) VALUES
('Hearthstone', 'CARD', 4, 2),
('Rainbow Six', 'FPS', 4, 1),
('Warframe', 'RPG', 5, 2);

-- --------------------------------------------------------

--
-- 資料表結構 `rpg`
--

CREATE TABLE `rpg` (
  `Name` varchar(50) NOT NULL,
  `Website` varchar(50) NOT NULL,
  `URL` varchar(255) NOT NULL,
  `Resource` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `rpg`
--

INSERT INTO `rpg` (`Name`, `Website`, `URL`, `Resource`) VALUES
('Warframe', '巴哈姆特', 'https://forum.gamer.com.tw/B.php?bsn=22797&subbsn=0', '情報、交易、武裝、氏族'),
('Warframe', '灰機wiki', 'https://warframe.huijiwiki.com/wiki/%E9%A6%96%E9%A1%B5', '戰甲、武器、MOD、虛空遺物、任務、ARCHWING');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`Name`,`Website`);

--
-- 資料表索引 `fps`
--
ALTER TABLE `fps`
  ADD PRIMARY KEY (`Name`,`Website`);

--
-- 資料表索引 `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`Name`);

--
-- 資料表索引 `rpg`
--
ALTER TABLE `rpg`
  ADD PRIMARY KEY (`Name`,`Website`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
