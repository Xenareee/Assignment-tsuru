-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Generation Time: Feb 29, 2024 at 09:10 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kanjiwebsite`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kanji`
--

CREATE TABLE `kanji` (
  `sortid` int(11) NOT NULL,
  `kanji` varchar(3) NOT NULL,
  `meaning` varchar(30) NOT NULL,
  `description` varchar(500) NOT NULL,
  `readingskun` varchar(100) NOT NULL,
  `readingson` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kanji`
--

INSERT INTO `kanji` (`sortid`, `kanji`, `meaning`, `description`, `readingskun`, `readingson`) VALUES
(0, '一', 'jeden, 1', '', '', ''),
(34, '丁', 'ulica', '', '', ''),
(16, '七', 'siedem, 7', '', '', ''),
(33, '万', 'sto tysięcy, 10000', '', '', ''),
(2, '三', 'trzy, 3', '', '', ''),
(5, '上', 'ponad', '', '', ''),
(6, '下', 'poniżej', '', '', ''),
(27, '中', 'środek', '', '', ''),
(50, '丸', 'okrągły, kulisty', '', '', ''),
(18, '九', 'dziewięć, 9', '', '', ''),
(39, '了', 'koniec', '', '', ''),
(1, '二', 'dwa, 2', '', '', ''),
(14, '五', 'pięć, 5', '', '', ''),
(3, '人', 'człowiek', '', '', ''),
(54, '今', 'teraz', '', '', ''),
(20, '入', 'wejść, wchodzić', '', '', ''),
(17, '八', 'osiem, 8', '', '', ''),
(15, '六', 'sześć, 6', '', '', ''),
(29, '円', 'yen, pieniądz', '', '', ''),
(46, '出', 'wyjście, wyjść', '', '', ''),
(7, '力', 'moc', '', '', ''),
(19, '十', 'dziesięć, 10', '', '', ''),
(32, '千', 'tysiąc, 1000', '', '', ''),
(11, '口', 'usta', '', '', ''),
(49, '古', 'stary, stare', '', '', ''),
(13, '四', 'cztery, 4', '', '', ''),
(30, '土', 'ziemia, gleba', '', '', ''),
(45, '夕', 'wieczór', '', '', ''),
(4, '大', 'duży', '', '', ''),
(12, '女', 'kobieta', '', '', ''),
(48, '子', 'dziecko', '', '', ''),
(42, '寸', 'mierzyć, miara', '', '', ''),
(47, '寺', 'świątynia', '', '', ''),
(22, '小', 'mały', '', '', ''),
(9, '山', 'góra', '', '', ''),
(8, '川', 'rzeka', '', '', ''),
(10, '工', 'budowa, konstrukcja', '', '', ''),
(44, '心', 'serce', '', '', ''),
(52, '手', 'ręka, dłoń', '', '', ''),
(38, '文', 'pisanie, pisać, pismo', '', '', ''),
(24, '日', 'słońce, dzień', '', '', ''),
(55, '時', 'czas', '', '', ''),
(25, '月', 'księżyc, miesiąc', '', '', ''),
(23, '木', 'drzewo', '', '', ''),
(43, '本', 'książka, źródło', '', '', ''),
(53, '母', 'matka, mama', '', '', ''),
(36, '水', 'woda', '', '', ''),
(28, '火', 'ogień', '', '', ''),
(41, '父', 'ojciec, tata', '', '', ''),
(21, '犬', 'pies', '', '', ''),
(51, '玉', 'piłka, klejnot', '', '', ''),
(40, '王', 'król', '', '', ''),
(26, '田', 'pole ryżowe, pole', '', '', ''),
(37, '白', 'biały, biel', '', '', ''),
(31, '百', 'sto, 100', '', '', ''),
(35, '目', 'oko', '', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kanjiprogress`
--

CREATE TABLE `kanjiprogress` (
  `kanji` varchar(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `progress` int(11) NOT NULL DEFAULT 0,
  `nextreview` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kanjiprogress`
--

INSERT INTO `kanjiprogress` (`kanji`, `username`, `progress`, `nextreview`) VALUES
('一', 'a', 1, '1687463086'),
('一', 'Ala', 1, '1687541006'),
('一', 'q', 1, '1687538276'),
('三', 'a', 1, '1687463086'),
('三', 'Ala', 1, '1687541006'),
('三', 'q', 1, '1687538276'),
('上', 'q', 2, '1687559876'),
('二', 'a', 1, '1687463086'),
('二', 'Ala', 1, '1687541006'),
('二', 'q', 2, '1687559876'),
('人', 'a', 1, '1687463086'),
('人', 'Ala', 0, '1687523006'),
('人', 'q', 2, '1687559876'),
('大', 'a', 0, '1687445086'),
('大', 'Ala', 0, '1687523006'),
('大', 'q', 9, '1718890131');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kanjiuser`
--

CREATE TABLE `kanjiuser` (
  `username` varchar(20) NOT NULL,
  `psswrd` varchar(100) NOT NULL,
  `pet` int(5) NOT NULL DEFAULT 0,
  `profilepicture` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kanjiuser`
--

INSERT INTO `kanjiuser` (`username`, `psswrd`, `pet`, `profilepicture`) VALUES
('a', 'e2a0e5e38b778421cceafbfe9a37068b032093fd', 0, 1),
('Ala', 'db56f9c099f771ee71e2a05099ae8adeb4921179', 0, 4),
('jolkafasolka', 'c8ca030861a1f9dc1b2b5aa26c88bbeda5f41c59', 0, 10),
('q', '41c5bafa4a270628d90f7d4ce3cdde6a0aa8771d', 0, 1),
('tatus', '0c7eedaa87eb59a8af7ccf97b7687a47da2b71f9', 0, 9),
('yee', 'e2a0e5e38b778421cceafbfe9a37068b032093fd', 0, 6);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kanji`
--
ALTER TABLE `kanji`
  ADD PRIMARY KEY (`kanji`),
  ADD UNIQUE KEY `sortid` (`sortid`);

--
-- Indeksy dla tabeli `kanjiprogress`
--
ALTER TABLE `kanjiprogress`
  ADD PRIMARY KEY (`kanji`,`username`);

--
-- Indeksy dla tabeli `kanjiuser`
--
ALTER TABLE `kanjiuser`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
