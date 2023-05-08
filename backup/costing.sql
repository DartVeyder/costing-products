-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Трв 08 2023 р., 17:17
-- Версія сервера: 10.3.22-MariaDB
-- Версія PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `costing`
--

-- --------------------------------------------------------

--
-- Структура таблиці `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `attributes`
--

INSERT INTO `attributes` (`id`, `unit_id`, `name`, `name_en`) VALUES
(1, 3, 'Довжина', ''),
(2, 3, 'Ширина', ''),
(3, 3, 'Діаметр', ''),
(7, 2, 'Об\'єм', ''),
(8, 8, 'Відходи', ''),
(9, 3, 'Висота', ''),
(10, 9, 'Робочий ресурс', ''),
(11, 9, 'Площа обробки', '');

-- --------------------------------------------------------

--
-- Структура таблиці `attribute_type`
--

CREATE TABLE `attribute_type` (
  `id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `attribute_type`
--

INSERT INTO `attribute_type` (`id`, `product_type_id`, `attribute_id`, `value`) VALUES
(1, 1, 1, ''),
(2, 1, 2, ''),
(4, 1, 9, ''),
(5, 1, 8, '80');

-- --------------------------------------------------------

--
-- Структура таблиці `costs`
--

CREATE TABLE `costs` (
  `id` int(11) NOT NULL,
  `cost_category_id` int(11) NOT NULL,
  `cost_type_id` int(11) DEFAULT NULL,
  `unit_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_cost` decimal(10,2) NOT NULL,
  `multiplier` float DEFAULT NULL,
  `descriptions` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `costs`
--

INSERT INTO `costs` (`id`, `cost_category_id`, `cost_type_id`, `unit_id`, `name`, `unit_cost`, `multiplier`, `descriptions`, `created_at`, `updated_at`, `delete_at`) VALUES
(18, 2, 4, 2, 'Дерево вільха', '8000.00', NULL, NULL, '2023-03-20 17:52:11', '2023-04-14 11:17:14', NULL),
(23, 1, 1, 4, 'Наждачка А', '20.00', NULL, NULL, '2023-03-30 10:30:00', '2023-04-12 15:57:23', NULL),
(24, 1, 2, 6, 'Клей', '50.00', NULL, NULL, '2023-03-30 13:14:47', '2023-04-13 10:21:41', NULL),
(25, 1, 1, 4, 'Наждачка Б', '100.00', NULL, NULL, '2023-04-13 10:24:23', '2023-04-13 10:24:57', NULL),
(26, 1, 2, 6, 'Клей В', '60.00', NULL, NULL, '2023-04-13 17:02:36', '2023-04-13 17:02:36', NULL),
(27, 1, 1, 4, 'Наждачка В', '150.00', NULL, NULL, '2023-04-13 17:03:04', '2023-04-13 17:03:04', NULL),
(29, 1, 6, 1, '50х1219мм Р320 Лента наждачка ', '1800.00', NULL, NULL, '2023-04-25 17:18:35', '2023-05-08 16:43:25', NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `cost_attributes`
--

CREATE TABLE `cost_attributes` (
  `id` int(11) NOT NULL,
  `cost_id` bigint(20) NOT NULL,
  `attribute_id` bigint(20) NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `cost_attributes`
--

INSERT INTO `cost_attributes` (`id`, `cost_id`, `attribute_id`, `value`) VALUES
(1, 29, 10, 100);

-- --------------------------------------------------------

--
-- Структура таблиці `cost_categories`
--

CREATE TABLE `cost_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `cost_categories`
--

INSERT INTO `cost_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Матеріали', '2023-03-16 17:31:08', '2023-03-16 17:31:08'),
(2, 'Сировина', '2023-03-28 17:09:34', '2023-03-28 17:09:34');

-- --------------------------------------------------------

--
-- Структура таблиці `cost_types`
--

CREATE TABLE `cost_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `cost_types`
--

INSERT INTO `cost_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Наждачка', '2023-04-12 15:55:39', '2023-04-12 15:55:39'),
(2, 'Клей', '2023-04-13 10:21:53', '2023-04-13 10:21:53'),
(4, 'Дерево', '2023-04-14 11:12:35', '2023-04-14 11:12:35'),
(6, 'Наждачка стрічкова', '2023-04-25 17:18:12', '2023-04-25 17:18:12');

-- --------------------------------------------------------

--
-- Структура таблиці `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `products`
--

INSERT INTO `products` (`id`, `product_type_id`, `sku`, `name`, `description`, `created_at`, `updated_at`, `delete_at`) VALUES
(22, 0, 'mz0001', 'Дошка', NULL, '2023-03-20 12:41:35', '2023-03-20 14:41:35', '2023-03-20 17:13:01'),
(23, 0, 'asdsf', 'dsfdsfds', NULL, '2023-03-20 14:13:17', '2023-03-20 16:13:17', '2023-03-20 17:37:50'),
(24, 0, '111', 'Дошка ', NULL, '2023-03-20 14:45:18', '2023-03-20 16:45:18', '2023-03-20 18:43:58'),
(25, 1, 'mz1111', 'Дошка ', NULL, '2023-03-20 15:44:14', '2023-03-20 17:44:14', '2023-04-07 15:10:09'),
(26, 1, 'mz598878', 'Дошка для подачі', NULL, '2023-04-03 12:30:43', '2023-04-03 15:30:43', '2023-04-07 15:10:07'),
(27, 1, 'sdasd', 'asdasdas', NULL, '2023-04-07 09:15:14', '2023-04-07 12:15:14', '2023-04-07 12:45:40'),
(28, 1, 'ghjgh', 'jghjghj', NULL, '2023-04-07 09:25:53', '2023-04-07 12:25:53', '2023-04-07 12:45:39'),
(29, 1, 'ghjgh', 'jghjghj', NULL, '2023-04-07 09:27:10', '2023-04-07 12:27:10', '2023-04-07 12:45:38'),
(30, 1, 'gfdg', 'dfgdfg', NULL, '2023-04-07 09:32:34', '2023-04-07 12:32:34', '2023-04-07 12:45:37'),
(31, 1, 'mz564646', 'Дошка вільха', NULL, '2023-04-07 09:33:13', '2023-04-07 12:33:13', '2023-04-07 12:45:37'),
(32, 1, 'івфів', 'фівфівфі', NULL, '2023-04-07 09:39:08', '2023-04-07 12:39:08', '2023-04-07 12:45:36'),
(33, 1, 'івфів', 'фівфівфі', NULL, '2023-04-07 09:39:33', '2023-04-07 12:39:33', '2023-04-07 12:45:36'),
(34, 1, 'івфів', 'фівфівфі', NULL, '2023-04-07 09:39:42', '2023-04-07 12:39:42', '2023-04-07 12:45:35'),
(35, 1, 'пвап', 'вапвап', NULL, '2023-04-07 09:40:00', '2023-04-07 12:40:00', '2023-04-07 12:45:35'),
(36, 1, 'пвап', 'вапвап', NULL, '2023-04-07 09:40:23', '2023-04-07 12:40:23', '2023-04-07 12:45:34'),
(37, 1, 'пвап', 'вапвап', NULL, '2023-04-07 09:40:42', '2023-04-07 12:40:42', '2023-04-07 12:45:33'),
(38, 1, 'т1', 'фівфв', NULL, '2023-04-07 09:41:18', '2023-04-07 12:41:18', '2023-04-07 12:45:33'),
(39, 1, 'т1', 'фівфв', NULL, '2023-04-07 09:41:50', '2023-04-07 12:41:50', '2023-04-07 12:45:32'),
(40, 1, 'вапва', 'пвпвап', NULL, '2023-04-07 09:41:57', '2023-04-07 12:41:57', '2023-04-07 12:45:31'),
(41, 1, 'вапва', 'пвпвап', NULL, '2023-04-07 09:42:25', '2023-04-07 12:42:25', '2023-04-07 12:45:27'),
(42, 1, 'вапвап', 'вапвап', NULL, '2023-04-07 09:42:31', '2023-04-07 12:42:31', '2023-04-07 12:45:29'),
(43, 1, 'віавіа', 'віавіа', NULL, '2023-04-07 09:43:39', '2023-04-07 12:43:39', '2023-04-07 12:45:29'),
(44, 1, 'віавіа', 'віавіа', NULL, '2023-04-07 09:45:10', '2023-04-07 12:45:10', '2023-04-07 12:45:30'),
(45, 1, 'fdfsdf', 'dsfsdf', NULL, '2023-04-07 11:59:37', '2023-04-07 14:59:37', '2023-04-07 15:10:07'),
(46, 7, 'нге', 'генген', NULL, '2023-04-07 12:12:33', '2023-04-07 15:12:33', '2023-04-07 15:37:39'),
(47, 1, 'mz111111', 'Дошка ', NULL, '2023-04-07 13:43:39', '2023-04-07 16:43:39', NULL),
(48, 7, '487878', 'jkjjojio', NULL, '2023-04-07 14:40:24', '2023-04-07 17:40:24', '2023-04-07 17:41:09'),
(49, 1, 'mz2222', 'Дошка Прямокутна 20*30', NULL, '2023-04-13 12:32:10', '2023-04-13 15:32:10', NULL),
(50, 1, 'mz4564', 'Дошка 20х20 Ольха', NULL, '2023-04-14 08:18:36', '2023-04-14 11:18:36', '2023-04-18 16:51:26'),
(51, 1, '1654848', 'лщщлщд', NULL, '2023-04-14 08:58:59', '2023-04-14 11:58:59', '2023-04-14 15:33:20');

-- --------------------------------------------------------

--
-- Структура таблиці `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_id`, `value`) VALUES
(1, 25, 1, 400),
(2, 25, 2, 500),
(3, 25, 9, 20),
(4, 25, 8, 60),
(5, 26, 1, 200),
(6, 26, 2, 200),
(7, 26, 9, 20),
(8, 26, 8, 60),
(9, 30, 8, 80),
(10, 31, 8, 60),
(11, 31, 1, 100),
(12, 31, 2, 200),
(13, 31, 9, 20),
(14, 34, 8, 80),
(15, 44, 8, 80),
(16, 45, 8, 90),
(17, 45, 1, 200),
(18, 45, 2, 100),
(19, 45, 9, 10),
(20, 47, 8, 70),
(21, 47, 1, 200),
(22, 47, 2, 200),
(23, 47, 9, 30),
(24, 49, 8, 80),
(25, 49, 1, 111),
(26, 49, 2, 300),
(27, 49, 9, 20),
(28, 50, 8, 70),
(29, 50, 1, 200),
(30, 50, 2, 200),
(31, 50, 9, 30),
(32, 51, 8, 90),
(33, 51, 1, 50),
(34, 51, 2, 80),
(35, 51, 9, 4);

-- --------------------------------------------------------

--
-- Структура таблиці `product_costs`
--

CREATE TABLE `product_costs` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cost_id` int(11) NOT NULL,
  `quantity` varchar(255) DEFAULT '0',
  `total_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `product_costs`
--

INSERT INTO `product_costs` (`id`, `product_id`, `cost_id`, `quantity`, `total_cost`, `description`, `created_at`, `updated_at`) VALUES
(1, 26, 18, '0.0008 кб.м', '10.67', 'Довжина 100 мм</br>Ширина 100 мм</br>Висота 100 мм</br>Відходи 40 %</br>Ціна за штуку = 8000.00 / ((1 / 100 * 60) /  0.0008 кб.м) = 10.67', '2023-04-05 12:48:57', '2023-04-05 12:48:57'),
(2, 25, 18, '0.004 кб.м', '53.33', 'Довжина 400 мм</br>Ширина 200 мм</br>Висота 20 мм</br>Відходи 60 %</br>Ціна за штуку = 8000.00 / ((1 / 100 * 60) /  0.004 кб.м) = 53.33', '2023-04-05 12:50:59', '2023-04-05 12:50:59'),
(3, 26, 23, '0.2 м', '4.00', NULL, '2023-04-05 12:53:12', '2023-04-05 12:53:12'),
(4, 26, 24, '0.1 л', '5.00', NULL, '2023-04-05 12:53:20', '2023-04-05 12:53:20'),
(5, 25, 23, '0.1 м', '2.00', NULL, '2023-04-05 14:08:15', '2023-04-05 14:08:15'),
(6, 25, 24, '0.3 л', '15.00', NULL, '2023-04-05 14:08:21', '2023-04-05 14:08:21'),
(7, 31, 18, '0.0004 кб.м', '5.33', 'Довжина 100 мм</br>Ширина 200 мм</br>Висота 20 мм</br>Відходи 80 %</br>Ціна за штуку = 8000.00 / ((1 / 100 * 60) /  0.0004 кб.м) = 5.33', '2023-04-07 12:33:25', '2023-04-07 12:33:25'),
(8, 45, 18, '0.0002 кб.м', '1.78', 'Довжина  мм</br>Ширина  мм</br>Висота  мм</br>Відходи 90 %</br>Ціна за штуку = 8000.00 / ((1 / 100 * 90) /  0.0002 кб.м) = 1.78', '2023-04-07 14:59:48', '2023-04-07 14:59:48'),
(9, 47, 18, '0.0012 кб.м', '13.71', 'Довжина 200 мм</br>Ширина 200 мм</br>Висота 30 мм</br>Відходи 70 </br>Ціна за штуку = 8000.00 / ((1 / 100 * 70) /  0.0012 кб.м) = 13.71', '2023-04-07 16:43:48', '2023-04-07 16:43:48'),
(10, 47, 23, '0.1 м', '2.00', NULL, '2023-04-07 16:44:08', '2023-04-07 16:44:08'),
(17, 49, 18, '0.0012 кб.м', '12.00', 'Довжина 200 мм</br>Ширина 300 мм</br>Висота 20 мм</br>Відходи 80 </br>Ціна за штуку = 8000.00 / ((1 / 100 * 80) /  0.0012 кб.м) = 12', '2023-04-13 15:33:03', '2023-04-13 15:33:03'),
(22, 50, 26, '0.05 л', '3.00', NULL, '2023-04-14 11:21:00', '2023-04-14 11:21:00'),
(23, 50, 28, '0.0012 кб.м', '49.85', 'Довжина 200 мм</br>Ширина 200 мм</br>Висота 30 мм</br>Відходи 65 </br>Ціна за штуку = 27000.00 / ((1 / 100 * 65) /  0.0012 кб.м) = 49.85', '2023-04-14 11:48:31', '2023-04-14 11:48:31'),
(24, 50, 18, '0.0012 кб.м', '13.71', 'Довжина 200 мм</br>Ширина 200 мм</br>Висота 30 мм</br>Відходи 29 </br>Ціна за штуку = 8000.00 / ((1 / 100 * 70) /  0.0012 кб.м) = 13.71', '2023-04-14 11:57:26', '2023-04-14 11:57:26'),
(25, 51, 28, '1.6E-5 кб.м', '0.48', 'Довжина  мм</br>Ширина  мм</br>Висота  мм</br>Відходи 90 </br>Ціна за штуку = 27000.00 / ((1 / 100 * 90) /  1.6E-5 кб.м) = 0.48', '2023-04-14 11:59:10', '2023-04-14 11:59:10'),
(32, 47, 29, '0.0004', '0.72', NULL, '2023-05-08 16:12:44', '2023-05-08 16:12:44'),
(34, 49, 29, '0', '0.00', NULL, '2023-05-08 17:10:30', '2023-05-08 17:10:30');

-- --------------------------------------------------------

--
-- Структура таблиці `product_cost_atrributes`
--

CREATE TABLE `product_cost_atrributes` (
  `id` int(10) NOT NULL,
  `product_cost_id` int(10) NOT NULL,
  `attribute_id` int(10) NOT NULL,
  `value` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `product_cost_atrributes`
--

INSERT INTO `product_cost_atrributes` (`id`, `product_cost_id`, `attribute_id`, `value`) VALUES
(1, 32, 11, 0.08),
(2, 34, 11, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `product_types`
--

CREATE TABLE `product_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Пиломатеріали', '2023-03-21 17:11:48', '2023-03-21 17:11:48'),
(7, 'ХДФ', '2023-04-07 15:11:47', '2023-04-07 15:11:47');

-- --------------------------------------------------------

--
-- Структура таблиці `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `units`
--

INSERT INTO `units` (`id`, `name`) VALUES
(1, 'шт'),
(2, 'кб.м'),
(3, 'мм'),
(4, 'м'),
(6, 'л'),
(8, '%'),
(9, 'кв.м');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `attribute_type`
--
ALTER TABLE `attribute_type`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `cost_attributes`
--
ALTER TABLE `cost_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `cost_categories`
--
ALTER TABLE `cost_categories`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `cost_types`
--
ALTER TABLE `cost_types`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `product_costs`
--
ALTER TABLE `product_costs`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Індекси таблиці `product_cost_atrributes`
--
ALTER TABLE `product_cost_atrributes`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблиці `attribute_type`
--
ALTER TABLE `attribute_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблиці `costs`
--
ALTER TABLE `costs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблиці `cost_attributes`
--
ALTER TABLE `cost_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблиці `cost_categories`
--
ALTER TABLE `cost_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблиці `cost_types`
--
ALTER TABLE `cost_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблиці `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT для таблиці `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблиці `product_costs`
--
ALTER TABLE `product_costs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблиці `product_cost_atrributes`
--
ALTER TABLE `product_cost_atrributes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблиці `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблиці `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
