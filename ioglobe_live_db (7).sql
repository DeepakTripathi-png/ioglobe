-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 18, 2025 at 05:32 AM
-- Server version: 8.0.41
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ioglobe_live_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alarms`
--

CREATE TABLE `alarms` (
  `id` bigint UNSIGNED NOT NULL,
  `ioslave_id` bigint NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modbus_data` longtext COLLATE utf8mb4_unicode_ci,
  `alarm_status` enum('active','acknowledged') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `occurrences` int UNSIGNED NOT NULL DEFAULT '1',
  `last_triggered_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_acknowledged_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alarms`
--

INSERT INTO `alarms` (`id`, `ioslave_id`, `message`, `modbus_data`, `alarm_status`, `occurrences`, `last_triggered_at`, `last_acknowledged_at`, `created_at`, `updated_at`) VALUES
(1, 4, 'Fire Alarm Panel Has Detected An Alarm!', NULL, 'active', 560, '2025-02-13 10:55:07', NULL, '2025-02-13 09:21:30', '2025-02-13 10:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `alert_notifications`
--

CREATE TABLE `alert_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assign_device_to_sites`
--

CREATE TABLE `assign_device_to_sites` (
  `id` bigint UNSIGNED NOT NULL,
  `site_id` bigint DEFAULT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `modified_by` bigint DEFAULT NULL,
  `status` enum('active','delete','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign_device_to_sites`
--

INSERT INTO `assign_device_to_sites` (`id`, `site_id`, `device_id`, `description`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 'Hi', '127.0.0.1', NULL, 1, NULL, 'active', '2025-01-13 06:05:48', '2025-01-13 06:05:48'),
(2, 1, '2', NULL, '127.0.0.1', '127.0.0.1', 1, 1, 'delete', '2025-01-13 06:52:31', '2025-01-13 06:52:31');

-- --------------------------------------------------------

--
-- Table structure for table `assign_site_to_customers`
--

CREATE TABLE `assign_site_to_customers` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint DEFAULT NULL,
  `site_id` bigint DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `modified_by` bigint DEFAULT NULL,
  `status` enum('active','delete','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign_site_to_customers`
--

INSERT INTO `assign_site_to_customers` (`id`, `customer_id`, `site_id`, `description`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, NULL, '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-01-13 05:51:03', '2025-01-13 05:52:06'),
(2, 6, 1, NULL, '127.0.0.1', '127.0.0.1', 1, 1, 'delete', '2025-01-13 06:51:58', '2025-01-13 06:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `mobile`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Deepak', '7318560108', 'deepak@gmail.com', 'ermkewkmktfrketgkerter', '2024-12-23 05:14:07', '2024-12-23 05:14:07'),
(2, 'Johnutesk', '88745432869', 'yawiviseya67@gmail.com', 'Hi, ego volo scire vestri pretium.', '2025-02-15 20:02:30', '2025-02-15 20:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `controller_devices`
--

CREATE TABLE `controller_devices` (
  `id` bigint UNSIGNED NOT NULL,
  `controller_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `modified_by` bigint DEFAULT NULL,
  `status` enum('active','delete','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `controller_devices`
--

INSERT INTO `controller_devices` (`id`, `controller_name`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pluto', 'null', 'null', 0, NULL, 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `controller_device_ports`
--

CREATE TABLE `controller_device_ports` (
  `id` bigint UNSIGNED NOT NULL,
  `controller_device_id` bigint DEFAULT NULL,
  `port` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `modified_by` bigint DEFAULT NULL,
  `status` enum('active','delete','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `controller_device_ports`
--

INSERT INTO `controller_device_ports` (`id`, `controller_device_id`, `port`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'di1', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(3, 1, 'di2', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(4, 1, 'ai1', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(5, 1, 'ai2', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(6, 1, 'slave1', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(7, 1, 'slave2', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(8, 1, 'slave3', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(9, 1, 'slave4', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(10, 1, 'slave5', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(11, 1, 'slave6', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(12, 1, 'slave7', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(13, 1, 'slave8', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(14, 1, 'slave9', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(15, 1, 'slave10', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(16, 1, 'slave11', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(17, 1, 'slave12', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(18, 1, 'slave13', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30'),
(19, 1, 'slave14', 'null', 'null', 0, 0, 'active', '2025-01-08 06:02:30', '2025-01-08 06:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `device_masters`
--

CREATE TABLE `device_masters` (
  `id` bigint UNSIGNED NOT NULL,
  `controller_type_id` bigint DEFAULT NULL,
  `device_id` text COLLATE utf8mb4_unicode_ci,
  `device_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `modified_by` bigint DEFAULT NULL,
  `status` enum('active','delete','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `device_masters`
--

INSERT INTO `device_masters` (`id`, `controller_type_id`, `device_id`, `device_name`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '867409072672715', 'KE312001', '127.0.0.1', NULL, 2, NULL, 'active', '2025-01-08 01:16:50', '2025-01-08 01:16:50'),
(2, 1, '867409072672716', 'KE312002', '127.0.0.1', NULL, 1, NULL, 'active', '2025-01-13 05:34:15', '2025-01-13 05:34:15');

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
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `map_link` longtext COLLATE utf8mb4_unicode_ci,
  `facebook_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `modified_by` bigint DEFAULT NULL,
  `status` enum('active','delete','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `i_o_slaves`
--

CREATE TABLE `i_o_slaves` (
  `id` bigint UNSIGNED NOT NULL,
  `master_device_id` bigint DEFAULT NULL,
  `slave_device_id` bigint DEFAULT NULL,
  `io_slave_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `io_device_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `modified_by` bigint DEFAULT NULL,
  `status` enum('active','delete','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `i_o_slaves`
--

INSERT INTO `i_o_slaves` (`id`, `master_device_id`, `slave_device_id`, `io_slave_name`, `io_device_status`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, 5, 'di1', 'alarm', '127.0.0.1', NULL, 1, NULL, 'active', '2025-01-08 04:49:15', '2025-02-13 10:55:07'),
(5, 1, 12, 'slave1', 'normal', '127.0.0.1', NULL, 1, NULL, 'active', '2025-01-08 05:49:57', '2025-02-13 10:55:07'),
(6, 2, 11, 'di1', NULL, '127.0.0.1', NULL, 1, NULL, 'active', '2025-01-13 05:34:35', '2025-01-13 05:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `master_admins`
--

CREATE TABLE `master_admins` (
  `id` bigint UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_profile_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_profile_image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` bigint DEFAULT NULL,
  `status` enum('active','delete','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `modified_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_admins`
--

INSERT INTO `master_admins` (`id`, `user_type`, `user_id`, `user_name`, `email`, `password`, `mobile_no`, `role_id`, `address`, `user_profile_image_path`, `user_profile_image_name`, `fcm_token`, `access_token`, `last_login`, `remember_token`, `api_token`, `otp`, `status`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'system', NULL, 'Super Admin', 'superadmin@gmail.com', '$2y$10$0AVkTepXHUcEZlAqLgwPI.A3dMtsXeu9BWSXmtfEuibfb79UCY1HK', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2025-01-14 06:15:16', NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL, NULL, '2025-01-14 00:45:16'),
(2, 'system', NULL, 'Admin', 'admin@gmail.com', '$2y$10$H96yJAyONnwqzbJmFp5nW.sgDoE.IWT21K8/WyXsenu7p3P9Z7lHG', '7310560108', '3', 'Codepix Pune Maharastra', NULL, NULL, NULL, NULL, '2025-02-18 04:04:27', NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2024-11-27 01:02:56', '2025-02-18 04:04:27'),
(4, 'system', NULL, 'Client', 'client@gmail.com', '$2y$10$fv2ghBw5xF4fHdJAYgRwyu6F65C2F9vhkR1QfXu.nA357D6cGtmPu', '+91 7310560108', '4', 'This is Deepak Client', NULL, NULL, NULL, NULL, '2025-01-14 06:19:39', NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-01-03 03:31:41', '2025-01-14 00:49:39'),
(7, 'system', NULL, 'Operator', 'operator@gmail.com', '$2y$10$VJ8AGunoFyapRJatE48A6.8ig6SkLi.5NZ5Thm1g1HiKK7/X3cyCe', '+91 7310560108', '5', NULL, NULL, NULL, NULL, NULL, '2025-01-14 04:46:25', NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 4, NULL, '2025-01-13 23:15:48', '2025-01-13 23:16:25');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_05_075239_create_master_admins_table', 1),
(6, '2023_07_13_034312_create_general_settings_table', 1),
(7, '2023_08_22_102532_create_role_privileges_table', 1),
(8, '2023_08_28_112847_create_visual_settings_table', 1),
(9, '2024_11_25_043851_create_alert_notifications_table', 2),
(11, '2024_11_25_070606_create_device_type_masters_table', 3),
(12, '2024_11_26_063603_create_site_masters_table', 4),
(13, '2024_11_28_060802_create_devices_table', 5),
(14, '2024_12_16_091649_create_assign_devices_table', 6),
(15, '2024_12_23_095058_create_contacts_table', 7),
(17, '2025_01_02_042419_create_slave_device_masters_table', 9),
(18, '2025_01_02_094652_create_i_o_slaves_table', 10),
(25, '2025_01_08_051722_create_controller_device_ports_table', 15),
(26, '2025_01_08_050938_create_controller_devices_table', 16),
(27, '2024_12_30_111541_create_device_masters_table', 17),
(28, '2025_01_13_111403_create_assign_site_to_customers_table', 18),
(29, '2025_01_13_112721_create_assign_device_to_sites_table', 19),
(30, '2025_01_06_105009_create_alarms_table', 20);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hierarchy_level` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `hierarchy_level`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 1, '2024-11-27 07:16:24', NULL),
(2, 'Admin', 2, '2024-11-27 07:16:24', NULL),
(3, 'Client Admin', 3, '2024-11-27 07:16:24', NULL),
(4, 'Client Operator', 4, '2024-11-27 07:16:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_privileges`
--

CREATE TABLE `role_privileges` (
  `id` bigint UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privileges` text COLLATE utf8mb4_unicode_ci,
  `created_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `modified_by` bigint DEFAULT NULL,
  `status` enum('active','delete','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_privileges`
--

INSERT INTO `role_privileges` (`id`, `role_name`, `privileges`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'dashboard_view, site_master_view, site_master_add, site_master_edit, site_master_delete, site_master_status_change, device_type_master_view, device_master_add, device_master_edit, device_type_master_delete, device_type_master_status_change, slave_device_master_view, slave_device_master_add, slave_device_master_edit, slave_device_master_delete, slave_device_master_status_change, role_privileges_view, role_privileges_add, role_privileges_edit, role_privileges_delete, role_privileges_status_change, user_view, user_add, user_edit, user_delete, user_status_change, io_slave_management_view, io_slave_management_add, io_slave_management_edit, io_slave_management_delete, io_slave_management_status_change, device_view, device_add, device_edit, device_delete, device_status, map_site_view, map_site_add, map_site_edit, map_site_delete, map_site_status, alarm_view, alarm_edit, alarm_add, alarm_delete, alarm_status, report_view, report_add,device_type_master_edit', NULL, '127.0.0.1', NULL, 1, 'active', NULL, '2024-11-25 03:53:55'),
(3, 'Admin', 'dashboard_view,site_master_view,site_master_add,site_master_edit,site_master_delete,site_master_status_change,device_type_master_view,device_master_add,device_master_edit,device_type_master_delete,device_type_master_status_change,slave_device_master_view,slave_device_master_add,slave_device_master_edit,slave_device_master_delete,slave_device_master_status_change,role_privileges_view,role_privileges_add,role_privileges_edit,role_privileges_delete,role_privileges_status_change,user_view,user_add,user_edit,user_delete,user_status_change,io_slave_management_view,io_slave_management_add,io_slave_management_edit,io_slave_management_delete,io_slave_management_status_change,device_view,device_add,device_edit,device_delete,device_status,map_site_view,map_site_add,map_site_edit,map_site_delete,map_site_status,alarm_view,alarm_edit,alarm_add,alarm_delete,alarm_status,report_view,report_add', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2024-11-15 05:28:04', '2025-01-06 23:45:54'),
(4, 'Client', 'dashboard_view,user_view,user_add,user_edit,user_delete,user_status_change,alarm_view,report_view,report_add', '127.0.0.1', '127.0.0.1', 1, 2, 'active', '2024-11-15 05:32:08', '2025-01-06 23:49:06'),
(5, 'Operator', 'dashboard_view,alarm_view,alarm_edit,alarm_add,alarm_delete,alarm_status,report_view,report_add', '127.0.0.1', '127.0.0.1', 1, 2, 'active', '2024-11-26 04:47:07', '2025-01-06 23:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `site_masters`
--

CREATE TABLE `site_masters` (
  `id` bigint UNSIGNED NOT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_address` longtext COLLATE utf8mb4_unicode_ci,
  `created_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `modified_by` bigint DEFAULT NULL,
  `status` enum('active','delete','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_masters`
--

INSERT INTO `site_masters` (`id`, `site_name`, `site_address`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Codepix  111', 'Swami Plot No 166, Gajanan Nagar, 1/1/1, opposite ASHTAVINAYAK CITY, next to Pearl Society, Maharashtra Vidhyut Department Quarters, Phursungi, Pune, Maharashtra 412308', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2024-11-26 01:31:05', '2024-12-11 04:15:43'),
(2, NULL, NULL, '127.0.0.1', '127.0.0.1', 1, 1, 'delete', '2024-11-28 02:46:18', '2024-11-28 02:46:18'),
(3, 'aa', 'aa', '127.0.0.1', '127.0.0.1', 1, 1, 'delete', '2024-12-12 03:59:49', '2024-12-12 03:59:49'),
(4, 'ashu', 'Swami Plot No 166, Gajanan Nagar, 1/1/1, opposite ASHTAVINAYAK CITY, next to Pearl Society, Maharashtra Vidhyut Department Quarters, Phursungi, Pune, Maharashtra 412308', '127.0.0.1', '127.0.0.1', 1, 1, 'delete', '2024-12-12 23:53:36', '2024-12-13 00:08:57'),
(5, 'asas', 'asasas', '127.0.0.1', '127.0.0.1', 1, 1, 'delete', '2024-12-13 01:07:47', '2024-12-13 01:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `slave_device_masters`
--

CREATE TABLE `slave_device_masters` (
  `id` bigint UNSIGNED NOT NULL,
  `slave_device_name` text COLLATE utf8mb4_unicode_ci,
  `slave_device_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slave_device_image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `modified_by` bigint DEFAULT NULL,
  `status` enum('active','delete','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slave_device_masters`
--

INSERT INTO `slave_device_masters` (`id`, `slave_device_name`, `slave_device_image_path`, `slave_device_image_name`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(2, 'asd', 'public/images/slave_device_images/1735795234gzxsP.png', 'favicon_icon (2).png', '127.0.0.1', '127.0.0.1', 1, 1, 'delete', '2025-01-01 23:50:34', '2025-01-01 23:50:34'),
(3, 'dsf', 'public/images/slave_device_images/1735798281rWrSN.png', 'Screenshot 2024-12-30 163649.png', '127.0.0.1', '127.0.0.1', 1, 1, 'delete', '2025-01-01 23:55:55', '2025-01-02 00:41:21'),
(4, 'sdzfsz', 'public/images/slave_device_images/17357983085CN8M.png', 'logo.png', '127.0.0.1', '127.0.0.1', 1, 1, 'delete', '2025-01-02 00:41:48', '2025-01-02 00:41:48'),
(5, 'FIRE ALARM PANEL', 'public/images/slave_device_images/1735799843P2YYI.jfif', 'FireAlarmPanel.jfif', '127.0.0.1', NULL, 1, NULL, 'active', '2025-01-02 01:07:23', '2025-01-02 01:07:23'),
(6, 'VESDA SYSTEM PANEL', 'public/images/slave_device_images/1735799903n5zxK.jfif', 'vesda.jfif', '127.0.0.1', NULL, 1, NULL, 'active', '2025-01-02 01:08:23', '2025-01-02 01:08:23'),
(7, 'Room Temperature', 'public/images/slave_device_images/1735799968fOiP0.png', 'roomtemp.png', '127.0.0.1', NULL, 1, NULL, 'active', '2025-01-02 01:09:28', '2025-01-02 01:09:28'),
(8, 'Room Humidity', 'public/images/slave_device_images/173580006170AKz.jfif', 'humidity.jfif', '127.0.0.1', NULL, 1, NULL, 'active', '2025-01-02 01:11:01', '2025-01-02 01:11:01'),
(9, 'Electric Meter', 'public/images/slave_device_images/1735800110a2fRM.jfif', 'electricmeter.jfif', '127.0.0.1', NULL, 1, NULL, 'active', '2025-01-02 01:11:50', '2025-01-02 01:11:50'),
(10, 'WATER PUMP STATUS', 'public/images/slave_device_images/1735800179vlGqM.jfif', 'waterpump.jfif', '127.0.0.1', NULL, 1, NULL, 'active', '2025-01-02 01:12:59', '2025-01-02 01:12:59'),
(11, 'WATER PUMP COMMAND', 'public/images/slave_device_images/1735800736LgQjO.jfif', 'firePump.jfif', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-01-02 01:13:53', '2025-01-02 01:22:16'),
(12, 'WATER TANK', 'public/images/slave_device_images/1735800465MulTd.jfif', 'watertank.jfif', '127.0.0.1', NULL, 1, NULL, 'active', '2025-01-02 01:17:45', '2025-01-02 01:17:45'),
(13, 'WATER VALVES', 'public/images/slave_device_images/1735800535soqA5.jfif', 'WATER VALVES.jfif', '127.0.0.1', NULL, 1, NULL, 'active', '2025-01-02 01:18:55', '2025-01-02 01:18:55'),
(14, 'WATER METER', 'public/images/slave_device_images/17358005920Isl1.jfif', 'WATER METER.jfif', '127.0.0.1', NULL, 1, NULL, 'active', '2025-01-02 01:19:52', '2025-01-02 01:19:52');

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

-- --------------------------------------------------------

--
-- Table structure for table `visual_settings`
--

CREATE TABLE `visual_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `logo_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mini_logo_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mini_logo_image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_email_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_email_image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon_image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `modified_by` bigint DEFAULT NULL,
  `status` enum('active','delete','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alarms`
--
ALTER TABLE `alarms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alert_notifications`
--
ALTER TABLE `alert_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_device_to_sites`
--
ALTER TABLE `assign_device_to_sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_site_to_customers`
--
ALTER TABLE `assign_site_to_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `controller_devices`
--
ALTER TABLE `controller_devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `controller_device_ports`
--
ALTER TABLE `controller_device_ports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_masters`
--
ALTER TABLE `device_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `i_o_slaves`
--
ALTER TABLE `i_o_slaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_admins`
--
ALTER TABLE `master_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `role_privileges`
--
ALTER TABLE `role_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_masters`
--
ALTER TABLE `site_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slave_device_masters`
--
ALTER TABLE `slave_device_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visual_settings`
--
ALTER TABLE `visual_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alarms`
--
ALTER TABLE `alarms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alert_notifications`
--
ALTER TABLE `alert_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `assign_device_to_sites`
--
ALTER TABLE `assign_device_to_sites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assign_site_to_customers`
--
ALTER TABLE `assign_site_to_customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `controller_devices`
--
ALTER TABLE `controller_devices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `controller_device_ports`
--
ALTER TABLE `controller_device_ports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `device_masters`
--
ALTER TABLE `device_masters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `i_o_slaves`
--
ALTER TABLE `i_o_slaves`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_admins`
--
ALTER TABLE `master_admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_privileges`
--
ALTER TABLE `role_privileges`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `site_masters`
--
ALTER TABLE `site_masters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `slave_device_masters`
--
ALTER TABLE `slave_device_masters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visual_settings`
--
ALTER TABLE `visual_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
