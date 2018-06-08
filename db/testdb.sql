-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2018 at 10:51 AM
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
(12, 2, 1, 'qwerty'),
(13, 2, 1, 'tyuio'),
(14, 2, 1, 'Мы только что получили запрос на изменение вашего пароля.\nЕсли вы не отправляли подобный запрос, проигнорируйте это сообщение. Однако, если'),
(15, 2, 1, 'If this is your first visit, be sure to check out the FAQ by clicking the link above. You may have to register before you can post: click th'),
(16, 2, 1, 'margin:0;\n		margin-top:3%;\n		border:0;\n		padding:1%;\n		display: block;\n		vertical-align:top;\n		white-space:normal;\n		background:none;\n		line'),
(18, 10, 11, 'very good)'),
(19, 10, 11, 'nice'),
(20, 10, 11, 'againe'),
(21, 10, 11, 'hopeless'),
(22, 38, 1, 'very good)'),
(23, 38, 1, 'ertyui'),
(24, 38, 1, '(=^-^=)'),
(25, 38, 1, 'like)'),
(26, 1, 1, 'some txt');

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
(10, 1, '2018-05-31 14:31:31'),
(9, 1, '2018-05-31 14:33:37'),
(11, 1, '2018-05-31 14:34:29'),
(12, 1, '2018-05-31 14:39:37'),
(13, 1, '2018-05-31 14:40:29'),
(14, 1, '2018-05-31 14:44:17'),
(26, 1, '2018-05-31 15:14:48'),
(30, 1, '2018-05-31 16:27:05'),
(6, 1, '2018-06-01 07:57:22'),
(8, 1, '2018-06-01 08:53:36'),
(33, 9, '2018-06-01 09:40:30'),
(2, 9, '2018-06-01 09:56:47'),
(1, 8, '2018-06-01 09:59:23'),
(1, 7, '2018-06-01 09:59:43'),
(1, 9, '2018-06-01 10:06:19'),
(3, 9, '2018-06-01 10:09:00'),
(33, 10, '2018-06-01 10:16:01'),
(35, 10, '2018-06-01 10:51:24'),
(37, 10, '2018-06-01 10:51:29'),
(2, 1, '2018-06-08 09:57:17');

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
(1, 1, '../../public/test/lWJviz1yFS.png', 999999, '2018-05-25 11:33:13'),
(2, 1, '../../public/test/6X9xedftAo.png', 5, '2018-05-25 11:36:41'),
(3, 1, '../../public/test/bKglXGWZv6.png', 3, '2018-05-25 11:36:41'),
(4, 1, '../../public/test/ngE3Ozs4fS.png', 1, '2018-05-25 11:37:01'),
(6, 1, '../../public/test/RHcwung43h.png', 1, '2018-05-25 11:41:18'),
(8, 1, '../../public/test/9skGWOuMwg.png', 1, '2018-05-25 13:44:25'),
(9, 1, '../../public/test/vaeyNwcrqI.png', 1, '2018-05-25 13:46:23'),
(10, 1, '../../public/test/HOPgw6r0nC.png', 1, '2018-05-25 13:48:29'),
(13, 1, '../../public/test/FxRNg6PdXl.png', 1, '2018-05-25 14:41:32'),
(14, 1, '../../public/test/yBOi5o19a6.png', 1, '2018-05-31 10:16:56'),
(15, 1, '../../public/test/IkDFqe9ASg.png', 0, '2018-05-31 10:18:39'),
(16, 1, '../../public/test/Lk5iVBqyOS.png', 0, '2018-05-31 10:20:38'),
(18, 1, '../../public/test/hfvd4UM7YK.png', 0, '2018-05-31 10:22:25'),
(19, 1, '../../public/test/80t2IVPLYh.png', 0, '2018-05-31 10:26:14'),
(20, 1, '../../public/test/31b5c6EiO0.png', 0, '2018-05-31 10:27:09'),
(32, 1, '../../public/test/zRi68rEI3U.png', 0, '2018-06-01 08:47:12'),
(33, 1, '../../public/test/5scDTb17fj.png', 2, '2018-06-01 08:54:54'),
(34, 9, '../../public/test/bSJzhmxeL2.png', 0, '2018-06-01 09:40:42'),
(35, 9, '../../public/test/AK5SY6POHG.png', 1, '2018-06-01 09:40:52'),
(37, 10, '../../public/test/yEFrJ7dxw9.png', 1, '2018-06-01 10:51:13'),
(38, 11, '../../public/test/VAxn7uo8Z9.png', 0, '2018-06-08 14:46:16'),
(39, 1, '../../public/test/V1nCIbRBml.png', 0, '2018-06-08 15:50:06'),
(40, 1, '../../public/test/CpoDQ4ak7F.png', 0, '2018-06-08 15:51:32'),
(41, 1, '../../public/test/bEMBf7cNhI.png', 0, '2018-06-08 15:53:41'),
(42, 1, '../../public/test/EA0SOm7Xtc.png', 0, '2018-06-08 15:54:55'),
(43, 1, '../../public/test/DbKmq7Xlzc.png', 0, '2018-06-08 15:56:12'),
(44, 1, '../../public/test/816nXyS50a.png', 0, '2018-06-08 16:32:32');

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
(1, 1, 0, 1, 1),
(2, 11, 1, 1, 1);

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
(1, 'risha1', '$2y$10$WyFIJ4zv6SrwOOAKS5NEnOsBYD/282GSA/PmVcBlDvRlLTAlUU3G2', 'ishtr929@gmail.com', 1, 'j9i7/dWg$f'),
(2, 'true1', '$2y$10$in70oo9aemBeHKvx1h4NKuvI.Ktm0aUlj0Z5DITUCV6nk3vfV29H2', 'qwerty@gmail.com', 0, 'BT4mi7eo0p'),
(3, 'zorro', '$2y$10$mL4g2vZijTeq.CLpg2ByseF2tGOam/15CSTbtOKf5O8Ub9X0TIkja', 'iui@lol.com', 0, '/z!nCiM1Po'),
(4, 'lola1', '$2y$10$exHIcnFbL1IZ/c1KrtxGg.fSJro1yWXCANoFHLB9lYeYa.JunVcOe', 'lola@lol.com', 0, 'BEfT1sklWN'),
(5, 'woodoo', '$2y$10$0c2TwowR99v70S3DLCAwPOcRN9rNhvhhdTUoLhdXgdSN4O6LsdRXS', 'q1q1q@jij.com', 0, 'l4M(fVHZS/'),
(6, 'google', '$2y$10$bbworNSJH9BU9XBhoXpJ5.ompIPtZzE5WY4ZxJusFqZfNDoZdzKFa', '123@gmail.com', 1, 'xAH/lBfGLp'),
(7, 'zuzu1', '$2y$10$d5FG9/CIv/7rPs/As/h6c.Yk6K1n6wbh2JcImQ7Eo5431RTcp1Gra', 'ishtar9@gmail.com', 0, 'kht6UiXyFH'),
(8, 'soap5', '$2y$10$ZNdFS2HgPsw1NK7PMwrpaOgGyx602gyOdGB1kd9rjUhX16pGB0.oC', 'soap5@i.ua', 0, '/pnBhS4bGlL5$RAXicCD'),
(9, 'soap4', '$2y$10$vbYTBgPZUcaXftqsjj5bdOtY4PIu3PoSyScxo2ycWFZsmv6M8uje2', 'tqwqts@gmail.com', 1, 'NJhfi132Rm(nlWQEFrcu'),
(10, 'PineApple', '$2y$10$Bm/DYYDgejrrPeQ.0zkjquJsoZ6ZihbxLiQp2IdV5Cy0m/ExuQ/oy', 'istar929@gmail.com', 1, 'mX7AOfhj/pBt2ezR53wq'),
(11, 'mamboJambo', '$2y$10$DMu1QC2Ka3U/r6ep862IJuDc/pJPuiiechSTsuiPkUWK4xOz3iJte', 'ishar929@gmail.com', 1, '9KHrbku*Is03Pn8a/wlA'),
(15, '<script type=\"text/javascript\">alert(\"111\")</script>', '$2y$10$AtzoCz/CySlfnn/H4jWifeH6ZF3OJ0ueItVy1wM0BCuTOXhoqUZW6', 'ishtar929@gmail.com', 0, 'mGYHRkP(eDoNJ8Q*5iVt');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pics`
--
ALTER TABLE `pics`
  MODIFY `id_pic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
