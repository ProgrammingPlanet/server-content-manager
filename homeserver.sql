-- phpMyAdmin SQL Dump
-- version 5.0.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2020 at 06:38 PM
-- Server version: 5.7.28-0ubuntu0.18.04.4
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homeserver`
--

-- --------------------------------------------------------

--
-- Table structure for table `Captions`
--

CREATE TABLE `Captions` (
  `id` varchar(20) NOT NULL,
  `lang` varchar(5) NOT NULL,
  `lable` varchar(25) NOT NULL,
  `type` varchar(10) NOT NULL,
  `uploaded_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Captions`
--

INSERT INTO `Captions` (`id`, `lang`, `lable`, `type`, `uploaded_at`) VALUES
('abcdefghij', 'en', 'English', 'vtt', '2020-02-23 15:34:44'),
('abcdefghij', 'fr', 'French', 'vtt', '2020-02-23 15:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `Medias`
--

CREATE TABLE `Medias` (
  `id` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `owner` varchar(10) NOT NULL,
  `content_type` varchar(50) NOT NULL,
  `size` double NOT NULL,
  `quality` varchar(20) NOT NULL,
  `uploaded_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Medias`
--

INSERT INTO `Medias` (`id`, `title`, `owner`, `content_type`, `size`, `quality`, `uploaded_at`) VALUES
('abcdefghij', 'view from blue moon', 'user1', 'video/mp4', 25698720, '240', '1583092690'),
('abcdefghij', 'view from blue moon', 'user1', 'video/mp4', 25698720, '576', '1583092690'),
('abcdefghik', 'hitman', 'user2', 'audio/mp3', 6256987, '320', '1582472088');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Captions`
--
ALTER TABLE `Captions`
  ADD PRIMARY KEY (`id`,`lang`);

--
-- Indexes for table `Medias`
--
ALTER TABLE `Medias`
  ADD PRIMARY KEY (`id`,`quality`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

