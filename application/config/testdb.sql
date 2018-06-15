-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2018 at 07:46 AM
-- Server version: 5.7.21
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_pic` int(11) NOT NULL,
  `who_comment` int(11) NOT NULL,
  `comment_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_pic`, `who_comment`, `comment_text`) VALUES
(27, 42, 16, 'I like anime (=^-^=)'),
(28, 42, 17, 'nice))'),
(29, 42, 18, 'like your style!'),
(30, 48, 18, 'like your style!'),
(31, 46, 18, 'like your style!'),
(33, 49, 18, 'Продам котят, недорого'),
(34, 42, 19, 'Call me cacao))'),
(35, 51, 19, 'bOOOOOOO))');

-- --------------------------------------------------------

--
-- Table structure for table `layers`
--

CREATE TABLE `layers` (
  `id` int(11) NOT NULL,
  `src` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `layers`
--

INSERT INTO `layers` (`id`, `src`) VALUES
(1, '../../templates/layers/grampy.png'),
(2, '../../templates/layers/doge.png'),
(3, '../../templates/layers/space-cat.png'),
(4, '../../templates/layers/wowcat.png'),
(5, '../../templates/layers/ihorunya.png'),
(6, '../../templates/layers/rainbow.png'),
(7, '../../templates/layers/spidy.gif'),
(8, '../../templates/layers/anime.png'),
(9, '../../templates/layers/snow.png'),
(15, '../../templates/layers/cat.png');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `id_pic` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `id_pic`, `user_id`, `time`) VALUES
(22, 42, 16, '2018-06-08 09:57:17'),
(24, 42, 17, '2018-06-15 13:58:50'),
(25, 45, 17, '2018-06-15 13:58:51'),
(26, 46, 17, '2018-06-15 13:58:52'),
(27, 49, 18, '2018-06-15 14:02:15'),
(28, 48, 18, '2018-06-15 14:02:16'),
(29, 47, 18, '2018-06-15 14:02:17'),
(30, 46, 18, '2018-06-15 14:02:20'),
(31, 45, 18, '2018-06-15 14:02:21'),
(32, 42, 18, '2018-06-15 14:02:21'),
(33, 51, 19, '2018-06-15 14:07:46'),
(34, 50, 19, '2018-06-15 14:07:47'),
(35, 49, 19, '2018-06-15 14:07:47'),
(36, 45, 19, '2018-06-15 14:07:49'),
(37, 46, 19, '2018-06-15 14:07:50'),
(38, 47, 19, '2018-06-15 14:07:51'),
(39, 42, 19, '2018-06-15 14:07:53'),
(40, 52, 19, '2018-06-15 14:10:35'),
(41, 66, 20, '2018-06-15 14:29:17'),
(42, 65, 20, '2018-06-15 14:29:17'),
(43, 64, 20, '2018-06-15 14:29:18'),
(44, 61, 20, '2018-06-15 14:29:19'),
(45, 62, 20, '2018-06-15 14:29:20'),
(46, 63, 20, '2018-06-15 14:29:21'),
(47, 60, 20, '2018-06-15 14:29:23'),
(48, 52, 20, '2018-06-15 14:29:24'),
(49, 51, 20, '2018-06-15 14:29:25'),
(50, 50, 20, '2018-06-15 14:29:26'),
(51, 49, 20, '2018-06-15 14:29:26'),
(52, 47, 20, '2018-06-15 14:29:27'),
(53, 46, 20, '2018-06-15 14:29:30'),
(54, 45, 20, '2018-06-15 14:29:31'),
(55, 42, 20, '2018-06-15 14:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `pics`
--

CREATE TABLE `pics` (
  `id_pic` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `link` text NOT NULL,
  `likes` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pics`
--

