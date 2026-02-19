-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 13, 2025 at 02:29 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalback`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint UNSIGNED DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activities_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `user_id`, `type`, `description`, `subject_id`, `subject_type`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, NULL, 'utility_payment', 'Created utility bill of $5747 for property ID 6', 3, 'UtilityBill', '127.0.0.1', '2025-07-08 01:25:04', '2025-07-08 01:25:04'),
(2, NULL, 'payment', 'Created payment of $438 for property ID 1', 5, 'Payment', '127.0.0.1', '2025-07-08 01:25:22', '2025-07-08 01:25:22'),
(3, NULL, 'tenant_create', 'Created tenant Rith for property ID 1', 3, 'PropertyRenting', '127.0.0.1', '2025-07-08 01:25:48', '2025-07-08 01:25:48'),
(4, NULL, 'payment', 'Created payment of $368 for property ID 1', 6, 'Payment', '127.0.0.1', '2025-07-08 01:32:27', '2025-07-08 01:32:27'),
(5, NULL, 'utility_payment', 'Created utility bill of $8483 for property ID 1', 4, 'UtilityBill', '127.0.0.1', '2025-07-08 01:32:49', '2025-07-08 01:32:49'),
(6, 8, 'tenant_create', 'Created tenant Songhy for property ID 2', 2, 'Property', '127.0.0.1', '2025-07-10 05:11:10', '2025-07-10 05:11:10'),
(7, 8, 'tenant_create', 'Created tenant Nisa for property ID 4', 4, 'Property', '127.0.0.1', '2025-07-10 05:15:00', '2025-07-10 05:15:00'),
(8, 8, 'tenant_create', 'Created tenant Linhchue for property ID 5', 5, 'Property', '127.0.0.1', '2025-07-10 06:35:04', '2025-07-10 06:35:04'),
(9, 8, 'utility_payment', 'Created utility bill of $234 for property ID 4', 7, 'UtilityBill', '127.0.0.1', '2025-07-10 06:39:16', '2025-07-10 06:39:16'),
(10, 8, 'utility_payment', 'Created utility bill of $12 for property ID 3', 11, 'UtilityBill', '127.0.0.1', '2025-07-10 07:17:39', '2025-07-10 07:17:39'),
(11, 8, 'payment', 'Created payment of $438 for property ID 2', 10, 'Payment', '127.0.0.1', '2025-07-10 07:32:41', '2025-07-10 07:32:41'),
(12, 8, 'payment', 'Created payment of $438 for property ID 2', 11, 'Payment', '127.0.0.1', '2025-07-10 07:32:49', '2025-07-10 07:32:49'),
(13, 8, 'utility_payment', 'Created utility bill of $884 for property ID 2', 12, 'UtilityBill', '127.0.0.1', '2025-07-10 07:33:04', '2025-07-10 07:33:04'),
(14, 8, 'tenant_edit', 'Edited tenant Songhy for property ID 3', 3, 'Property', '127.0.0.1', '2025-07-10 07:33:49', '2025-07-10 07:33:49'),
(15, 8, 'payment', 'Created payment of $8000 for property ID 3', 12, 'Payment', '127.0.0.1', '2025-07-10 07:38:28', '2025-07-10 07:38:28'),
(16, 8, 'tenant_create', 'Created tenant Bora for property ID 9', 9, 'Property', '127.0.0.1', '2025-07-10 07:44:00', '2025-07-10 07:44:00'),
(17, 8, 'tenant_edit', 'Edited tenant Boras for property ID 9', 9, 'Property', '127.0.0.1', '2025-07-10 07:44:06', '2025-07-10 07:44:06'),
(18, 8, 'utility_payment', 'Created utility bill of $234 for property ID 9', 13, 'UtilityBill', '127.0.0.1', '2025-07-10 07:44:30', '2025-07-10 07:44:30'),
(19, 8, 'utility_payment', 'Updated utility bill of $234 for property ID 9', 13, 'UtilityBill', '127.0.0.1', '2025-07-10 07:46:15', '2025-07-10 07:46:15'),
(20, 8, 'payment', 'Created payment of $438 for property ID 9', 13, 'Payment', '127.0.0.1', '2025-07-10 07:46:35', '2025-07-10 07:46:35');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` bigint NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin_password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin_email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin_phone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_password`, `admin_email`, `admin_phone`) VALUES
(1, 'Super Admin', '$2y$12$S6dofym50/y.cAO9oFDroeanspR2qzzC988y0/IT4dGm389pQA.f2', 'admin@prophive.com', '123456789'),
(2, 'Admin', '$2y$12$ynCtgFVFI84.pAsH.a6/febo0MrpuSS232kV/yspfpOJk5o7fp7B6', 'admin@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `assigned_to` bigint UNSIGNED DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `replied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contacts_assigned_to_foreign` (`assigned_to`),
  KEY `contacts_status_index` (`status`),
  KEY `contacts_created_at_index` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `status`, `assigned_to`, `read_at`, `replied_at`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john.doe@example.com', 'Request for Property Viewing', 'I would like to schedule a viewing for the property at 123 Main St.', 'Open', NULL, '2025-07-17 12:38:00', '2025-07-29 12:38:00', '2025-07-08 16:00:24', '2025-07-10 07:35:01');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `contact_us_id` bigint NOT NULL AUTO_INCREMENT,
  `contact_us_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_us_email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_us_message` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_us_submitted_at` date DEFAULT NULL,
  `contact_us_status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`contact_us_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE IF NOT EXISTS `faqs` (
  `FAQs_id` bigint NOT NULL AUTO_INCREMENT,
  `FAQs_question` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `FAQs_answer` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`FAQs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_07_04_061253_create_FAQs_table', 0),
(2, '2025_07_04_061253_create_admin_table', 0),
(3, '2025_07_04_061253_create_contact_us_table', 0),
(4, '2025_07_04_061253_create_payment_table', 0),
(5, '2025_07_04_061253_create_property_table', 0),
(6, '2025_07_04_061253_create_property_image_table', 0),
(7, '2025_07_04_061253_create_property_owner_table', 0),
(8, '2025_07_04_061253_create_property_purchase_table', 0),
(9, '2025_07_04_061253_create_property_renting_table', 0),
(10, '2025_07_04_061253_create_property_type_table', 0),
(11, '2025_07_04_061253_create_support_ticket_table', 0),
(12, '2025_07_04_061253_create_user_table', 0),
(13, '2025_07_04_061253_create_utility_bill_table', 0),
(14, '2025_07_04_061253_create_utility_request_table', 0),
(15, '2025_07_04_062319_create_FAQs_table', 0),
(16, '2025_07_04_062319_create_admin_table', 0),
(17, '2025_07_04_062319_create_contact_us_table', 0),
(18, '2025_07_04_062319_create_payment_table', 0),
(19, '2025_07_04_062319_create_property_table', 0),
(20, '2025_07_04_062319_create_property_image_table', 0),
(21, '2025_07_04_062319_create_property_owner_table', 0),
(22, '2025_07_04_062319_create_property_purchase_table', 0),
(23, '2025_07_04_062319_create_property_renting_table', 0),
(24, '2025_07_04_062319_create_property_type_table', 0),
(25, '2025_07_04_062319_create_support_ticket_table', 0),
(26, '2025_07_04_062319_create_user_table', 0),
(27, '2025_07_04_062319_create_utility_bill_table', 0),
(28, '2025_07_04_062319_create_utility_request_table', 0),
(29, '2025_07_04_062322_add_foreign_keys_to_payment_table', 0),
(30, '2025_07_04_062322_add_foreign_keys_to_property_table', 0),
(31, '2025_07_04_062322_add_foreign_keys_to_property_image_table', 0),
(32, '2025_07_04_062322_add_foreign_keys_to_property_owner_table', 0),
(33, '2025_07_04_062322_add_foreign_keys_to_property_purchase_table', 0),
(34, '2025_07_04_062322_add_foreign_keys_to_property_renting_table', 0),
(35, '2025_07_04_062322_add_foreign_keys_to_support_ticket_table', 0),
(36, '2025_07_04_062322_add_foreign_keys_to_utility_bill_table', 0),
(37, '2025_07_04_062322_add_foreign_keys_to_utility_request_table', 0),
(38, '0001_01_01_000000_create_users_table', 1),
(39, '0001_01_01_000001_create_cache_table', 1),
(40, '0001_01_01_000002_create_jobs_table', 1),
(41, '2025_07_05_090511_add_details_to_property_table', 2),
(42, '2024_01_01_000003_create_properties_table', 3),
(43, '2024_01_01_000004_create_contacts_table', 3),
(44, '2024_01_01_000005_create_testimonials_table', 3),
(45, '2024_01_01_000006_create_team_members_table', 3),
(46, '2025_07_08_081848_create_activities_table', 4),
(47, '2025_07_08_081900_add_is_admin_to_user_table', 5),
(48, '2025_07_10_999998_update_property_id_column_types', 6),
(49, '2025_07_10_999999_update_foreign_keys_to_properties_table', 7),
(50, '2025_06_28_142242_create_properties_table', 1),
(51, '2025_07_08_061415_create_personal_access_tokens_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `property_id` bigint UNSIGNED NOT NULL,
  `payment_amount` bigint DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `user_id` (`user_id`),
  KEY `payment_property_id_foreign` (`property_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `user_id`, `property_id`, `payment_amount`, `payment_date`, `payment_status`, `payment_type`) VALUES
