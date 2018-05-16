-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Май 16 2018 г., 07:49
-- Версия сервера: 5.7.21
-- Версия PHP: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
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
-- Дамп данных таблицы `users`
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
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
