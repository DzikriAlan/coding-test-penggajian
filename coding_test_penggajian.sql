-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 17 Nov 2023 pada 10.38
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coding_test_penggajian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2023_11_09_055243_mst_data_pegawai', 1),
(4, '2023_11_09_055508_mst_data_jabatan', 1),
(5, '2023_11_09_055646_mst_data_kehadiran', 1),
(6, '2023_11_09_055859_mst_hak_akses', 1),
(7, '2023_11_09_055928_mst_potongan_gaji', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_data_jabatan`
--

CREATE TABLE `mst_data_jabatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(120) NOT NULL,
  `gaji_pokok` bigint(20) NOT NULL,
  `tj_transport` bigint(20) NOT NULL,
  `uang_makan` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mst_data_jabatan`
--

INSERT INTO `mst_data_jabatan` (`id`, `nama_jabatan`, `gaji_pokok`, `tj_transport`, `uang_makan`, `created_at`, `updated_at`) VALUES
(1, 'Full Stack Web Developer', 5600000, 1000000, 1000000, '2023-11-15 01:10:44', '2023-11-16 19:39:54'),
(2, 'Product Manager', 8000000, 1000000, 1000000, '2023-11-15 16:31:18', '2023-11-15 16:31:18'),
(6, 'Frontend Developer', 4500000, 100000, 100000, '2023-11-16 17:37:27', '2023-11-16 17:45:38'),
(7, 'Mobile Developer', 7000000, 1000000, 1000000, '2023-11-16 17:37:49', '2023-11-16 17:46:11'),
(8, 'Backend Developer', 6000000, 1000000, 1000000, '2023-11-16 17:45:56', '2023-11-16 17:45:56'),
(10, 'CEO', 10000000, 2000000, 2000000, '2023-11-17 02:03:51', '2023-11-17 02:03:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_data_pegawai`
--

CREATE TABLE `mst_data_pegawai` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `jabatan_id` bigint(20) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `hak_akses` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mst_data_pegawai`
--

INSERT INTO `mst_data_pegawai` (`id`, `user_id`, `jabatan_id`, `nik`, `nama_pegawai`, `jenis_kelamin`, `tanggal_masuk`, `status`, `photo`, `hak_akses`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1111111111', 'Dzikri Alan', 'Laki-Laki', '0000-00-00', 'Pegawai Tetap', '', 1, '2023-11-15 22:32:43', '2023-11-17 00:26:46'),
(2, 2, 2, '2222222222', 'Aulia Harvy', 'Laki-Laki', '0000-00-00', 'Pegawai Tetap', '', 2, '2023-11-15 22:38:26', '2023-11-16 20:04:15'),
(4, 6, 6, '3333333333', 'Adlina Farah', 'Perempuan', '0000-00-00', 'Pegawai Tidak Tetap', '', 2, '2023-11-16 19:37:56', '2023-11-16 20:04:25'),
(7, 9, 1, '66666666666', 'Nabila', 'Perempuan', '0000-00-00', 'Pegawai Tidak Tetap', '', 2, '2023-11-17 02:04:57', '2023-11-17 02:05:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_data_potongan_gaji`
--

CREATE TABLE `mst_data_potongan_gaji` (
  `id` int(10) UNSIGNED NOT NULL,
  `potongan` varchar(100) NOT NULL,
  `jml_potongan` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mst_data_potongan_gaji`
--

INSERT INTO `mst_data_potongan_gaji` (`id`, `potongan`, `jml_potongan`, `created_at`, `updated_at`) VALUES
(1, 'hari tua', 100000, '2023-11-16 07:23:25', '2023-11-16 13:42:59'),
(5, 'asuransi', 500000, '2023-11-16 20:58:28', '2023-11-16 20:58:40'),
(7, 'Pensiun', 200000, '2023-11-17 02:06:10', '2023-11-17 02:06:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_hak_akses`
--

CREATE TABLE `mst_hak_akses` (
  `id` int(10) UNSIGNED NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `hak_akses` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 0 COMMENT '0: admin, 1: pegawai',
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `password`, `remember_token`, `api_token`, `created_at`, `updated_at`) VALUES
(1, 'Dzikri Alan', 'dzikri@gmail.com', NULL, 1, '$2y$10$3Dr9xKofX/30uerWeYmaLuPWNO/qIUiG4olA9rpCpSwFD7jd4yjjS', '8JNQaYOkCnC7NbZUsuKvDLRMLX09ng1qmyiH4q9LbZYUVmWyVkb7Vc5rsJsG', '6sEubgIlaFx8G6sUwWCrcoEkqZBweVrPXhh8VLwR', '2023-11-15 22:32:43', '2023-11-17 02:03:21'),
(2, 'Aulia Harvy', 'auliaharvy@gmail.com', NULL, 2, '$2y$10$KCKgyYiIjKr59i5P05ReceLKKgkn8XlUJl6wDIPr2DBORMDZeHzMG', NULL, 'FpP3nxA3KhOmPMHrAoUhVmi2Dn3ShM1FaaAX5K2L', '2023-11-15 22:38:26', '2023-11-17 02:02:40'),
(5, 'samsul ibrohim', 'samsul@gmail.com', NULL, 1, '$2y$10$ySwZHQCZDZeJUYZgPK09MO7d5.QOazL.lf78tOtW8tqGbOpFmr6z.', NULL, NULL, '2023-11-16 01:01:36', '2023-11-16 01:14:23'),
(6, 'Adlina Farah', 'farah@gmail.com', NULL, 1, '$2y$10$iDt4HbBwgY2/iYWI0CM/j.qklwAGFCnMgOkSuv.vCz0TgHkXhddma', NULL, NULL, '2023-11-16 19:37:56', '2023-11-16 19:37:56'),
(7, 'Akbar', 'robby@gmail.com', NULL, 1, '$2y$10$YeLPZI02pP30RTO4HBNk5uI7ICVzi/994cRsdlq/Youw8If/w/UAS', NULL, NULL, '2023-11-16 19:38:59', '2023-11-17 00:02:58'),
(8, 'salah', 'salah@gmail.com', NULL, 0, '$2y$10$7OPNmBI1L87FlRLd.4.xy.qBcprjYmw6GkKpevcXd4mZhf3Z7QepC', NULL, NULL, '2023-11-16 20:05:09', '2023-11-16 20:05:09'),
(9, 'Nabila', 'nabila@gmail.com', NULL, 0, '$2y$10$EHFQW.nqd/pVf2aO.ck4rObMRxAukSwMetVMPeiIxDYrmxXwKuw4q', NULL, NULL, '2023-11-17 02:04:57', '2023-11-17 02:05:46');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mst_data_jabatan`
--
ALTER TABLE `mst_data_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mst_data_pegawai`
--
ALTER TABLE `mst_data_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mst_data_potongan_gaji`
--
ALTER TABLE `mst_data_potongan_gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mst_hak_akses`
--
ALTER TABLE `mst_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `mst_data_jabatan`
--
ALTER TABLE `mst_data_jabatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `mst_data_pegawai`
--
ALTER TABLE `mst_data_pegawai`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `mst_data_potongan_gaji`
--
ALTER TABLE `mst_data_potongan_gaji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `mst_hak_akses`
--
ALTER TABLE `mst_hak_akses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
