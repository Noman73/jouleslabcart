-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 16, 2025 at 04:21 AM
-- Server version: 9.4.0
-- PHP Version: 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jouleslabcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
(1, 'noman', 'noman.eng73@gmail.com', NULL, '$2y$12$el7h6q1T/pL1kmv0Jm2/5.G2z8.6cLdM420560gczpYG767u8agXy', '2025-10-13 19:52:33', '2025-10-13 19:52:33');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_type` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `discount_amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `maximum_discount_amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `minimum_total_price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `maximum_num_of_items` int NOT NULL,
  `minimum_num_of_items` int NOT NULL,
  `allowed_product_id` bigint UNSIGNED DEFAULT NULL,
  `max_uses_system` int DEFAULT NULL,
  `max_uses_user` int DEFAULT NULL,
  `is_auto_applied` tinyint(1) NOT NULL DEFAULT '0',
  `expiry_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount_type`, `discount_amount`, `maximum_discount_amount`, `minimum_total_price`, `maximum_num_of_items`, `minimum_num_of_items`, `allowed_product_id`, `max_uses_system`, `max_uses_user`, `is_auto_applied`, `expiry_date`, `created_at`, `updated_at`) VALUES
(1, 'SAVE300', 'fixed', 200.00, 200.00, 3.00, 2, 2, 6, 3, 3, 0, '2025-10-16 23:22:00', '2025-10-15 17:23:00', '2025-10-15 17:23:00'),
(2, 'auto20', 'percentage', 30.00, 20.00, 300.00, 3, 2, 6, 2, 2, 1, '2025-10-24 02:44:00', '2025-10-15 20:44:59', '2025-10-15 20:44:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_13_143838_create_admin_table', 2),
(9, '2025_10_13_144059_create_products_table', 3),
(10, '2025_10_13_154125_create_orders_table', 3),
(11, '2025_10_14_164335_create_order_items_table', 4),
(20, '2025_10_15_105903_create_coupons_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `total_amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sub_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `coupon_id` bigint UNSIGNED DEFAULT NULL,
  `total_items` int NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `created_at`, `updated_at`) VALUES
