-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 21 2026 г., 21:19
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `task2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Clients`
--

CREATE TABLE `Clients` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('User','Admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Clients`
--

INSERT INTO `Clients` (`id`, `name`, `email`, `phone`, `password`, `role`, `is_blocked`) VALUES
(11, 'mojebka12345', 'thehookzip3@gmail.com', '1231231231', '$2y$10$xuEbVzrx.3.bSJgciR7zauh/99y9rtcLJ8ZuLKBCBIcI/pq5nzOcS', 'User', 0),
(12, 'Flstudio67', 'thehookzip1@gmail.com', '1231231231', '$2y$10$OvSQqkZRxp9ovH00vGiUpumrtwDFwGt0KJv35lv4lpIvF1AB2nQsy', 'User', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `Orders`
--

CREATE TABLE `Orders` (
  `id` int NOT NULL,
  `client_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(15,2) DEFAULT NULL,
  `status` enum('paid','cancelled','shipped','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Orders`
--

INSERT INTO `Orders` (`id`, `client_id`, `product_id`, `created_at`, `total_amount`, `status`) VALUES
(8, 11, 15, '2026-10-21 20:56:59', '1.28', 'shipped'),
(9, 11, 16, '2026-10-21 20:57:31', '269.00', 'cancelled'),
(10, 12, 17, '2026-10-21 20:58:28', '145888.00', 'paid'),
(11, 12, 16, '2026-10-21 20:58:52', '2325.00', 'paid'),
(12, 12, 15, '2026-10-21 20:59:07', '12345.00', 'shipped'),
(13, 12, 16, '2026-10-21 21:03:19', '1.21', 'cancelled');

-- --------------------------------------------------------

--
-- Структура таблицы `Product`
--

CREATE TABLE `Product` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `remains` decimal(10,2) DEFAULT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Product`
--

INSERT INTO `Product` (`id`, `name`, `price`, `remains`, `category_id`) VALUES
(15, 'Бананы', '12.00', '69.00', 14),
(16, 'Яблооко', '1.32', '44.00', 13),
(17, 'Огурец', '12.00', '43.00', 12),
(18, 'Помидор', '34.00', '23.00', 12);

-- --------------------------------------------------------

--
-- Структура таблицы `Product_category`
--

CREATE TABLE `Product_category` (
  `id` int NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Product_category`
--

INSERT INTO `Product_category` (`id`, `category`) VALUES
(12, 'Овощи'),
(13, 'Фрукты'),
(14, 'Ягоды');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `Product_category`
--
ALTER TABLE `Product_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Clients`
--
ALTER TABLE `Clients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `Product`
--
ALTER TABLE `Product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `Product_category`
--
ALTER TABLE `Product_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders` FOREIGN KEY (`client_id`) REFERENCES `Clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `Clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_product` FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_product_fk` FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `Product_category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
