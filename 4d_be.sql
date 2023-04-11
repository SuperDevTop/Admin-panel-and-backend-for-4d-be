-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2023 at 02:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4d_be`
--

-- --------------------------------------------------------

--
-- Table structure for table `be_histories`
--

CREATE TABLE `be_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `big` int(11) NOT NULL,
  `small` int(11) NOT NULL,
  `ticketno` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `number` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `be_histories`
--

INSERT INTO `be_histories` (`id`, `userid`, `big`, `small`, `ticketno`, `total`, `number`, `company`, `created_at`, `updated_at`) VALUES
(1, 3, 10, 50, 92, 120, '3228', 'md', '2023-04-08 11:29:22', '2023-04-08 11:29:22'),
(2, 3, 10, 50, 36, 120, '3228', 'md', '2023-04-08 11:31:25', '2023-04-08 11:31:25'),
(3, 3, 10, 50, 71, 120, '3228', 'md', '2023-04-08 11:32:21', '2023-04-08 11:32:21'),
(4, 3, 10, 50, 94, 120, '3228', 'md', '2023-04-08 11:34:58', '2023-04-08 11:34:58'),
(5, 3, 10, 50, 90, 120, '3228', 'md', '2023-04-08 11:35:04', '2023-04-08 11:35:04'),
(6, 3, 10, 50, 36, 120, '3228', 'md', '2023-04-08 11:35:04', '2023-04-08 11:35:27'),
(7, 3, 10, 50, 89, 120, '3228', 'md', '2023-04-08 11:35:04', '2023-04-08 11:35:39'),
(8, 3, 10, 50, 28, 120, '3228', 'md', '2023-04-08 11:35:04', '2023-04-08 11:35:40'),
(9, 3, 10, 50, 56, 120, '3228', 'md', '2023-04-08 11:35:04', '2023-04-08 11:35:41'),
(10, 3, 10, 50, 4, 120, '3228', 'md', '2023-04-08 11:35:04', '2023-04-08 11:35:42'),
(11, 3, 10, 50, 83, 120, '3228', 'md', '2023-04-08 11:35:04', '2023-04-08 11:35:52'),
(12, 3, 10, 50, 91, 120, '3228', 'md', '2023-04-08 11:35:04', '2023-04-08 11:35:54'),
(13, 2, 2, 1, 84, 6, '1234', 'MT', '2023-04-08 12:38:32', '2023-04-08 12:38:32'),
(14, 2, 1, 2, 98, 6, '2341', 'MD', '2023-04-08 12:38:32', '2023-04-08 12:38:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `limits`
--

CREATE TABLE `limits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `big` int(11) NOT NULL,
  `small` int(11) NOT NULL,
  `sold_out_big` int(11) NOT NULL,
  `sold_out_small` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `limits`
--

INSERT INTO `limits` (`id`, `big`, `small`, `sold_out_big`, `sold_out_small`, `created_at`, `updated_at`) VALUES
(1, 50, 50, 100, 100, '2023-04-08 11:29:15', '2023-04-08 11:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(46, '2014_10_12_000000_create_users_table', 1),
(47, '2014_10_12_100000_create_password_resets_table', 1),
(48, '2019_08_19_000000_create_failed_jobs_table', 1),
(49, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(50, '2023_04_01_200647_create_be_histories_table', 1),
(51, '2023_04_02_015819_create_rank_numbers_table', 1),
(52, '2023_04_03_054207_create_limits_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rank_numbers`
--

CREATE TABLE `rank_numbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company` varchar(20) NOT NULL,
  `rank` tinyint(4) NOT NULL,
  `ranknumber` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rank_numbers`
--

INSERT INTO `rank_numbers` (`id`, `company`, `rank`, `ranknumber`, `created_at`, `updated_at`) VALUES
(1, 'm', 1, '8442', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(2, 'm', 2, '7264', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(3, 'm', 3, '9349', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(4, 'm', 4, '7343', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(5, 'm', 4, '7120', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(6, 'm', 4, '9816', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(7, 'm', 4, '6413', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(8, 'm', 4, '4217', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(9, 'm', 4, '0259', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(10, 'm', 4, '6301', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(11, 'm', 4, '3183', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(12, 'm', 4, '5657', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(13, 'm', 4, '6032', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(14, 'm', 5, '7453', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(15, 'm', 5, '6384', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(16, 'm', 5, '7321', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(17, 'm', 5, '9946', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(18, 'm', 5, '9316', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(19, 'm', 5, '7484', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(20, 'm', 5, '7148', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(21, 'm', 5, '3257', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(22, 'm', 5, '6538', '2023-04-08 11:29:15', '2023-04-08 11:29:15'),
(23, 'm', 5, '8306', '2023-04-08 11:29:15', '2023-04-08 11:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `postal` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `phoneNumber`, `firstname`, `lastname`, `email`, `email_verified_at`, `password`, `address`, `city`, `country`, `postal`, `about`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '1111111111', 'Admin', 'Admin', 'admin@gmail.com', NULL, '$2y$10$bFPmoMS8VKvMSUchKP9yCO3RMatQ.EFs1iWWELSDNLb02ZiWdmgwm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'name', '1913448289', NULL, NULL, NULL, NULL, '$2y$10$gLAwViOAQc2nkK68wV5lCuhRrCrHh5LTuXxmQrQUkb6Zo.NOFEBQe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `be_histories`
--
ALTER TABLE `be_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `limits`
--
ALTER TABLE `limits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rank_numbers`
--
ALTER TABLE `rank_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phonenumber_unique` (`phoneNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `be_histories`
--
ALTER TABLE `be_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `limits`
--
ALTER TABLE `limits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rank_numbers`
--
ALTER TABLE `rank_numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
