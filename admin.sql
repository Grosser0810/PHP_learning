-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 05 2019 г., 13:32
-- Версия сервера: 5.7.25
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `admin`
--

-- --------------------------------------------------------

--
-- Структура таблицы `carousels`
--

CREATE TABLE `carousels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `carousels`
--

INSERT INTO `carousels` (`id`, `image`, `created_at`, `updated_at`) VALUES
(5, '1567590793.png', '2019-09-04 06:53:14', '2019-09-04 06:53:14'),
(6, '1567590903.png', '2019-09-04 06:55:03', '2019-09-04 06:55:03'),
(7, '1567590910.png', '2019-09-04 06:55:10', '2019-09-04 06:55:10'),
(8, '1567590918.png', '2019-09-04 06:55:18', '2019-09-04 06:55:18'),
(9, '1567590927.jpeg', '2019-09-04 06:55:27', '2019-09-04 06:55:27'),
(10, '1567590937.png', '2019-09-04 06:55:37', '2019-09-04 06:55:37'),
(11, '1567590945.png', '2019-09-04 06:55:45', '2019-09-04 06:55:45');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `group`, `created_at`, `updated_at`) VALUES
(1, 'Аксессуары', '2019-08-26 08:02:29', '2019-08-26 08:02:40'),
(3, 'Бритвенные принадлежности', '2019-08-26 12:45:44', '2019-08-29 16:57:55'),
(5, 'Средства для ухода', '2019-08-28 20:41:30', '2019-08-28 20:41:30');

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturers`
--

CREATE TABLE `manufacturers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manufacturer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `manufacturer`, `created_at`, `updated_at`) VALUES
(1, 'Baxter of California', '2019-08-26 12:42:22', '2019-08-26 12:42:22'),
(2, 'Mr Natty', '2019-08-26 12:42:37', '2019-08-26 12:42:37'),
(3, 'Baxter of California1', '2019-08-26 14:06:45', '2019-08-26 14:06:45'),
(4, 'Baxter of California', '2019-08-26 14:06:56', '2019-08-26 14:06:56'),
(5, 'Suavecito', '2019-08-26 14:07:29', '2019-08-26 14:07:29'),
(6, 'Malin+Goetz', '2019-08-26 14:07:38', '2019-08-26 14:07:38');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_20_205152_create_groups_table', 1),
(9, '2019_08_20_215413_create_manufacturers_table', 1),
(10, '2019_08_20_222152_create_products_table', 1),
(11, '2019_09_04_091541_create_carousels_table', 2),
(12, '2019_09_05_093243_create_previews_table', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `previews`
--

CREATE TABLE `previews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `previews`
--

