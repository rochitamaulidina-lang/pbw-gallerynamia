-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2026 at 05:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallerynamia`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `no_bahan` int(11) NOT NULL,
  `nama_bahan` varchar(255) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `stok_bahan` int(11) NOT NULL,
  `stok_kritis` int(11) NOT NULL,
  `harga_beli` decimal(12,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`no_bahan`, `nama_bahan`, `satuan`, `stok_bahan`, `stok_kritis`, `harga_beli`) VALUES
(1, 'Kain Marbella', 'yard', 199, 50, 45000.00),
(2, 'Kain Voal', 'yard', 200, 60, 35000.00),
(3, 'Kain Jersey Premium', 'yard', 100, 30, 55000.00),
(4, 'Kain Katun Premium', 'yard', 125, 40, 48000.00),
(5, 'Benang Jahit Premium', 'roll', 93, 20, 8000.00),
(6, 'Karet Gamis', 'meter', 75, 15, 5000.00),
(7, 'Label Gallery Namia', 'pcs', 500, 50, 1500.00),
(8, 'Ritsleting', 'pcs', 200, 50, 3000.00);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `no_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `ukuran` varchar(35) NOT NULL,
  `stok_barang` int(11) NOT NULL,
  `harga_barang` decimal(12,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`no_barang`, `nama_barang`, `ukuran`, `stok_barang`, `harga_barang`) VALUES
(1, 'Gamis Marbella', 'S', 26, 250000.00),
(2, 'Gamis Marbella', 'M', 30, 250000.00),
(3, 'Gamis Marbella', 'L', 20, 275000.00),
(4, 'Khimar Voal Polos', 'Free Size', 51, 125000.00),
(5, 'Set Gamis + Khimar', 'M', 20, 375000.00),
(6, 'Tunik Jersey Premium', 'L', 40, 225000.00),
(7, 'Seragam Custom Kantor', 'All Size', 150, 150000.00),
(8, 'Hijab Voal', 'Free Size', 20, 50000.00);

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
-- Table structure for table `detail_barang`
--

