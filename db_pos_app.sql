-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jun 2024 pada 15.45
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pos_app`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectuser` ()  BEGIN
SELECT id,name,email,password,role FROM users;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `brands`
--

INSERT INTO `brands` (`id`, `nama`, `alamat`, `keterangan`, `telepon`, `foto`, `kode_pos`, `created_at`, `updated_at`) VALUES
(1, 'Gatoko', 'Jl. Sudira', 'Toko Gatoko', '08123102312', NULL, 1313144, '2024-02-29 09:35:46', '2024-02-29 09:35:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` bigint(20) NOT NULL,
  `sub_total` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` bigint(20) NOT NULL DEFAULT 0,
  `kode_unik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `carts`
--

INSERT INTO `carts` (`id`, `produk_id`, `jumlah`, `sub_total`, `user_id`, `status`, `kode_unik`, `created_at`, `updated_at`) VALUES
(21, '1', 10, 200000, 3, 1, '9727405726', '2024-05-25 06:04:05', '2024-05-25 06:04:46'),
(22, '4', 20, 400000, 3, 1, '9727405726', '2024-05-25 06:04:21', '2024-05-25 06:04:46'),
(23, '1', 10, 200000, 3, 1, '9201112933', '2024-05-26 09:46:33', '2024-05-26 09:47:26'),
(32, '1', 11, 200000, 3, 1, '5189666826', '2024-06-22 12:27:52', '2024-06-23 00:24:39'),
(33, '4', 10, 200000, 3, 1, '5189666826', '2024-06-23 00:23:48', '2024-06-23 00:24:39'),
(35, '14', 11, 220000, 7, 1, '1464181207', '2024-06-23 00:25:45', '2024-06-23 05:59:30'),
(43, '13', 1, 15000, 7, 1, '6257825462', '2024-06-23 01:10:54', '2024-06-23 05:25:40'),
(44, '4', 1, 20000, 7, 1, '6257825462', '2024-06-23 01:11:13', '2024-06-23 05:25:40'),
(45, '1', 1, 20000, 7, 1, '6257825462', '2024-06-23 01:12:52', '2024-06-23 05:25:40'),
(46, '1', 1, 20000, 7, 1, '5685908848', '2024-06-23 06:03:21', '2024-06-23 11:12:54'),
(47, '14', 2, 40000, 7, 1, '5685908848', '2024-06-23 06:03:56', '2024-06-23 11:12:54'),
(48, '4', 1, 20000, 7, 1, '5685908848', '2024-06-23 11:01:24', '2024-06-23 11:12:54'),
(49, '13', 1, 15000, 7, 1, '1950007291', '2024-06-23 11:15:17', '2024-06-23 11:22:07'),
(50, '14', 1, 20000, 7, 1, '8137561317', '2024-06-23 11:23:16', '2024-06-23 11:24:16'),
(51, '13', 3, 45000, 7, 1, '4480413292', '2024-06-23 11:25:30', '2024-06-23 11:28:03'),
(52, '4', 1, 20000, 7, 1, '9366549423', '2024-06-23 11:31:30', '2024-06-23 11:50:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `checkouts`
--

CREATE TABLE `checkouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `saldo` bigint(20) DEFAULT NULL,
  `kembalian` bigint(20) DEFAULT NULL,
  `metode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_unik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MENUNGGU PEMBAYARAN',
  `bukti_pembayaran` varchar(254) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_pengiriman` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `checkouts`
--

INSERT INTO `checkouts` (`id`, `total`, `user_id`, `saldo`, `kembalian`, `metode`, `kode_unik`, `status`, `bukti_pembayaran`, `alamat`, `tgl_pengiriman`, `created_at`, `updated_at`) VALUES
(13, 600000, 3, 600000, 0, 'cash', '9727405726', 'BARANG DALAM PROSES PENGIRIMAN', 'Screenshot.png', 'JL.Jati Bening', '2024-05-26', '2024-05-25 06:04:46', '2024-05-26 08:54:56'),
(14, 200000, 3, 200000, 0, 'cash', '9201112933', 'BARANG DALAM PROSES PENGIRIMAN', NULL, NULL, '2024-06-02', '2024-05-26 09:47:26', '2024-06-01 23:44:49'),
(15, 400000, 3, 400000, 0, 'cash', '5189666826', 'MENUNGGU PEMBAYARAN', NULL, NULL, NULL, '2024-06-23 00:24:39', '2024-06-23 00:24:39'),
(16, 55000, 7, 110000, 55000, 'TRANSFER', '6257825462', 'BARANG TELAH SAMPAI', 'google.png', 'Jl. Sugar Firdaus', '2024-06-25', '2024-06-23 05:25:40', '2024-06-23 08:33:28'),
(17, 220000, 7, NULL, NULL, 'COD', '1464181207', 'PEMBAYARAN SUDAH DILAKUKAN', NULL, 'Jl. Surga Abadi', NULL, '2024-06-23 05:59:30', '2024-06-23 05:59:30'),
(18, 80000, 7, NULL, NULL, 'COD', '5685908848', 'PEMBAYARAN SUDAH DILAKUKAN', NULL, 'Jl. Surga Abadi', NULL, '2024-06-23 11:12:54', '2024-06-23 11:12:54'),
(19, 15000, 7, NULL, NULL, 'COD', '1950007291', 'PEMBAYARAN SUDAH DILAKUKAN', NULL, 'Jl. Surga Abadi', NULL, '2024-06-23 11:22:08', '2024-06-23 11:22:08'),
(20, 20000, 7, NULL, NULL, 'COD', '8137561317', 'PEMBAYARAN SUDAH DILAKUKAN', NULL, 'Jl. Surga Abadi', NULL, '2024-06-23 11:24:16', '2024-06-23 11:24:16'),
(21, 20000, 7, 20000, 0, 'TRANSFER', '9366549423', 'BARANG TELAH SAMPAI', NULL, 'Jl. Surga Abadi', '2024-06-25', '2024-06-23 11:50:22', '2024-06-23 11:53:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_kategori` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id`, `kategori`, `foto_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Buah', 'Buah_Buahan_1717911863_buah.jpeg', '2024-02-26 22:08:28', '2024-06-08 22:44:23'),
(2, 'Sayur', 'sayur.png', '2024-02-26 22:08:28', '2024-02-27 05:21:07'),
(3, 'Minuman', 'Minuman_1717911845_minuman.jpg', '2024-02-26 22:08:28', '2024-06-08 22:44:05'),
(4, 'Minyak', '1717911615_oil.png', '2024-06-08 22:40:15', '2024-06-08 22:40:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_uangs`
--

CREATE TABLE `mata_uangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matauang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mata_uangs`
--

INSERT INTO `mata_uangs` (`id`, `matauang`, `created_at`, `updated_at`) VALUES
(1, 'Rp.', '2024-02-26 22:08:28', '2024-02-26 22:08:28'),
(2, '$', '2024-02-26 22:08:28', '2024-02-26 22:08:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_11_20_062651_create_produks_table', 1),
(5, '2019_11_20_062931_create_kategoris_table', 1),
(6, '2019_11_20_063228_create_mata_uangs_table', 1),
(7, '2019_11_20_063314_create_units_table', 1),
(8, '2019_11_20_063344_create_persentase_labas_table', 1),
(9, '2019_11_20_063417_create_stok_ppns_table', 1),
(10, '2019_11_20_141948_create_brands_table', 1),
(11, '2019_11_22_012130_create_carts_table', 1),
(12, '2019_11_22_061554_create_checkouts_table', 1),
(13, '2019_11_24_011234_create_pengumumen_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumumen`
--

CREATE TABLE `pengumumen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `pengumuman` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengumumen`
--

INSERT INTO `pengumumen` (`id`, `user_id`, `pengumuman`, `created_at`, `updated_at`) VALUES
(1, 1, 'Harga Promo Mulai 2 Maret 2024', '2024-02-26 23:21:20', '2024-02-26 23:21:20'),
(2, 1, 'sedang diskon tanggal 2 maret', '2024-03-01 21:23:20', '2024-03-01 21:23:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `persentase_labas`
--

CREATE TABLE `persentase_labas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `laba` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `persentase_labas`
--

INSERT INTO `persentase_labas` (`id`, `laba`, `created_at`, `updated_at`) VALUES
(1, 10, '2024-02-26 22:08:28', '2024-02-26 22:08:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mata_uang_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_jual` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diskon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laba` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ppn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produks`
--

INSERT INTO `produks` (`id`, `barcode`, `nama`, `stok`, `kategori_id`, `mata_uang_id`, `unit_id`, `harga_beli`, `harga_jual`, `diskon`, `laba`, `ppn`, `keterangan`, `foto_produk`, `created_at`, `updated_at`) VALUES
(1, '1720455964', 'Cabai Merah', '769', '3', '1', '3', '20000', '20000', NULL, '0', '0', 'Cabai Merah Segar', 'Cabai_Merah_1717910963_cabimerah.jpg', '2024-02-26 22:30:07', '2024-06-23 06:03:21'),
(4, '9911370689', 'Cabai Ijo', '783', '3', '1', '3', '20000', '20000', NULL, '0', '0', 'Cabai Merah Segar', 'cabai.jpeg', '2024-02-26 22:30:07', '2024-06-23 11:31:30'),
(13, '7529388978', 'Bimoli 2L', '784', '1', '1', '1', '15000', '15000', NULL, '0', '0', '213121', 'Bimoli_2L_1717910832_minyakgoreng.jpg', '2024-06-08 22:22:21', '2024-06-23 11:25:57'),
(14, '1180859926', 'Fortune 2.5 KG', '786', '1', '1', '1', '20000', '20000', NULL, '0', '0', 'Beras fortune premium 2.5 kg', 'Fortune_2_5_KG_1717910934_berasfortune.jpeg', '2024-06-08 22:28:54', '2024-06-23 11:23:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_ppns`
--

CREATE TABLE `stok_ppns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stok_minimum` bigint(20) NOT NULL,
  `ppn` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stok_ppns`
--

INSERT INTO `stok_ppns` (`id`, `stok_minimum`, `ppn`, `created_at`, `updated_at`) VALUES
(1, 1, 10, '2024-02-26 22:08:28', '2024-02-26 22:08:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `units`
--

INSERT INTO `units` (`id`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'pcs', '2024-02-26 22:08:28', '2024-02-26 22:08:28'),
(3, 'KG', '2024-02-26 23:14:46', '2024-02-26 23:14:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `alamat`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'superadmin@gmail.com', NULL, '', NULL, '$2y$10$Rfo85IcfkWrSLLC7.7tgeu79J/rbsf6PAVqZKg0zfeuxdD12Wxdua', '2', NULL, '2024-02-26 22:08:28', '2024-02-26 22:08:28'),
(2, 'Admin', 'admin@gmail.com', NULL, '', NULL, '$2y$10$yDNjmEMX5Msw8xZTuTydCe9WkWgt1tlDmfxplpcudJlD/4uDuQbLy', '1', NULL, '2024-02-26 22:08:28', '2024-02-26 22:08:28'),
(3, 'Kasir', 'kasir@gmail.com', NULL, '', NULL, '$2y$10$SZDI3mZTsSMtetHnksCTpui9qX/XDXSIo9XtETKhzabU7wCAlvO3e', '0', NULL, '2024-02-26 22:08:28', '2024-02-26 22:08:28'),
(4, 'Kasir 2', 'kasir2@gmail.com', NULL, '', NULL, '$2y$10$Qmn1HwrLjY7sHoyKi.8DqOBu7/IXQ/UOueLOooys8Srv7usCZ77Eu', '0', NULL, '2024-03-01 18:39:34', '2024-03-01 18:39:34'),
(5, 'kasir3', 'kasir3@gmail.com', NULL, '', NULL, '$2y$10$Wj9ycmsol.YfkdqtNkwu2eeKUA0CeJEVHlpAiB5.BPL/M0Qwt9Gge', '0', NULL, '2024-03-01 21:22:38', '2024-03-01 21:22:38'),
(6, 'kasircoba', 'kasircoba@gmail.com', NULL, '', NULL, '$2y$10$6cRtyE6SILVDYdLjgUeP1uECH4A0IAcQK8kTAxzN6oRjEwkU9QOTq', '0', NULL, '2024-05-23 12:53:53', '2024-05-23 12:53:53'),
(7, 'testuser', 'testuser@gmail.com', '081356783436', 'Jl. Surga Abadi', NULL, '$2y$10$KvEq1QiQ5ZfoF482c46fZOcbn5EI3nODn/x.YIAut9v6rWrSdGWE2', '3', NULL, '2024-06-19 09:26:53', '2024-06-23 05:59:20');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mata_uangs`
--
ALTER TABLE `mata_uangs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pengumumen`
--
ALTER TABLE `pengumumen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `persentase_labas`
--
ALTER TABLE `persentase_labas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stok_ppns`
--
ALTER TABLE `stok_ppns`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
