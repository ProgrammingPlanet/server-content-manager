-- phpMyAdmin SQL Dump
-- version 5.0.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 11, 2020 at 03:30 PM
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
-- Table structure for table `Audios`
--

CREATE TABLE `Audios` (
  `id` varchar(20) NOT NULL,
  `quality` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `size` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Audios`
--

INSERT INTO `Audios` (`id`, `quality`, `type`, `size`) VALUES
('abcdefghik', 320, 'mp3', 8035387);

-- --------------------------------------------------------

--
-- Table structure for table `Captions`
--

CREATE TABLE `Captions` (
  `id` varchar(20) NOT NULL,
  `lang` varchar(5) NOT NULL,
  `lable` varchar(25) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Captions`
--

INSERT INTO `Captions` (`id`, `lang`, `lable`, `type`) VALUES
('abcdefghij', 'en', 'English', 'vtt'),
('abcdefghij', 'fr', 'French', 'vtt');

-- --------------------------------------------------------

--
-- Table structure for table `Contents`
--

CREATE TABLE `Contents` (
  `id` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `owner` varchar(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `views` bigint(20) NOT NULL DEFAULT '0',
  `downloads` bigint(20) NOT NULL DEFAULT '0',
  `uploaded_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Contents`
--

INSERT INTO `Contents` (`id`, `title`, `owner`, `type`, `views`, `downloads`, `uploaded_at`) VALUES
('abcdefghij', 'view from blue moon', 'user1', 'video', 64, 0, '2020-03-04 09:13:25'),
('abcdefghik', 'hitman', 'user2', 'audio', 13, 0, '2020-03-03 09:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `Videos`
--

CREATE TABLE `Videos` (
  `id` varchar(20) NOT NULL,
  `quality` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `size` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Videos`
--

INSERT INTO `Videos` (`id`, `quality`, `type`, `size`) VALUES
('abcdefghij', 240, 'mp4', 14323168),
('abcdefghij', 576, 'mp4', 49900386);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Audios`
--
ALTER TABLE `Audios`
  ADD PRIMARY KEY (`id`,`quality`);

--
-- Indexes for table `Captions`
--
ALTER TABLE `Captions`
  ADD PRIMARY KEY (`id`,`lang`);

--
-- Indexes for table `Contents`
--
ALTER TABLE `Contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Videos`
--
ALTER TABLE `Videos`
  ADD PRIMARY KEY (`id`,`quality`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

