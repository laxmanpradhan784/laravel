-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 11:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lara`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` enum('published','draft') DEFAULT 'published',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `image`, `author`, `content`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Healthy Living Tips', 'images/hsceSVIQwBncJI7hRXt2ScMqnMo9R1VlhDZS238j.jpg', 'Jane Smith', 'Discover practical tips for living a healthier life. From diet to exercise, we\'ve got you covered.', 'published', '2024-10-15 06:02:57', '2024-10-15 04:09:19'),
(6, 'Traveling on a Budget', 'images/z7zbMiV3ZOWO2S88HmrLTRNTz7YqkFvFaIby7cnz.jpg', 'Alice Johnson', 'Travel doesn\'t have to be expensive. Here are some tips to explore the world without breaking the bank.', 'published', '2024-10-15 06:02:57', '2024-10-15 04:09:27'),
(7, 'The Art of Mindfulness', 'images/fpmtbV5tCIMFD9rc2nhekKyX6zUsz2gwrHlXTYve.jpg', 'David Lee', 'Mindfulness can improve your mental well-being. Learn how to incorporate it into your daily routine.', 'published', '2024-10-15 06:02:57', '2024-10-15 04:09:35'),
(8, 'Understanding Blockchain', 'images/7312oeD0n5oc4scNom9qqr4FqTjy2nZsF44SWsV5.jpg', 'Eve Carter', 'Blockchain technology is revolutionizing industries. This blog demystifies how it works.', 'published', '2024-10-15 06:02:57', '2024-10-15 04:09:43'),
(9, 'Home Gardening Basics', 'images/yeL5xGpAWr4ClAcojY8L8mRWSwOnhuAMSyDmcfld.jpg', 'Chris Martin', 'Start your own garden with these easy tips. From herbs to vegetables, gardening is rewarding!', 'published', '2024-10-15 06:02:57', '2024-10-16 03:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_summary_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `ParentCategoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`, `ParentCategoryID`) VALUES
(1, 'Electronic', NULL),
(4, 'Fashion', NULL),
(5, 'Men\'s Clothing', NULL),
(8, 'Tool', NULL);

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` varchar(255) NOT NULL,
  `attempts` tinyint(4) NOT NULL DEFAULT 0,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_10_17_113333_create_users_table', 1),
(2, '2024_10_17_113724_create_cache_table', 1),
(3, '2024_10_17_113725_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Status` enum('active','inactive') DEFAULT 'active',
  `CategoryID` int(11) DEFAULT NULL,
  `StockQuantity` int(11) DEFAULT 0,
  `Size` varchar(50) DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  `Rating` decimal(2,1) DEFAULT 0.0,
  `DiscountPercentage` decimal(5,2) DEFAULT 0.00,
  `MetaDescription` text DEFAULT NULL,
  `MetaKeywords` text DEFAULT NULL,
  `IsFeatured` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `Name`, `Description`, `Image`, `Price`, `Status`, `CategoryID`, `StockQuantity`, `Size`, `Color`, `Rating`, `DiscountPercentage`, `MetaDescription`, `MetaKeywords`, `IsFeatured`, `created_at`, `updated_at`) VALUES