(4, 'mango', 100.00, 'products/6u235B7Ruw0hzGMjKVqeULFVea4frlkiYMj1XI4V.jpg', '2025-10-15 12:36:21', '2025-10-15 12:54:29'),
(5, 'noman', 220.00, 'products/YFxy62CuOGPN3jTomHTtPa7MuJiFN5PLfPbVWKuN.png', '2025-10-15 12:45:41', '2025-10-15 12:45:41'),
(6, 'noman', 200.00, 'products/oNCJe6hX4hWZYrHQCWDSPMyqoxPXrAypWa6zGe0h.jpg', '2025-10-15 12:54:10', '2025-10-15 12:54:10'),
(7, '100', 300.00, 'products/OVph8tFQi57o3V6syjXaaXhKfGVN2K6gBd4wVwGE.png', '2025-10-15 14:16:15', '2025-10-15 14:16:15'),
(8, 'voluptatem molestias dolore', 298.26, 'https://via.placeholder.com/640x480.png/0077ff?text=products+ipsam', '2025-10-15 16:30:01', '2025-10-15 16:30:01'),
(9, 'voluptates quia voluptas', 35.45, 'https://via.placeholder.com/640x480.png/0055aa?text=products+omnis', '2025-10-15 16:30:01', '2025-10-15 16:30:01'),
(10, 'eum sed rerum', 305.65, 'https://via.placeholder.com/640x480.png/00ffcc?text=products+vitae', '2025-10-15 16:30:01', '2025-10-15 16:30:01'),
(11, 'quis illum nulla', 865.30, 'https://via.placeholder.com/640x480.png/00ee88?text=products+exercitationem', '2025-10-15 16:30:01', '2025-10-15 16:30:01'),
(12, 'at ea est', 964.58, 'https://via.placeholder.com/640x480.png/00ee99?text=products+eum', '2025-10-15 16:30:01', '2025-10-15 16:30:01'),
(13, 'quod qui voluptatem', 968.35, 'https://via.placeholder.com/640x480.png/0077ff?text=products+nesciunt', '2025-10-15 16:30:01', '2025-10-15 16:30:01'),
(14, 'iste repellendus perferendis', 76.66, 'https://via.placeholder.com/640x480.png/004444?text=products+nihil', '2025-10-15 16:30:01', '2025-10-15 16:30:01'),
(15, 'aut illo illum', 677.52, 'https://via.placeholder.com/640x480.png/00cc88?text=products+et', '2025-10-15 16:30:01', '2025-10-15 16:30:01'),
(16, 'dolorum veritatis dolor', 968.69, 'https://via.placeholder.com/640x480.png/00aaff?text=products+commodi', '2025-10-15 16:30:01', '2025-10-15 16:30:01'),
(17, 'est rerum explicabo', 949.02, 'https://via.placeholder.com/640x480.png/009966?text=products+est', '2025-10-15 16:30:01', '2025-10-15 16:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BSRrM1xpUzPavwQyFlPFeASUi0lsCVqgBtooc0wr', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo1OntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNzoiaHR0cDovL2pvdWxlc2xhYmNhcnQudGVzdC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NjoiX3Rva2VuIjtzOjQwOiJCOVdlOVVpaE8yNjBDc3hqZU9GSmx1STZoQ0xtNVRuek1GM2pZWGw1IjtzOjQ6ImNhcnQiO2E6Mjp7aTo1O2E6NTp7czoyOiJpZCI7aTo1O3M6NDoibmFtZSI7czo1OiJub21hbiI7czo1OiJwcmljZSI7czo2OiIyMjAuMDAiO3M6NToiaW1hZ2UiO3M6NTM6InByb2R1Y3RzL1lGeHk2MkN1T0dQTjNqVG9tSFR0UGE3TXVKaUZONVBMZlBiVldLdU4ucG5nIjtzOjg6InF1YW50aXR5IjtpOjI7fWk6NzthOjU6e3M6MjoiaWQiO2k6NztzOjQ6Im5hbWUiO3M6MzoiMTAwIjtzOjU6InByaWNlIjtzOjY6IjMwMC4wMCI7czo1OiJpbWFnZSI7czo1MzoicHJvZHVjdHMvT1ZwaDh0RlFpNTdvM1Y2c3lqWGFhWGhLZkdWTjJLNmdCZDR3VndHRS5wbmciO3M6ODoicXVhbnRpdHkiO2k6MTt9fXM6MTQ6ImFwcGxpZWRfY291cG9uIjtPOjE3OiJBcHBcTW9kZWxzXENvdXBvbiI6MzM6e3M6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6NzoiY291cG9ucyI7czoxMzoiACoAcHJpbWFyeUtleSI7czoyOiJpZCI7czoxMDoiACoAa2V5VHlwZSI7czozOiJpbnQiO3M6MTI6ImluY3JlbWVudGluZyI7YjoxO3M6NzoiACoAd2l0aCI7YTowOnt9czoxMjoiACoAd2l0aENvdW50IjthOjA6e31zOjE5OiJwcmV2ZW50c0xhenlMb2FkaW5nIjtiOjA7czoxMDoiACoAcGVyUGFnZSI7aToxNTtzOjY6ImV4aXN0cyI7YjoxO3M6MTg6Indhc1JlY2VudGx5Q3JlYXRlZCI7YjowO3M6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDtzOjEzOiIAKgBhdHRyaWJ1dGVzIjthOjE1OntzOjI6ImlkIjtpOjI7czo0OiJjb2RlIjtzOjY6ImF1dG8yMCI7czoxMzoiZGlzY291bnRfdHlwZSI7czoxMDoicGVyY2VudGFnZSI7czoxNToiZGlzY291bnRfYW1vdW50IjtzOjU6IjMwLjAwIjtzOjIzOiJtYXhpbXVtX2Rpc2NvdW50X2Ftb3VudCI7czo1OiIyMC4wMCI7czoxOToibWluaW11bV90b3RhbF9wcmljZSI7czo2OiIzMDAuMDAiO3M6MjA6Im1heGltdW1fbnVtX29mX2l0ZW1zIjtpOjM7czoyMDoibWluaW11bV9udW1fb2ZfaXRlbXMiO2k6MjtzOjE4OiJhbGxvd2VkX3Byb2R1Y3RfaWQiO2k6NjtzOjE1OiJtYXhfdXNlc19zeXN0ZW0iO2k6MjtzOjEzOiJtYXhfdXNlc191c2VyIjtpOjI7czoxNToiaXNfYXV0b19hcHBsaWVkIjtpOjE7czoxMToiZXhwaXJ5X2RhdGUiO3M6MTk6IjIwMjUtMTAtMjQgMDg6NDQ6MDAiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMTAtMTYgMDI6NDQ6NTkiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMTAtMTYgMDI6NDQ6NTkiO31zOjExOiIAKgBvcmlnaW5hbCI7YToxNTp7czoyOiJpZCI7aToyO3M6NDoiY29kZSI7czo2OiJhdXRvMjAiO3M6MTM6ImRpc2NvdW50X3R5cGUiO3M6MTA6InBlcmNlbnRhZ2UiO3M6MTU6ImRpc2NvdW50X2Ftb3VudCI7czo1OiIzMC4wMCI7czoyMzoibWF4aW11bV9kaXNjb3VudF9hbW91bnQiO3M6NToiMjAuMDAiO3M6MTk6Im1pbmltdW1fdG90YWxfcHJpY2UiO3M6NjoiMzAwLjAwIjtzOjIwOiJtYXhpbXVtX251bV9vZl9pdGVtcyI7aTozO3M6MjA6Im1pbmltdW1fbnVtX29mX2l0ZW1zIjtpOjI7czoxODoiYWxsb3dlZF9wcm9kdWN0X2lkIjtpOjY7czoxNToibWF4X3VzZXNfc3lzdGVtIjtpOjI7czoxMzoibWF4X3VzZXNfdXNlciI7aToyO3M6MTU6ImlzX2F1dG9fYXBwbGllZCI7aToxO3M6MTE6ImV4cGlyeV9kYXRlIjtzOjE5OiIyMDI1LTEwLTI0IDA4OjQ0OjAwIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI1LTEwLTE2IDAyOjQ0OjU5IjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI1LTEwLTE2IDAyOjQ0OjU5Ijt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czoxMToiACoAcHJldmlvdXMiO2E6MDp7fXM6ODoiACoAY2FzdHMiO2E6MTp7czoxMToiZXhwaXJ5X2RhdGUiO3M6ODoiZGF0ZXRpbWUiO31zOjE3OiIAKgBjbGFzc0Nhc3RDYWNoZSI7YTowOnt9czoyMToiACoAYXR0cmlidXRlQ2FzdENhY2hlIjthOjA6e31zOjEzOiIAKgBkYXRlRm9ybWF0IjtOO3M6MTA6IgAqAGFwcGVuZHMiO2E6MDp7fXM6MTk6IgAqAGRpc3BhdGNoZXNFdmVudHMiO2E6MDp7fXM6MTQ6IgAqAG9ic2VydmFibGVzIjthOjA6e31zOjEyOiIAKgByZWxhdGlvbnMiO2E6MDp7fXM6MTA6IgAqAHRvdWNoZXMiO2E6MDp7fXM6Mjc6IgAqAHJlbGF0aW9uQXV0b2xvYWRDYWxsYmFjayI7TjtzOjI2OiIAKgByZWxhdGlvbkF1dG9sb2FkQ29udGV4dCI7TjtzOjEwOiJ0aW1lc3RhbXBzIjtiOjE7czoxMzoidXNlc1VuaXF1ZUlkcyI7YjowO3M6OToiACoAaGlkZGVuIjthOjA6e31zOjEwOiIAKgB2aXNpYmxlIjthOjA6e31zOjExOiIAKgBmaWxsYWJsZSI7YToxMjp7aTowO3M6NDoiY29kZSI7aToxO3M6MTM6ImRpc2NvdW50X3R5cGUiO2k6MjtzOjE1OiJkaXNjb3VudF9hbW91bnQiO2k6MztzOjIzOiJtYXhpbXVtX2Rpc2NvdW50X2Ftb3VudCI7aTo0O3M6MTk6Im1pbmltdW1fdG90YWxfcHJpY2UiO2k6NTtzOjIwOiJtYXhpbXVtX251bV9vZl9pdGVtcyI7aTo2O3M6MjA6Im1pbmltdW1fbnVtX29mX2l0ZW1zIjtpOjc7czoxODoiYWxsb3dlZF9wcm9kdWN0X2lkIjtpOjg7czoxNToibWF4X3VzZXNfc3lzdGVtIjtpOjk7czoxMzoibWF4X3VzZXNfdXNlciI7aToxMDtzOjExOiJjb3Vwb25fdHlwZSI7aToxMTtzOjExOiJleHBpcnlfZGF0ZSI7fXM6MTA6IgAqAGd1YXJkZWQiO2E6MTp7aTowO3M6MToiKiI7fX19', 1760588080);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
