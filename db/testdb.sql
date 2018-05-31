-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2018 at 09:34 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id_pic` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id_pic`, `user_id`, `time`) VALUES
(24, 1, '2018-05-31 10:30:10'),
(25, 1, '2018-05-31 10:34:24'),
(6, 1, '2018-05-31 14:31:07'),
(10, 1, '2018-05-31 14:31:31'),
(9, 1, '2018-05-31 14:33:37'),
(11, 1, '2018-05-31 14:34:29'),
(8, 1, '2018-05-31 14:35:35'),
(12, 1, '2018-05-31 14:39:37'),
(13, 1, '2018-05-31 14:40:29'),
(14, 1, '2018-05-31 14:44:17'),
(15, 1, '2018-05-31 14:45:12'),
(26, 1, '2018-05-31 15:14:48'),
(30, 1, '2018-05-31 16:27:05'),
(1, 1, '2018-05-31 16:33:33'),
(3, 1, '2018-05-31 16:33:39');

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
(1, 1, '../../public/test/lWJviz1yFS.png', 1, '2018-05-25 11:33:13'),
(2, 1, '../../public/test/6X9xedftAo.png', 3, '2018-05-25 11:36:41'),
(3, 1, '../../public/test/bKglXGWZv6.png', 3, '2018-05-25 11:36:41'),
(4, 1, '../../public/test/ngE3Ozs4fS.png', 1, '2018-05-25 11:37:01'),
(6, 1, '../../public/test/RHcwung43h.png', 1, '2018-05-25 11:41:18'),
(8, 1, '../../public/test/9skGWOuMwg.png', 1, '2018-05-25 13:44:25'),
(9, 1, '../../public/test/vaeyNwcrqI.png', 1, '2018-05-25 13:46:23'),
(10, 1, '../../public/test/HOPgw6r0nC.png', 1, '2018-05-25 13:48:29'),
(13, 1, '../../public/test/FxRNg6PdXl.png', 1, '2018-05-25 14:41:32'),
(14, 1, '../../public/test/yBOi5o19a6.png', 1, '2018-05-31 10:16:56'),
(15, 1, '../../public/test/IkDFqe9ASg.png', 1, '2018-05-31 10:18:39'),
(16, 1, '../../public/test/Lk5iVBqyOS.png', 0, '2018-05-31 10:20:38'),
(18, 1, '../../public/test/hfvd4UM7YK.png', 0, '2018-05-31 10:22:25'),
(19, 1, '../../public/test/80t2IVPLYh.png', 0, '2018-05-31 10:26:14'),
(20, 1, '../../public/test/31b5c6EiO0.png', 0, '2018-05-31 10:27:09');

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
(1, 'risha1', '$2y$10$WyFIJ4zv6SrwOOAKS5NEnOsBYD/282GSA/PmVcBlDvRlLTAlUU3G2', 'ishtar929@gmail.com', 1, 'j9i7/dWg$f'),
(2, 'true1', '$2y$10$in70oo9aemBeHKvx1h4NKuvI.Ktm0aUlj0Z5DITUCV6nk3vfV29H2', 'qwerty@gmail.com', 0, 'BT4mi7eo0p'),
(3, 'zorro', '$2y$10$mL4g2vZijTeq.CLpg2ByseF2tGOam/15CSTbtOKf5O8Ub9X0TIkja', 'iui@lol.com', 0, '/z!nCiM1Po'),
(4, 'lola1', '$2y$10$exHIcnFbL1IZ/c1KrtxGg.fSJro1yWXCANoFHLB9lYeYa.JunVcOe', 'lola@lol.com', 0, 'BEfT1sklWN'),
(5, 'woodoo', '$2y$10$0c2TwowR99v70S3DLCAwPOcRN9rNhvhhdTUoLhdXgdSN4O6LsdRXS', 'q1q1q@jij.com', 0, 'l4M(fVHZS/'),
(6, 'google', '$2y$10$bbworNSJH9BU9XBhoXpJ5.ompIPtZzE5WY4ZxJusFqZfNDoZdzKFa', 'ishtar929@gmail.com', 1, 'xAH/lBfGLp'),
(7, 'zuzu1', '$2y$10$d5FG9/CIv/7rPs/As/h6c.Yk6K1n6wbh2JcImQ7Eo5431RTcp1Gra', 'ishtar929@gmail.com', 0, 'kht6UiXyFH');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pics`
--
ALTER TABLE `pics`
  ADD PRIMARY KEY (`id_pic`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pics`
--
ALTER TABLE `pics`
  MODIFY `id_pic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