(8, 1, 2, 438, '2025-07-29', 'Pending', 'Credit Card'),
(9, 1, 2, 438, '2025-07-29', 'Pending', 'Credit Card'),
(10, 1, 2, 438, '2025-07-08', 'Pending', 'Credit Card'),
(11, 6, 2, 438, '2025-07-29', 'Pending', 'Credit Card'),
(12, 17, 3, 8000, '2025-06-30', 'Failed', 'Cash'),
(13, 20, 9, 438, '2025-07-14', 'Refunded', 'Bank Transfer');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `bedrooms` int DEFAULT NULL,
  `bathrooms` int DEFAULT NULL,
  `square_feet` int DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `features` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_id` bigint DEFAULT NULL,
  `agent_id` bigint UNSIGNED DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tenant_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `properties_owner_id_foreign` (`owner_id`),
  KEY `properties_agent_id_foreign` (`agent_id`),
  KEY `properties_status_index` (`status`),
  KEY `properties_type_index` (`type`),
  KEY `properties_price_index` (`price`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `title`, `description`, `price`, `type`, `status`, `bedrooms`, `bathrooms`, `square_feet`, `address`, `features`, `images`, `owner_id`, `agent_id`, `is_featured`, `is_active`, `created_at`, `updated_at`, `tenant_id`) VALUES
(2, 'House', 'Cozy house', 80000.00, 'Villa', 'Booked', 12, 12, 12, 'PhnomPenh', 'House', NULL, NULL, NULL, 0, 1, '2025-07-10 02:52:27', '2025-07-10 07:33:49', NULL),
(3, 'My house', 'My house', 80000.00, 'Villa', 'Sold', 12, 8, 60, 'PhnomPenh', 'House', 'properties/hO7pVSw9k4OhAVjhAeUsnovBXKu9Md3PfLyJS1Gz.jpg', NULL, NULL, 0, 1, '2025-07-10 03:07:48', '2025-07-10 07:33:49', 17),
(4, 'Sample Property', 'A great place to live', 100000.00, 'Apartment', 'Available', 2, 1, 900, '123 Main St', 'Nice view', NULL, NULL, NULL, 0, 1, '2025-07-10 10:14:17', '2025-07-10 05:15:00', 18),
(6, 'White houses', 'president resident', 80000.00, 'Big house', 'Pending', 10, 10, 1000, 'US', 'WHite house', 'properties/K3jWUtaKs1DJP8gyxjoUW4KT7oJTPDW5FkMdaGAZ.jpg', NULL, NULL, 0, 1, '2025-07-10 05:21:16', '2025-07-10 05:38:32', NULL),
(8, 'Hill top houses', 'Hill top', 100000.00, 'Big house', 'Pending', 10, 10, 1000, 'PhnomPenh', 'Hill top', 'properties/XcEf5YxRQEM74J0eE91KvmBHLEtVomKlRenv42BU.jpg', NULL, NULL, 0, 1, '2025-07-10 07:34:32', '2025-07-10 07:34:43', NULL),
(9, 'Beach Houses', 'Very beachy', 80000.00, 'Villa', 'Booked', 19, 10, 10, 'PhnomPenh', 'Beach', 'properties/REIHYCZF0X7Rcugky6BnfohneNuREUI0DkpGBzHr.jpg', NULL, NULL, 0, 1, '2025-07-10 07:43:12', '2025-07-10 07:44:06', 20),
(10, 'Apartment 2A', 'Spacious 2-bedroom apartment.', 1200.00, 'Apartment', 'available', NULL, NULL, NULL, '123 Main St', NULL, NULL, NULL, NULL, 0, 1, '2025-07-10 15:03:39', '2025-07-10 15:03:39', NULL),
(11, 'Unit 5B', 'Modern unit with great view.', 1500.00, 'Unit', 'available', NULL, NULL, NULL, '456 Elm St', NULL, NULL, NULL, NULL, 0, 1, '2025-07-10 15:03:39', '2025-07-10 15:03:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

DROP TABLE IF EXISTS `property`;
CREATE TABLE IF NOT EXISTS `property` (
  `property_id` bigint NOT NULL AUTO_INCREMENT,
  `property_size` bigint DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `property_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `property_status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `property_type_id` bigint DEFAULT NULL,
  `admin_id` bigint DEFAULT NULL,
  PRIMARY KEY (`property_id`),
  KEY `property_type_id` (`property_type_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `property_size`, `price`, `property_title`, `location`, `description`, `property_status`, `property_type_id`, `admin_id`) VALUES