CREATE TABLE `detail_barang` (
  `no_barang` int(11) NOT NULL,
  `no_bahan` int(11) NOT NULL,
  `qty_pakai` int(11) NOT NULL DEFAULT 1,
  `subtotal_bom` decimal(12,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_barang`
--

INSERT INTO `detail_barang` (`no_barang`, `no_bahan`, `qty_pakai`, `subtotal_bom`) VALUES
(1, 1, 3, 135000.00),
(1, 5, 1, 8000.00),
(1, 6, 1, 5000.00),
(1, 7, 1, 1500.00),
(2, 1, 3, 135000.00),
(2, 5, 1, 8000.00),
(2, 6, 1, 5000.00),
(2, 7, 1, 1500.00),
(3, 1, 4, 180000.00),
(3, 5, 1, 8000.00),
(3, 6, 1, 5000.00),
(3, 7, 1, 1500.00),
(4, 2, 2, 70000.00),
(4, 5, 1, 8000.00),
(5, 1, 3, 135000.00),
(5, 2, 2, 70000.00),
(5, 5, 1, 8000.00),
(5, 6, 1, 5000.00),
(5, 7, 2, 3000.00),
(6, 3, 2, 110000.00),
(6, 5, 1, 8000.00),
(6, 7, 1, 1500.00),
(6, 8, 1, 3000.00),
(7, 4, 1, 48000.00),
(7, 5, 1, 8000.00),
(7, 7, 1, 1500.00),
(7, 8, 1, 3000.00);

-- --------------------------------------------------------

--
-- Table structure for table `detail_beli`
--

CREATE TABLE `detail_beli` (
  `no_beli` int(11) NOT NULL,
  `no_bahan` int(11) NOT NULL,
  `qty_beli` int(11) NOT NULL DEFAULT 1,
  `subtotal_beli` decimal(12,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_beli`
--

INSERT INTO `detail_beli` (`no_beli`, `no_bahan`, `qty_beli`, `subtotal_beli`) VALUES
(2, 2, 200, 7000000.00),
(3, 5, 100, 800000.00),
(4, 3, 100, 5500000.00),
(5, 1, 200, 9000000.00),
(6, 4, 120, 5760000.00),
(7, 6, 75, 375000.00),
(8, 7, 500, 750000.00),
(9, 8, 200, 600000.00),
(10, 4, 5, 240000.00);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `no_jual` int(11) NOT NULL,
  `no_barang` int(11) NOT NULL,
  `qty_jual` int(11) NOT NULL DEFAULT 1,
  `subtotal_jual` decimal(12,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`no_jual`, `no_barang`, `qty_jual`, `subtotal_jual`) VALUES
(3, 7, 60, 9000000.00),
(4, 7, 100, 15000000.00);

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
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
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
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_10_085447_add_role_to_users_table', 2);

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
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `no_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `tlp_pegawai` varchar(30) DEFAULT NULL,
  `ttd_pegawai` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`no_pegawai`, `nama_pegawai`, `tlp_pegawai`, `ttd_pegawai`) VALUES
(1, 'Siti Aisyah', '081234567890', '1_1780499232.png'),
(2, 'Fatimah Zahra', '085810225678', ''),
(3, 'Rumaisha', '089822315432', '3_1780499242.png'),
(4, 'Aminah', '081234567893', ''),
(5, 'Zenith Fauziah', '085772702543', '');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `no_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `tlp_pelanggan` varchar(30) DEFAULT NULL,
  `email_pelanggan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`no_pelanggan`, `nama_pelanggan`, `tlp_pelanggan`, `email_pelanggan`) VALUES
(1, 'Aisyah Store', '081319450806', 'aisyah.store@gmail.com'),
(2, 'Majlis Taklim Al-Ikhlas', '085712345678', 'majlis.ikhlas@yahoo.com'),
(3, 'Zahra Collection', '081278902345', 'zahracollection@gmail.com'),
(4, 'PT Berkah Sejahtera', '021-5556789', 'hrd@berkahsejahtera.co.id'),
(5, 'Nadia Muslimah Store', '081234567003', 'nadia.muslimah@yahoo.com'),
(6, 'Yumi', '085771382179', 'yumyum@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `no_beli` int(11) NOT NULL,
  `no_supplier` int(11) NOT NULL,
  `no_pegawai` int(11) NOT NULL,
  `no_faktur` varchar(50) DEFAULT NULL,
  `tgl_beli` date NOT NULL,
  `total_beli` decimal(12,2) DEFAULT 0.00,
  `faktur_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`no_beli`, `no_supplier`, `no_pegawai`, `no_faktur`, `tgl_beli`, `total_beli`, `faktur_file`) VALUES
(2, 2, 1, 'FKT/002/05/2025', '2025-05-12', 7000000.00, NULL),
(3, 5, 3, 'FKT/003/06/2025', '2025-06-02', 800000.00, NULL),
(4, 3, 5, 'FKT/004/06/2025', '2025-06-05', 5500000.00, NULL),
(5, 1, 4, 'FKT/005/06/2025', '2025-06-08', 9000000.00, NULL),
(6, 4, 4, 'FKT/006/06/2025', '2025-06-10', 5760000.00, NULL),
(7, 3, 5, 'FKT/007/06/2025', '2025-06-12', 375000.00, NULL),
(8, 2, 5, 'FKT/008/06/2025', '2025-06-15', 750000.00, NULL),
(9, 5, 5, 'FKT/009/06/2025', '2025-06-18', 600000.00, NULL),
(10, 1, 1, 'A/6/V', '2026-05-04', 240000.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `no_jual` int(11) NOT NULL,
  `no_pelanggan` int(11) NOT NULL,
  `no_pegawai` int(11) NOT NULL,
  `tgl_jual` date NOT NULL,
  `dp` decimal(12,2) DEFAULT 0.00,
  `sisa_bayar` decimal(12,2) DEFAULT 0.00,
  `total_jual` decimal(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`no_jual`, `no_pelanggan`, `no_pegawai`, `tgl_jual`, `dp`, `sisa_bayar`, `total_jual`) VALUES
(3, 2, 1, '2025-06-01', 2700000.00, 6300000.00, 9000000.00),
(4, 4, 3, '2025-06-10', 4500000.00, 10500000.00, 15000000.00);

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
('jXgVJfZ0pwXGeigeB8ICgrnjDVmz8VvQrJDCDzfS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicW1uMTN1NFFlVW8wMEZubU5NS3FZRmdxdHJXQzRueFdPU3k3N0xQSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlciI7czo1OiJyb3V0ZSI7czo4OiJyZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781100914),
('r3ieLVXud5nTWpFFULGmPTyLFakUCu4JT87tcRbJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUt6MUJQTHpHOW00Ukl2cHc5dDlENnZLMTJ4UW9kYjc5eFFSWHFzayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1781104953);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `no_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat_supplier` varchar(255) DEFAULT NULL,
  `tlp_supplier` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`no_supplier`, `nama_supplier`, `alamat_supplier`, `tlp_supplier`) VALUES
(1, 'Toko Kain Makmur', 'Pasar Jatinegara, Jakarta Timur', '0271-123456'),
(2, 'Supplier Voal A', 'Jalan Kebon Jeruk No 10, Jakarta Barat', '022-7890123'),
(3, 'Toko Kain Berkah', 'Jalan Raya Tajur, Tangerang', '0251-456789'),
(4, 'Supplier Katun C', 'Pasar Gede, Jatinegara, Jakarta Timur', '0271-987654'),
(5, 'Toko Benang Jaya', 'Jalan Industri No 45, Tangerang', '021-5551234');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','pemilik') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Pemilik', 'pemilik@gmail.com', NULL, '$2y$12$E3mW0UcuVuaBBcCIOe9qUeM6yh08F25u0olI47gFPpWwgUbrWLJdC', 'A6ZNjErPPeUweWfPjYEMWSdRcUqeKitVXqHkp1P2wipVYq63lXUSrFDjKCkB', '2026-06-10 15:20:58', '2026-06-10 15:20:58', 'pemilik'),
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$12$.rxiJuqEUzVSlR5YS6AgRu8azJ/gybPA4PMOge08GkVlwPtp02u8O', 'JoV5zMvt2eDfREYPV4dl4RUPCLwKtFWdPwPzSPFy6oSGtjzQF3ZEzCWsGTVB', '2026-06-10 15:20:58', '2026-06-10 15:20:58', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`no_bahan`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`no_barang`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD PRIMARY KEY (`no_barang`,`no_bahan`),
  ADD KEY `no_bahan` (`no_bahan`);

--
-- Indexes for table `detail_beli`
--
ALTER TABLE `detail_beli`
  ADD PRIMARY KEY (`no_beli`,`no_bahan`),
  ADD KEY `no_bahan` (`no_bahan`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`no_jual`,`no_barang`),
  ADD KEY `no_barang` (`no_barang`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`no_pegawai`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`no_pelanggan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`no_beli`),
  ADD KEY `no_supplier` (`no_supplier`),
  ADD KEY `no_pegawai` (`no_pegawai`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`no_jual`),
  ADD KEY `no_pegawai` (`no_pegawai`),
  ADD KEY `no_pelanggan` (`no_pelanggan`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`no_supplier`);

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
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `no_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `no_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `no_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `no_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `no_beli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `no_jual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `no_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD CONSTRAINT `detail_barang_ibfk_1` FOREIGN KEY (`no_barang`) REFERENCES `barang` (`no_barang`),
  ADD CONSTRAINT `detail_barang_ibfk_2` FOREIGN KEY (`no_bahan`) REFERENCES `bahan_baku` (`no_bahan`);

--
-- Constraints for table `detail_beli`
--
ALTER TABLE `detail_beli`
  ADD CONSTRAINT `detail_beli_ibfk_1` FOREIGN KEY (`no_beli`) REFERENCES `pembelian` (`no_beli`),
  ADD CONSTRAINT `detail_beli_ibfk_2` FOREIGN KEY (`no_bahan`) REFERENCES `bahan_baku` (`no_bahan`);

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`no_jual`) REFERENCES `penjualan` (`no_jual`),
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`no_barang`) REFERENCES `barang` (`no_barang`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`no_supplier`) REFERENCES `supplier` (`no_supplier`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`no_pegawai`) REFERENCES `pegawai` (`no_pegawai`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`no_pegawai`) REFERENCES `pegawai` (`no_pegawai`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`no_pelanggan`) REFERENCES `pelanggan` (`no_pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