INSERT INTO `pics` (`id_pic`, `user_id`, `link`, `likes`, `date`) VALUES
(42, 16, '../../public/test/2yZ1M3KEVx.png', 5, '2018-06-08 15:54:55'),
(45, 17, '../../public/test/ArV5dhGKf6.png', 4, '2018-06-15 13:58:34'),
(46, 17, '../../public/test/FxRNg6PdXl.png', 4, '2018-06-15 13:58:34'),
(47, 18, '../../public/test/PLDIiUvrhq.png', 3, '2018-06-15 14:01:58'),
(49, 18, '../../public/test/s0vW9dj8az.png', 3, '2018-06-15 14:01:58'),
(50, 19, '../../public/test/TrqSmCoctU.png', 2, '2018-06-15 14:06:31'),
(51, 19, '../../public/test/vEqL1kXFNn.png', 2, '2018-06-15 14:06:31'),
(52, 19, '../../public/test/x3zVCbmjLT.png', 2, '2018-06-15 14:10:07'),
(60, 20, '../../public/test/DBtLx7HeVP.png', 1, '2018-06-15 14:27:20'),
(61, 20, '../../public/test/4gToIJFNSi.png', 1, '2018-06-15 14:28:23'),
(62, 20, '../../public/test/pseZqmRTX3.png', 1, '2018-06-15 14:28:32'),
(63, 20, '../../public/test/SajhcyLReP.png', 1, '2018-06-15 14:28:42'),
(64, 20, '../../public/test/tUhx54KbEi.png', 1, '2018-06-15 14:28:50'),
(65, 20, '../../public/test/d7oYRTPlmO.png', 1, '2018-06-15 14:29:01'),
(66, 20, '../../public/test/0jiKkIoMTv.png', 1, '2018-06-15 14:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_comment` tinyint(4) NOT NULL DEFAULT '1',
  `sub_pass` tinyint(4) NOT NULL DEFAULT '1',
  `sub_login` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `user_id`, `sub_comment`, `sub_pass`, `sub_login`) VALUES
(3, 16, 1, 1, 1),
(4, 17, 1, 1, 1),
(5, 18, 1, 1, 1),
(6, 19, 1, 1, 1),
(7, 20, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `login` text NOT NULL,
  `pass` text NOT NULL,
  `email` text NOT NULL,
  `isEmailConfirmed` tinyint(4) NOT NULL DEFAULT '0',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`, `isEmailConfirmed`, `token`) VALUES
(16, 'risha', '$2y$10$eYKjSQTyrelUNxOniPyl2.bEvq7RJXfmZ2EJpx6CVrQ4cNSBPyJI2', 'ishtar@gmail.com', 1, 'sZ0GD$*aPt/Jfq5gbz3r'),
(17, 'totoshka', '$2y$10$V/y6ChQRtNGNYGBoOpVj1.udG.JKgZPVPLEggYHsJMkzXxrLFNfgG', 'ishtar@gmail.com', 1, 'yxadRzA8r!13NIPkUi(w'),
(18, 'MiriamMaisel', '$2y$10$g5PVqMNLel1nZXaoFAgk6.vmv87kJnSRZJRERRYLfrxxeFPuQp4zu', 'ishtar@gmail.com', 1, '8VNfM362Igu4*pXRawoP'),
(19, 'Zorro', '$2y$10$U89JokxeXU4m4Ecqxx7V2ueniIDm/1iIG1pAn9t4esRfgdaoht9gW', 'ishtar@gmail.com', 1, '$Z*pIGCV4F13vhY0UPsn'),
(20, 'SelectedPhoto', '$2y$10$FWdJnJeX1EsVMvMmob5DaObljx.TX6xi1v6AsqO17KgS3GYEIeIwa', 'ishtar929@gmail.com', 1, '81shl5oxe0Wp/AUvqb3j');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layers`
--
ALTER TABLE `layers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pics`
--
ALTER TABLE `pics`
  ADD PRIMARY KEY (`id_pic`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `layers`
--
ALTER TABLE `layers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `pics`
--
ALTER TABLE `pics`
  MODIFY `id_pic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