(1, 1200, 80000.00, 'Sunny Downtown Apartment', 'USA', 'Very old nice cozy house', 'Available', 1, 1),
(4, NULL, 1.00, '1', '1', '1', NULL, 2, 1),
(6, NULL, 2.00, 'villa', '2', '2', NULL, 1, 1),
(7, NULL, 32758295.00, 'Farm', 'Phnompenh ToulKork', 'a farm house', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `property_image`
--

DROP TABLE IF EXISTS `property_image`;
CREATE TABLE IF NOT EXISTS `property_image` (
  `image_id` bigint NOT NULL AUTO_INCREMENT,
  `property_id` bigint DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uploaded_at` datetime DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `property_id` (`property_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_image`
--

INSERT INTO `property_image` (`image_id`, `property_id`, `image_url`, `uploaded_at`) VALUES
(3, 4, 'properties/TCzdO26INq5gilgEiGl5LZGluzAMAGQHKPNQpcpz.jpg', NULL),
(5, 6, 'properties/dbH7yQXGYMGuc6DPNIqnp9dt587Q0IFF1P4gBkGy.jpg', NULL),
(6, 7, 'properties/EXsBkDzuIvNAQs7t211oljKiXEg81AFkWJKjzD7n.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_owner`
--

DROP TABLE IF EXISTS `property_owner`;
CREATE TABLE IF NOT EXISTS `property_owner` (
  `property_owner_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `property_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`property_owner_id`),
  KEY `user_id` (`user_id`),
  KEY `property_owner_ibfk_2` (`property_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_owner`
--

INSERT INTO `property_owner` (`property_owner_id`, `user_id`, `property_id`) VALUES
(3, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `property_purchase`
--

DROP TABLE IF EXISTS `property_purchase`;
CREATE TABLE IF NOT EXISTS `property_purchase` (
  `property_purchase_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `property_id` bigint DEFAULT NULL,
  `property_purchase_date` date DEFAULT NULL,
  PRIMARY KEY (`property_purchase_id`),
  KEY `user_id` (`user_id`),
  KEY `property_id` (`property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_renting`
--

DROP TABLE IF EXISTS `property_renting`;
CREATE TABLE IF NOT EXISTS `property_renting` (
  `property_renting_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `property_owner_id` bigint DEFAULT NULL,
  `property_renting_amount` bigint DEFAULT NULL,
  `property_renting_start_date` date DEFAULT NULL,
  `property_renting_end_date` date DEFAULT NULL,
  `rental_status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`property_renting_id`),
  KEY `user_id` (`user_id`),
  KEY `property_owner_id` (`property_owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_renting`
--

INSERT INTO `property_renting` (`property_renting_id`, `user_id`, `property_owner_id`, `property_renting_amount`, `property_renting_start_date`, `property_renting_end_date`, `rental_status`) VALUES
(2, 4, 3, 0, '2025-07-25', '2025-07-31', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `property_type`
--

DROP TABLE IF EXISTS `property_type`;
CREATE TABLE IF NOT EXISTS `property_type` (
  `property_type_id` bigint NOT NULL AUTO_INCREMENT,
  `property_type_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`property_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_type`
--

INSERT INTO `property_type` (`property_type_id`, `property_type_name`) VALUES
(1, 'Apartment'),
(2, 'Villa');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4gbKEfnpBN88rBZnM4OkFKd08ICqilFsUYKXrJjh', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS0s3WDVTeWhWQXMxT1RmZjJ1SXJRTkRzR0FZT3FhdW1nV0VxZDdNcSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAxL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDEvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1751971255),
('bRLOgYMl5d34MlwjCnleZxUO78KT21uMfKQwBu5w', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMldVcTlpU2ZGaXl1c1A5N1hlSm9pYlk5RUJmZ1F6N1hORndlUU5YNiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAxL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDEvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1751971139),
('D4nNrda4DjFC2KuxAN2WNiCMHOBlSpJ2LOKDmgTI', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUWlrandBbUtONVVxRlNlSzMwTHRoRDBtWnpKcW1Jam01Y3N4a2VEQyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1751984281),
('OMC7atRgkDwsWbO6RcCvrzALi1bX6uK2NWkwxW5c', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibkdFMVEwakxUU0dMMnVaYkZmY0J6UVlRVXY1VWdmeDRLMWdpTEJYYyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1751984862),
('QtlvxbiP0B4w4pCP2MyLnBGUb3Hx1GKJl3eVpsyP', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiekxtTDMwOWtxQ21NNUZUdnpDNjJuWExjWkwzU0VEOFRZdmJ5bDY2NiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1751985189),
('vOuyRvcwGod5AAH0wYAfnhUtcfpJy76JgWZkxgOK', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV3NZZkpsTkRwcVhUYlo5VnM5ZXdvUWpubDJMQTRxVGVEamEyU2pENCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9saXN0aW5nIjt9fQ==', 1751989806);

-- --------------------------------------------------------

--
-- Table structure for table `support_ticket`
--

DROP TABLE IF EXISTS `support_ticket`;
CREATE TABLE IF NOT EXISTS `support_ticket` (
  `support_ticket_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `support_ticket_message` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `support_ticket_status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `support_ticket_created_at` datetime DEFAULT NULL,
  `support_ticket_responded_at` datetime DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`support_ticket_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support_ticket`
--

INSERT INTO `support_ticket` (`support_ticket_id`, `user_id`, `user_email`, `support_ticket_message`, `support_ticket_status`, `support_ticket_created_at`, `support_ticket_responded_at`, `name`) VALUES
(2, 5, 'jane.smith@example.com', 'I was charged twice for my last payment. Please assist.', 'Open', '2025-07-10 21:55:51', NULL, 'Jane Smith');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
CREATE TABLE IF NOT EXISTS `team_members` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_members_status_index` (`status`),
  KEY `team_members_sort_order_index` (`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `testimonial` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int NOT NULL DEFAULT '5',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `testimonials_status_index` (`status`),
  KEY `testimonials_sort_order_index` (`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` bigint NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_phone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_profile_picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_email`, `user_phone`, `user_profile_picture`, `is_admin`) VALUES
(1, 'John Doe', 'password123', 'john.doe@email.com', '111-222-3333', NULL, 0),
(2, 'Jane Smith', 'password456', 'jane.smith@email.com', '444-555-6666', NULL, 0),
(3, 'Lora', '$2y$12$z2YH4d2Z6EppGwe3klL.hOtMxHT4MEc4Bw/vV6zgLWvvRebO7knXC', 'lora@gmail.com', '348973p50', NULL, 0),
(4, 'Billa', '$2y$12$3gVN5h5IcHnShm1Hin9UY.6DoQgQJIwc/dRhU6KC.QeL/pNbsu/GW', 'bill@gmail.com', '89347385', NULL, 0),
(5, 'Rith', '$2y$12$V/dL0C2uOwNiSBg4OYWiae9OnwU23uVx41qQ.xlJM0mNbn9KLHTpS', 'rith@gmail.com', '3899438', NULL, 0),
(6, 'Chue', '$2y$12$tEGnskglBj1wNSOLQFhkbOwa8i6WYIQPVCFITMMx0PhKmj2vJByl6', 'lchue@gmail.com', '37385395', NULL, 0),
(7, 'Long', '$2y$12$w/Bd3a.qnD1RqH2.OAPpwekPBsVnGFBfrFb97lH/hJqYF0rXmwYKK', 'Long@gmail.com', '382579505', NULL, 0),
(8, 'Admin', '$2y$12$48zVwgwX6sGjELyo3v8fW.gtLwgxrEjxcmJx92Qg2QfIiQ1hVjzs6', 'admin@gmail.com', NULL, NULL, 1),
(16, 'Chay', '$2y$12$7aolfQDAX.J9USUFbC5OO.AHEHNX6/3y8PVacy4cmKfvrosuoLp2a', 'chay@gmail.com', '2829755', NULL, 0),
(17, 'Songhy', '$2y$12$AodXUpYq00x86oYgOTgMmuyIivvP4x4f64s5PvHKQ3qnYT4h4cmyG', 'hy@gmail.com', '37385395', NULL, 0),
(18, 'Nisa', '$2y$12$Vi4ZSylaxUBDrkB44H0AtuqivvyYtbjhR1zVr/FobNQOyDQtg0pkW', 'Nisa@gmail.com', '48357966', NULL, 0),
(19, 'Linhchue', '$2y$12$F44z.qVjsbi4Pgb.66708e4kiS/bciVCsBiSILmjMn2Q/bEZt/UUi', 'chue@gmail.com', '38457369', NULL, 0),
(20, 'Boras', '$2y$12$Rd39fFru30QDfXpNpYGeLup3WE7VtmepWORVg7CzlSbmyMIQ07Qpe', 'bora@gmail.com', '38457369', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utility_bill`
--

DROP TABLE IF EXISTS `utility_bill`;
CREATE TABLE IF NOT EXISTS `utility_bill` (
  `utility_bill_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `property_id` bigint UNSIGNED NOT NULL,
  `utility_bill_type` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `utility_bill_usage` bigint DEFAULT NULL,
  `utility_bill_amount` bigint DEFAULT NULL,
  `utility_bill_date` datetime DEFAULT NULL,
  `utility_bill_due_date` datetime DEFAULT NULL,
  `utility_bill_status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`utility_bill_id`),
  KEY `user_id` (`user_id`),
  KEY `utility_bill_property_id_foreign` (`property_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utility_bill`
--

INSERT INTO `utility_bill` (`utility_bill_id`, `user_id`, `property_id`, `utility_bill_type`, `utility_bill_usage`, `utility_bill_amount`, `utility_bill_date`, `utility_bill_due_date`, `utility_bill_status`) VALUES
(3, 3, 6, 'Electricity', 940, 5747, '2025-07-22 00:00:00', '2025-07-31 00:00:00', 'Paid'),
(5, 5, 6, 'Electricity', 1234, 234, '2025-07-24 00:00:00', '2025-07-25 00:00:00', 'Pending'),
(6, 6, 4, 'Electricity', 3482, 234, '2025-07-25 00:00:00', '2025-08-07 00:00:00', 'Pending'),
(7, 6, 4, 'Electricity', 3482, 234, '2025-07-25 00:00:00', '2025-08-07 00:00:00', 'Pending'),
(11, 1, 3, 'Electricity', 12, 12, '2025-07-15 00:00:00', '2025-07-23 00:00:00', 'Pending'),
(12, 1, 2, 'Water', 32955, 884, '2025-07-16 00:00:00', '2025-07-22 00:00:00', 'Pending'),
(13, 20, 9, 'Water', 3482, 234, '2025-07-19 00:00:00', '2025-07-30 00:00:00', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `utility_request`
--

DROP TABLE IF EXISTS `utility_request`;
CREATE TABLE IF NOT EXISTS `utility_request` (
  `utility_request_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `property_id` bigint UNSIGNED NOT NULL,
  `utility_request_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `utility_request_status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `utility_request_created_at` timestamp NULL DEFAULT NULL,
  `utility_request_responded_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`utility_request_id`),
  KEY `user_id` (`user_id`),
  KEY `utility_request_property_id_foreign` (`property_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utility_request`
--

INSERT INTO `utility_request` (`utility_request_id`, `user_id`, `property_id`, `utility_request_description`, `utility_request_status`, `utility_request_created_at`, `utility_request_responded_at`) VALUES
(11, 2, 11, 'Electricity outage reported in Unit 5B.', 'In Progress', '2025-07-10 15:10:18', NULL),
(12, 3, 9, 'Request for garbage collection service at Beach Houses.', 'Completed', '2025-07-10 15:10:18', '2025-07-10 15:10:18');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `payment_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`property_type_id`) REFERENCES `property_type` (`property_type_id`),
  ADD CONSTRAINT `property_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `property_image`
--
ALTER TABLE `property_image`
  ADD CONSTRAINT `property_image_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`);

--
-- Constraints for table `property_owner`
--
ALTER TABLE `property_owner`
  ADD CONSTRAINT `property_owner_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `property_owner_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_purchase`
--
ALTER TABLE `property_purchase`
  ADD CONSTRAINT `property_purchase_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `property_purchase_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`);

--
-- Constraints for table `property_renting`
--
ALTER TABLE `property_renting`
  ADD CONSTRAINT `property_renting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `property_renting_ibfk_2` FOREIGN KEY (`property_owner_id`) REFERENCES `property_owner` (`property_owner_id`);

--
-- Constraints for table `support_ticket`
--
ALTER TABLE `support_ticket`
  ADD CONSTRAINT `support_ticket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `utility_bill`
--
ALTER TABLE `utility_bill`
  ADD CONSTRAINT `utility_bill_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `utility_bill_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `utility_request`
--
ALTER TABLE `utility_request`
  ADD CONSTRAINT `utility_request_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `utility_request_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
