-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 24 2019 г., 12:24
-- Версия сервера: 5.6.38-log
-- Версия PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `projekt`
--

-- --------------------------------------------------------

--
-- Структура таблицы `achievement`
--

CREATE TABLE `achievement` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `str` int(11) NOT NULL,
  `ach_undying` int(11) NOT NULL,
  `ach_coliseum` int(11) NOT NULL,
  `ach_arena` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `name` varchar(11) DEFAULT NULL,
  `text` varchar(250) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `power` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `admin_log`
--

CREATE TABLE `admin_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(250) NOT NULL,
  `ho` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `aid`
--

CREATE TABLE `aid` (
  `id` int(11) NOT NULL,
  `voln` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `ten` int(11) NOT NULL,
  `gr` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `aid_ten`
--

CREATE TABLE `aid_ten` (
  `id` int(11) NOT NULL,
  `users` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `strong` int(11) NOT NULL,
  `def` int(11) NOT NULL,
  `koef` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `aluko`
--

CREATE TABLE `aluko` (
  `id` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `max_health` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `rubin` int(11) NOT NULL,
  `dead` int(11) NOT NULL,
  `oput` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `aluko`
--

INSERT INTO `aluko` (`id`, `health`, `max_health`, `money`, `rubin`, `dead`, `oput`) VALUES
(1, 0, 195538, 1000, 10, 0, 1000);

-- --------------------------------------------------------

--
-- Структура таблицы `aluko_log`
--

CREATE TABLE `aluko_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lords` int(11) NOT NULL,
  `text` varchar(250) NOT NULL,
  `time` int(11) NOT NULL,
  `uron` int(11) NOT NULL,
  `udar` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `ank`
--

CREATE TABLE `ank` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `about` varchar(250) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `block` enum('0','1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `arena`
--

CREATE TABLE `arena` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `opponent` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `arena`
--

INSERT INTO `arena` (`id`, `user`, `opponent`, `time`) VALUES
(1, 1, 0, 1552268406),
(2, 21, 9, 1551924019),
(3, 22, 17, 1551965210),
(4, 25, 14, 1552160461);

-- --------------------------------------------------------

--
-- Структура таблицы `azart`
--

CREATE TABLE `azart` (
  `id` int(11) NOT NULL,
  `cush` int(11) NOT NULL,
  `djek` int(11) NOT NULL,
  `djek_pot` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `ban`
--

CREATE TABLE `ban` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `ip` mediumtext,
  `reason` varchar(250) NOT NULL,
  `cost` int(11) NOT NULL,
  `who` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `usr` varchar(10) NOT NULL,
  `g` int(11) NOT NULL,
  `ltime` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bank_statistic`
--

CREATE TABLE `bank_statistic` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `summa` int(11) NOT NULL,
  `type` enum('1','2') NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bank_users`
--

CREATE TABLE `bank_users` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `summa` int(11) NOT NULL,
  `vozvrat` int(11) NOT NULL,
  `type` enum('1','2') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `banned`
--

CREATE TABLE `banned` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `ip` mediumtext,
  `text` varchar(200) NOT NULL,
  `who` varchar(50) NOT NULL,
  `chat` int(11) NOT NULL DEFAULT '0',
  `forum` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bazaar`
--

CREATE TABLE `bazaar` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `1` int(11) NOT NULL DEFAULT '0',
  `2` int(11) NOT NULL DEFAULT '0',
  `3` int(11) NOT NULL DEFAULT '0',
  `4` int(11) NOT NULL DEFAULT '0',
  `5` int(11) NOT NULL DEFAULT '0',
  `6` int(11) NOT NULL DEFAULT '0',
  `7` int(11) NOT NULL DEFAULT '0',
  `8` int(11) NOT NULL DEFAULT '0',
  `9` int(11) NOT NULL DEFAULT '0',
  `10` int(11) NOT NULL DEFAULT '0',
  `11` int(11) NOT NULL DEFAULT '0',
  `12` int(12) NOT NULL DEFAULT '0',
  `skystone` int(11) NOT NULL DEFAULT '0',
  `elic1` int(11) NOT NULL DEFAULT '0',
  `luck` int(11) NOT NULL DEFAULT '0' COMMENT 'Джекпот',
  `donat` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bazaar_log`
--

CREATE TABLE `bazaar_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(250) NOT NULL,
  `time` int(11) NOT NULL,
  `koll` int(11) NOT NULL,
  `res` int(11) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Покупки на рынке';

-- --------------------------------------------------------

--
-- Структура таблицы `BB_code`
--

