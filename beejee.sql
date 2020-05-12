-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 12 2020 г., 05:40
-- Версия сервера: 5.5.53
-- Версия PHP: 7.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `beejee`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `content` text NOT NULL,
  `addDate` datetime NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `adedited` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `user`, `name`, `content`, `addDate`, `email`, `status`, `adedited`) VALUES
(1, 2, 'Александр', 'Описание задачи №2', '2017-07-29 08:00:00', 'user1@test.com', 1, 1),
(2, 1, 'Сергей', 'Описание задачи №1', '2017-07-29 09:00:00', 'user2@test.com', 0, 0),
(3, 0, 'Алиса', 'Описание задачи №3', '2020-05-10 00:00:00', 'user3@test.com', 1, 0),
(4, 0, 'Елена', 'Описание задачи №4', '2020-05-10 00:00:00', 'user4@test.com', 0, 0),
(5, 0, 'Ян', 'dsa', '2020-05-12 02:39:16', 'user-yournumber@test.com', 0, 0),
(6, 0, 'Ян', 'dsa', '2020-05-12 02:59:42', 'user-yournumber@test.com', 1, 0),
(7, 0, 'Ян', '<script a=\"b\">alert(\'test\');</script>', '2020-05-12 03:00:37', 'user-yournumber@test.com', 0, 1),
(8, 1, 'Администратор', 'da fdafadsf sadfa sdfas d', '2020-05-12 03:00:57', 'admin@test.com', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users2`
--

CREATE TABLE `users2` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `salt` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `grade` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `users2`
--

INSERT INTO `users2` (`id`, `login`, `name`, `email`, `salt`, `password`, `grade`) VALUES
(1, 'admin', 'Администратор', 'admin@test.com', '202cb962ac59075b964b07152d234b70', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1),
(2, 'user1', 'Пользователь-1', 'u1@rambler.ru', '202cb962ac59075b964b07152d234b70', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0),
(3, 'user2', 'Пользователь-2', 'u2@rambler.ru', '', '', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users2`
--
ALTER TABLE `users2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `users2`
--
ALTER TABLE `users2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
