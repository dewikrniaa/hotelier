-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 07, 2026 at 02:08 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(50) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `record_id` char(36) DEFAULT NULL,
  `description` text,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `table_name`, `record_id`, `description`, `ip_address`, `created_at`) VALUES
(1, '4', 'LOGIN', 'users', '4', 'User berhasil login', '127.0.0.1', '2026-01-06 17:07:05'),
(2, '4', 'DELETE', 'checkin', '8ee60b49-eb1d-11f0-8807-00ff48ff2bc0', 'Delete checkin pelanggan', '127.0.0.1', '2026-01-06 17:20:50'),
(3, '4', 'DELETE', 'pelanggan', '76d7556b-eb17-11f0-8807-00ff48ff2bc0', 'Menghapus data pelanggan', '127.0.0.1', '2026-01-06 17:30:18'),
(4, '4', 'CHECKIN', 'checkin', '9f7c4f0e-541a-49f4-b55c-cca5392a0744', 'Proses check-in pelanggan', '127.0.0.1', '2026-01-06 17:50:22'),
(5, '4', 'PAYMENT', 'checkin', '9f7c4f0e-541a-49f4-b55c-cca5392a0744', 'Pembayaran check-in', '127.0.0.1', '2026-01-06 17:50:31'),
(6, '4', 'CHECKOUT', 'checkin', '9f7c4f0e-541a-49f4-b55c-cca5392a0744', 'Checkout pelanggan', '127.0.0.1', '2026-01-06 17:50:36'),
(7, '4', 'LOGIN', 'users', '4', 'User berhasil login', '127.0.0.1', '2026-01-07 03:19:45'),
(8, '4', 'CHECKIN', 'checkin', '09152241-6335-4a33-a631-a64b4054bfc9', 'Proses check-in pelanggan', '127.0.0.1', '2026-01-07 03:24:04'),
(9, '4', 'PAYMENT', 'checkin', '09152241-6335-4a33-a631-a64b4054bfc9', 'Pembayaran check-in', '127.0.0.1', '2026-01-07 03:24:11'),
(10, '4', 'CHECKOUT', 'checkin', '09152241-6335-4a33-a631-a64b4054bfc9', 'Checkout pelanggan', '127.0.0.1', '2026-01-07 03:24:15'),
(11, '4', 'LOGIN', 'users', '4', 'User berhasil login', '127.0.0.1', '2026-01-07 04:07:53'),
(12, '4', 'LOGIN', 'users', '4', 'User berhasil login', '127.0.0.1', '2026-01-07 04:46:52'),
(13, '4', 'CHECKIN', 'checkin', '34f2a69a-8847-42bd-b67b-7364d66d64ea', 'Proses check-in pelanggan', '127.0.0.1', '2026-01-07 04:50:19'),
(14, '4', 'LOGIN', 'users', '4', 'User berhasil login', '127.0.0.1', '2026-01-07 07:37:39'),
(15, '4', 'DELETE', 'pelanggan', 'da820d2f-eb11-11f0-8807-00ff48ff2bc0', 'Menghapus data pelanggan', '127.0.0.1', '2026-01-07 07:45:15'),
(16, '4', 'CREATE', 'pelanggan', '01ef6ed5-a3e1-4fb2-8ea6-5915ba4dec2a', 'Menambahkan data pelanggan baru', '127.0.0.1', '2026-01-07 09:21:49'),
(17, '4', 'DELETE', 'pelanggan', '01ef6ed5-a3e1-4fb2-8ea6-5915ba4dec2a', 'Menghapus data pelanggan', '127.0.0.1', '2026-01-07 09:21:55'),
(18, '4', 'CREATE', 'pelanggan', '19a61358-c902-4dde-9146-29c7106cc248', 'Menambahkan data pelanggan baru', '127.0.0.1', '2026-01-07 09:22:15'),
(19, '4', 'DELETE', 'pelanggan', '19a61358-c902-4dde-9146-29c7106cc248', 'Menghapus data pelanggan', '127.0.0.1', '2026-01-07 09:22:24'),
(20, '4', 'DELETE', 'pelanggan', 'c2b21566-eadd-11f0-971f-50ebf6d09c21', 'Menghapus data pelanggan', '127.0.0.1', '2026-01-07 09:25:21'),
(21, '4', 'DELETE', 'checkin', '9f7c4f0e-541a-49f4-b55c-cca5392a0744', 'Menghapus data checkin pelanggan', '127.0.0.1', '2026-01-07 09:34:52'),
(22, '4', 'DELETE', 'checkin', '34f2a69a-8847-42bd-b67b-7364d66d64ea', 'Menghapus data check-in pelanggan', '127.0.0.1', '2026-01-07 09:45:07'),
(23, '4', 'CHECKIN', 'checkin', '66f785bb-3129-48e8-80c2-6f25d3d22e0f', 'Proses check-in pelanggan', '127.0.0.1', '2026-01-07 09:48:44'),
(24, '4', 'PAYMENT', 'checkin', '66f785bb-3129-48e8-80c2-6f25d3d22e0f', 'Pembayaran check-in', '127.0.0.1', '2026-01-07 09:48:55'),
(25, '4', 'CHECKOUT', 'checkin', '66f785bb-3129-48e8-80c2-6f25d3d22e0f', 'Checkout pelanggan, kamar masuk maintenance', '127.0.0.1', '2026-01-07 09:49:22'),
(26, '4', 'CHECKIN', 'checkin', '0efeb024-024f-4f7c-98d0-dce5f274d7ad', 'Proses check-in pelanggan', '127.0.0.1', '2026-01-07 09:49:50'),
(27, '4', 'CREATE', 'kamar', 'b0268844-5472-4a29-a483-bc4fdd796bb0', 'Menambahkan data kamar baru', '127.0.0.1', '2026-01-07 09:50:03'),
(28, '4', 'UPDATE', 'checkin', '0efeb024-024f-4f7c-98d0-dce5f274d7ad', 'Update check-in pelanggan', '127.0.0.1', '2026-01-07 09:50:24'),
(29, '4', 'UPDATE', 'checkin', '0efeb024-024f-4f7c-98d0-dce5f274d7ad', 'Update check-in pelanggan', '127.0.0.1', '2026-01-07 09:50:43'),
(30, '4', 'PAYMENT', 'checkin', '0efeb024-024f-4f7c-98d0-dce5f274d7ad', 'Pembayaran check-in', '127.0.0.1', '2026-01-07 09:51:01'),
(31, '4', 'UPDATE', 'checkin', '0efeb024-024f-4f7c-98d0-dce5f274d7ad', 'Update check-in pelanggan', '127.0.0.1', '2026-01-07 09:52:30'),
(32, '4', 'UPDATE', 'kamar', '083648ae-eae8-11f0-971f-50ebf6d09c21', 'Menyelesaikan maintenance kamar', '127.0.0.1', '2026-01-07 10:03:05'),
(33, '4', 'CHECKIN', 'checkin', '9c0ac310-9041-4ea4-a44f-88216fc331c0', 'Proses check-in pelanggan', '127.0.0.1', '2026-01-07 10:05:45'),
(34, '4', 'LOGIN', 'users', '4', 'User berhasil login', '127.0.0.1', '2026-01-07 13:44:22'),
(35, '4', 'UPDATE', 'kamar', 'b0268844-5472-4a29-a483-bc4fdd796bb0', 'Mengubah data kamar', '127.0.0.1', '2026-01-07 13:48:01'),
(36, '4', 'UPDATE', 'kamar', '083648ae-eae8-11f0-971f-50ebf6d09c21', 'Mengubah data kamar', '127.0.0.1', '2026-01-07 13:48:12'),
(37, '4', 'UPDATE', 'kamar', 'b0268844-5472-4a29-a483-bc4fdd796bb0', 'Mengubah data kamar', '127.0.0.1', '2026-01-07 13:48:22'),
(38, '4', 'UPDATE', 'kamar', 'c2b21566-eadd-11f0-971f-50ebf6d09c21', 'Mengubah data kamar', '127.0.0.1', '2026-01-07 13:49:10'),
(39, '4', 'CREATE', 'kamar', '748b4a8e-d773-44fa-aae4-4a2bcd303199', 'Menambahkan data kamar baru', '127.0.0.1', '2026-01-07 13:49:27'),
(40, '4', 'CREATE', 'kamar', '3b932592-d77a-467e-b72e-8d4af5a257ff', 'Menambahkan data kamar baru', '127.0.0.1', '2026-01-07 13:49:55'),
(41, '4', 'CREATE', 'kamar', '8a0fa0ed-73ea-4998-8a0d-1ff679c6375a', 'Menambahkan data kamar baru', '127.0.0.1', '2026-01-07 13:50:10'),
(42, '4', 'CREATE', 'kamar', '7df6ae2e-40e1-4449-99ce-3eda88738f07', 'Menambahkan data kamar baru', '127.0.0.1', '2026-01-07 13:50:22'),
(43, '4', 'UPDATE', 'pelanggan', 'ab231502-eaba-11f0-9bbd-00ff48ff2bc0', 'Mengedit data pelanggan', '127.0.0.1', '2026-01-07 13:51:17'),
(44, '4', 'UPDATE', 'pelanggan', 'ab231502-eaba-11f0-9bbd-00ff48ff2bc0', 'Mengedit data pelanggan', '127.0.0.1', '2026-01-07 13:51:43'),
(45, '4', 'UPDATE', 'pelanggan', 'ab231502-eaba-11f0-9bbd-00ff48ff2bc0', 'Mengedit data pelanggan', '127.0.0.1', '2026-01-07 13:52:12'),
(46, '4', 'CREATE', 'pelanggan', 'f68ed65f-8fac-4061-add8-ebf7dbe9118c', 'Menambahkan data pelanggan baru', '127.0.0.1', '2026-01-07 13:53:23'),
(47, '4', 'CREATE', 'pelanggan', 'c89ce9a5-7bed-41e0-bd28-88159ed0d3a2', 'Menambahkan data pelanggan baru', '127.0.0.1', '2026-01-07 13:54:37'),
(48, '4', 'DELETE', 'checkin', '09152241-6335-4a33-a631-a64b4054bfc9', 'Menghapus data check-in pelanggan', '127.0.0.1', '2026-01-07 13:55:56'),
(49, '4', 'DELETE', 'checkin', '66f785bb-3129-48e8-80c2-6f25d3d22e0f', 'Menghapus data check-in pelanggan', '127.0.0.1', '2026-01-07 13:57:36'),
(50, '4', 'DELETE', 'checkin', 'b7d38330-eaf9-11f0-b454-0a0027000013', 'Menghapus data check-in pelanggan', '127.0.0.1', '2026-01-07 13:57:46'),
(51, '4', 'DELETE', 'checkin', '9c0ac310-9041-4ea4-a44f-88216fc331c0', 'Menghapus data check-in pelanggan', '127.0.0.1', '2026-01-07 13:58:00'),
(52, '4', 'CHECKIN', 'checkin', '80789d63-d003-4bb8-8449-040640c06e08', 'Proses check-in pelanggan', '127.0.0.1', '2026-01-07 13:58:53'),
(53, '4', 'CHECKIN', 'checkin', 'b1c84b8b-9c06-4f18-b6a7-dd1add8cb9ce', 'Proses check-in pelanggan', '127.0.0.1', '2026-01-07 13:59:39'),
(54, '4', 'PAYMENT', 'checkin', 'b1c84b8b-9c06-4f18-b6a7-dd1add8cb9ce', 'Pembayaran check-in', '127.0.0.1', '2026-01-07 13:59:57'),
(55, '4', 'CHECKOUT', 'checkin', 'b1c84b8b-9c06-4f18-b6a7-dd1add8cb9ce', 'Checkout pelanggan, kamar masuk maintenance', '127.0.0.1', '2026-01-07 14:00:12'),
(56, '4', 'CHECKOUT', 'checkin', '0efeb024-024f-4f7c-98d0-dce5f274d7ad', 'Checkout pelanggan, kamar masuk maintenance', '127.0.0.1', '2026-01-07 14:00:43'),
(57, '4', 'PAYMENT', 'checkin', '80789d63-d003-4bb8-8449-040640c06e08', 'Pembayaran check-in', '127.0.0.1', '2026-01-07 14:00:53');