CREATE TABLE `BB_code` (
  `id` int(3) NOT NULL,
  `replace` varchar(255) NOT NULL,
  `what` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `blacklist`
--

CREATE TABLE `blacklist` (
  `id` int(255) NOT NULL,
  `user` int(255) NOT NULL,
  `user2` int(255) NOT NULL,
  `time` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `block`
--

CREATE TABLE `block` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `ip` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `boss`
--

CREATE TABLE `boss` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `lvl` int(11) NOT NULL,
  `sila` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `lovk` int(11) NOT NULL,
  `zashit` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `image` varchar(20) NOT NULL,
  `rub` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `boss`
--

INSERT INTO `boss` (`id`, `name`, `lvl`, `sila`, `health`, `lovk`, `zashit`, `gold`, `exp`, `image`, `rub`) VALUES
(1, 'Огненный пес', 1, 500, 1000, 300, 450, 35, 50, '1.png', 1),
(8, ' Горлум', 35, 5357, 7000, 4800, 5297, 210, 310, '5.png', 40),
(2, 'Рыцырь смерти', 5, 1000, 1500, 500, 600, 45, 75, '40.png', 5),
(3, 'Палач', 10, 1300, 1050, 960, 950, 60, 100, '15.png', 10),
(4, 'Горгулья', 15, 1650, 2000, 1200, 1700, 80, 150, '20.png', 20),
(5, 'Змей', 20, 3050, 3500, 2520, 2510, 120, 200, '25.png', 25),
(6, 'Минотавр', 25, 3500, 3850, 3550, 3600, 150, 210, '30.png', 30),
(7, 'Повелитель огня', 30, 4520, 4071, 4347, 4254, 180, 250, '40.png', 35),
(9, 'Варлорд', 40, 7000, 8000, 5000, 8000, 300, 350, '45.png', 40);

-- --------------------------------------------------------

--
-- Структура таблицы `campaign`
--

CREATE TABLE `campaign` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `kol` int(11) NOT NULL DEFAULT '3',
  `grass` int(11) NOT NULL,
  `grass_stat` int(11) NOT NULL,
  `stone` int(11) NOT NULL,
  `stone_stat` int(11) NOT NULL,
  `udar` int(11) NOT NULL DEFAULT '9',
  `boss` int(11) NOT NULL,
  `boss_stat` int(11) NOT NULL,
  `boss_hp` int(11) NOT NULL,
  `agi` int(11) NOT NULL,
  `def` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `limit` int(11) NOT NULL,
  `user_hp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `campaign`
--

INSERT INTO `campaign` (`id`, `id_user`, `status`, `kol`, `grass`, `grass_stat`, `stone`, `stone_stat`, `udar`, `boss`, `boss_stat`, `boss_hp`, `agi`, `def`, `time`, `limit`, `user_hp`) VALUES
(4, 1, 2, 2, 0, 0, 0, 0, 8, 10, 1, 9789, 1125, 1375, 1552315595, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `campaign_boss`
--

CREATE TABLE `campaign_boss` (
  `id` int(11) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `campaign_log`
--

CREATE TABLE `campaign_log` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `text` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `campaign_log`
--

INSERT INTO `campaign_log` (`id`, `id_user`, `text`) VALUES
(7, 1, 'Вы ударили <img src=\"/images/campaign/bot.png\" alt=\"Босс\">  на 211'),
(8, 1, '<img src=\"/images/campaign/bot.png\" alt=\"Босс\"><span class=\"dred\">  ударил Вас на 1340</span>'),
(9, 1, '<img src=\"/images/campaign/rip.png\" alt=\"Труп\"> <img src=\"/images/campaign/bot.png\" alt=\"Босс\"><span class=\"dred\">  убил Вас</span>');

-- --------------------------------------------------------

--
-- Структура таблицы `cave`
--

CREATE TABLE `cave` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `dawn` enum('0','1') NOT NULL DEFAULT '0',
  `res_1` int(11) NOT NULL DEFAULT '0',
  `res_1_chanse` int(11) NOT NULL DEFAULT '0',
  `res_2` int(11) NOT NULL DEFAULT '0',
  `res_2_chanse` int(11) NOT NULL DEFAULT '0',
  `res_3` int(11) NOT NULL DEFAULT '0',
  `res_3_chanse` int(11) NOT NULL DEFAULT '0',
  `gather` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cave`
--

INSERT INTO `cave` (`id`, `user`, `dawn`, `res_1`, `res_1_chanse`, `res_2`, `res_2_chanse`, `res_3`, `res_3_chanse`, `gather`, `time`) VALUES
(1, 21, '1', 0, 0, 0, 0, 0, 0, 0, 1552146515),
(2, 25, '0', 0, 0, 0, 0, 0, 0, 0, 0),
(3, 1, '1', 0, 0, 0, 0, 0, 0, 0, 1552315472);

-- --------------------------------------------------------

--
-- Структура таблицы `cavebattle`
--

CREATE TABLE `cavebattle` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `bosshp` int(11) NOT NULL,
  `start` int(11) NOT NULL DEFAULT '1',
  `end` int(11) NOT NULL,
  `step` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `cavewar`
--

CREATE TABLE `cavewar` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `timedel` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `cforum_comments`
--

CREATE TABLE `cforum_comments` (
  `id` int(11) NOT NULL,
  `topic` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `to` int(11) NOT NULL DEFAULT '0',
  `text` mediumtext,
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `cforum_sub`
--

CREATE TABLE `cforum_sub` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET cp1251 DEFAULT NULL,
  `access` enum('0','1','2') CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `cforum_topic`
--

CREATE TABLE `cforum_topic` (
  `id` int(11) NOT NULL,
  `sub` int(11) NOT NULL DEFAULT '0',
  `close` enum('0','1') CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `stick` enum('0','1') CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) CHARACTER SET cp1251 DEFAULT NULL,
  `text` text CHARACTER SET cp1251,
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `to` int(11) NOT NULL DEFAULT '0',
  `text` mediumtext,
  `time` int(11) NOT NULL DEFAULT '0',
  `read` enum('0','1') NOT NULL DEFAULT '0',
  `clan` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`id`, `user`, `to`, `text`, `time`, `read`, `clan`) VALUES
(1, 0, 0, '<span class=dgreen>Ваш клан получил 2 уровень</span>', 1552284335, '0', 7),
(2, 0, 0, '<span class=dgreen>Ваш клан получил 3 уровень</span>', 1552284354, '0', 7),
(3, 0, 0, '<span class=dgreen>Ваш клан получил 4 уровень</span>', 1552313547, '0', 7),
(4, 0, 0, '<span class=dgreen>Ваш клан получил 5 уровень</span>', 1552313548, '0', 7),
(5, 0, 0, '<span class=dgreen>Ваш клан получил 6 уровень</span>', 1552313553, '0', 7),
(6, 0, 0, '<span class=dgreen>Ваш клан получил 7 уровень</span>', 1552313553, '0', 7),
(7, 0, 0, '<span class=dgreen>Ваш клан получил 8 уровень</span>', 1552313554, '0', 7),
(8, 0, 0, '<span class=dgreen>Ваш клан получил 9 уровень</span>', 1552313564, '0', 7),
(9, 0, 0, '<span class=dgreen>Ваш клан получил 10 уровень</span>', 1552313564, '0', 7),
(10, 0, 0, '<span class=dgreen>Ваш клан получил 11 уровень</span>', 1552313564, '0', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `chest`
--

CREATE TABLE `chest` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `1` int(11) NOT NULL,
  `2` int(11) NOT NULL,
  `3` int(11) NOT NULL,
  `4` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chest`
--

INSERT INTO `chest` (`id`, `user`, `1`, `2`, `3`, `4`) VALUES
(1, 1, 0, 0, 0, 0),
(2, 2, 0, 0, 0, 0),
(3, 3, 0, 0, 0, 0),
(4, 20, 0, 0, 0, 0),
(5, 21, 0, 0, 0, 0),
(6, 22, 0, 0, 0, 0),
(7, 24, 0, 0, 0, 0),
(8, 25, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `church_req`
--

CREATE TABLE `church_req` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `ank` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `status` enum('0','1','2','3') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `clans`
--

CREATE TABLE `clans` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `clanq` varchar(100) DEFAULT NULL,
  `gerb` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '1',
  `exp` bigint(255) NOT NULL DEFAULT '0',
  `g` bigint(11) NOT NULL DEFAULT '0',
  `s` bigint(11) NOT NULL DEFAULT '0',
  `r` enum('0','1') NOT NULL DEFAULT '0',
  `rank_for_invite` enum('0','1','2','3','4') NOT NULL DEFAULT '0',
  `rank_for_delete` enum('0','1','2','3','4') NOT NULL DEFAULT '0',
  `built_1` int(11) NOT NULL DEFAULT '0',
  `built_2` int(11) NOT NULL DEFAULT '0',
  `built_2_time` int(11) NOT NULL DEFAULT '0',
  `built_3` int(11) NOT NULL DEFAULT '0',
  `built_3_time` int(11) NOT NULL DEFAULT '0',
  `clan_memb` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  `quest` int(11) NOT NULL,
  `barrack` int(11) NOT NULL DEFAULT '1',
  `infa` varchar(150) NOT NULL DEFAULT 'информации нет.',
  `cris` int(20) NOT NULL,
  `epic_hp` int(11) NOT NULL,
  `epic_boss` int(11) NOT NULL,
  `epic_war` int(11) NOT NULL,
  `epic_time` int(11) NOT NULL,
  `epic_total` int(11) NOT NULL,
  `epic_uron` int(11) NOT NULL,
  `epic_gold` int(11) NOT NULL,
  `epic_s` int(11) NOT NULL,
  `epic_exp` int(11) NOT NULL,
  `epic_run` int(11) NOT NULL,
  `arena` int(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `clans`
--

INSERT INTO `clans` (`id`, `name`, `clanq`, `gerb`, `level`, `exp`, `g`, `s`, `r`, `rank_for_invite`, `rank_for_delete`, `built_1`, `built_2`, `built_2_time`, `built_3`, `built_3_time`, `clan_memb`, `gold`, `quest`, `barrack`, `infa`, `cris`, `epic_hp`, `epic_boss`, `epic_war`, `epic_time`, `epic_total`, `epic_uron`, `epic_gold`, `epic_s`, `epic_exp`, `epic_run`, `arena`) VALUES
(7, 'jhhhh', NULL, 0, 11, 0, 0, 0, '0', '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, 1, 'информации нет.', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `clan_buff`
--

CREATE TABLE `clan_buff` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `buff` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `clan_buff`
--

INSERT INTO `clan_buff` (`id`, `level`, `buff`) VALUES
(1, 1, 4),
(2, 2, 8),
(3, 3, 12),
(4, 4, 24),
(5, 5, 28),
(6, 6, 32),
(7, 7, 36),
(8, 8, 48),
(9, 9, 52),
(10, 10, 56),
(11, 11, 60),
(12, 12, 72),
(13, 13, 76),
(14, 14, 80),
(15, 15, 84),
(16, 16, 96),
(17, 17, 100),
(18, 18, 104),
(19, 19, 108),
(20, 20, 120),
(21, 21, 124),
(22, 22, 128),
(23, 23, 132),
(24, 24, 144),
(25, 25, 148),
(26, 26, 152),
(27, 27, 156),
(28, 28, 168),
(29, 29, 172),
(30, 30, 176),
(31, 31, 180),
(32, 32, 192),
(33, 33, 196),
(34, 34, 200),
(35, 25, 200);

-- --------------------------------------------------------

--
-- Структура таблицы `clan_invite`
--

CREATE TABLE `clan_invite` (
  `id` int(11) NOT NULL,
  `clan` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `clan_journal`
--

CREATE TABLE `clan_journal` (
  `id` int(255) NOT NULL,
  `cl_id` int(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `time` int(255) NOT NULL,
  `stick` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `clan_level`
--

CREATE TABLE `clan_level` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `exp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `clan_level`
--

INSERT INTO `clan_level` (`id`, `level`, `exp`) VALUES
(1, 1, 30),
(2, 2, 58),
(3, 3, 111),
(4, 4, 210),
(5, 5, 394),
(6, 6, 732),
(7, 7, 1346),
(8, 8, 2449),
(9, 9, 4408),
(10, 10, 7846),
(11, 11, 13808),
(12, 12, 24025),
(13, 13, 42323),
(14, 14, 70249),
(15, 15, 118018),
(16, 16, 195909),
(17, 17, 321290),
(18, 18, 520489),
(19, 19, 832782),
(20, 20, 1315795),
(21, 21, 2052640),
(22, 22, 3161065),
(23, 23, 4804818),
(24, 24, 7207227),
(25, 25, 10666695),
(26, 26, 15573374),
(27, 27, 22425658),
(28, 28, 31844434),
(29, 29, 44582207),
(30, 30, 61500000),
(31, 31, 83700000),
(32, 32, 112100000),
(33, 33, 148000000),
(34, 34, 192400000),
(35, 35, 246300000),
(36, 36, 2147483647);

-- --------------------------------------------------------

--
-- Структура таблицы `clan_memb`
--

CREATE TABLE `clan_memb` (
  `id` int(11) NOT NULL,
  `clan` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `rank` enum('0','1','2','3','4') NOT NULL DEFAULT '0',
  `g` int(11) NOT NULL DEFAULT '0',
  `s` int(11) NOT NULL DEFAULT '0',
  `exp` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `last_update` int(11) NOT NULL DEFAULT '0',
  `v` int(11) NOT NULL DEFAULT '0',
  `bko` varchar(255) NOT NULL DEFAULT '0',
  `arena` int(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `clan_memb`
--

INSERT INTO `clan_memb` (`id`, `clan`, `user`, `rank`, `g`, `s`, `exp`, `time`, `last_update`, `v`, `bko`, `arena`) VALUES
(7, 7, 1, '4', 0, 0, 0, 1552284007, 1552370407, 0, '0', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `clan_msg`
--

CREATE TABLE `clan_msg` (
  `id` int(11) NOT NULL,
  `clan` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `text` mediumtext,
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `clan_msg_read`
--

CREATE TABLE `clan_msg_read` (
  `id` int(11) NOT NULL,
  `msg` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `clan_poxod`
--

CREATE TABLE `clan_poxod` (
  `id` int(11) NOT NULL,
  `user` varchar(33) NOT NULL,
  `user_id` int(11) NOT NULL,
  `clan` int(11) NOT NULL,
  `death` int(11) NOT NULL,
  `nagr` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `clan_poxod_boss`
--

CREATE TABLE `clan_poxod_boss` (
  `id` int(11) NOT NULL,
  `clan` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `max_hp` int(11) NOT NULL,
  `sila` int(11) NOT NULL,
  `zashita` int(11) NOT NULL,
  `nagr` int(11) NOT NULL,
  `etap` int(11) NOT NULL,
  `time` int(33) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `clan_poxod_klon`
--

CREATE TABLE `clan_poxod_klon` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(22) NOT NULL,
  `time_udar` int(22) NOT NULL,
  `death` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `clan_poxod_log`
--

CREATE TABLE `clan_poxod_log` (
  `id` int(11) NOT NULL,
  `user` varchar(33) NOT NULL,
  `clan` int(11) NOT NULL,
  `text` text NOT NULL,
  `death` int(11) NOT NULL,
  `time` int(33) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `clan_poxod_open`
--

CREATE TABLE `clan_poxod_open` (
  `id` int(11) NOT NULL,
  `clan` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `nagr` int(11) NOT NULL,
  `time` int(22) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `clan_rud_user`
--

CREATE TABLE `clan_rud_user` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `clan` int(11) NOT NULL DEFAULT '0',
  `gold` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `clan_rud_user`
--

INSERT INTO `clan_rud_user` (`id`, `user`, `clan`, `gold`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 1, 4, 0),
(5, 1, 5, 0),
(6, 1, 6, 0),
(7, 1, 7, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `clan_z`
--

CREATE TABLE `clan_z` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `clan` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `coliseum`
--

CREATE TABLE `coliseum` (
  `id` int(11) NOT NULL,
  `start` enum('0','1') NOT NULL DEFAULT '0',
  `end` enum('0','1') NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `coliseum_log`
--

CREATE TABLE `coliseum_log` (
  `id` int(11) NOT NULL,
  `battle` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `text` mediumtext,
  `show` int(11) NOT NULL DEFAULT '0',
  `object` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `coliseum_member`
--

CREATE TABLE `coliseum_member` (
  `id` int(11) NOT NULL,
  `battle` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `trav` int(11) NOT NULL,
  `trav_status` int(11) NOT NULL,
  `kam` int(11) NOT NULL,
  `kam_status` int(11) NOT NULL,
  `object` int(11) NOT NULL DEFAULT '0',
  `kills` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `exit` enum('0','1') NOT NULL DEFAULT '0',
  `dead` enum('0','1') NOT NULL DEFAULT '0',
  `dmg` int(11) NOT NULL,
  `stone` int(11) NOT NULL,
  `grass` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `complects`
--

CREATE TABLE `complects` (
  `id` int(11) NOT NULL,
  `quality` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT NULL,
  `w_1` int(11) NOT NULL DEFAULT '0',
  `w_2` int(11) NOT NULL DEFAULT '0',
  `w_3` int(11) NOT NULL DEFAULT '0',
  `w_4` int(11) NOT NULL DEFAULT '0',
  `w_5` int(11) NOT NULL DEFAULT '0',
  `w_6` int(11) NOT NULL DEFAULT '0',
  `w_7` int(11) NOT NULL DEFAULT '0',
  `w_8` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `complects`
--

INSERT INTO `complects` (`id`, `quality`, `name`, `w_1`, `w_2`, `w_3`, `w_4`, `w_5`, `w_6`, `w_7`, `w_8`) VALUES
(1, '1', 'Комплект воина', 9, 10, 11, 12, 13, 14, 15, 16),
(36, '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(37, '3', 'Комплект стервятника', 105, 106, 107, 108, 109, 110, 111, 112),
(34, '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(35, '3', 'Комплект паладина', 81, 82, 83, 84, 85, 86, 87, 88),
(32, '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(33, '3', 'Комплект зверобоя', 57, 58, 59, 60, 61, 62, 63, 64),
(30, '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(31, '3', 'Комплект возмездия', 49, 50, 51, 52, 53, 54, 55, 56),
(28, '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(29, '3', 'Комплект ветерана', 41, 42, 43, 44, 45, 46, 47, 48),
(26, '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(27, '2', 'Комплект рыцаря', 73, 74, 75, 76, 77, 78, 79, 80),
(24, '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(25, '2', 'Комплект искателя', 65, 66, 67, 68, 69, 70, 71, 72),
(22, '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(23, '2', 'Комплект ассасина', 33, 34, 35, 36, 37, 38, 39, 40),
(21, '1', 'Комплект охотника', 25, 26, 27, 28, 29, 30, 31, 32),
(20, '1', 'Комплект ополченца', 17, 18, 19, 20, 21, 22, 23, 24),
(38, '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(39, '3', 'Комплект стойкости', 113, 114, 115, 116, 117, 118, 119, 120),
(40, '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(41, '4', 'Комплект призрака', 89, 90, 91, 92, 93, 94, 95, 96),
(42, '4', 'Комплект скалы', 97, 98, 99, 100, 101, 102, 103, 104),
(43, '4', 'Комплект страха', 121, 122, 123, 124, 125, 126, 127, 128),
(44, '4', 'Комплект атакера', 129, 130, 131, 132, 133, 134, 135, 136),
(45, '5', 'Комплект мстителя', 202, 203, 204, 205, 206, 207, 208, 209),
(46, '5', 'Комплект инквизитора', 186, 187, 188, 189, 190, 191, 192, 193),
(47, '5', 'Комплект хранителя', 194, 195, 196, 197, 198, 199, 200, 201),
(48, '5', 'Комплект избранного', 178, 179, 180, 181, 182, 183, 184, 185),
(49, '4', 'Комплект гладиатора', 137, 138, 139, 140, 141, 142, 143, 144),
(50, '4', 'Комплект элиты', 145, 146, 147, 148, 149, 150, 151, 152),
(51, '4', 'Комплект молотобоя', 161, 162, 163, 164, 165, 166, 167, 168),
(52, '0', '', 0, 0, 0, 0, 0, 0, 0, 0),
(53, '5', 'Комплект палача', 210, 211, 212, 213, 214, 215, 216, 217),
(54, '5', 'Комплект броненосца', 314, 315, 316, 317, 318, 319, 320, 321),
(55, '6', 'Комплект луны', 306, 307, 308, 309, 310, 311, 312, 313),
(56, '6', 'Комплект анархии', 218, 219, 220, 221, 222, 223, 224, 225),
(57, '6', 'Комплект дракона', 226, 227, 228, 229, 230, 231, 232, 233),
(58, '6', 'Комплект ястреба', 250, 251, 252, 253, 254, 255, 256, 257),
(59, '6', 'Комплект осквернителя', 242, 243, 244, 245, 246, 247, 248, 249),
(60, '6', 'Комплект молнии', 234, 235, 236, 237, 238, 239, 240, 241),
(61, '6', 'Комплект циклопа', 290, 291, 292, 293, 294, 295, 296, 297),
(62, '6', 'Комплект атланта', 258, 259, 260, 261, 262, 263, 264, 265),
(70, '6', 'Комплект ярости', 440, 441, 442, 443, 444, 445, 446, 447),
(71, '6', 'Комплект жнеца', 460, 461, 462, 463, 464, 465, 466, 467),
(73, '6', 'Комплект проклятого', 274, 275, 276, 277, 278, 279, 280, 281);

-- --------------------------------------------------------

--
-- Структура таблицы `control`
--

CREATE TABLE `control` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `hp` int(11) NOT NULL,
  `hpall` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `money` varchar(10) NOT NULL,
  `control` varchar(10) NOT NULL,
  `lvl` int(11) NOT NULL,
  `mlvl` int(11) NOT NULL,
  `cena` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `cw_clans`
--

CREATE TABLE `cw_clans` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL DEFAULT '0',
  `id_clan` int(11) NOT NULL DEFAULT '0',
  `kp` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `cw_event`
--

CREATE TABLE `cw_event` (
  `id` int(11) NOT NULL,
  `start` int(11) NOT NULL DEFAULT '0',
  `end` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `cw_event`
--

INSERT INTO `cw_event` (`id`, `start`, `end`, `time`) VALUES
(1, 0, 0, 1552171320);

-- --------------------------------------------------------

--
-- Структура таблицы `cw_log`
--

CREATE TABLE `cw_log` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL DEFAULT '0',
  `text` text
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `cw_memb`
--

CREATE TABLE `cw_memb` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL DEFAULT '0',
  `id_clan` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '0',
  `hp` int(11) NOT NULL DEFAULT '0',
  `id_opponent` int(11) NOT NULL DEFAULT '0',
  `last_attack` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `dialog`
--

CREATE TABLE `dialog` (
  `id` int(11) NOT NULL,
  `uid1` int(11) NOT NULL,
  `uid2` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dialog`
--

INSERT INTO `dialog` (`id`, `uid1`, `uid2`, `time`) VALUES
(1, 21, 2, 1552145092),
(2, 2, 1, 1552263707);

-- --------------------------------------------------------

--
-- Структура таблицы `domination`
--

CREATE TABLE `domination` (
  `id` int(11) NOT NULL,
  `1` int(11) NOT NULL,
  `0` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `dragonEvent`
--

CREATE TABLE `dragonEvent` (
  `id` int(11) NOT NULL,
  `start` int(11) NOT NULL DEFAULT '0',
  `end` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `dragon` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `dragonEvent`
--

INSERT INTO `dragonEvent` (`id`, `start`, `end`, `time`, `dragon`) VALUES
(1, 0, 0, 1552152238, 15000000);

-- --------------------------------------------------------

--
-- Структура таблицы `dragonEventLog`
--

CREATE TABLE `dragonEventLog` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL DEFAULT '0',
  `text` text
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `dragonEventMemb`
--

CREATE TABLE `dragonEventMemb` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `hp` int(11) NOT NULL DEFAULT '0',
  `opponent` int(11) NOT NULL DEFAULT '0',
  `lastAttack` int(11) NOT NULL DEFAULT '0',
  `dragon` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `duel`
--

CREATE TABLE `duel` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `opponent` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `elikagi`
--

CREATE TABLE `elikagi` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `elikdef`
--

CREATE TABLE `elikdef` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `elikstr`
--

CREATE TABLE `elikstr` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `elikvit`
--

CREATE TABLE `elikvit` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `exchange`
--

CREATE TABLE `exchange` (
  `user_id` int(11) NOT NULL,
  `time` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `farm`
--

CREATE TABLE `farm` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `h` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `farm`
--

INSERT INTO `farm` (`id`, `user`, `h`, `time`) VALUES
(1, 25, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `fish`
--

CREATE TABLE `fish` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `udo4ka` int(11) NOT NULL,
  `pop` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `iznos` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `forum_comments`
--

CREATE TABLE `forum_comments` (
  `id` int(11) NOT NULL,
  `topic` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `to` int(11) NOT NULL DEFAULT '0',
  `text` mediumtext,
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forum_comments`
--

INSERT INTO `forum_comments` (`id`, `topic`, `user`, `to`, `text`, `time`) VALUES
(1, 1, 1, 0, 'asdsad', 1552316613),
(2, 1, 1, 0, 'asdasd', 1552316616),
(3, 2, 1, 0, 'asdasdsadsadsad', 1552336667);

-- --------------------------------------------------------

--
-- Структура таблицы `forum_sub`
--

CREATE TABLE `forum_sub` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `access` enum('0','1','2') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forum_sub`
--

INSERT INTO `forum_sub` (`id`, `name`, `access`) VALUES
(1, 'Новости игры', '2'),
(2, 'Помощь по игре', '0'),
(3, '\"Общение\"', '0'),
(4, 'Правила игры', '0'),
(5, 'Вопросы по оплате', '0'),
(6, 'Ошибки', '0'),
(10, '&quot;МОЙ КЛАН&quot;', '2'),
(9, 'Конкурсы', '1'),
(11, 'Должность МД', '2');

-- --------------------------------------------------------

--
-- Структура таблицы `forum_topic`
--

CREATE TABLE `forum_topic` (
  `id` int(11) NOT NULL,
  `sub` int(11) NOT NULL DEFAULT '0',
  `close` enum('0','1') NOT NULL DEFAULT '0',
  `stick` enum('0','1') NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT NULL,
  `text` mediumtext,
  `time` int(11) NOT NULL DEFAULT '0',
  `red_login` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forum_topic`
--

INSERT INTO `forum_topic` (`id`, `sub`, `close`, `stick`, `user`, `name`, `text`, `time`, `red_login`) VALUES
(1, 2, '1', '0', 1, 'asdsad', 'asdsda', 1552316408, ''),
(2, 2, '0', '0', 1, 'asdasdaыыffaass', 'asdasdsadsadsadasdffыыffaass', 1552316666, '');

-- --------------------------------------------------------

--
-- Структура таблицы `friends`
--

CREATE TABLE `friends` (
  `id` int(255) NOT NULL,
  `user` int(255) NOT NULL,
  `user2` int(255) NOT NULL,
  `time` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gifts`
--

CREATE TABLE `gifts` (
  `id_user` mediumtext NOT NULL,
  `ot_id` mediumtext NOT NULL,
  `text` text NOT NULL,
  `time` text NOT NULL,
  `id_gifts` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `hellworld`
--

CREATE TABLE `hellworld` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `img` varchar(55) NOT NULL,
  `preview` varchar(55) NOT NULL,
  `hp` int(11) NOT NULL,
  `str_min` int(11) NOT NULL,
  `str_max` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `quality` int(11) NOT NULL,
  `respawn` int(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `hellworld_action`
--

CREATE TABLE `hellworld_action` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `creature` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `max_hp` int(11) NOT NULL,
  `str_min` int(11) NOT NULL,
  `str_max` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `hellworld_info`
--

CREATE TABLE `hellworld_info` (
  `boss_name` varchar(24) NOT NULL,
  `dmg` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `hellworld_logs`
--

CREATE TABLE `hellworld_logs` (
  `id` int(11) NOT NULL,
  `action` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `dmg` int(11) NOT NULL,
  `usery` int(11) NOT NULL,
  `text` varchar(55) NOT NULL,
  `dead` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `hellworld_reward`
--

CREATE TABLE `hellworld_reward` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `exp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `hellworld_rewards`
--

CREATE TABLE `hellworld_rewards` (
  `id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `g` int(11) NOT NULL,
  `s` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `hellworld_user`
--

CREATE TABLE `hellworld_user` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `creature` int(11) NOT NULL,
  `respawn` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `inv`
--

CREATE TABLE `inv` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `item` int(11) NOT NULL DEFAULT '0',
  `quality` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0',
  `bonus` int(11) NOT NULL DEFAULT '0',
  `smith` int(11) NOT NULL DEFAULT '0',
  `equip` enum('0','1') NOT NULL DEFAULT '0',
  `new` enum('0','1') NOT NULL DEFAULT '0',
  `rune` enum('0','1','2','3','4','5') NOT NULL DEFAULT '0',
  `_str` int(11) NOT NULL DEFAULT '0',
  `_vit` int(11) NOT NULL DEFAULT '0',
  `_agi` int(11) NOT NULL DEFAULT '0',
  `_def` int(11) NOT NULL DEFAULT '0',
  `place` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `inv`
--

INSERT INTO `inv` (`id`, `user`, `item`, `quality`, `bonus`, `smith`, `equip`, `new`, `rune`, `_str`, `_vit`, `_agi`, `_def`, `place`) VALUES
(1, 22, 75, '2', 10, 0, '0', '1', '0', 45, 45, 45, 45, '0'),
(2, 22, 37, '2', 10, 0, '0', '1', '0', 45, 45, 45, 45, '0'),
(3, 25, 20, '1', 5, 0, '0', '1', '1', 31, 31, 106, 31, '0'),
(4, 25, 38, '2', 10, 0, '0', '1', '1', 120, 45, 45, 45, '0'),
(5, 25, 13, '1', 5, 0, '0', '1', '1', 106, 31, 31, 31, '0'),
(6, 1, 37, '2', 10, 0, '1', '1', '0', 45, 45, 45, 45, '0'),
(9, 1, 18, '1', 5, 0, '1', '1', '0', 31, 31, 31, 31, '0'),
(10, 1, 75, '2', 10, 0, '1', '1', '0', 45, 45, 45, 45, '0'),
(11, 1, 62, '2', 10, 0, '1', '1', '0', 52, 52, 52, 52, '0'),
(12, 1, 23, '0', 5, 0, '1', '1', '0', 31, 31, 31, 31, '0');

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `w` enum('1','2','3','4','5','6','7','8') NOT NULL DEFAULT '1',
  `name` varchar(100) DEFAULT NULL,
  `quality` enum('0','1','2','3','4','5','6','7') NOT NULL DEFAULT '0',
  `skill` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `w`, `name`, `quality`, `skill`) VALUES
(1, '1', 'Шлем бродяги', '0', 0),
(2, '2', 'Наплечник бродяги', '0', 0),
(3, '3', 'Рубашка бродяги', '0', 0),
(4, '4', 'Перчатки бродяги', '0', 0),
(5, '5', 'Щит бродяги', '0', 0),
(6, '6', 'Нож бродяги', '0', 0),
(7, '7', 'Штаны бродяги', '0', 0),
(8, '8', 'Ботинки бродяги', '0', 0),
(9, '1', 'Шлем воина', '1', 1),
(10, '2', 'Наплечник воина', '1', 1),
(11, '3', 'Броня воина', '1', 1),
(12, '4', 'Перчатки воина', '1', 1),
(13, '5', 'Щит воина', '1', 1),
(14, '6', 'Меч воина', '1', 1),
(15, '7', 'Штаны воина', '1', 1),
(16, '8', 'Сапоги воина', '1', 1),
(17, '1', 'Шлем ополченца', '1', 1),
(18, '2', 'Наплечник ополченца', '1', 1),
(19, '3', 'Броня ополченца', '1', 1),
(20, '4', 'Перчатки ополченца', '1', 1),
(21, '5', 'Щит ополченца', '1', 1),
(22, '6', 'Топор ополченца', '1', 1),
(23, '7', 'Штаны ополченца', '1', 1),
(24, '8', 'Сапоги ополченца', '1', 1),
(25, '1', 'Маска охотника', '1', 1),
(26, '2', 'Наплечник охотника', '1', 1),
(27, '3', 'Броня охотника', '1', 1),
(28, '4', 'Перчатки охотника', '1', 1),
(29, '5', 'Катар охотника инь', '1', 1),
(30, '6', 'Катар охотника янь', '1', 1),
(31, '7', 'Штаны охотника', '1', 1),
(32, '8', 'Сапоги охотника', '1', 1),
(33, '1', 'Шлем ассасина', '2', 10),
(34, '2', 'Наплечник ассасина', '2', 10),
(35, '3', 'Броня ассасина', '2', 10),
(36, '4', 'Перчатки ассасина', '2', 10),
(37, '5', 'Веер ассасина инь', '2', 10),
(38, '6', 'Веер ассасина инь', '2', 10),
(39, '7', 'Штаны ассасина', '2', 10),
(40, '8', 'Сапоги ассасина', '2', 10),
(41, '1', 'Шлем ветерана', '3', 24),
(42, '2', 'Наплечник ветерана', '3', 24),
(43, '3', 'Броня ветерана', '3', 24),
(44, '4', 'Перчатки ветерана', '3', 24),
(45, '5', 'Щит ветерана', '3', 24),
(46, '6', 'Топор ветерана', '3', 24),
(47, '7', 'Штаны ветерана', '3', 24),
(48, '8', 'Сапоги ветерана', '3', 24),
(49, '1', 'Шлем возмездия', '3', 24),
(50, '2', 'Наплечник возмездия', '3', 24),
(51, '3', 'Броня возмездия', '3', 24),
(52, '4', 'Перчатки возмездия', '3', 24),
(53, '5', 'Меч возмездия инь', '3', 24),
(54, '6', 'Меч возмездия янь', '3', 24),
(55, '7', 'Штаны возмездия', '3', 24),
(56, '8', 'Сапоги возмездия', '3', 24),
(57, '1', 'Шлем зверобоя', '3', 24),
(58, '2', 'Наплечник зверобоя', '3', 24),
(59, '3', 'Броня зверобоя', '3', 24),
(60, '4', 'Перчатки зверобоя', '3', 24),
(61, '5', 'Щит зверобоя', '3', 24),
(62, '6', 'Меч зверобоя', '3', 24),
(63, '7', 'Штаны зверобоя', '3', 24),
(64, '8', 'Сапоги зверобоя', '3', 24),
(65, '1', 'Шлем искателя', '2', 10),
(66, '2', 'Наплечник искателя', '2', 10),
(67, '3', 'Броня искателя', '2', 10),
(68, '4', 'Перчатки искателя', '2', 10),
(69, '5', 'Коготь искателя инь', '2', 10),
(70, '6', 'Коготь искателя янь', '2', 10),
(71, '7', 'Штаны искател', '2', 10),
(72, '8', 'Сапоги искателя', '2', 10),
(73, '1', 'Шлем рыцаря', '2', 10),
(74, '2', 'Наплечник рыцаря', '2', 10),
(75, '3', 'Броня рыцаря', '2', 10),
(76, '4', 'Перчатки рыцаря', '2', 10),
(77, '5', 'Щит рыцаря', '2', 10),
(78, '6', 'Топор рыцаря', '2', 10),
(79, '7', 'Штаны рыцаря', '2', 10),
(80, '8', 'Сапоги рыцаря', '2', 10),
(81, '1', 'Шлем паладина', '3', 24),
(82, '2', 'Наплечник паладина', '3', 24),
(83, '3', 'Броня паладина', '3', 24),
(84, '4', 'Перчатки паладина', '3', 24),
(85, '5', 'Меч паладина инь', '3', 24),
(86, '6', 'Меч паладина янь', '3', 24),
(87, '7', 'Штаны паладина', '3', 24),
(88, '8', 'Сапоги паладина', '3', 24),
(89, '1', 'Шлем призрака', '4', 48),
(90, '2', 'Наплечник призрака', '4', 48),
(91, '3', 'Броня призрака', '4', 48),
(92, '4', 'Перчатки призрака', '4', 48),
(93, '5', 'Когти призрака инь', '4', 48),
(94, '6', 'Когти призрака янь', '4', 48),
(95, '7', 'Штаны призрака', '4', 48),
(96, '8', 'Сапоги призрака', '4', 48),
(97, '1', 'Шлем скалы', '4', 48),
(98, '2', 'Наплечник скалы', '4', 48),
(99, '3', 'Броня скалы', '4', 48),
(100, '4', 'Перчатки скалы', '4', 48),
(101, '5', 'Щит скалы', '4', 48),
(102, '6', 'Тесак скалы', '4', 48),
(103, '7', 'Штаны скалы', '4', 48),
(104, '8', 'Сапоги скалы', '4', 48),
(105, '1', 'Шлем стервятника', '3', 24),
(106, '2', 'Наплечники стервятника', '3', 24),
(107, '3', 'Броня стервятника', '3', 24),
(108, '4', 'Перчатки стервятника', '3', 24),
(109, '5', 'Клинок стервятника инь', '3', 24),
(110, '6', 'Клинок стервятника янь', '3', 24),
(111, '7', 'Штаны стервятника', '3', 24),
(112, '8', 'Сапоги стервятника', '3', 24),
(113, '1', 'Шлем стойкости', '3', 24),
(114, '2', 'Наплечник стойкости', '3', 24),
(115, '3', 'Броня стойкости', '3', 24),
(116, '4', 'Перчатки стойкости', '3', 24),
(117, '5', 'Щит стойкости', '3', 24),
(118, '6', 'Топор стойкости', '3', 24),
(120, '8', 'Сапоги стойкости', '3', 24),
(119, '7', 'Штаны стойкости', '3', 24),
(121, '1', 'Шлем страха', '4', 48),
(122, '2', 'Наплечник страха', '4', 48),
(123, '3', 'Броня страха', '4', 48),
(124, '4', 'Перчатки страха', '4', 48),
(125, '5', 'Меч страха инь', '4', 48),
(126, '6', 'Меч страха янь', '4', 48),
(127, '7', 'Штаны страха', '4', 48),
(128, '8', 'Сапоги страха', '4', 48),
(129, '1', 'Шлем атакера', '4', 48),
(130, '2', 'Наплечник атакера', '4', 48),
(131, '3', 'Броня атакера', '4', 48),
(132, '4', 'Перчатки атакера', '4', 48),
(133, '5', 'Щит атакера', '4', 48),
(134, '6', 'Меч атакера', '4', 48),
(135, '7', 'Штаны атакера', '4', 48),
(136, '8', 'Сапоги атакера', '4', 48),
(137, '1', 'Шлем гладиатора', '4', 48),
(138, '2', 'Наплечник гладиатора', '4', 48),
(139, '3', 'Броня гладиатора', '4', 48),
(140, '4', 'Перчатки гладиатора', '4', 48),
(141, '5', 'Меч гладиатора инь', '4', 48),
(142, '6', 'Меч гладиатора янь', '4', 48),
(143, '7', 'Штаны гладиатора', '4', 48),
(144, '8', 'Сапоги гладиатора', '4', 48),
(145, '1', 'Шлем элиты', '4', 48),
(146, '2', 'Наплечник элиты', '4', 48),
(147, '3', 'Броня элиты', '4', 48),
(148, '4', 'Перчатки элиты', '4', 48),
(149, '5', 'Щит элиты', '4', 48),
(150, '6', 'Меч элиты', '4', 48),
(151, '7', 'Штаны элиты', '4', 48),
(152, '8', 'Сапоги элиты', '4', 48),
(161, '1', 'Шлем молотобоя', '4', 48),
(162, '2', 'Наплечник молотобоя', '4', 48),
(163, '3', 'Броня молотобоя', '4', 48),
(164, '4', 'Перчатки молотобоя', '4', 48),
(165, '5', 'Молот молотобоя инь', '4', 48),
(166, '6', 'Молот молотобоя янь', '4', 48),
(167, '7', 'Штаны молотобоя', '4', 48),
(168, '8', 'Сапоги молотобоя', '4', 48),
(169, '1', 'Маска тени', '4', 48),
(170, '2', 'Наплечник тени', '4', 48),
(171, '3', 'Броня тени', '4', 48),
(172, '4', 'Перчатки тени', '4', 48),
(173, '5', 'Зубья тени инь', '4', 48),
(174, '6', 'Зубья тени янь', '4', 48),
(175, '7', 'Штаны тени', '4', 48),
(176, '8', 'Сапоги тени', '4', 48),
(178, '1', 'Шлем избранного', '5', 200),
(179, '2', 'Наплечник избранного', '5', 200),
(180, '3', 'Броня избранного', '5', 200),
(181, '4', 'Перчатки избранного', '5', 200),
(182, '5', 'Меч избранного инь', '5', 200),
(183, '6', 'Меч избранного янь', '5', 200),
(184, '7', 'Штаны избранного', '5', 200),
(185, '8', 'Сапоги избранного', '5', 200),
(186, '1', 'Шлем инквизитора', '5', 200),
(187, '2', 'Наплечник инквизитора', '5', 200),
(188, '3', 'Кираса инквизитора', '5', 200),
(189, '4', 'Перчатки инквизитора', '5', 200),
(190, '5', 'Щит инквизитора', '5', 200),
(191, '6', 'Меч инквизитора', '5', 200),
(192, '7', 'Штаны инквизитора', '5', 200),
(193, '8', 'Сапоги инквизитора', '5', 200),
(194, '1', 'Шлем хранителя', '5', 200),
(195, '2', 'Наплечник хранителя', '5', 200),
(196, '3', 'Броня хранителя', '5', 200),
(197, '4', 'Перчатки хранителя', '5', 200),
(198, '5', 'Щит хранителя', '5', 200),
(199, '6', 'Меч хранителя', '5', 200),
(200, '7', 'Штаны хранителя', '5', 200),
(201, '8', 'Сапоги хранителя', '5', 200),
(202, '1', 'Шлем мстителя', '5', 200),
(203, '2', 'Наплечник мстителя', '5', 200),
(204, '3', 'Броня мстителя', '5', 200),
(205, '4', 'Перчатки мстителя', '5', 200),
(206, '5', 'Меч мстителя инь', '5', 200),
(207, '6', 'Меч мстителя янь', '5', 200),
(208, '7', 'Штаны мстителя', '5', 200),
(209, '8', 'Сапоги мстителя', '5', 200),
(210, '1', 'Шлем палача', '5', 200),
(211, '2', 'Наплечник палача', '5', 200),
(212, '3', 'Кираса палача', '5', 200),
(213, '4', 'Перчатки палача', '5', 200),
(214, '5', 'Шипастый круг палача', '5', 200),
(215, '6', 'Топор палача', '5', 200),
(216, '7', 'Штаны палача', '5', 200),
(217, '8', 'Сапоги палача', '5', 200),
(218, '1', 'Шлем анархии', '6', 200),
(219, '2', 'Наплечник анархии', '6', 200),
(220, '3', 'Броня анархии', '6', 200),
(221, '4', 'Перчатки анархии', '6', 200),
(222, '5', 'Щит анархии', '6', 200),
(223, '6', 'Посох анархии', '6', 200),
(224, '7', 'Штаны анархии', '6', 200),
(225, '8', 'Сапоги анархии', '6', 200),
(226, '1', 'Шлем дракона', '6', 200),
(227, '2', 'Наплечник дракона', '6', 200),
(228, '3', 'Броня дракона', '6', 200),
(229, '4', 'Перчатки дракона', '6', 200),
(230, '5', 'Коса дракона инь', '6', 200),
(231, '6', 'Коса дракона янь', '6', 200),
(232, '7', 'Штаны дракона', '6', 200),
(233, '8', 'Сапоги дракона', '6', 200),
(234, '1', 'Шлем молнии', '6', 200),
(235, '2', 'Наплечник молнии', '6', 200),
(236, '3', 'Броня молнии', '6', 200),
(237, '4', 'Перчатки молнии', '6', 200),
(238, '5', 'Меч молнии инь', '6', 200),
(239, '6', 'Меч молнии янь', '6', 200),
(240, '7', 'Штаны молнии', '6', 200),
(241, '8', 'Сапоги молнии', '6', 200),
(242, '1', 'Шлем осквернителя', '6', 200),
(243, '2', 'Наплечник осквернителя', '6', 200),
(244, '3', 'Броня осквернителя', '6', 200),
(245, '4', 'Перчатки осквернителя', '6', 200),
(246, '5', 'Щит осквернителя', '6', 200),
(247, '6', 'Меч осквернителя', '6', 200),
(248, '7', 'Штаны осквернителя', '6', 200),
(249, '8', 'Сапоги осквернителя', '6', 200),
(250, '1', 'Шлем ястреба', '6', 200),
(251, '2', 'Наплечник ястреба', '6', 200),
(252, '3', 'Броня ястреба', '6', 200),
(253, '4', 'Перчатки ястреба', '6', 200),
(254, '5', 'Арбалет ястреба инь', '6', 200),
(255, '6', 'Арбалет ястреба янь', '6', 200),
(256, '7', 'Штаны ястреба', '6', 200),
(257, '8', 'Сапоги ястреба', '6', 200),
(258, '1', 'Шлем атланта', '6', 200),
(259, '2', 'Наплечник атланта', '6', 200),
(260, '3', 'Броня атланта', '6', 200),
(261, '4', 'Перчатки атланта', '6', 200),
(262, '5', 'Щит атланта', '6', 200),
(263, '6', 'Молот атланта', '6', 200),
(264, '7', 'Штаны атланта', '6', 200),
(265, '8', 'Сапоги атланта', '6', 200),
(266, '1', 'Шлем эльфийца', '6', 200),
(267, '2', 'Наплечник эльфийца', '6', 200),
(268, '3', 'Броня эльфийца', '6', 200),
(269, '4', 'Перчатки эльфийца', '6', 200),
(270, '5', 'Клинок эльфийца инь', '6', 200),
(271, '6', 'Клинок эльфийца янь', '6', 200),
(272, '7', 'Штаны эльфийца', '6', 200),
(273, '8', 'Сапоги эльфийца', '6', 200),
(274, '1', 'Шлем проклятого', '6', 200),
(275, '2', 'Наплечник проклятого', '6', 200),
(276, '3', 'Доспех проклятого', '6', 200),
(277, '4', 'Перчатки проклятого', '6', 200),
(278, '5', 'Щит проклятого', '6', 200),
(279, '6', 'Молот проклятого', '6', 200),
(280, '7', 'Штаны проклятого', '6', 200),
(281, '8', 'Сапоги проклятого', '6', 200),
(282, '1', 'Шлем солнца', '6', 200),
(283, '2', 'Наплечник солнца', '6', 200),
(284, '3', 'Доспех солнца', '6', 200),
(285, '4', 'Перчатки солнца', '6', 200),
(286, '5', 'Клинок солнца инь', '6', 200),
(287, '6', 'Клинок солнца янь', '6', 200),
(288, '7', 'Штаны солнца', '6', 200),
(289, '8', 'Сапоги солнца', '6', 200),
(290, '1', 'Шлем циклопа', '6', 200),
(291, '2', 'Наплечник циклопа', '6', 200),
(292, '3', 'Доспех циклопа', '6', 200),
(293, '4', 'Перчатки циклопа', '6', 200),
(294, '5', 'Щит циклопа', '6', 200),
(295, '6', 'Меч циклопа', '6', 200),
(296, '7', 'Штаны циклопа', '6', 200),
(297, '8', 'Сапоги циклопа', '6', 200),
(298, '1', 'Шлем олимпийца', '5', 200),
(299, '2', 'Наплечник олимпийца', '5', 200),
(300, '3', 'Броня олимпийца', '5', 200),
(301, '4', 'Перчатки олимпийца', '5', 200),
(302, '5', 'Щит олимпийца', '5', 200),
(303, '6', 'Меч олимпийца', '5', 200),
(304, '7', 'Штаны олимпийца', '5', 200),
(305, '8', 'Сапоги олимпийца', '5', 200),
(306, '1', 'Шлем луны', '5', 200),
(307, '2', 'Наплечник луны', '5', 200),
(308, '3', 'Броня луны', '5', 200),
(309, '4', 'Перчатки луны', '5', 200),
(310, '5', 'Щит луны', '5', 200),
(311, '6', 'Меч луны', '5', 200),
(312, '7', 'Штаны луны', '5', 200),
(313, '8', 'Сапоги луны', '5', 200),
(177, '5', 'Автомат Калашникова', '4', 48),
(314, '1', 'Шлем броненосца', '5', 200),
(315, '2', 'Наплечник броненосца', '5', 200),
(316, '3', 'Броня Броненосца', '5', 200),
(317, '4', 'Перчатки Броненосца', '5', 200),
(318, '5', 'Щит Броненосца', '5', 200),
(319, '6', 'Меч Броненосца', '5', 200),
(320, '7', 'Штаны Броненосца', '5', 200),
(321, '8', 'Сапоги Броненосца', '5', 200),
(440, '1', 'Шлем ярости', '5', 250),
(441, '2', 'Наплечники ярости', '6', 250),
(442, '3', 'Броня ярости', '6', 250),
(443, '4', 'Перчатки ярости', '6', 250),
(446, '7', 'Штаны ярости', '6', 250),
(447, '8', 'Сапоги ярости', '6', 250),
(444, '5', 'Меч ярости', '6', 250),
(445, '6', 'Меч ярости', '6', 250),
(460, '1', 'Шлем жнеца', '6', 250),
(461, '2', 'Наплечник жнеца', '6', 250),
(462, '3', 'Броня жнеца', '6', 250),
(463, '4', 'Перчатки жнеца', '6', 250),
(464, '5', 'Коса жнеца инь', '6', 250),
(465, '6', 'Коса жнеца янь', '6', 250),
(466, '7', 'Штаны жнеца ', '6', 250),
(467, '8', 'Сапоги жнеца ', '6', 250),
(600, '1', 'Шлем армейца', '7', 25),
(601, '2', 'Наплечник армейца', '7', 25),
(602, '3', 'Рубашка армейца', '7', 25),
(603, '4', 'Перчатки армейца', '7', 25),
(604, '5', 'АК-47', '7', 25),
(605, '6', 'Пулемёт армейца', '7', 25),
(606, '7', 'Штаны армейца', '7', 25),
(607, '8', 'Сапоги армейца', '7', 25);

-- --------------------------------------------------------

--
-- Структура таблицы `jour`
--

CREATE TABLE `jour` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `journal`
--

CREATE TABLE `journal` (
  `id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(500) NOT NULL,
  `time` int(11) NOT NULL,
  `read` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `kamni`
--

CREATE TABLE `kamni` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `metal` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `king`
--

CREATE TABLE `king` (
  `id` int(11) NOT NULL,
  `time` int(11) NOT NULL DEFAULT '0',
  `end` enum('0','1') NOT NULL DEFAULT '0',
  `start` enum('0','1') NOT NULL DEFAULT '0',
  `opponents` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `king_member`
--

CREATE TABLE `king_member` (
  `id` int(11) NOT NULL,
  `battle` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `dead` enum('0','1') NOT NULL DEFAULT '0',
  `exit` enum('0','1') NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `kills` int(11) NOT NULL DEFAULT '0',
  `dmg` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `lair`
--

CREATE TABLE `lair` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `lair_fight` int(11) NOT NULL,
  `lair_check` enum('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20') NOT NULL DEFAULT '1',
  `lair_sila` int(11) NOT NULL,
  `lair_lovk` int(11) NOT NULL,
  `lair_def` int(11) NOT NULL,
  `lair_hp` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `lair_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `time` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL,
  `uid1` int(11) NOT NULL,
  `uid2` int(11) NOT NULL,
  `proch` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mail`
--

INSERT INTO `mail` (`id`, `uid1`, `uid2`, `proch`, `text`, `time`) VALUES
(6, 2, 1, 1, 'Поздравляем вы достигли уровня 11. Награда: <img src=\"/images/icon/gold.png\"/> 55 золота!', 1552263715),
(5, 2, 1, 1, 'Поздравляем вы достигли уровня 10. Награда: <img src=\"/images/icon/gold.png\"/> 50 золота!', 1552263707),
(7, 2, 1, 1, 'Поздравляем вы достигли уровня 12. Награда: <img src=\"/images/icon/gold.png\"/> 60 золота!', 1552263725),
(8, 2, 1, 1, 'Поздравляем вы достигли уровня 13. Награда: <img src=\"/images/icon/gold.png\"/> 65 золота!', 1552267312),
(9, 2, 1, 1, 'Поздравляем вы достигли уровня 14. Награда: <img src=\"/images/icon/gold.png\"/> 70 золота!', 1552268130),
(10, 2, 1, 1, 'Поздравляем вы достигли уровня 15. Награда: <img src=\"/images/icon/gold.png\"/> 75 золота!', 1552268417);

-- --------------------------------------------------------

--
-- Структура таблицы `maneken`
--

CREATE TABLE `maneken` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `w_1` int(11) NOT NULL DEFAULT '0',
  `w_2` int(11) NOT NULL DEFAULT '0',
  `w_3` int(11) NOT NULL DEFAULT '0',
  `w_4` int(11) NOT NULL DEFAULT '0',
  `w_5` int(11) NOT NULL DEFAULT '0',
  `w_6` int(11) NOT NULL DEFAULT '0',
  `w_7` int(11) NOT NULL DEFAULT '0',
  `w_8` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `maneken`
--

INSERT INTO `maneken` (`id`, `user`, `w_1`, `w_2`, `w_3`, `w_4`, `w_5`, `w_6`, `w_7`, `w_8`) VALUES
(1, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 21, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 35, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 40, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 61, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 64, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 84, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 107, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 131, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 166, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 175, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 176, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 177, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 171, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 200, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 199, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 202, 0, 0, 0, 0, 0, 0, 0, 0),
(19, 201, 0, 0, 0, 0, 0, 0, 0, 0),
(20, 205, 0, 0, 0, 0, 0, 0, 0, 0),
(21, 206, 0, 0, 0, 0, 0, 0, 0, 0),
(22, 214, 0, 0, 0, 0, 0, 0, 0, 0),
(23, 244, 0, 0, 0, 0, 0, 0, 0, 0),
(24, 236, 0, 0, 0, 0, 0, 0, 0, 0),
(25, 248, 0, 0, 0, 0, 0, 0, 0, 0),
(26, 231, 0, 0, 0, 0, 0, 0, 0, 0),
(27, 255, 0, 0, 0, 0, 0, 0, 0, 0),
(28, 256, 0, 0, 0, 0, 0, 0, 0, 0),
(29, 249, 0, 0, 0, 0, 0, 0, 0, 0),
(30, 237, 0, 0, 0, 0, 0, 0, 0, 0),
(31, 270, 0, 0, 0, 0, 0, 0, 0, 0),
(32, 229, 0, 0, 0, 0, 0, 0, 0, 0),
(33, 273, 0, 0, 0, 0, 0, 0, 0, 0),
(34, 267, 0, 0, 0, 0, 0, 0, 0, 0),
(35, 277, 0, 0, 0, 0, 0, 0, 0, 0),
(36, 264, 0, 0, 0, 0, 0, 0, 0, 0),
(37, 16, 0, 0, 0, 0, 0, 0, 0, 0),
(38, 192, 0, 0, 0, 0, 0, 0, 0, 0),
(39, 313, 0, 0, 0, 0, 0, 0, 0, 0),
(40, 228, 0, 0, 0, 0, 0, 0, 0, 0),
(41, 282, 0, 0, 0, 0, 0, 0, 0, 0),
(42, 322, 0, 0, 0, 0, 0, 0, 0, 0),
(43, 289, 0, 0, 0, 0, 0, 0, 0, 0),
(44, 258, 0, 0, 0, 0, 0, 0, 0, 0),
(45, 363, 0, 0, 0, 0, 0, 0, 0, 0),
(46, 367, 0, 0, 0, 0, 0, 0, 0, 0),
(47, 369, 0, 0, 0, 0, 0, 0, 0, 0),
(48, 379, 0, 0, 0, 0, 0, 0, 0, 0),
(49, 382, 0, 0, 0, 0, 0, 0, 0, 0),
(50, 386, 0, 0, 0, 0, 0, 0, 0, 0),
(51, 319, 0, 0, 0, 0, 0, 0, 0, 0),
(52, 390, 0, 0, 0, 0, 0, 0, 0, 0),
(53, 385, 0, 0, 0, 0, 0, 0, 0, 0),
(54, 396, 0, 0, 0, 0, 0, 0, 0, 0),
(55, 402, 0, 0, 0, 0, 0, 0, 0, 0),
(56, 399, 0, 0, 0, 0, 0, 0, 0, 0),
(57, 408, 0, 0, 0, 0, 0, 0, 0, 0),
(58, 409, 0, 0, 0, 0, 0, 0, 0, 0),
(59, 410, 0, 0, 0, 0, 0, 0, 0, 0),
(60, 412, 0, 0, 0, 0, 0, 0, 0, 0),
(61, 413, 0, 0, 0, 0, 0, 0, 0, 0),
(62, 416, 0, 0, 0, 0, 0, 0, 0, 0),
(63, 418, 0, 0, 0, 0, 0, 0, 0, 0),
(64, 420, 0, 0, 0, 0, 0, 0, 0, 0),
(65, 283, 0, 0, 0, 0, 0, 0, 0, 0),
(66, 424, 0, 0, 0, 0, 0, 0, 0, 0),
(67, 422, 0, 0, 0, 0, 0, 0, 0, 0),
(68, 429, 0, 0, 0, 0, 0, 0, 0, 0),
(69, 431, 0, 0, 0, 0, 0, 0, 0, 0),
(70, 365, 0, 0, 0, 0, 0, 0, 0, 0),
(71, 433, 0, 0, 0, 0, 0, 0, 0, 0),
(72, 435, 0, 0, 0, 0, 0, 0, 0, 0),
(73, 394, 0, 0, 0, 0, 0, 0, 0, 0),
(74, 438, 0, 0, 0, 0, 0, 0, 0, 0),
(75, 445, 0, 0, 0, 0, 0, 0, 0, 0),
(76, 415, 0, 0, 0, 0, 0, 0, 0, 0),
(77, 459, 0, 0, 0, 0, 0, 0, 0, 0),
(78, 462, 0, 0, 0, 0, 0, 0, 0, 0),
(79, 481, 0, 0, 0, 0, 0, 0, 0, 0),
(80, 487, 0, 0, 0, 0, 0, 0, 0, 0),
(81, 488, 0, 0, 0, 0, 0, 0, 0, 0),
(82, 486, 0, 0, 0, 0, 0, 0, 0, 0),
(83, 375, 0, 0, 0, 0, 0, 0, 0, 0),
(84, 491, 0, 0, 0, 0, 0, 0, 0, 0),
(85, 518, 0, 0, 0, 0, 0, 0, 0, 0),
(86, 299, 0, 0, 0, 0, 0, 0, 0, 0),
(87, 461, 0, 0, 0, 0, 0, 0, 0, 0),
(88, 493, 0, 0, 0, 0, 0, 0, 0, 0),
(89, 529, 0, 0, 0, 0, 0, 0, 0, 0),
(90, 546, 0, 0, 0, 0, 0, 0, 0, 0),
(91, 441, 0, 0, 0, 0, 0, 0, 0, 0),
(92, 376, 0, 0, 0, 0, 0, 0, 0, 0),
(93, 537, 0, 0, 0, 0, 0, 0, 0, 0),
(94, 366, 0, 0, 0, 0, 0, 0, 0, 0),
(95, 562, 0, 0, 0, 0, 0, 0, 0, 0),
(96, 565, 0, 0, 0, 0, 0, 0, 0, 0),
(97, 548, 0, 0, 0, 0, 0, 0, 0, 0),
(98, 477, 0, 0, 0, 0, 0, 0, 0, 0),
(99, 442, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 606, 0, 0, 0, 0, 0, 0, 0, 0),
(101, 609, 0, 0, 0, 0, 0, 0, 0, 0),
(102, 624, 0, 0, 0, 0, 0, 0, 0, 0),
(103, 641, 0, 0, 0, 0, 0, 0, 0, 0),
(104, 642, 0, 0, 0, 0, 0, 0, 0, 0),
(105, 646, 0, 0, 0, 0, 0, 0, 0, 0),
(106, 652, 0, 0, 0, 0, 0, 0, 0, 0),
(107, 658, 0, 0, 0, 0, 0, 0, 0, 0),
(108, 656, 0, 0, 0, 0, 0, 0, 0, 0),
(109, 661, 0, 0, 0, 0, 0, 0, 0, 0),
(110, 576, 0, 0, 0, 0, 0, 0, 0, 0),
(111, 687, 0, 0, 0, 0, 0, 0, 0, 0),
(112, 688, 0, 0, 0, 0, 0, 0, 0, 0),
(113, 515, 0, 0, 0, 0, 0, 0, 0, 0),
(114, 571, 0, 0, 0, 0, 0, 0, 0, 0),
(115, 221, 0, 0, 0, 0, 0, 0, 0, 0),
(116, 684, 0, 0, 0, 0, 0, 0, 0, 0),
(117, 374, 0, 0, 0, 0, 0, 0, 0, 0),
(118, 706, 0, 0, 0, 0, 0, 0, 0, 0),
(119, 713, 0, 0, 0, 0, 0, 0, 0, 0),
(120, 550, 0, 0, 0, 0, 0, 0, 0, 0),
(121, 731, 0, 0, 0, 0, 0, 0, 0, 0),
(122, 712, 0, 0, 0, 0, 0, 0, 0, 0),
(123, 722, 0, 0, 0, 0, 0, 0, 0, 0),
(124, 738, 0, 0, 0, 0, 0, 0, 0, 0),
(125, 747, 0, 0, 0, 0, 0, 0, 0, 0),
(126, 754, 0, 0, 0, 0, 0, 0, 0, 0),
(127, 724, 0, 0, 0, 0, 0, 0, 0, 0),
(128, 725, 0, 0, 0, 0, 0, 0, 0, 0),
(129, 510, 0, 0, 0, 0, 0, 0, 0, 0),
(130, 764, 0, 0, 0, 0, 0, 0, 0, 0),
(131, 726, 0, 0, 0, 0, 0, 0, 0, 0),
(132, 727, 0, 0, 0, 0, 0, 0, 0, 0),
(133, 767, 0, 0, 0, 0, 0, 0, 0, 0),
(134, 780, 0, 0, 0, 0, 0, 0, 0, 0),
(135, 788, 0, 0, 0, 0, 0, 0, 0, 0),
(136, 285, 0, 0, 0, 0, 0, 0, 0, 0),
(137, 792, 0, 0, 0, 0, 0, 0, 0, 0),
(138, 718, 0, 0, 0, 0, 0, 0, 0, 0),
(139, 698, 0, 0, 0, 0, 0, 0, 0, 0),
(140, 801, 0, 0, 0, 0, 0, 0, 0, 0),
(141, 809, 0, 0, 0, 0, 0, 0, 0, 0),
(142, 808, 0, 0, 0, 0, 0, 0, 0, 0),
(143, 775, 0, 0, 0, 0, 0, 0, 0, 0),
(144, 812, 0, 0, 0, 0, 0, 0, 0, 0),
(145, 834, 0, 0, 0, 0, 0, 0, 0, 0),
(146, 833, 0, 0, 0, 0, 0, 0, 0, 0),
(147, 842, 0, 0, 0, 0, 0, 0, 0, 0),
(148, 843, 0, 0, 0, 0, 0, 0, 0, 0),
(149, 822, 0, 0, 0, 0, 0, 0, 0, 0),
(150, 830, 0, 0, 0, 0, 0, 0, 0, 0),
(151, 856, 0, 0, 0, 0, 0, 0, 0, 0),
(152, 848, 0, 0, 0, 0, 0, 0, 0, 0),
(153, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(154, 873, 0, 0, 0, 0, 0, 0, 0, 0),
(155, 878, 0, 0, 0, 0, 0, 0, 0, 0),
(156, 883, 0, 0, 0, 0, 0, 0, 0, 0),
(157, 909, 0, 0, 0, 0, 0, 0, 0, 0),
(158, 914, 0, 0, 0, 0, 0, 0, 0, 0),
(159, 937, 0, 0, 0, 0, 0, 0, 0, 0),
(160, 938, 0, 0, 0, 0, 0, 0, 0, 0),
(161, 947, 0, 0, 0, 0, 0, 0, 0, 0),
(162, 879, 0, 0, 0, 0, 0, 0, 0, 0),
(163, 976, 0, 0, 0, 0, 0, 0, 0, 0),
(164, 964, 0, 0, 0, 0, 0, 0, 0, 0),
(165, 810, 0, 0, 0, 0, 0, 0, 0, 0),
(166, 984, 0, 0, 0, 0, 0, 0, 0, 0),
(167, 978, 0, 0, 0, 0, 0, 0, 0, 0),
(168, 991, 0, 0, 0, 0, 0, 0, 0, 0),
(169, 1000, 0, 0, 0, 0, 0, 0, 0, 0),
(170, 926, 0, 0, 0, 0, 0, 0, 0, 0),
(171, 1025, 0, 0, 0, 0, 0, 0, 0, 0),
(172, 1039, 0, 0, 0, 0, 0, 0, 0, 0),
(173, 985, 0, 0, 0, 0, 0, 0, 0, 0),
(174, 1055, 0, 0, 0, 0, 0, 0, 0, 0),
(175, 1067, 0, 0, 0, 0, 0, 0, 0, 0),
(176, 1079, 0, 0, 0, 0, 0, 0, 0, 0),
(177, 1004, 0, 0, 0, 0, 0, 0, 0, 0),
(178, 1083, 0, 0, 0, 0, 0, 0, 0, 0),
(179, 1091, 0, 0, 0, 0, 0, 0, 0, 0),
(180, 1096, 0, 0, 0, 0, 0, 0, 0, 0),
(181, 1086, 0, 0, 0, 0, 0, 0, 0, 0),
(182, 996, 0, 0, 0, 0, 0, 0, 0, 0),
(183, 1127, 0, 0, 0, 0, 0, 0, 0, 0),
(184, 1082, 0, 0, 0, 0, 0, 0, 0, 0),
(185, 1151, 0, 0, 0, 0, 0, 0, 0, 0),
(186, 1146, 0, 0, 0, 0, 0, 0, 0, 0),
(187, 1150, 0, 0, 0, 0, 0, 0, 0, 0),
(188, 1063, 0, 0, 0, 0, 0, 0, 0, 0),
(189, 1143, 0, 0, 0, 0, 0, 0, 0, 0),
(190, 1158, 0, 0, 0, 0, 0, 0, 0, 0),
(191, 1164, 0, 0, 0, 0, 0, 0, 0, 0),
(192, 1050, 0, 0, 0, 0, 0, 0, 0, 0),
(193, 1175, 0, 0, 0, 0, 0, 0, 0, 0),
(194, 203, 0, 0, 0, 0, 0, 0, 0, 0),
(195, 998, 0, 0, 0, 0, 0, 0, 0, 0),
(196, 1085, 0, 0, 0, 0, 0, 0, 0, 0),
(197, 1194, 0, 0, 0, 0, 0, 0, 0, 0),
(198, 1142, 0, 0, 0, 0, 0, 0, 0, 0),
(199, 1163, 0, 0, 0, 0, 0, 0, 0, 0),
(200, 1201, 0, 0, 0, 0, 0, 0, 0, 0),
(201, 1216, 0, 0, 0, 0, 0, 0, 0, 0),
(202, 1206, 0, 0, 0, 0, 0, 0, 0, 0),
(203, 1114, 0, 0, 0, 0, 0, 0, 0, 0),
(204, 1219, 0, 0, 0, 0, 0, 0, 0, 0),
(205, 852, 0, 0, 0, 0, 0, 0, 0, 0),
(206, 1125, 0, 0, 0, 0, 0, 0, 0, 0),
(207, 1236, 0, 0, 0, 0, 0, 0, 0, 0),
(208, 1242, 0, 0, 0, 0, 0, 0, 0, 0),
(209, 1247, 0, 0, 0, 0, 0, 0, 0, 0),
(210, 1240, 0, 0, 0, 0, 0, 0, 0, 0),
(211, 1193, 0, 0, 0, 0, 0, 0, 0, 0),
(212, 1262, 0, 0, 0, 0, 0, 0, 0, 0),
(213, 1267, 0, 0, 0, 0, 0, 0, 0, 0),
(214, 1250, 0, 0, 0, 0, 0, 0, 0, 0),
(215, 1238, 0, 0, 0, 0, 0, 0, 0, 0),
(216, 1277, 0, 0, 0, 0, 0, 0, 0, 0),
(217, 1281, 0, 0, 0, 0, 0, 0, 0, 0),
(218, 1174, 0, 0, 0, 0, 0, 0, 0, 0),
(219, 1295, 0, 0, 0, 0, 0, 0, 0, 0),
(220, 1301, 0, 0, 0, 0, 0, 0, 0, 0),
(221, 1298, 0, 0, 0, 0, 0, 0, 0, 0),
(222, 1300, 0, 0, 0, 0, 0, 0, 0, 0),
(223, 450, 0, 0, 0, 0, 0, 0, 0, 0),
(224, 1316, 0, 0, 0, 0, 0, 0, 0, 0),
(225, 1220, 0, 0, 0, 0, 0, 0, 0, 0),
(226, 1347, 0, 0, 0, 0, 0, 0, 0, 0),
(227, 1350, 0, 0, 0, 0, 0, 0, 0, 0),
(228, 1344, 0, 0, 0, 0, 0, 0, 0, 0),
(229, 1357, 0, 0, 0, 0, 0, 0, 0, 0),
(230, 1369, 0, 0, 0, 0, 0, 0, 0, 0),
(231, 1382, 0, 0, 0, 0, 0, 0, 0, 0),
(232, 1398, 0, 0, 0, 0, 0, 0, 0, 0),
(233, 1362, 0, 0, 0, 0, 0, 0, 0, 0),
(234, 1412, 0, 0, 0, 0, 0, 0, 0, 0),
(235, 1370, 0, 0, 0, 0, 0, 0, 0, 0),
(236, 1407, 0, 0, 0, 0, 0, 0, 0, 0),
(237, 1432, 0, 0, 0, 0, 0, 0, 0, 0),
(238, 1437, 0, 0, 0, 0, 0, 0, 0, 0),
(239, 934, 0, 0, 0, 0, 0, 0, 0, 0),
(240, 1447, 0, 0, 0, 0, 0, 0, 0, 0),
(241, 1122, 0, 0, 0, 0, 0, 0, 0, 0),
(242, 1384, 0, 0, 0, 0, 0, 0, 0, 0),
(243, 1305, 0, 0, 0, 0, 0, 0, 0, 0),
(244, 180, 0, 0, 0, 0, 0, 0, 0, 0),
(245, 1077, 0, 0, 0, 0, 0, 0, 0, 0),
(246, 1481, 0, 0, 0, 0, 0, 0, 0, 0),
(247, 1359, 0, 0, 0, 0, 0, 0, 0, 0),
(248, 1487, 0, 0, 0, 0, 0, 0, 0, 0),
(249, 1484, 0, 0, 0, 0, 0, 0, 0, 0),
(250, 1497, 0, 0, 0, 0, 0, 0, 0, 0),
(251, 1381, 0, 0, 0, 0, 0, 0, 0, 0),
(252, 908, 0, 0, 0, 0, 0, 0, 0, 0),
(253, 17782, 0, 0, 0, 0, 0, 0, 0, 0),
(254, 1533, 0, 0, 0, 0, 0, 0, 0, 0),
(255, 17803, 0, 0, 0, 0, 0, 0, 0, 0),
(256, 17776, 0, 0, 0, 0, 0, 0, 0, 0),
(257, 1531, 0, 0, 0, 0, 0, 0, 0, 0),
(258, 17808, 0, 0, 0, 0, 0, 0, 0, 0),
(259, 1502, 0, 0, 0, 0, 0, 0, 0, 0),
(260, 702, 0, 0, 0, 0, 0, 0, 0, 0),
(261, 17814, 0, 0, 0, 0, 0, 0, 0, 0),
(262, 17827, 0, 0, 0, 0, 0, 0, 0, 0),
(263, 17816, 0, 0, 0, 0, 0, 0, 0, 0),
(264, 17855, 0, 0, 0, 0, 0, 0, 0, 0),
(265, 682, 0, 0, 0, 0, 0, 0, 0, 0),
(266, 17859, 0, 0, 0, 0, 0, 0, 0, 0),
(267, 17846, 0, 0, 0, 0, 0, 0, 0, 0),
(268, 1123, 0, 0, 0, 0, 0, 0, 0, 0),
(269, 17839, 0, 0, 0, 0, 0, 0, 0, 0),
(270, 17881, 0, 0, 0, 0, 0, 0, 0, 0),
(271, 17895, 0, 0, 0, 0, 0, 0, 0, 0),
(272, 17917, 0, 0, 0, 0, 0, 0, 0, 0),
(273, 17885, 0, 0, 0, 0, 0, 0, 0, 0),
(274, 17847, 0, 0, 0, 0, 0, 0, 0, 0),
(275, 17946, 0, 0, 0, 0, 0, 0, 0, 0),
(276, 17961, 0, 0, 0, 0, 0, 0, 0, 0),
(277, 17894, 0, 0, 0, 0, 0, 0, 0, 0),
(278, 17791, 0, 0, 0, 0, 0, 0, 0, 0),
(279, 17944, 0, 0, 0, 0, 0, 0, 0, 0),
(280, 17988, 0, 0, 0, 0, 0, 0, 0, 0),
(281, 18005, 0, 0, 0, 0, 0, 0, 0, 0),
(282, 17998, 0, 0, 0, 0, 0, 0, 0, 0),
(283, 18009, 0, 0, 0, 0, 0, 0, 0, 0),
(284, 17924, 0, 0, 0, 0, 0, 0, 0, 0),
(285, 17880, 0, 0, 0, 0, 0, 0, 0, 0),
(286, 18040, 0, 0, 0, 0, 0, 0, 0, 0),
(287, 18052, 0, 0, 0, 0, 0, 0, 0, 0),
(288, 18071, 0, 0, 0, 0, 0, 0, 0, 0),
(289, 18086, 0, 0, 0, 0, 0, 0, 0, 0),
(290, 17811, 0, 0, 0, 0, 0, 0, 0, 0),
(291, 18095, 0, 0, 0, 0, 0, 0, 0, 0),
(292, 18094, 0, 0, 0, 0, 0, 0, 0, 0),
(293, 18099, 0, 0, 0, 0, 0, 0, 0, 0),
(294, 17972, 0, 0, 0, 0, 0, 0, 0, 0),
(295, 18109, 0, 0, 0, 0, 0, 0, 0, 0),
(296, 18111, 0, 0, 0, 0, 0, 0, 0, 0),
(297, 18115, 0, 0, 0, 0, 0, 0, 0, 0),
(298, 18122, 0, 0, 0, 0, 0, 0, 0, 0),
(299, 1494, 0, 0, 0, 0, 0, 0, 0, 0),
(300, 18141, 0, 0, 0, 0, 0, 0, 0, 0),
(301, 18155, 0, 0, 0, 0, 0, 0, 0, 0),
(302, 17954, 0, 0, 0, 0, 0, 0, 0, 0),
(303, 11, 0, 0, 0, 0, 0, 0, 0, 0),
(304, 18, 0, 0, 0, 0, 0, 0, 0, 0),
(305, 111, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `mobs`
--

CREATE TABLE `mobs` (
  `id` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `str` int(11) NOT NULL,
  `attack` int(11) NOT NULL,
  `battle` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `dead` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_chat`
--

CREATE TABLE `mod_chat` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `to` int(11) NOT NULL DEFAULT '0',
  `text` text,
  `time` int(11) NOT NULL DEFAULT '0',
  `read` enum('0','1') NOT NULL DEFAULT '0',
  `clan` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `monst`
--

CREATE TABLE `monst` (
  `id` int(11) NOT NULL,
  `info` varchar(50) NOT NULL DEFAULT 'Отключено',
  `health` int(11) NOT NULL,
  `max_health` int(11) NOT NULL,
  `g` int(11) NOT NULL,
  `s` int(11) NOT NULL,
  `dead` int(11) NOT NULL,
  `exp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `monst`
--

INSERT INTO `monst` (`id`, `info`, `health`, `max_health`, `g`, `s`, `dead`, `exp`) VALUES
(1, 'Отключено', 0, 1000000, 5000000, 5000000, 0, 10000000);

-- --------------------------------------------------------

--
-- Структура таблицы `monst_log`
--

CREATE TABLE `monst_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lords` int(11) NOT NULL,
  `text` varchar(250) NOT NULL,
  `time` int(11) NOT NULL,
  `uron` int(11) NOT NULL,
  `udar` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mor`
--

CREATE TABLE `mor` (
  `id` int(11) NOT NULL,
  `etap` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `ter_1` int(11) NOT NULL,
  `ter_2` int(11) NOT NULL,
  `ter_3` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `text` text NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news_comm`
--

CREATE TABLE `news_comm` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(20) NOT NULL,
  `news` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news_go`
--

CREATE TABLE `news_go` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `news` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `news_status`
--

CREATE TABLE `news_status` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `news` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `msg` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news_status_read`
--

CREATE TABLE `news_status_read` (
  `id` int(11) NOT NULL,
  `msg` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `online`
--

CREATE TABLE `online` (
  `usr` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `laikas` int(20) DEFAULT NULL,
  `lvl` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `party`
--

CREATE TABLE `party` (
  `id` int(11) NOT NULL,
  `leader` int(11) NOT NULL,
  `dungeon` int(11) NOT NULL,
  `start` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pet`
--

CREATE TABLE `pet` (
  `id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `screen` varchar(255) NOT NULL,
  `cena` int(11) NOT NULL,
  `vit` int(11) NOT NULL,
  `str` int(11) NOT NULL,
  `agi` int(11) NOT NULL,
  `def` int(11) NOT NULL,
  `mana` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `pet`
--

INSERT INTO `pet` (`id`, `name`, `screen`, `cena`, `vit`, `str`, `agi`, `def`, `mana`) VALUES
(1, 'Дракон', '1.png', 500, 100, 100, 100, 100, 100),
(2, 'Гидра', '2.png', 500, 100, 100, 100, 100, 100),
(3, 'Цербер', '3.png', 500, 100, 100, 100, 100, 100),
(4, 'Тигр и Пантера', '4.png', 500, 100, 100, 100, 100, 100);

-- --------------------------------------------------------

--
-- Структура таблицы `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `images` varchar(250) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `crov` int(11) DEFAULT '1',
  `str` int(12) DEFAULT NULL,
  `vit` int(12) DEFAULT NULL,
  `agi` int(12) DEFAULT NULL,
  `def` int(12) DEFAULT NULL,
  `lvl` int(11) NOT NULL DEFAULT '1',
  `img` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pets_shop`
--

CREATE TABLE `pets_shop` (
  `id` int(11) NOT NULL,
  `images` varchar(250) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `str` int(12) DEFAULT NULL,
  `vit` int(12) DEFAULT NULL,
  `agi` int(12) DEFAULT NULL,
  `def` int(12) DEFAULT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pets_sxvatki`
--

CREATE TABLE `pets_sxvatki` (
  `id` int(11) NOT NULL,
  `start` enum('0','1') NOT NULL DEFAULT '0',
  `end` enum('0','1') NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `pets_sxvatki_log`
--

CREATE TABLE `pets_sxvatki_log` (
  `id` int(11) NOT NULL,
  `battle` int(11) NOT NULL DEFAULT '0',
  `pet` int(11) NOT NULL DEFAULT '0',
  `text` text,
  `show` int(11) NOT NULL DEFAULT '0',
  `object` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `pets_sxvatki_member`
--

CREATE TABLE `pets_sxvatki_member` (
  `id` int(11) NOT NULL,
  `battle` int(11) NOT NULL DEFAULT '0',
  `pet` int(11) NOT NULL DEFAULT '0',
  `object` int(11) NOT NULL DEFAULT '0',
  `kills` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `exit` enum('0','1') NOT NULL DEFAULT '0',
  `dead` enum('0','1') NOT NULL DEFAULT '0',
  `hp` int(11) NOT NULL,
  `skr` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `pets_tj`
--

CREATE TABLE `pets_tj` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `img` varchar(155) NOT NULL,
  `str` int(11) NOT NULL,
  `vit` int(11) NOT NULL,
  `agi` int(11) NOT NULL,
  `def` int(11) NOT NULL,
  `g` int(11) NOT NULL,
  `s` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pet_u`
--

CREATE TABLE `pet_u` (
  `id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `screen` varchar(255) NOT NULL,
  `lvl_str` int(11) NOT NULL,
  `lvl_vit` int(11) NOT NULL,
  `lvl_agi` int(11) NOT NULL,
  `lvl_def` int(11) NOT NULL,
  `lvl_mana` int(11) NOT NULL,
  `vit` int(11) NOT NULL,
  `str` int(11) NOT NULL,
  `agi` int(11) NOT NULL,
  `def` int(11) NOT NULL,
  `mana` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `pit`
--

CREATE TABLE `pit` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `sila` int(10) DEFAULT '0',
  `heart` int(10) DEFAULT '0',
  `ud` int(10) DEFAULT '0',
  `bron` int(10) DEFAULT '0',
  `mana` int(10) DEFAULT '0',
  `pit_id` int(10) UNSIGNED NOT NULL,
  `level` int(12) DEFAULT '1',
  `img` varchar(200) NOT NULL DEFAULT 'pet.png',
  `name` varchar(200) NOT NULL DEFAULT 'Дракон'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pitomec`
--

CREATE TABLE `pitomec` (
  `id` int(11) NOT NULL,
  `city` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rasa` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hp` int(11) NOT NULL,
  `hpall` int(11) NOT NULL,
  `sila` int(11) NOT NULL,
  `prot` int(11) NOT NULL,
  `pgolova` int(11) NOT NULL,
  `pbody` int(11) NOT NULL,
  `pnogi` int(11) NOT NULL,
  `antikrit` int(11) NOT NULL,
  `krit` int(11) NOT NULL,
  `ukrit` int(11) NOT NULL,
  `lovk` int(11) NOT NULL,
  `umin` int(11) NOT NULL,
  `umax` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `klas` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `pit_item`
--

CREATE TABLE `pit_item` (
  `id` int(11) NOT NULL,
  `usr` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pit` int(11) NOT NULL,
  `tip` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cena` int(11) NOT NULL,
  `umin` int(11) NOT NULL,
  `umax` int(11) NOT NULL,
  `pgolova` int(11) NOT NULL,
  `pbody` int(11) NOT NULL,
  `pnogi` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `krit` int(11) NOT NULL,
  `ukrit` int(11) NOT NULL,
  `antikrit` int(11) NOT NULL,
  `sila` int(11) NOT NULL,
  `lovk` int(11) NOT NULL,
  `rasa` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nlvl` int(11) NOT NULL,
  `image` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ur` int(11) NOT NULL,
  `images` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `pit_mag`
--

CREATE TABLE `pit_mag` (
  `id` int(11) NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `cena` int(12) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pit_shop`
--

CREATE TABLE `pit_shop` (
  `id` int(11) NOT NULL,
  `city` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tip` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cena` int(11) NOT NULL,
  `umin` int(11) NOT NULL,
  `umax` int(11) NOT NULL,
  `pgolova` int(11) NOT NULL,
  `pbody` int(11) NOT NULL,
  `pnogi` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `krit` int(11) NOT NULL,
  `ukrit` int(11) NOT NULL,
  `antikrit` int(11) NOT NULL,
  `sila` int(11) NOT NULL,
  `lovk` int(11) NOT NULL,
  `rasa` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nlvl` int(11) NOT NULL,
  `ur` int(11) NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `pnv`
--

CREATE TABLE `pnv` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `gemt` int(11) NOT NULL DEFAULT '0',
  `quality` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0',
  `bonus` int(11) NOT NULL DEFAULT '0',
  `smith` int(11) NOT NULL DEFAULT '0',
  `equip` enum('0','1') NOT NULL DEFAULT '0',
  `new` enum('0','1') NOT NULL DEFAULT '0',
  `rune` enum('0','1','2','3','4','5') NOT NULL DEFAULT '0',
  `_str` int(11) NOT NULL DEFAULT '0',
  `_vit` int(11) NOT NULL DEFAULT '0',
  `_agi` int(11) NOT NULL DEFAULT '0',
  `_def` int(11) NOT NULL DEFAULT '0',
  `place` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `podarok`
--

CREATE TABLE `podarok` (
  `id` int(11) NOT NULL,
  `id_us` int(11) NOT NULL,
  `day1` varchar(3) NOT NULL,
  `day2` varchar(3) NOT NULL,
  `day3` varchar(3) NOT NULL,
  `day4` varchar(3) NOT NULL,
  `day5` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `premium`
--

CREATE TABLE `premium` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `presents`
--

CREATE TABLE `presents` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `present_boss`
--

CREATE TABLE `present_boss` (
  `id` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `mhp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `profesion`
--

CREATE TABLE `profesion` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `prof_farm` int(11) NOT NULL DEFAULT '0',
  `prof_cave` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `pvp_event`
--

CREATE TABLE `pvp_event` (
  `id` int(11) NOT NULL,
  `start` int(11) NOT NULL DEFAULT '0',
  `end` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `pvp_log`
--

CREATE TABLE `pvp_log` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL DEFAULT '0',
  `text` text
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `pvp_memb`
--

CREATE TABLE `pvp_memb` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL DEFAULT '0',
  `team` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '0',
  `hp` int(11) NOT NULL DEFAULT '0',
  `last_opponent` int(11) NOT NULL DEFAULT '0',
  `last_attack` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `quest`
--

CREATE TABLE `quest` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `place` int(11) NOT NULL DEFAULT '0',
  `c` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `_gold` int(11) NOT NULL DEFAULT '0',
  `_plat` int(11) NOT NULL DEFAULT '0',
  `_exp` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `quest`
--

INSERT INTO `quest` (`id`, `title`, `description`, `place`, `c`, `type`, `_gold`, `_plat`, `_exp`) VALUES
(1, 'Только победы!', 'Победи противников на арене 10 раз подряд', 1, 10, 0, 2, 490, 37),
(3, 'Бои на арене', 'Проведи 5 боев на арене', 1, 5, 0, 2, 330, 29),
(4, 'Дуэли', 'Проведи 2 боя в дуэлях', 3, 2, 0, 2, 330, 29),
(6, 'Дуэлитян', 'Проведи 15 боёв в дуэлях', 3, 15, 0, 20, 330, 400),
(7, 'Поиск ресурсов', 'Найди 1 ресурс в пещере', 5, 1, 1, 2, 330, 29),
(8, 'Гладиатор', 'Проведи 3 боя в колизее', 6, 3, 0, 1, 420, 27),
(9, 'Жажда крови!', 'Убей 5 врагов в долине бессмертных', 7, 5, 1, 0, 1240, 0),
(10, 'Легенда арены', 'Победи противников на арене 125 раз ', 1, 125, 0, 50, 2000, 370),
(11, 'Чемпион', 'Проведи 10 боя в колизее', 6, 10, 0, 10, 720, 270);

-- --------------------------------------------------------

--
-- Структура таблицы `ref`
--

CREATE TABLE `ref` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `ho` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `relict`
--

CREATE TABLE `relict` (
  `id` int(11) NOT NULL,
  `usr` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `a1` int(1) NOT NULL,
  `a2` int(1) NOT NULL,
  `a3` int(1) NOT NULL,
  `a4` int(1) NOT NULL,
  `b1` int(1) NOT NULL,
  `b2` int(1) NOT NULL,
  `b3` int(1) NOT NULL,
  `b4` int(1) NOT NULL,
  `c1` int(1) NOT NULL,
  `c2` int(1) NOT NULL,
  `c3` int(1) NOT NULL,
  `c4` int(1) NOT NULL,
  `d1` int(1) NOT NULL,
  `d2` int(1) NOT NULL,
  `d3` int(1) NOT NULL,
  `d4` int(1) NOT NULL,
  `e1` int(1) NOT NULL,
  `e2` int(1) NOT NULL,
  `e3` int(1) NOT NULL,
  `e4` int(1) NOT NULL,
  `f1` int(1) NOT NULL,
  `f2` int(1) NOT NULL,
  `f3` int(1) NOT NULL,
  `f4` int(1) NOT NULL,
  `g1` int(1) NOT NULL,
  `g2` int(1) NOT NULL,
  `g3` int(1) NOT NULL,
  `g4` int(1) NOT NULL,
  `h1` int(1) NOT NULL,
  `h2` int(1) NOT NULL,
  `h3` int(1) NOT NULL,
  `h4` int(1) NOT NULL,
  `i1` int(1) NOT NULL,
  `i2` int(1) NOT NULL,
  `i3` int(1) NOT NULL,
  `i4` int(1) NOT NULL,
  `j1` int(1) NOT NULL,
  `j2` int(1) NOT NULL,
  `j3` int(1) NOT NULL,
  `j4` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `relict`
--

INSERT INTO `relict` (`id`, `usr`, `a1`, `a2`, `a3`, `a4`, `b1`, `b2`, `b3`, `b4`, `c1`, `c2`, `c3`, `c4`, `d1`, `d2`, `d3`, `d4`, `e1`, `e2`, `e3`, `e4`, `f1`, `f2`, `f3`, `f4`, `g1`, `g2`, `g3`, `g4`, `h1`, `h2`, `h3`, `h4`, `i1`, `i2`, `i3`, `i4`, `j1`, `j2`, `j3`, `j4`) VALUES
(1, 'Admin', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'Aleks1122', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'Aleks1123', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'lohin', 1, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'Solex', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `res`
--

CREATE TABLE `res` (
  `id` int(11) NOT NULL,
  `usr` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lat_name` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tip` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `what` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `give` varchar(400) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kol` int(11) NOT NULL,
  `cena` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `revolt`
--

CREATE TABLE `revolt` (
  `id` int(11) NOT NULL,
  `time_start` int(11) NOT NULL,
  `start` int(1) NOT NULL DEFAULT '0',
  `end` int(1) NOT NULL DEFAULT '0',
  `time_left` int(11) NOT NULL,
  `kill_boss` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `revolt`
--

INSERT INTO `revolt` (`id`, `time_start`, `start`, `end`, `time_left`, `kill_boss`) VALUES
(1, 1552149000, 0, 0, 1552149900, 0),
(2, 1552291200, 0, 0, 1552292100, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `revolt_logs`
--

CREATE TABLE `revolt_logs` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `time` int(11) NOT NULL,
  `revolt` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `revolt_member`
--

CREATE TABLE `revolt_member` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `revolt` int(11) NOT NULL,
  `dead` int(1) NOT NULL,
  `cooldown` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `kill` int(11) NOT NULL,
  `nagrada` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `revolt_member`
--

INSERT INTO `revolt_member` (`id`, `user`, `revolt`, `dead`, `cooldown`, `target`, `kill`, `nagrada`) VALUES
(1, 21, 1, 0, 0, 0, 0, 0),
(2, 1, 2, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `revolt_mobs`
--

CREATE TABLE `revolt_mobs` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `revolt` int(11) NOT NULL,
  `str` int(11) NOT NULL,
  `def` int(11) NOT NULL,
  `agi` int(11) NOT NULL,
  `max_hp` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `dead` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sack`
--

CREATE TABLE `sack` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `1` int(11) NOT NULL DEFAULT '0',
  `2` int(11) NOT NULL DEFAULT '0',
  `3` int(11) NOT NULL DEFAULT '0',
  `4` int(11) NOT NULL DEFAULT '0',
  `5` int(11) NOT NULL DEFAULT '0',
  `6` int(11) NOT NULL DEFAULT '0',
  `7` int(11) NOT NULL DEFAULT '0',
  `8` int(11) NOT NULL DEFAULT '0',
  `9` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `sack`
--

INSERT INTO `sack` (`id`, `user`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`) VALUES
(1, 21, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 25, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `set`
--

CREATE TABLE `set` (
  `id` int(11) NOT NULL,
  `usr` varchar(35) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(35) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vip` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `viptime` int(11) NOT NULL DEFAULT '0',
  `avatar` varchar(29) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `quality` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0',
  `bonus` int(11) NOT NULL DEFAULT '0',
  `cost` int(11) NOT NULL DEFAULT '0',
  `_str` int(11) NOT NULL DEFAULT '0',
  `_vit` int(11) NOT NULL DEFAULT '0',
  `_agi` int(11) NOT NULL DEFAULT '0',
  `_def` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `shop`
--

INSERT INTO `shop` (`id`, `quality`, `bonus`, `cost`, `_str`, `_vit`, `_agi`, `_def`) VALUES
(9, '1', 5, 10, 31, 31, 31, 31),
(10, '1', 5, 10, 31, 31, 31, 31),
(11, '1', 5, 10, 31, 31, 31, 31),
(12, '1', 5, 10, 31, 31, 31, 31),
(13, '1', 5, 10, 31, 31, 31, 31),
(14, '1', 5, 10, 31, 31, 31, 31),
(15, '1', 5, 10, 31, 31, 31, 31),
(16, '1', 5, 10, 31, 31, 31, 31),
(198, '5', 10, 2000, 120, 120, 120, 120),
(199, '5', 10, 2000, 120, 120, 120, 120),
(17, '1', 5, 10, 31, 31, 31, 31),
(18, '1', 5, 10, 31, 31, 31, 31),
(19, '1', 5, 10, 31, 31, 31, 31),
(20, '1', 5, 10, 31, 31, 31, 31),
(21, '1', 5, 10, 31, 31, 31, 31),
(22, '1', 5, 10, 31, 31, 31, 31),
(23, '1', 5, 10, 31, 31, 31, 31),
(24, '1', 5, 10, 31, 31, 31, 31),
(25, '1', 5, 10, 31, 31, 31, 31),
(26, '1', 5, 10, 31, 31, 31, 31),
(27, '1', 5, 10, 31, 31, 31, 31),
(28, '1', 5, 10, 31, 31, 31, 31),
(29, '1', 5, 10, 31, 31, 31, 31),
(30, '1', 5, 10, 31, 31, 31, 31),
(31, '1', 5, 10, 31, 31, 31, 31),
(32, '1', 5, 10, 31, 31, 31, 31),
(33, '2', 10, 30, 45, 45, 45, 45),
(34, '2', 10, 30, 45, 45, 45, 45),
(35, '2', 10, 30, 45, 45, 45, 45),
(36, '2', 10, 30, 45, 45, 45, 45),
(37, '2', 10, 30, 45, 45, 45, 45),
(38, '2', 10, 30, 45, 45, 45, 45),
(39, '2', 10, 30, 45, 45, 45, 45),
(40, '2', 10, 30, 45, 45, 45, 45),
(65, '2', 10, 30, 45, 45, 45, 45),
(66, '2', 10, 30, 45, 45, 45, 45),
(67, '2', 10, 30, 45, 45, 45, 45),
(68, '2', 10, 30, 45, 45, 45, 45),
(69, '2', 10, 30, 45, 45, 45, 45),
(70, '2', 10, 30, 45, 45, 45, 45),
(71, '2', 10, 30, 45, 45, 45, 45),
(72, '2', 10, 30, 45, 45, 45, 45),
(73, '2', 10, 30, 45, 45, 45, 45),
(74, '2', 10, 30, 45, 45, 45, 45),
(75, '2', 10, 30, 45, 45, 45, 45),
(76, '2', 10, 30, 45, 45, 45, 45),
(77, '2', 10, 30, 45, 45, 45, 45),
(78, '2', 10, 30, 45, 45, 45, 45),
(79, '2', 10, 30, 45, 45, 45, 45),
(80, '2', 10, 30, 45, 45, 45, 45),
(41, '3', 10, 60, 52, 52, 52, 52),
(42, '3', 10, 60, 52, 52, 52, 52),
(43, '3', 10, 60, 52, 52, 52, 52),
(44, '3', 10, 60, 52, 52, 52, 52),
(45, '3', 10, 60, 52, 52, 52, 52),
(46, '3', 10, 60, 52, 52, 52, 52),
(47, '3', 10, 60, 52, 52, 52, 52),
(48, '3', 10, 60, 52, 52, 52, 52),
(49, '3', 10, 60, 52, 52, 52, 52),
(50, '3', 10, 60, 52, 52, 52, 52),
(51, '3', 10, 60, 52, 52, 52, 52),
(52, '3', 10, 60, 52, 52, 52, 52),
(53, '3', 10, 60, 52, 52, 52, 52),
(54, '3', 10, 60, 52, 52, 52, 52),
(55, '3', 10, 60, 52, 52, 52, 52),
(56, '3', 10, 60, 52, 52, 52, 52),
(57, '3', 10, 60, 52, 52, 52, 52),
(58, '3', 10, 60, 52, 52, 52, 52),
(59, '3', 10, 60, 52, 52, 52, 52),
(60, '3', 10, 60, 52, 52, 52, 52),
(61, '3', 10, 60, 52, 52, 52, 52),
(62, '3', 10, 60, 52, 52, 52, 52),
(63, '3', 10, 60, 52, 52, 52, 52),
(64, '3', 10, 60, 52, 52, 52, 52),
(81, '3', 10, 60, 52, 52, 52, 52),
(82, '3', 10, 60, 52, 52, 52, 52),
(83, '3', 10, 60, 52, 52, 52, 52),
(84, '3', 10, 60, 52, 52, 52, 52),
(85, '3', 10, 60, 52, 52, 52, 52),
(86, '3', 10, 60, 52, 52, 52, 52),
(87, '3', 10, 60, 52, 52, 52, 52),
(88, '3', 10, 60, 52, 52, 52, 52),
(105, '3', 10, 60, 52, 52, 52, 52),
(106, '3', 10, 60, 52, 52, 52, 52),
(107, '3', 10, 60, 52, 52, 52, 52),
(108, '3', 10, 60, 52, 52, 52, 52),
(109, '3', 10, 60, 52, 52, 52, 52),
(110, '3', 10, 60, 52, 52, 52, 52),
(111, '3', 10, 60, 52, 52, 52, 52),
(112, '3', 10, 60, 52, 52, 52, 52),
(113, '3', 10, 60, 52, 52, 52, 52),
(114, '3', 10, 60, 52, 52, 52, 52),
(115, '3', 10, 60, 52, 52, 52, 52),
(116, '3', 10, 60, 52, 52, 52, 52),
(117, '3', 10, 60, 52, 52, 52, 52),
(118, '3', 10, 60, 52, 52, 52, 52),
(119, '3', 10, 60, 52, 52, 52, 52),
(120, '3', 10, 60, 52, 52, 52, 52),
(89, '4', 10, 200, 60, 60, 60, 60),
(90, '4', 10, 200, 60, 60, 60, 60),
(91, '4', 10, 200, 60, 60, 60, 60),
(92, '4', 10, 200, 60, 60, 60, 60),
(93, '4', 10, 200, 60, 60, 60, 60),
(94, '4', 10, 200, 60, 60, 60, 60),
(95, '4', 10, 200, 60, 60, 60, 60),
(96, '4', 10, 200, 60, 60, 60, 60),
(97, '4', 10, 200, 60, 60, 60, 60),
(98, '4', 10, 200, 60, 60, 60, 60),
(99, '4', 10, 200, 60, 60, 60, 60),
(100, '4', 10, 200, 60, 60, 60, 60),
(101, '4', 10, 200, 60, 60, 60, 60),
(102, '4', 10, 200, 60, 60, 60, 60),
(103, '4', 10, 200, 60, 60, 60, 60),
(104, '4', 10, 200, 60, 60, 60, 60),
(121, '4', 10, 200, 60, 60, 60, 60),
(122, '4', 10, 200, 60, 60, 60, 60),
(123, '4', 10, 200, 60, 60, 60, 60),
(124, '4', 10, 200, 60, 60, 60, 60),
(125, '4', 10, 200, 60, 60, 60, 60),
(126, '4', 10, 200, 60, 60, 60, 60),
(127, '4', 10, 200, 60, 60, 60, 60),
(128, '4', 10, 200, 60, 60, 60, 60),
(129, '4', 10, 200, 60, 60, 60, 60),
(130, '4', 10, 200, 60, 60, 60, 60),
(131, '4', 10, 200, 60, 60, 60, 60),
(132, '4', 10, 200, 60, 60, 60, 60),
(133, '4', 10, 200, 60, 60, 60, 60),
(134, '4', 10, 200, 60, 60, 60, 60),
(135, '4', 10, 200, 60, 60, 60, 60),
(136, '4', 10, 200, 60, 60, 60, 60),
(202, '5', 10, 2000, 120, 120, 120, 120),
(203, '5', 10, 2000, 120, 120, 120, 120),
(204, '5', 10, 2000, 120, 120, 120, 120),
(205, '5', 10, 2000, 120, 120, 120, 120),
(206, '5', 10, 2000, 120, 120, 120, 120),
(207, '5', 10, 2000, 120, 120, 120, 120),
(208, '5', 10, 2000, 120, 120, 120, 120),
(209, '5', 10, 2000, 120, 120, 120, 120),
(186, '5', 10, 2000, 120, 120, 120, 120),
(187, '5', 10, 2000, 120, 120, 120, 120),
(188, '5', 10, 2000, 120, 120, 120, 120),
(189, '5', 10, 2000, 120, 120, 120, 120),
(190, '5', 10, 2000, 120, 120, 120, 120),
(191, '5', 10, 2000, 120, 120, 120, 120),
(192, '5', 10, 2000, 120, 120, 120, 120),
(193, '5', 10, 2000, 120, 120, 120, 120),
(194, '5', 10, 2000, 120, 120, 120, 120),
(195, '5', 10, 2000, 120, 120, 120, 120),
(196, '5', 10, 2000, 120, 120, 120, 120),
(197, '5', 10, 2000, 120, 120, 120, 120),
(200, '5', 10, 2000, 120, 120, 120, 120),
(201, '5', 10, 2000, 120, 120, 120, 120),
(178, '5', 10, 2000, 120, 120, 120, 120),
(179, '5', 10, 2000, 120, 120, 120, 120),
(180, '5', 10, 2000, 120, 120, 120, 120),
(181, '5', 10, 2000, 120, 120, 120, 120),
(182, '5', 10, 2000, 120, 120, 120, 120),
(183, '5', 10, 2000, 120, 120, 120, 120),
(184, '5', 10, 2000, 120, 120, 120, 120),
(185, '5', 10, 2000, 120, 120, 120, 120),
(137, '4', 10, 200, 60, 60, 60, 60),
(138, '4', 10, 200, 60, 60, 60, 60),
(139, '4', 10, 200, 60, 60, 60, 60),
(140, '4', 10, 200, 60, 60, 60, 60),
(141, '4', 10, 200, 60, 60, 60, 60),
(142, '4', 10, 200, 60, 60, 60, 60),
(143, '4', 10, 200, 60, 60, 60, 60),
(144, '4', 10, 200, 60, 60, 60, 60),
(145, '4', 10, 200, 60, 60, 60, 60),
(146, '4', 10, 200, 60, 60, 60, 60),
(147, '4', 10, 200, 60, 60, 60, 60),
(148, '4', 10, 200, 60, 60, 60, 60),
(149, '4', 10, 200, 60, 60, 60, 60),
(150, '4', 10, 200, 60, 60, 60, 60),
(151, '4', 10, 200, 60, 60, 60, 60),
(152, '4', 10, 200, 60, 60, 60, 60),
(161, '4', 10, 200, 60, 60, 60, 60),
(162, '4', 10, 200, 60, 60, 60, 60),
(163, '4', 10, 200, 60, 60, 60, 60),
(164, '4', 10, 200, 60, 60, 60, 60),
(165, '4', 10, 200, 60, 60, 60, 60),
(166, '4', 10, 200, 60, 60, 60, 60),
(167, '4', 10, 200, 60, 60, 60, 60),
(168, '4', 10, 200, 60, 60, 60, 60),
(210, '5', 10, 2000, 120, 120, 120, 120),
(211, '5', 10, 2000, 120, 120, 120, 120),
(212, '5', 10, 2000, 120, 120, 120, 120),
(213, '5', 10, 2000, 120, 120, 120, 120),
(214, '5', 10, 2000, 120, 120, 120, 120),
(215, '5', 10, 2000, 120, 120, 120, 120),
(216, '5', 10, 2000, 120, 120, 120, 120),
(217, '5', 10, 2000, 120, 120, 120, 120),
(314, '5', 10, 2000, 120, 120, 120, 120),
(315, '5', 10, 2000, 120, 120, 120, 120),
(316, '5', 10, 2000, 120, 120, 120, 120),
(317, '5', 10, 2000, 120, 120, 120, 120),
(318, '5', 10, 2000, 120, 120, 120, 120),
(319, '5', 10, 2000, 120, 120, 120, 120),
(320, '5', 10, 2000, 120, 120, 120, 120),
(321, '5', 10, 2000, 120, 120, 120, 120),
(306, '6', 10, 3000, 160, 160, 160, 160),
(307, '6', 10, 3000, 160, 160, 160, 160),
(308, '6', 10, 3000, 160, 160, 160, 160),
(309, '6', 10, 3000, 160, 160, 160, 160),
(310, '6', 10, 3000, 160, 160, 160, 160),
(311, '6', 10, 3000, 160, 160, 160, 160),
(312, '6', 10, 3000, 160, 160, 160, 160),
(313, '6', 10, 3000, 160, 160, 160, 160),
(218, '6', 10, 3000, 160, 160, 160, 160),
(219, '6', 10, 3000, 160, 160, 160, 160),
(220, '6', 10, 3000, 160, 160, 160, 160),
(221, '6', 10, 3000, 160, 160, 160, 160),
(222, '6', 10, 3000, 160, 160, 160, 160),
(223, '6', 10, 3000, 160, 160, 160, 160),
(224, '6', 10, 3000, 160, 160, 160, 160),
(225, '6', 10, 3000, 160, 160, 160, 160),
(226, '6', 10, 3000, 160, 160, 160, 160),
(227, '6', 10, 3000, 160, 160, 160, 160),
(228, '6', 10, 3000, 160, 160, 160, 160),
(229, '6', 10, 3000, 160, 160, 160, 160),
(230, '6', 10, 3000, 160, 160, 160, 160),
(231, '6', 10, 3000, 160, 160, 160, 160),
(232, '6', 10, 3000, 160, 160, 160, 160),
(233, '6', 10, 3000, 160, 160, 160, 160),
(250, '6', 10, 3000, 160, 160, 160, 160),
(251, '6', 10, 3000, 160, 160, 160, 160),
(252, '6', 10, 3000, 160, 160, 160, 160),
(253, '6', 10, 3000, 160, 160, 160, 160),
(254, '6', 10, 3000, 160, 160, 160, 160),
(255, '6', 10, 3000, 160, 160, 160, 160),
(256, '6', 10, 3000, 160, 160, 160, 160),
(257, '6', 10, 3000, 160, 160, 160, 160),
(242, '6', 10, 3000, 160, 160, 160, 160),
(243, '6', 10, 3000, 160, 160, 160, 160),
(244, '6', 10, 3000, 160, 160, 160, 160),
(245, '6', 10, 3000, 160, 160, 160, 160),
(246, '6', 10, 3000, 160, 160, 160, 160),
(247, '6', 10, 3000, 160, 160, 160, 160),
(248, '6', 10, 3000, 160, 160, 160, 160),
(249, '6', 10, 3000, 160, 160, 160, 160),
(234, '6', 10, 3000, 160, 160, 160, 160),
(235, '6', 10, 3000, 160, 160, 160, 160),
(236, '6', 10, 3000, 160, 160, 160, 160),
(237, '6', 10, 3000, 160, 160, 160, 160),
(238, '6', 10, 3000, 160, 160, 160, 160),
(239, '6', 10, 3000, 160, 160, 160, 160),
(240, '6', 10, 3000, 160, 160, 160, 160),
(241, '6', 10, 3000, 160, 160, 160, 160),
(290, '6', 10, 3000, 160, 160, 160, 160),
(291, '6', 10, 3000, 160, 160, 160, 160),
(292, '6', 10, 3000, 160, 160, 160, 160),
(293, '6', 10, 3000, 160, 160, 160, 160),
(294, '6', 10, 3000, 160, 160, 160, 160),
(295, '6', 10, 3000, 160, 160, 160, 160),
(296, '6', 10, 3000, 160, 160, 160, 160),
(297, '6', 10, 3000, 160, 160, 160, 160),
(258, '6', 10, 3000, 160, 160, 160, 160),
(259, '6', 10, 3000, 160, 160, 160, 160),
(260, '6', 10, 3000, 160, 160, 160, 160),
(261, '6', 10, 3000, 160, 160, 160, 160),
(262, '6', 10, 3000, 160, 160, 160, 160),
(263, '6', 10, 3000, 160, 160, 160, 160),
(440, '6', 10, 3000, 160, 160, 160, 160),
(441, '6', 10, 3000, 160, 160, 160, 160),
(442, '6', 10, 3000, 160, 160, 160, 160),
(443, '6', 10, 3000, 160, 160, 160, 160),
(444, '6', 10, 3000, 160, 160, 160, 160),
(445, '6', 10, 3000, 160, 160, 160, 160),
(446, '6', 10, 3000, 160, 160, 160, 160),
(447, '6', 10, 3000, 160, 160, 160, 160),
(264, '6', 10, 3000, 160, 160, 160, 160),
(265, '6', 10, 3000, 160, 160, 160, 160),
(460, '6', 10, 3000, 160, 160, 160, 160),
(461, '6', 10, 3000, 160, 160, 160, 160),
(462, '6', 10, 3000, 160, 160, 160, 160),
(463, '6', 10, 3000, 160, 160, 160, 160),
(464, '6', 10, 3000, 160, 160, 160, 160),
(465, '6', 10, 3000, 160, 160, 160, 160),
(466, '6', 10, 3000, 160, 160, 160, 160),
(467, '6', 10, 3000, 160, 160, 160, 160),
(274, '6', 10, 3000, 160, 160, 160, 160),
(275, '6', 10, 3000, 160, 160, 160, 160),
(276, '6', 10, 3000, 160, 160, 160, 160),
(277, '6', 10, 3000, 160, 160, 160, 160),
(278, '6', 10, 3000, 160, 160, 160, 160),
(279, '6', 10, 3000, 160, 160, 160, 160),
(280, '6', 10, 3000, 160, 160, 160, 160),
(281, '6', 10, 3000, 160, 160, 160, 160);

-- --------------------------------------------------------

--
-- Структура таблицы `stone`
--

CREATE TABLE `stone` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sunduk_log`
--

CREATE TABLE `sunduk_log` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `user_login` varchar(250) NOT NULL,
  `nagr` text NOT NULL,
  `time` varchar(250) NOT NULL,
  `type` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `text` varchar(8048) NOT NULL,
  `status` enum('new','read','close','user') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `ticket_answer`
--

CREATE TABLE `ticket_answer` (
  `id` int(11) NOT NULL,
  `type` enum('user','admin') NOT NULL,
  `text` varchar(2048) NOT NULL,
  `ticket` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tj_admin`
--

CREATE TABLE `tj_admin` (
  `id` int(11) NOT NULL,
  `silver_vznos` int(11) NOT NULL,
  `gold_vznos` int(11) NOT NULL,
  `wins_gold` int(11) NOT NULL,
  `wins_silver` int(11) NOT NULL,
  `top_silver` int(11) NOT NULL,
  `top_gold` int(11) NOT NULL,
  `on/off` int(11) NOT NULL,
  `top` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `check_nagrada` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tj_users`
--

CREATE TABLE `tj_users` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `wins` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `torg_chat`
--

CREATE TABLE `torg_chat` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `text` text NOT NULL,
  `time` int(11) NOT NULL,
  `read` enum('0','1') NOT NULL,
  `clan` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `undying`
--

CREATE TABLE `undying` (
  `id` int(11) NOT NULL,
  `time` int(11) NOT NULL DEFAULT '0',
  `end` enum('0','1') NOT NULL DEFAULT '0',
  `start` enum('0','1') NOT NULL DEFAULT '0',
  `opponents` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `undying_member`
--

CREATE TABLE `undying_member` (
  `id` int(11) NOT NULL,
  `battle` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `dead` enum('0','1') NOT NULL DEFAULT '0',
  `exit` enum('0','1') NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `kills` int(11) NOT NULL DEFAULT '0',
  `dmg` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `unitpay_payments`
--

CREATE TABLE `unitpay_payments` (
  `id` int(10) NOT NULL,
  `unitpayId` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `sum` float NOT NULL,
  `itemsCount` int(11) NOT NULL DEFAULT '1',
  `dateCreate` datetime NOT NULL,
  `dateComplete` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nread` int(11) NOT NULL DEFAULT '0',
  `eread` enum('0','1') NOT NULL DEFAULT '0',
  `ava` int(11) DEFAULT NULL,
  `rub` int(255) DEFAULT NULL,
  `time_craft` int(11) NOT NULL,
  `object_craft` int(11) NOT NULL,
  `block` tinyint(1) NOT NULL DEFAULT '0',
  `mail` varchar(50) NOT NULL,
  `league` int(11) NOT NULL,
  `league_place` int(11) NOT NULL,
  `league_fights` int(11) NOT NULL,
  `login` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `sex` enum('0','1') NOT NULL DEFAULT '0',
  `online` int(11) NOT NULL DEFAULT '0',
  `last_update` int(11) NOT NULL DEFAULT '0',
  `access` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `r` enum('0','1','2') NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '1',
  `hp` int(11) NOT NULL DEFAULT '0',
  `mp` int(11) NOT NULL DEFAULT '0',
  `exp` int(11) NOT NULL DEFAULT '0',
  `g` int(11) NOT NULL DEFAULT '0',
  `s` int(11) NOT NULL DEFAULT '0',
  `skill` int(11) NOT NULL DEFAULT '0',
  `str` int(11) NOT NULL DEFAULT '10',
  `_str` int(11) NOT NULL DEFAULT '0',
  `vit` int(11) NOT NULL DEFAULT '10',
  `_vit` int(11) NOT NULL DEFAULT '0',
  `agi` int(11) NOT NULL DEFAULT '10',
  `_agi` int(11) NOT NULL DEFAULT '0',
  `def` int(11) NOT NULL DEFAULT '10',
  `_def` int(11) NOT NULL DEFAULT '0',
  `mana` int(11) NOT NULL DEFAULT '1000',
  `_mana` int(11) NOT NULL DEFAULT '0',
  `w_1` int(11) NOT NULL DEFAULT '0',
  `w_2` int(11) NOT NULL DEFAULT '0',
  `w_3` int(11) NOT NULL DEFAULT '0',
  `w_4` int(11) NOT NULL DEFAULT '0',
  `w_5` int(11) NOT NULL DEFAULT '0',
  `w_6` int(11) NOT NULL DEFAULT '0',
  `w_7` int(11) NOT NULL DEFAULT '0',
  `w_8` int(11) NOT NULL DEFAULT '0',
  `duel_rating` int(11) NOT NULL DEFAULT '0',
  `duel_fights` int(11) NOT NULL DEFAULT '0',
  `duel_last_update` int(11) NOT NULL DEFAULT '0',
  `duel_changes` int(11) NOT NULL DEFAULT '0',
  `ip` mediumtext,
  `ua` mediumtext,
  `coliseum_rating` int(11) NOT NULL DEFAULT '0',
  `self` mediumtext,
  `ability_1` int(11) NOT NULL DEFAULT '0',
  `ability_1_quality` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0',
  `ability_2` int(11) NOT NULL DEFAULT '0',
  `ability_2_quality` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0',
  `ability_3` int(11) NOT NULL DEFAULT '0',
  `ability_3_quality` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0',
  `ability_4` int(11) NOT NULL DEFAULT '0',
  `ability_4_quality` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0',
  `ability_5` int(11) NOT NULL DEFAULT '0',
  `ability_5_quality` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0',
  `bg` enum('0','1','2','3','4') NOT NULL DEFAULT '0',
  `chest` enum('0','1') NOT NULL DEFAULT '0',
  `duel_trophy` int(11) NOT NULL DEFAULT '0',
  `arena_opponent` int(11) NOT NULL DEFAULT '0',
  `arena_time` int(11) NOT NULL DEFAULT '0',
  `res_1` int(11) NOT NULL DEFAULT '0',
  `res_2` int(11) NOT NULL DEFAULT '0',
  `res_3` int(11) NOT NULL DEFAULT '0',
  `res_4` int(11) NOT NULL DEFAULT '0',
  `res_5` int(11) NOT NULL DEFAULT '0',
  `res_6` int(11) NOT NULL DEFAULT '0',
  `res_7` int(11) NOT NULL DEFAULT '0',
  `res_8` int(11) NOT NULL DEFAULT '0',
  `res_9` int(11) NOT NULL DEFAULT '0',
  `key` int(11) NOT NULL,
  `identity` varchar(100) NOT NULL,
  `network` varchar(100) NOT NULL,
  `identityq` varchar(100) DEFAULT NULL,
  `type_regq` varchar(100) DEFAULT NULL,
  `plat` int(250) NOT NULL DEFAULT '0',
  `plat_open` int(1) NOT NULL DEFAULT '0',
  `liga` varchar(11) NOT NULL,
  `arena_pobed` varchar(11) NOT NULL,
  `win_battle` int(11) NOT NULL,
  `troph1` enum('0','1') NOT NULL DEFAULT '0',
  `troph2` enum('0','1') NOT NULL DEFAULT '0',
  `troph3` enum('0','1') NOT NULL DEFAULT '0',
  `troph4` enum('0','1') NOT NULL DEFAULT '0',
  `troph5` enum('0','1') NOT NULL DEFAULT '0',
  `troph6` enum('0','1') NOT NULL DEFAULT '0',
  `troph7` enum('0','1') NOT NULL DEFAULT '0',
  `troph8` enum('0','1') NOT NULL DEFAULT '0',
  `troph9` enum('0','1') NOT NULL DEFAULT '0',
  `kods` varchar(250) NOT NULL,
  `hellworld` int(11) NOT NULL DEFAULT '0',
  `hellworld_stage` int(11) NOT NULL DEFAULT '0',
  `hellworld_time` int(11) NOT NULL DEFAULT '0',
  `hellworld_exp` int(11) NOT NULL DEFAULT '0',
  `hellworld_reward` int(11) NOT NULL DEFAULT '0',
  `undying` int(11) NOT NULL,
  `quests` int(11) NOT NULL,
  `el1` int(11) NOT NULL,
  `el2` int(11) NOT NULL,
  `el3` int(11) NOT NULL,
  `el4` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `pet_lvl` int(3) NOT NULL,
  `orator` int(11) NOT NULL,
  `dres_rating` int(11) NOT NULL,
  `clan_memb` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mail_closed` int(11) NOT NULL,
  `zamujem` varchar(10) NOT NULL,
  `lab_d` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pvp_rating` int(11) NOT NULL DEFAULT '0',
  `pvp_level` int(11) NOT NULL,
  `mary` int(11) NOT NULL,
  `baron` int(11) NOT NULL,
  `party` int(11) NOT NULL,
  `city` varchar(25) NOT NULL,
  `ach_undying` int(11) NOT NULL DEFAULT '0',
  `ach_coliseum` int(11) NOT NULL DEFAULT '0',
  `ach_arena` int(11) NOT NULL DEFAULT '0',
  `mute_time` int(11) NOT NULL,
  `crystal` int(11) NOT NULL,
  `aide` int(1) NOT NULL,
  `azart_exp` int(11) NOT NULL,
  `azart_sunduk` int(11) NOT NULL,
  `azart_1` int(11) NOT NULL,
  `azart_2` int(11) NOT NULL,
  `azart_3` int(11) NOT NULL,
  `uron_pohod` int(11) NOT NULL,
  `epic_run` int(11) NOT NULL,
  `griz` int(11) NOT NULL,
  `essence` int(11) NOT NULL DEFAULT '0',
  `parse` int(11) NOT NULL DEFAULT '0',
  `parse_exp` int(11) DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT 'Нет статуса :)',
  `status_color` varchar(50) NOT NULL DEFAULT '#BEBEBE',
  `kazino` int(11) NOT NULL,
  `star_1` varchar(250) NOT NULL DEFAULT '0',
  `star_2` varchar(250) NOT NULL DEFAULT '0',
  `star_3` varchar(250) NOT NULL DEFAULT '0',
  `belt` int(11) NOT NULL DEFAULT '0',
  `belt_inv` int(11) NOT NULL DEFAULT '1',
  `belt_time` int(11) NOT NULL DEFAULT '0',
  `lair` int(11) NOT NULL DEFAULT '0',
  `lair_time` int(11) NOT NULL DEFAULT '0',
  `stone` int(11) NOT NULL DEFAULT '0',
  `grass` int(11) NOT NULL DEFAULT '0',
  `stone_res` int(11) NOT NULL DEFAULT '1',
  `grass_res` int(11) NOT NULL DEFAULT '2',
  `avat` varchar(255) NOT NULL DEFAULT '0',
  `bko` varchar(255) NOT NULL DEFAULT '0',
  `arena` int(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `nread`, `eread`, `ava`, `rub`, `time_craft`, `object_craft`, `block`, `mail`, `league`, `league_place`, `league_fights`, `login`, `password`, `sex`, `online`, `last_update`, `access`, `r`, `level`, `hp`, `mp`, `exp`, `g`, `s`, `skill`, `str`, `_str`, `vit`, `_vit`, `agi`, `_agi`, `def`, `_def`, `mana`, `_mana`, `w_1`, `w_2`, `w_3`, `w_4`, `w_5`, `w_6`, `w_7`, `w_8`, `duel_rating`, `duel_fights`, `duel_last_update`, `duel_changes`, `ip`, `ua`, `coliseum_rating`, `self`, `ability_1`, `ability_1_quality`, `ability_2`, `ability_2_quality`, `ability_3`, `ability_3_quality`, `ability_4`, `ability_4_quality`, `ability_5`, `ability_5_quality`, `bg`, `chest`, `duel_trophy`, `arena_opponent`, `arena_time`, `res_1`, `res_2`, `res_3`, `res_4`, `res_5`, `res_6`, `res_7`, `res_8`, `res_9`, `key`, `identity`, `network`, `identityq`, `type_regq`, `plat`, `plat_open`, `liga`, `arena_pobed`, `win_battle`, `troph1`, `troph2`, `troph3`, `troph4`, `troph5`, `troph6`, `troph7`, `troph8`, `troph9`, `kods`, `hellworld`, `hellworld_stage`, `hellworld_time`, `hellworld_exp`, `hellworld_reward`, `undying`, `quests`, `el1`, `el2`, `el3`, `el4`, `pet_id`, `pet_lvl`, `orator`, `dres_rating`, `clan_memb`, `name`, `mail_closed`, `zamujem`, `lab_d`, `email`, `pvp_rating`, `pvp_level`, `mary`, `baron`, `party`, `city`, `ach_undying`, `ach_coliseum`, `ach_arena`, `mute_time`, `crystal`, `aide`, `azart_exp`, `azart_sunduk`, `azart_1`, `azart_2`, `azart_3`, `uron_pohod`, `epic_run`, `griz`, `essence`, `parse`, `parse_exp`, `status`, `status_color`, `kazino`, `star_1`, `star_2`, `star_3`, `belt`, `belt_inv`, `belt_time`, `lair`, `lair_time`, `stone`, `grass`, `stone_res`, `grass_res`, `avat`, `bko`, `arena`) VALUES
(2, 0, '0', NULL, NULL, 0, 0, 0, '', 0, 0, 0, 'Solex', 'e9bf5f58745dade2953a6fd2bfc3f096c5aaa5dc', '0', 1553419446, 1553419446, '0', '0', 1, 20, 1000, 0, 0, 0, 0, 10, 0, 10, 0, 10, 0, 10, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0', 0, 'Игра', 0, '0', 0, '0', 0, '0', 0, '0', 0, '0', '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, 0, 0, '', '', 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Нет статуса :)', '#BEBEBE', 0, '0', '0', '0', 0, 1, 0, 0, 0, 0, 0, 1, 2, '0', '0', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users_am`
--

CREATE TABLE `users_am` (
  `id` int(11) NOT NULL,
  `id_user` int(255) NOT NULL,
  `name` varchar(255) CHARACTER SET cp1251 NOT NULL,
  `name_rus` varchar(255) CHARACTER SET cp1251 NOT NULL,
  `lvl` int(11) NOT NULL DEFAULT '1',
  `efect` int(255) NOT NULL DEFAULT '0',
  `cena_activ` int(255) NOT NULL,
  `time` int(11) NOT NULL DEFAULT '0',
  `time_perez` int(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_level`
--

CREATE TABLE `user_level` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `exp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_level`
--

INSERT INTO `user_level` (`id`, `level`, `exp`) VALUES
(1, 1, 5),
(2, 2, 9),
(3, 3, 14),
(4, 4, 15),
(5, 5, 28),
(6, 6, 38),
(7, 7, 512),
(8, 8, 881),
(9, 9, 1282),
(10, 10, 1932),
(11, 11, 2287),
(12, 12, 3045),
(13, 13, 4756),
(14, 14, 6390),
(15, 15, 8927),
(16, 16, 11960),
(17, 17, 14515),
(18, 18, 19023),
(19, 19, 25966),
(20, 20, 32553),
(21, 21, 39951),
(22, 22, 47205),
(23, 23, 58995),
(24, 24, 70894),
(25, 25, 85995),
(26, 26, 99192),
(27, 27, 120172),
(28, 28, 146240),
(29, 29, 180991),
(30, 30, 201027),
(31, 31, 240016),
(32, 32, 273061),
(33, 33, 299979),
(34, 34, 350000),
(35, 35, 500000),
(36, 36, 600000),
(37, 37, 725000),
(38, 38, 850000),
(39, 39, 975000),
(40, 40, 1100000),
(41, 41, 1225000),
(42, 42, 1350000),
(43, 43, 1475000),
(44, 44, 1600000),
(45, 45, 1725000),
(46, 46, 1850000),
(47, 47, 1975000),
(48, 48, 2100000),
(49, 49, 2225000),
(50, 50, 2500000),
(51, 51, 2700000),
(52, 52, 2900000),
(53, 53, 3100000),
(54, 54, 3300000),
(55, 55, 3500000),
(56, 56, 3700000),
(57, 57, 3900000),
(58, 58, 4100000),
(59, 59, 4500000),
(60, 60, 100000000),
(61, 61, 150000000),
(62, 62, 200000000),
(63, 63, 250000000),
(64, 64, 300000000),
(65, 65, 360000000),
(66, 66, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user_pet`
--

CREATE TABLE `user_pet` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `1` int(11) NOT NULL DEFAULT '0',
  `2` int(11) NOT NULL DEFAULT '0',
  `3` int(11) NOT NULL DEFAULT '0',
  `4` int(11) NOT NULL DEFAULT '0',
  `use` int(11) NOT NULL DEFAULT '0',
  `5` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `user_pets`
--

CREATE TABLE `user_pets` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pets` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `arena_battle` int(11) NOT NULL,
  `img` varchar(155) NOT NULL,
  `str` int(11) NOT NULL,
  `vit` int(11) NOT NULL,
  `agi` int(11) NOT NULL,
  `def` int(11) NOT NULL,
  `tune_1` int(11) NOT NULL DEFAULT '1',
  `tune_2` int(11) NOT NULL DEFAULT '1',
  `tune_3` int(11) NOT NULL DEFAULT '1',
  `tune_4` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_podarok`
--

CREATE TABLE `user_podarok` (
  `user_id` int(255) NOT NULL,
  `last_auth` int(255) NOT NULL,
  `stage` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_podarok`
--

INSERT INTO `user_podarok` (`user_id`, `last_auth`, `stage`) VALUES
(21, 1552132031, 2),
(22, 1551966313, 1),
(24, 1551972193, 1),
(25, 1552159278, 1),
(1, 1552340399, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `user_q`
--

CREATE TABLE `user_q` (
  `user` int(11) NOT NULL DEFAULT '0',
  `q` int(11) NOT NULL DEFAULT '0',
  `c` int(11) NOT NULL DEFAULT '0',
  `complete` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `user_virus`
--

CREATE TABLE `user_virus` (
  `user_id` int(255) NOT NULL,
  `last_auth` int(255) NOT NULL,
  `stage` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `v_clan`
--

CREATE TABLE `v_clan` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `v` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `win_plat`
--

CREATE TABLE `win_plat` (
  `id` int(250) NOT NULL,
  `id_user` int(250) NOT NULL,
  `plat` int(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `worldkassa`
--

CREATE TABLE `worldkassa` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID платежа (Внутренний ID)',
  `id_user` int(11) UNSIGNED NOT NULL COMMENT 'ID пользователя',
  `id_bill` int(11) UNSIGNED NOT NULL COMMENT 'ID платежа в Worldkassa',
  `time` int(11) UNSIGNED NOT NULL COMMENT 'Время инициализации платежа',
  `time_oplata` int(11) UNSIGNED DEFAULT '0' COMMENT 'Время оплаты',
  `summa` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT 'Сумма',
  `type` enum('0','1','2') DEFAULT '0' COMMENT 'Тип пополнения 1 - , 2 - '
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Статистика платежей через WorldKassa';

-- --------------------------------------------------------

--
-- Структура таблицы `xsolla_billing`
--

CREATE TABLE `xsolla_billing` (
  `id` int(11) NOT NULL,
  `invoice` int(11) NOT NULL,
  `v1` int(11) NOT NULL,
  `currency` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `canceled` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `xsolla_payment`
--

CREATE TABLE `xsolla_payment` (
  `id` int(11) NOT NULL,
  `transaction_id` bigint(20) DEFAULT '0',
  `payment_date` varchar(64) DEFAULT NULL,
  `payment_currency` varchar(5) DEFAULT NULL,
  `payment_amount` decimal(11,2) DEFAULT '0.00',
  `id_user` int(11) DEFAULT '0',
  `currency_name` varchar(32) DEFAULT NULL,
  `currency_count` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `xsolla_shop`
--

CREATE TABLE `xsolla_shop` (
  `id` int(11) NOT NULL,
  `id_shop` int(11) NOT NULL,
  `v1` int(11) NOT NULL,
  `sum` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `zags`
--

CREATE TABLE `zags` (
  `id` int(11) NOT NULL,
  `id_0` int(11) NOT NULL,
  `id_1` int(11) NOT NULL,
  `status` set('net','da','off','') NOT NULL DEFAULT 'net'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `achievement`
--
ALTER TABLE `achievement`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `aid`
--
ALTER TABLE `aid`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `aid_ten`
--
ALTER TABLE `aid_ten`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `aluko`
--
ALTER TABLE `aluko`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ank`
--
ALTER TABLE `ank`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `arena`
--
ALTER TABLE `arena`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `azart`
--
ALTER TABLE `azart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bank_statistic`
--
ALTER TABLE `bank_statistic`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bank_users`
--
ALTER TABLE `bank_users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `banned`
--
ALTER TABLE `banned`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bazaar`
--
ALTER TABLE `bazaar`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bazaar_log`
--
ALTER TABLE `bazaar_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `BB_code`
--
ALTER TABLE `BB_code`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `boss`
--
ALTER TABLE `boss`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `campaign_boss`
--
ALTER TABLE `campaign_boss`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `campaign_log`
--
ALTER TABLE `campaign_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `cave`
--
ALTER TABLE `cave`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cavebattle`
--
ALTER TABLE `cavebattle`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cavewar`
--
ALTER TABLE `cavewar`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cforum_comments`
--
ALTER TABLE `cforum_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cforum_sub`
--
ALTER TABLE `cforum_sub`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cforum_topic`
--
ALTER TABLE `cforum_topic`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chest`
--
ALTER TABLE `chest`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `church_req`
--
ALTER TABLE `church_req`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clans`
--
ALTER TABLE `clans`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clan_buff`
--
ALTER TABLE `clan_buff`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clan_invite`
--
ALTER TABLE `clan_invite`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clan_journal`
--
ALTER TABLE `clan_journal`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clan_level`
--
ALTER TABLE `clan_level`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clan_memb`
--
ALTER TABLE `clan_memb`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clan_msg`
--
ALTER TABLE `clan_msg`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clan_msg_read`
--
ALTER TABLE `clan_msg_read`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clan_poxod`
--
ALTER TABLE `clan_poxod`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clan_poxod_boss`
--
ALTER TABLE `clan_poxod_boss`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clan_poxod_klon`
--
ALTER TABLE `clan_poxod_klon`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clan_poxod_log`
--
ALTER TABLE `clan_poxod_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clan_poxod_open`
--
ALTER TABLE `clan_poxod_open`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clan_rud_user`
--
ALTER TABLE `clan_rud_user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clan_z`
--
ALTER TABLE `clan_z`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `coliseum`
--
ALTER TABLE `coliseum`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `coliseum_log`
--
ALTER TABLE `coliseum_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `coliseum_member`
--
ALTER TABLE `coliseum_member`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `complects`
--
ALTER TABLE `complects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `control`
--
ALTER TABLE `control`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cw_clans`
--
ALTER TABLE `cw_clans`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cw_event`
--
ALTER TABLE `cw_event`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cw_log`
--
ALTER TABLE `cw_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cw_memb`
--
ALTER TABLE `cw_memb`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dialog`
--
ALTER TABLE `dialog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `domination`
--
ALTER TABLE `domination`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dragonEvent`
--
ALTER TABLE `dragonEvent`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dragonEventLog`
--
ALTER TABLE `dragonEventLog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dragonEventMemb`
--
ALTER TABLE `dragonEventMemb`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `duel`
--
ALTER TABLE `duel`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `exchange`
--
ALTER TABLE `exchange`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `nick` (`time`);

--
-- Индексы таблицы `farm`
--
ALTER TABLE `farm`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `fish`
--
ALTER TABLE `fish`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forum_sub`
--
ALTER TABLE `forum_sub`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forum_topic`
--
ALTER TABLE `forum_topic`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hellworld`
--
ALTER TABLE `hellworld`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hellworld_action`
--
ALTER TABLE `hellworld_action`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hellworld_info`
--
ALTER TABLE `hellworld_info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hellworld_logs`
--
ALTER TABLE `hellworld_logs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hellworld_reward`
--
ALTER TABLE `hellworld_reward`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hellworld_rewards`
--
ALTER TABLE `hellworld_rewards`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hellworld_user`
--
ALTER TABLE `hellworld_user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `inv`
--
ALTER TABLE `inv`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `jour`
--
ALTER TABLE `jour`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `king`
--
ALTER TABLE `king`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `king_member`
--
ALTER TABLE `king_member`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lair`
--
ALTER TABLE `lair`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `maneken`
--
ALTER TABLE `maneken`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mobs`
--
ALTER TABLE `mobs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mod_chat`
--
ALTER TABLE `mod_chat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mor`
--
ALTER TABLE `mor`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news_comm`
--
ALTER TABLE `news_comm`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news_go`
--
ALTER TABLE `news_go`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `news_status`
--
ALTER TABLE `news_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news_status_read`
--
ALTER TABLE `news_status_read`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`usr`),
  ADD KEY `laikas` (`laikas`);

--
-- Индексы таблицы `party`
--
ALTER TABLE `party`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pets_shop`
--
ALTER TABLE `pets_shop`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pets_sxvatki`
--
ALTER TABLE `pets_sxvatki`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pets_sxvatki_log`
--
ALTER TABLE `pets_sxvatki_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pets_sxvatki_member`
--
ALTER TABLE `pets_sxvatki_member`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pets_tj`
--
ALTER TABLE `pets_tj`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pet_u`
--
ALTER TABLE `pet_u`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pit`
--
ALTER TABLE `pit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `pitomec`
--
ALTER TABLE `pitomec`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pit_item`
--
ALTER TABLE `pit_item`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pit_mag`
--
ALTER TABLE `pit_mag`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pit_shop`
--
ALTER TABLE `pit_shop`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pnv`
--
ALTER TABLE `pnv`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `podarok`
--
ALTER TABLE `podarok`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `premium`
--
ALTER TABLE `premium`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `presents`
--
ALTER TABLE `presents`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `present_boss`
--
ALTER TABLE `present_boss`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `profesion`
--
ALTER TABLE `profesion`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pvp_event`
--
ALTER TABLE `pvp_event`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pvp_log`
--
ALTER TABLE `pvp_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pvp_memb`
--
ALTER TABLE `pvp_memb`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `quest`
--
ALTER TABLE `quest`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ref`
--
ALTER TABLE `ref`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `relict`
--
ALTER TABLE `relict`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `res`
--
ALTER TABLE `res`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `revolt`
--
ALTER TABLE `revolt`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `revolt_logs`
--
ALTER TABLE `revolt_logs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `revolt_member`
--
ALTER TABLE `revolt_member`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `revolt_mobs`
--
ALTER TABLE `revolt_mobs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sack`
--
ALTER TABLE `sack`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `stone`
--
ALTER TABLE `stone`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ticket_answer`
--
ALTER TABLE `ticket_answer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tj_admin`
--
ALTER TABLE `tj_admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tj_users`
--
ALTER TABLE `tj_users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `undying`
--
ALTER TABLE `undying`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `undying_member`
--
ALTER TABLE `undying_member`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `unitpay_payments`
--
ALTER TABLE `unitpay_payments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_am`
--
ALTER TABLE `users_am`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_pet`
--
ALTER TABLE `user_pet`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_pets`
--
ALTER TABLE `user_pets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `v_clan`
--
ALTER TABLE `v_clan`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `win_plat`
--
ALTER TABLE `win_plat`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `worldkassa`
--
ALTER TABLE `worldkassa`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `xsolla_billing`
--
ALTER TABLE `xsolla_billing`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `xsolla_payment`
--
ALTER TABLE `xsolla_payment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `xsolla_shop`
--
ALTER TABLE `xsolla_shop`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `zags`
--
ALTER TABLE `zags`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `achievement`
--
ALTER TABLE `achievement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `aid`
--
ALTER TABLE `aid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `aid_ten`
--
ALTER TABLE `aid_ten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `aluko`
--
ALTER TABLE `aluko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `ank`
--
ALTER TABLE `ank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `arena`
--
ALTER TABLE `arena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `azart`
--
ALTER TABLE `azart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `ban`
--
ALTER TABLE `ban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bank_statistic`
--
ALTER TABLE `bank_statistic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bank_users`
--
ALTER TABLE `bank_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `banned`
--
ALTER TABLE `banned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bazaar`
--
ALTER TABLE `bazaar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bazaar_log`
--
ALTER TABLE `bazaar_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `BB_code`
--
ALTER TABLE `BB_code`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `block`
--
ALTER TABLE `block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `boss`
--
ALTER TABLE `boss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `campaign_boss`
--
ALTER TABLE `campaign_boss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `campaign_log`
--
ALTER TABLE `campaign_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `cave`
--
ALTER TABLE `cave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `cavebattle`
--
ALTER TABLE `cavebattle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cavewar`
--
ALTER TABLE `cavewar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cforum_comments`
--
ALTER TABLE `cforum_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cforum_sub`
--
ALTER TABLE `cforum_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cforum_topic`
--
ALTER TABLE `cforum_topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `chest`
--
ALTER TABLE `chest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `church_req`
--
ALTER TABLE `church_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `clans`
--
ALTER TABLE `clans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `clan_buff`
--
ALTER TABLE `clan_buff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `clan_invite`
--
ALTER TABLE `clan_invite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `clan_journal`
--
ALTER TABLE `clan_journal`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `clan_level`
--
ALTER TABLE `clan_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `clan_memb`
--
ALTER TABLE `clan_memb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `clan_msg`
--
ALTER TABLE `clan_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `clan_msg_read`
--
ALTER TABLE `clan_msg_read`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `clan_poxod`
--
ALTER TABLE `clan_poxod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `clan_poxod_boss`
--
ALTER TABLE `clan_poxod_boss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `clan_poxod_klon`
--
ALTER TABLE `clan_poxod_klon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `clan_poxod_log`
--
ALTER TABLE `clan_poxod_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `clan_poxod_open`
--
ALTER TABLE `clan_poxod_open`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `clan_rud_user`
--
ALTER TABLE `clan_rud_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `clan_z`
--
ALTER TABLE `clan_z`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `coliseum`
--
ALTER TABLE `coliseum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `coliseum_log`
--
ALTER TABLE `coliseum_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `coliseum_member`
--
ALTER TABLE `coliseum_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `complects`
--
ALTER TABLE `complects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=465;

--
-- AUTO_INCREMENT для таблицы `control`
--
ALTER TABLE `control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cw_clans`
--
ALTER TABLE `cw_clans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cw_event`
--
ALTER TABLE `cw_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `cw_log`
--
ALTER TABLE `cw_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cw_memb`
--
ALTER TABLE `cw_memb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dialog`
--
ALTER TABLE `dialog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `domination`
--
ALTER TABLE `domination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dragonEvent`
--
ALTER TABLE `dragonEvent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `dragonEventLog`
--
ALTER TABLE `dragonEventLog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dragonEventMemb`
--
ALTER TABLE `dragonEventMemb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `duel`
--
ALTER TABLE `duel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `exchange`
--
ALTER TABLE `exchange`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `farm`
--
ALTER TABLE `farm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `fish`
--
ALTER TABLE `fish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `forum_comments`
--
ALTER TABLE `forum_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `forum_sub`
--
ALTER TABLE `forum_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `forum_topic`
--
ALTER TABLE `forum_topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hellworld`
--
ALTER TABLE `hellworld`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hellworld_action`
--
ALTER TABLE `hellworld_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hellworld_info`
--
ALTER TABLE `hellworld_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hellworld_logs`
--
ALTER TABLE `hellworld_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hellworld_reward`
--
ALTER TABLE `hellworld_reward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hellworld_rewards`
--
ALTER TABLE `hellworld_rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hellworld_user`
--
ALTER TABLE `hellworld_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `inv`
--
ALTER TABLE `inv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=608;

--
-- AUTO_INCREMENT для таблицы `jour`
--
ALTER TABLE `jour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `king`
--
ALTER TABLE `king`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `king_member`
--
ALTER TABLE `king_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `lair`
--
ALTER TABLE `lair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `maneken`
--
ALTER TABLE `maneken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT для таблицы `mobs`
--
ALTER TABLE `mobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `mod_chat`
--
ALTER TABLE `mod_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `mor`
--
ALTER TABLE `mor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `news_comm`
--
ALTER TABLE `news_comm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `news_go`
--
ALTER TABLE `news_go`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `news_status`
--
ALTER TABLE `news_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `news_status_read`
--
ALTER TABLE `news_status_read`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `party`
--
ALTER TABLE `party`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pet`
--
ALTER TABLE `pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pets_shop`
--
ALTER TABLE `pets_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pets_sxvatki`
--
ALTER TABLE `pets_sxvatki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pets_sxvatki_log`
--
ALTER TABLE `pets_sxvatki_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pets_sxvatki_member`
--
ALTER TABLE `pets_sxvatki_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pets_tj`
--
ALTER TABLE `pets_tj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pet_u`
--
ALTER TABLE `pet_u`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pit`
--
ALTER TABLE `pit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pitomec`
--
ALTER TABLE `pitomec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pit_item`
--
ALTER TABLE `pit_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pit_mag`
--
ALTER TABLE `pit_mag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pit_shop`
--
ALTER TABLE `pit_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pnv`
--
ALTER TABLE `pnv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `podarok`
--
ALTER TABLE `podarok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `premium`
--
ALTER TABLE `premium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `presents`
--
ALTER TABLE `presents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `present_boss`
--
ALTER TABLE `present_boss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `profesion`
--
ALTER TABLE `profesion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pvp_event`
--
ALTER TABLE `pvp_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pvp_log`
--
ALTER TABLE `pvp_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pvp_memb`
--
ALTER TABLE `pvp_memb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `quest`
--
ALTER TABLE `quest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `ref`
--
ALTER TABLE `ref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `relict`
--
ALTER TABLE `relict`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `res`
--
ALTER TABLE `res`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `revolt`
--
ALTER TABLE `revolt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `revolt_logs`
--
ALTER TABLE `revolt_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `revolt_member`
--
ALTER TABLE `revolt_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `revolt_mobs`
--
ALTER TABLE `revolt_mobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sack`
--
ALTER TABLE `sack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=468;

--
-- AUTO_INCREMENT для таблицы `stone`
--
ALTER TABLE `stone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `ticket_answer`
--
ALTER TABLE `ticket_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tj_admin`
--
ALTER TABLE `tj_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tj_users`
--
ALTER TABLE `tj_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `undying`
--
ALTER TABLE `undying`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `undying_member`
--
ALTER TABLE `undying_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `unitpay_payments`
--
ALTER TABLE `unitpay_payments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users_am`
--
ALTER TABLE `users_am`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT для таблицы `user_pet`
--
ALTER TABLE `user_pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user_pets`
--
ALTER TABLE `user_pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `v_clan`
--
ALTER TABLE `v_clan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `win_plat`
--
ALTER TABLE `win_plat`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `worldkassa`
--
ALTER TABLE `worldkassa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID платежа (Внутренний ID)';

--
-- AUTO_INCREMENT для таблицы `xsolla_billing`
--
ALTER TABLE `xsolla_billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `xsolla_payment`
--
ALTER TABLE `xsolla_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `xsolla_shop`
--
ALTER TABLE `xsolla_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `zags`
--
ALTER TABLE `zags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