(41, 'TV', 'to watch matches', 'images/products/RnMJtqBT7ctMfRqavuqJtWkcSfPiMsVlK7frMPnE.jpg', 1221.00, 'active', 1, 12, 'm', 'red', 1.0, 10.00, NULL, NULL, 1, '2024-10-17 00:13:44', '2024-10-17 03:00:25'),
(47, 'pants', 'to use in', 'images/products/RHyWk4TBoBGk4dNwKnogrxeNu0wXpJJBJfShgq0U.jpg', 34567.00, 'active', 5, 234, 'm', 'red', 1.0, 12.00, NULL, NULL, 1, '2024-10-17 00:15:49', '2024-10-17 03:01:48'),
(48, 'fashion', 'for mens or womens', 'images/products/5uNTGQiKRNz3xneZFHpQi3j5Q9g6Mxtq9QTfKZiK.jpg', 45.00, 'active', 4, 123, 'm', 'rgvde', 2.0, 22.00, NULL, NULL, 1, '2024-10-17 00:16:14', '2024-10-17 03:05:31'),
(49, 'Electronics', 'any time this can use this things', 'images/products/uEoV9Xtblg00s88hnN4BlhJZON8ppgNa3frOMIH2.jpg', 23456.00, 'active', 1, 23, 'FG', 'WSFF', 5.0, 22.00, NULL, NULL, 1, '2024-10-17 00:16:41', '2024-10-17 03:07:24'),
(50, 'mens clothes', 'casually mens clothes', 'images/products/kTwzU9bdGyBkvV4iDuOQXKHnVXL3PqmP4q5YuhhD.jpg', 3456.00, 'active', 5, 234, 'm', 'dfegf', 3.0, 33.00, NULL, NULL, 1, '2024-10-17 01:08:36', '2024-10-17 03:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6NSCHCcwlT4Q1L2yi1e2cbTEEoxUudu1Hq43ccNb', 5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMnlKelNWSDA4OGZZM3NtY0dMcE5IUGE3MUlxaHdqQ01uZHk4TmNJeiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMyOiJodHRwOi8vbG9jYWxob3N0L2xhcmF2ZWwtcHJvamVjdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiY2FydCI7YToyOntpOjQ5O2E6NDp7czo0OiJuYW1lIjtzOjExOiJFbGVjdHJvbmljcyI7czo1OiJwcmljZSI7czo4OiIyMzQ1Ni4wMCI7czo4OiJxdWFudGl0eSI7aToxO3M6NToiaW1hZ2UiO3M6NjA6ImltYWdlcy9wcm9kdWN0cy91RW9WOVh0YmxnMDBzODhobk40QmxoSlpPTjhwcGdOYTNmck9NSUgyLmpwZyI7fWk6NDc7YTo0OntzOjQ6Im5hbWUiO3M6NToicGFudHMiO3M6NToicHJpY2UiO3M6ODoiMzQ1NjcuMDAiO3M6ODoicXVhbnRpdHkiO2k6MTtzOjU6ImltYWdlIjtzOjYwOiJpbWFnZXMvcHJvZHVjdHMvUkh5V2s0VEJvQkdrNGROd0tub2dyeGVOdTB3WHBKSkJKZlNoZ3EwVS5qcGciO319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1729244897);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `image`, `status`, `created_at`, `updated_at`) VALUES
(51, 'Slider 1', 'images/z9oDiJxGFyNAp0upCRlEmqjl0Jj5sZOQTObUBGDB.jpg', 'active', '2024-10-15 06:24:12', '2024-10-15 03:37:09'),
(52, 'Slider 2', 'images/tCdjVwccelNGG5Tdmg62E3AwIAztkbhf49q9S1Q0.jpg', 'active', '2024-10-15 06:24:12', '2024-10-15 03:37:17'),
(53, 'Slider 3', 'images/bXQz0Z8TJMSvluEuAVWtwMP6BInpT1QndmMOUjtv.jpg', 'active', '2024-10-15 06:24:12', '2024-10-15 03:37:27'),
(58, 'slider 5', 'images/3HNdZ12Pi7lY2Nfz6vOmUaUX2XoQMLKaZHii3raL.jpg', 'active', '2024-10-15 03:17:43', '2024-10-16 03:02:15'),
(59, 'Slider 4', 'images/mH1JR6zY3WSXJlVCsNuj9vhnLagPm0YY6lm7E80r.jpg', 'active', '2024-10-15 04:01:54', '2024-10-16 03:02:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `dob`, `gender`, `password`, `created_at`, `updated_at`, `image`) VALUES
(5, 'laxman', 'laxman@gmail.com', '9913817411', '2002-05-24', 'male', '$2y$12$eMEUi0gtlY.pSfYb2uJSTunNjpapgHB.6xCDjmXN4ttV7aSlWg1Wi', '2024-10-17 23:39:59', '2024-10-17 23:45:04', 'profile_images/DsaV9tlCRHbebSDJSqyvyQrSs4aALpaR0GtKahb8.jpg'),
(6, 'vasu', 'vasu@gmail.com', '9913817411', '2002-05-30', 'male', '$2y$12$hvsIWQQsj2OXz8BK2AWNhe9W3XQB9bawiO8DOcZ3zaH9Yna.jEssm', '2024-10-18 01:31:50', '2024-10-18 01:31:50', 'profile_images/HnZwZqDs5jHdwcMWQzsksTK1PJ6vreFVnfh5Hptn.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_summary_id` (`order_summary_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`),
  ADD KEY `ParentCategoryID` (`ParentCategoryID`);

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
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_3` FOREIGN KEY (`order_summary_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`ParentCategoryID`) REFERENCES `categories` (`CategoryID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