-- --------------------------------------------------------

--
-- Table structure for table `checkin`
--

CREATE TABLE `checkin` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `id_pelanggan` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kamar` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_harga` int NOT NULL,
  `status_checkin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pembayaran` enum('Belum Bayar','Lunas') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Belum Bayar',
  `metode_pembayaran` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_bayar` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checkin`
--

INSERT INTO `checkin` (`id`, `checkin_date`, `checkout_date`, `id_pelanggan`, `id_kamar`, `total_harga`, `status_checkin`, `status_pembayaran`, `metode_pembayaran`, `tanggal_bayar`, `created_at`, `updated_at`) VALUES
('0efeb024-024f-4f7c-98d0-dce5f274d7ad', '2026-01-07', '2026-01-08', 'ab231502-eaba-11f0-9bbd-00ff48ff2bc0', 'b0268844-5472-4a29-a483-bc4fdd796bb0', 400000, 'Checkout', 'Lunas', 'Cash', '2026-01-07 16:51:01', '2026-01-07 09:49:50', '2026-01-07 14:00:43'),
('80789d63-d003-4bb8-8449-040640c06e08', '2025-12-31', '2026-01-01', 'c89ce9a5-7bed-41e0-bd28-88159ed0d3a2', 'c2b21566-eadd-11f0-971f-50ebf6d09c21', 300000, 'Aktif', 'Lunas', 'QRIS', '2026-01-07 21:00:53', '2026-01-07 13:58:53', '2026-01-07 14:00:53'),
('b1c84b8b-9c06-4f18-b6a7-dd1add8cb9ce', '2025-12-30', '2026-01-01', 'f68ed65f-8fac-4061-add8-ebf7dbe9118c', '748b4a8e-d773-44fa-aae4-4a2bcd303199', 500000, 'Checkout', 'Lunas', 'Cash', '2026-01-07 20:59:56', '2026-01-07 13:59:39', '2026-01-07 14:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kamar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_kamar_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `no_kamar`, `status`, `tipe_kamar_id`, `created_at`, `updated_at`) VALUES
('083648ae-eae8-11f0-971f-50ebf6d09c21', '301', 'Tersedia', 3, NULL, '2026-01-07 13:58:00'),
('3b932592-d77a-467e-b72e-8d4af5a257ff', '202', 'Tersedia', 2, '2026-01-07 13:49:55', '2026-01-07 13:49:55'),
('49f1da9f-eadd-11f0-971f-50ebf6d09c21', '101', 'Terpesan', 1, NULL, NULL),
('748b4a8e-d773-44fa-aae4-4a2bcd303199', '102', 'Maintenance', 1, '2026-01-07 13:49:27', '2026-01-07 14:00:12'),
('7df6ae2e-40e1-4449-99ce-3eda88738f07', '402', 'Tersedia', 4, '2026-01-07 13:50:21', '2026-01-07 13:50:21'),
('8a0fa0ed-73ea-4998-8a0d-1ff679c6375a', '401', 'Tersedia', 4, '2026-01-07 13:50:10', '2026-01-07 13:50:10'),
('b0268844-5472-4a29-a483-bc4fdd796bb0', '302', 'Maintenance', 3, '2026-01-07 09:50:03', '2026-01-07 14:00:43'),
('c2b21566-eadd-11f0-971f-50ebf6d09c21', '201', 'Terpesan', 2, NULL, '2026-01-07 13:49:10');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_12_17_165826_create_pelanggan_table', 1),
(6, '2025_12_17_165831_create_kamar_table', 1),
(7, '2025_12_17_165834_create_reservasi_table', 1),
(8, '2025_12_17_165837_create_checkin_table', 1),
(9, '2025_12_17_165840_create_checkout_table', 1),
(10, '2025_12_17_165844_create_laporan_table', 1),
(11, '2026_01_06_161558_add_timestamps_to_checkin_table', 2),
(12, '2026_01_06_233901_add_timestamps_to_pelanggan_table', 3),
(13, '2026_01_06_234307_add_timestamps_to_kamar_table', 4),
(14, '2026_07_16_015500_add_foreign_keys_to_hotel_tables', 5),
(15, '2026_07_16_020000_add_user_foreign_key_to_audit_logs_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ktp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `nik`, `foto_ktp`, `email`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
('ab231502-eaba-11f0-9bbd-00ff48ff2bc0', 'Dewi', '1234567890123456', 'Glt2wvyAROoJx5RcT1VwaNRYD7WHe61ndGPaE5Ph.jpg', 'dewi@gmail.com', 'Jl. Rowosari', '+6282289870352', NULL, '2026-01-07 13:52:12'),
('c89ce9a5-7bed-41e0-bd28-88159ed0d3a2', 'Shasy', '1235790853197531', 'kixLaXC6rqfEgB2LEa5xdd7NPrWGf8x9ARnbiJG6.jpg', 'ssy@gmail.com', 'Jl. Intisari', '+6281122334455', '2026-01-07 13:54:37', '2026-01-07 13:54:37'),
('f68ed65f-8fac-4061-add8-ebf7dbe9118c', 'Lutfi', '1230987654321098', 'sxksfpdLIc1tKajdN2lSk7Vx52tAajQLjwbcfEjP.jpg', 'lutfi@gmail.com', 'Jl. Sidomulyo', '+6280987654321', '2026-01-07 13:53:23', '2026-01-07 13:53:23');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kamar`
--

CREATE TABLE `tipe_kamar` (
  `id` int NOT NULL,
  `nama_tipe` varchar(50) NOT NULL,
  `harga` int NOT NULL,
  `kapasitas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tipe_kamar`
--

INSERT INTO `tipe_kamar` (`id`, `nama_tipe`, `harga`, `kapasitas`) VALUES
(1, 'Standar', 250000, 2),
(2, 'Superior', 300000, 2),
(3, 'Deluxe', 400000, 3),
(4, 'Suite', 600000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'shasy', 'shasy@gmail.com', 'shasy', NULL, '$2y$10$K/.opwq/zsABNnjLAK6nFOyHMkd4GliSYcx5t9Evy5ZoSfHi4IWrq', NULL, '2026-01-05 22:37:15', '2026-01-05 22:37:15'),
(5, 'Dewi Kurnia Sari', 'dewikrniaa@gmail.com', 'dewi', NULL, '$2y$10$84d2sRvwcO7e9cxylYSf..QVDuAZ8vTt91oEwbhQxTN0hBPxl8p6G', NULL, '2026-01-05 22:55:51', '2026-01-05 22:55:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_logs_user_id_index` (`user_id`);

--
-- Indexes for table `checkin`
--
ALTER TABLE `checkin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkin_id_pelanggan_index` (`id_pelanggan`),
  ADD KEY `checkin_id_kamar_index` (`id_kamar`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `kamar_tipe_kamar_id_index` (`tipe_kamar_id`);

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
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_tipe_kamar_id_foreign` FOREIGN KEY (`tipe_kamar_id`) REFERENCES `tipe_kamar` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `checkin`
--
ALTER TABLE `checkin`
  ADD CONSTRAINT `checkin_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `checkin_id_kamar_foreign` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