INSERT INTO `previews` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Быстро', 'Мы делаем свою работу быстро! Два часа пролетят не заметно и вы - счастливый обладатель стильной стрижки-минутки.', '2019-09-05 07:12:17', '2019-09-05 07:12:17'),
(4, 'Круто', 'Забудьте как вы стриглись раньше.Мы сделаем из вас звезду футбола или кино.Во всяком случае внешне.', '2019-09-05 07:12:44', '2019-09-05 07:12:44'),
(5, 'Дорого', 'Наши мастера профессионалы своего дела и не могут стоить дешего. К тому же, разве цена не дает определенный статус?', '2019-09-05 07:12:59', '2019-09-05 07:12:59');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `stock` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `composition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `image`, `stock`, `code`, `description`, `price`, `composition`, `group_id`, `manufacturer_id`, `created_at`, `updated_at`) VALUES
(1, 'что то непонтное', '1567467190.png', 'In stock', '1231', 'ловы авылоа рвлыоарлугкнщдсиш гшгуцпквуцлкцувка', 12.00, '123', 1, 1, '2019-09-02 20:33:11', '2019-09-02 20:33:11'),
(2, 'банка', '1567467226.png', 'not available', '4141', 'фыв ыфвыфв ыфвжлбз ощдщу рлшу аткук', 123.00, 'sdaf asdfasdf asdf', 1, 2, '2019-09-02 20:33:47', '2019-09-02 20:33:47'),
(3, 'Title 1', '1567467271.jpeg', 'In stock', '1231', 'просто фотография', 123.00, 'sdaf asdfasdf asdf', 3, 2, '2019-09-02 20:34:31', '2019-09-02 20:34:31'),
(4, 'Title 4', '1567467319.png', 'In stock', 'Start', 'sdf asdf asd adsf adsf asdf asdf dsf dsfsdfasdfsdf sadfa dsf', 12.00, '1343241324134', 3, 5, '2019-09-02 20:35:19', '2019-09-02 20:35:19'),
(5, 'blog', '1567467336.png', 'not available', 'Start', 'sdflkasndfj.lidghoaoirhggkdajghdfklagjasdfadsfasdfasdfasdfasdfasdfasdfaasdfasdfasdfsdfsdfsdfsdf asdf asdf asd adsf adsf asdf asdf dsf dsfsdfasdfsdf sadfa dsf', 12.00, '1343241324134', 3, 4, '2019-09-02 20:35:36', '2019-09-02 20:35:36'),
(6, 'город1', '1567467356.png', 'In stock', '1231', 'sdf asdf asd adsf adsf asdf asdf dsf dsfsdfasdfsdf sadfa dsf', 123.00, 'sdaf asdfasdf asdf', 3, 3, '2019-09-02 20:35:56', '2019-09-02 20:35:56'),
(7, 'крем', '1567467388.png', 'In stock', 'Start', 'sdflkasndfj.lidghoaoirhggkdajghdfklagjasdfadsfasdfasdfasdfasdfasdfasdfaasdfasdfasdfsdfsdfsdfsdf asdf asdf asd adsf adsf asdf asdf dsf dsfsdfasdfsdf sadfa dsf', 2111.00, '1343241324134', 1, 1, '2019-09-02 20:36:29', '2019-09-02 20:36:29');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `bio` mediumtext COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'profile.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `bio`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$9y5Gmx/SxD2ARmCYD6vNO.ReWTBJrW83aKTcox6EFFCAoooBhcbaO', 'admin', NULL, 'profile.png', 'zKf06oyg8xWgdPIenUXKWUfgUold0OD9ClaTYSNfxUtNwwDsVTjSLSd1pRIJ', '2019-08-25 14:48:15', '2019-08-25 15:30:18'),
(2, 'Noadmin', 'noadmin@noadmin.com', NULL, '$2y$10$uUN/9ip7rdl//Xzry.x6oOaHPs8QSmQ9Hc6mhwmEfe9OJBtwRzRva', 'user', 'asdsad', NULL, NULL, '2019-08-26 12:57:10', '2019-08-26 12:57:10'),
(3, 'about2', 'admi2321n@admin11111.com', NULL, 'Cfvehfq11', 'user', '1233123123', NULL, NULL, '2019-08-26 13:15:50', '2019-08-26 13:16:01'),
(4, '123', 'admin@adm123123123in.com', NULL, '$2y$10$IGVW4SXy5Lx3G0W6D0slnOlzfy/S1bRZx00kA2HRaGFL8WmTAbrNC', 'admin', '123123', NULL, NULL, '2019-08-26 13:16:12', '2019-08-26 13:16:12'),
(7, 'admin123', '1111admin@mail.com', NULL, '$2y$10$MRN5JgBD.f.kWf2khvb.j.MFmRg7QQwpTW5amd2HT.r7Vkzr52ni.', 'admin', '1233', NULL, NULL, '2019-08-26 17:49:33', '2019-08-26 17:49:33'),
(8, '1312322', 'a231231dmin@admin.com', NULL, '$2y$10$sOxOsm/WdmiW0BSMy0oRLOSvRDy9EREOeNroCwoPOJzBxAZoGyjQK', 'user', '123', NULL, NULL, '2019-08-26 17:49:55', '2019-08-28 18:12:43');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `carousels`
--
ALTER TABLE `carousels`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Индексы таблицы `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `previews`
--
ALTER TABLE `previews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `carousels`
--
ALTER TABLE `carousels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `previews`
--
ALTER TABLE `previews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
