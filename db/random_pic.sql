-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 11, 2018 at 07:14 AM
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
-- Table structure for table `random_pic`
--

CREATE TABLE `random_pic` (
  `id` int(11) NOT NULL,
  `pic` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `random_pic`
--

TRUNCATE TABLE `random_pic`;
--
-- Dumping data for table `random_pic`
--

INSERT INTO `random_pic` (`id`, `pic`) VALUES
(1, '../templates/img/1.jpg'),
(2, '../templates/img/2.jpg'),
(3, '../templates/img/3.jpg'),
(4, '../templates/img/4.jpg'),
(5, '../templates/img/5.jpg'),
(6, '../templates/img/6.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `random_pic`
--
ALTER TABLE `random_pic`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
