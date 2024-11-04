-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 11:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survei_umrah`
--

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Fakultas Ilmu Komputer', '2024-11-04 10:09:33', '2024-11-04 10:09:33'),
(2, 'Fakultas Ekonomi', '2024-11-04 10:09:33', '2024-11-04 10:09:33'),
(3, 'Fakultas Hukum', '2024-11-04 10:09:33', '2024-11-04 10:09:33'),
(4, 'Fakultas Kedokteran', '2024-11-04 10:09:33', '2024-11-04 10:09:33'),
(5, 'Fakultas Teknik', '2024-11-04 10:09:33', '2024-11-04 10:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_survei`
--

CREATE TABLE `hasil_survei` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_responden` int(11) UNSIGNED DEFAULT NULL,
  `id_pertanyaan` int(11) UNSIGNED DEFAULT NULL,
  `id_survei` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-10-25-134302', 'App\\Database\\Migrations\\Users', 'default', 'App', 1730714751, 1),
(2, '2024-10-31-123625', 'App\\Database\\Migrations\\UnitPlaceholderPertanyaan', 'default', 'App', 1730714751, 1),
(3, '2024-10-31-124702', 'App\\Database\\Migrations\\Pertanyaan', 'default', 'App', 1730714751, 1),
(4, '2024-10-31-124735', 'App\\Database\\Migrations\\Survei', 'default', 'App', 1730714751, 1),
(5, '2024-10-31-124922', 'App\\Database\\Migrations\\SurveiPertanyaan', 'default', 'App', 1730714751, 1),
(6, '2024-10-31-125000', 'App\\Database\\Migrations\\TipePertanyaan', 'default', 'App', 1730714751, 1),
(7, '2024-10-31-131002', 'App\\Database\\Migrations\\Prodi', 'default', 'App', 1730714751, 1),
(8, '2024-10-31-131107', 'App\\Database\\Migrations\\Fakultas', 'default', 'App', 1730714751, 1),
(9, '2024-10-31-131405', 'App\\Database\\Migrations\\Responden', 'default', 'App', 1730714751, 1),
(10, '2024-10-31-131526', 'App\\Database\\Migrations\\HasilSurvei', 'default', 'App', 1730714751, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id` int(11) UNSIGNED NOT NULL,
  `pertanyaan` varchar(255) NOT NULL,
  `tipe_pertanyaan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id`, `pertanyaan`, `tipe_pertanyaan`, `created_at`, `updated_at`) VALUES
(1, 'Persyaratan teknis dan administratif yang ditetapkan <unit layanan> sudah sesuai untuk memenuhi layanannya.', 'none', '2024-11-04 10:09:08', '2024-11-04 10:09:08'),
(2, 'Prosedur pelayanan di <unit layanan> mudah, sesuai dengan aturan.', 'none', '2024-11-04 10:09:08', '2024-11-04 10:09:08'),
(3, 'Layanan <unit layanan> memiliki kejelasan alur layanan yang sesuai dengan aturan.', 'none', '2024-11-04 10:09:08', '2024-11-04 10:09:08'),
(4, '<unit layanan> memiliki kepastian jadwal layanan.', 'none', '2024-11-04 10:09:08', '2024-11-04 10:09:08'),
(5, '<unit layanan> memberikan pelayanan yang cepat.', 'none', '2024-11-04 10:09:08', '2024-11-04 10:09:08'),
(6, 'Petugas pemberi layanan di <unit layanan> selalu disiplin dalam melaksanakan tugas-tugasnya.', 'none', '2024-11-04 10:09:08', '2024-11-04 10:09:08'),
(7, 'Pelayanan yang diberikan oleh <unit layanan> telah sesuai dengan standar ketentuan yang berlaku.', 'none', '2024-11-04 10:09:08', '2024-11-04 10:09:08'),
(8, 'Petugas pemberi layanan di <unit layanan> memiliki kompetensi yang baik dalam hal pengetahuan, keahlian, keterampilan, dan pengalaman.', 'none', '2024-11-04 10:09:08', '2024-11-04 10:09:08'),
(9, 'Petugas pemberi layanan di <unit layanan> memberikan layanan dengan sopan, ramah dan responsif.', 'none', '2024-11-04 10:09:08', '2024-11-04 10:09:08'),
(10, '<unit layanan> memberikan pelayanan yang adil kepada semua pihak yang datang.', 'none', '2024-11-04 10:09:08', '2024-11-04 10:09:08'),
(11, '<unit layanan> membuka jalur pengaduan dan saran yang berfungsi baik serta melakukan tindaklanjut atas pengaduan dan saran terkait dengan layanannya', 'none', '2024-11-04 10:09:08', '2024-11-04 10:09:08'),
(12, '<unit layanan> memiliki lingkungan pelayanan yang nyaman', 'none', '2024-11-04 10:09:08', '2024-11-04 10:09:08'),
(13, '<unit layanan> memiliki lingkungan yang aman dan mendukung pemberian layanan', 'none', '2024-11-04 10:09:08', '2024-11-04 10:09:08'),
(14, 'Layanan di <unit layanan> didukung dengan sarana dan prasarana (termasuk teknologi informasi) yang baik dan memadai.', 'none', '2024-11-04 10:09:08', '2024-11-04 10:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Ilmu Pemerintahan', NULL, NULL),
(2, 'Sosiologi', NULL, NULL),
(3, 'Ilmu Administrasi Negara', NULL, NULL),
(4, 'Teknik Informatika', NULL, NULL),
(5, 'Teknik Elektro', NULL, NULL),
(6, 'Teknik Sipil', NULL, NULL),
(7, 'Manajemen Sumber Daya Perairan', NULL, NULL),
(8, 'Teknologi Hasil Perikanan', NULL, NULL),
(9, 'Budidaya Perikanan', NULL, NULL),
(10, 'Pendidikan Bahasa Indonesia', NULL, NULL),
(11, 'Pendidikan Matematika', NULL, NULL),
(12, 'Pendidikan Biologi', NULL, NULL),
(13, 'Ekonomi Pembangunan', NULL, NULL),
(14, 'Manajemen', NULL, NULL),
(15, 'Akuntansi', NULL, NULL),
(16, 'Sastra Inggris', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `responden`
--

CREATE TABLE `responden` (
  `id` int(11) UNSIGNED NOT NULL,
  `umur` int(3) NOT NULL,
  `angkatan` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `jam_survei` enum('08.00 - 12.00','13.00 - 17.00') DEFAULT NULL,
  `tanggal_survei` datetime DEFAULT NULL,
  `jawaban` enum('1','2','3','4') DEFAULT NULL,
  `saran_masukan` text DEFAULT NULL,
  `kategori_responden` enum('mahasiswa','dosen','tendik','mitra','umum') DEFAULT NULL,
  `id_survei` int(11) UNSIGNED DEFAULT NULL,
  `id_prodi` int(11) UNSIGNED DEFAULT NULL,
  `id_fakultas` int(11) UNSIGNED DEFAULT NULL,
  `jenis_layanan_diterima` text DEFAULT NULL,
  `unit_layanan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survei`
--

CREATE TABLE `survei` (
  `id` int(11) UNSIGNED NOT NULL,
  `judul` enum('Instrumen survei kepuasan mahasiswa di UPPS','Instrumen survei kepuasan dosen di UPPS','Instrumen survei kepuasan tenaga kependidikan di UPPS','Instrumen survei kepuasan mitra di UPPS','Instrumen survei kepuasan Unit Layanan di lingkungan UMRAH') DEFAULT NULL,
  `dekripsi` text DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `status` enum('on','off') DEFAULT NULL,
  `id_unit_placeholder` int(11) UNSIGNED DEFAULT NULL,
  `id_pertanyaan` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survei_pertanyaan`
--

CREATE TABLE `survei_pertanyaan` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_pertanyaan` int(11) UNSIGNED DEFAULT NULL,
  `id_survei` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipe_pertanyaan`
--

CREATE TABLE `tipe_pertanyaan` (
  `id` int(11) UNSIGNED NOT NULL,
  `tipe_pertanyaan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipe_pertanyaan`
--

INSERT INTO `tipe_pertanyaan` (`id`, `tipe_pertanyaan`, `created_at`, `updated_at`) VALUES
(1, 'none', '2024-11-04 10:08:03', '2024-11-04 10:08:03'),
(2, 'Tata Kelola, Tata Pamong, dan Kerjasama', '2024-11-04 10:08:03', '2024-11-04 10:08:03'),
(3, 'Bidang Kemahasiswaan', '2024-11-04 10:08:03', '2024-11-04 10:08:03'),
(4, 'Bidang Sarana dan Prasarana', '2024-11-04 10:08:03', '2024-11-04 10:08:03'),
(5, 'Sistem Tata Pamong', '2024-11-04 10:08:03', '2024-11-04 10:08:03'),
(6, 'Kepemimpinan dan Kemampuan Manajerial', '2024-11-04 10:08:03', '2024-11-04 10:08:03'),
(7, 'Kerjasama', '2024-11-04 10:08:03', '2024-11-04 10:08:03'),
(8, 'Layanan dan Sumber Daya Manusia', '2024-11-04 10:08:03', '2024-11-04 10:08:03'),
(9, 'Layanan Keuangan', '2024-11-04 10:08:03', '2024-11-04 10:08:03');

-- --------------------------------------------------------

--
-- Table structure for table `unit_placeholder_pertanyaan`
--

CREATE TABLE `unit_placeholder_pertanyaan` (
  `id` int(11) UNSIGNED NOT NULL,
  `jenis_unit` varchar(255) NOT NULL,
  `nama_unit` varchar(255) NOT NULL,
  `jenis_layanan_yang_diterima` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_placeholder_pertanyaan`
--

INSERT INTO `unit_placeholder_pertanyaan` (`id`, `jenis_unit`, `nama_unit`, `jenis_layanan_yang_diterima`, `created_at`, `updated_at`) VALUES
(1, 'UPPS', 'Fakultas Ekonomi dan Bisnis Maritim (FEBM)', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(2, 'UPPS', 'Fakultas Ilmu Kelautan dan Perikanan (FIKP)', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(3, 'UPPS', 'Fakultas Ilmu Sosial dan Ilmu Pemerintahan (FISIP)', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(4, 'UPPS', 'Fakultas Keguruan dan Ilmu Pendidikan (FKIP)', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(5, 'UPPS', 'Fakultas Teknik dan Teknologi Kemaritiman (FTTK)', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(6, 'UPPS', 'Magister Ilmu Lingkungan (MIL)', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(7, 'UPPS', 'Magister Administrasi Publik (MAP)', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(8, 'Unit Layanan', 'Layanan umum', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(9, 'Unit Layanan', 'Layanan keuangan', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(10, 'Unit Layanan', 'Layanan kepegawaian', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(11, 'Unit Layanan', 'Layanan akademik', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(12, 'Unit Layanan', 'Layanan kemahasiswaan', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(13, 'Unit Layanan', 'Layanan perencanaan', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(14, 'Unit Layanan', 'Lembaga Penelitian dan Pengabdian Masyarakat', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(15, 'Unit Layanan', 'Lembaga Penjaminan Mutu dan Pusat Pembelajaran', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(16, 'Unit Layanan', 'UPA Teknologi, Informasi, dan Komunikasi (TIK)', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(17, 'Unit Layanan', 'UPA Bahasa', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(18, 'Unit Layanan', 'UPA Karir', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(19, 'Unit Layanan', 'UPA Perpustakaan', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31'),
(20, 'Unit Layanan', 'UPA Lab Terpadu', '', '2024-11-04 10:07:31', '2024-11-04 10:07:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('unit','pimpinan','admin') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', 'Admin', '$2y$10$1Zz2NguSLr50syT1034jf.jjwX1AsKao8s6X5QIh4hC5/Ad.pXb5e', 'admin', NULL, NULL),
(2, 'unit1@gmail.com', 'Unit 1', '$2y$10$/qOunO8SNCAXQoSNR7PS/ugqTBn5MoSCWdwPd3NKC/KZ9Lu5lhvvK', 'unit', NULL, NULL),
(3, 'pimpinan@gmail.com', 'Pimpinan', '$2y$10$ICeFzNXpFOAE5oln1IFHiOlYyuko60Ib.LS4X0oO463s2Zy3if7p.', 'pimpinan', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_survei`
--
ALTER TABLE `hasil_survei`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_survei_id_responden_foreign` (`id_responden`),
  ADD KEY `hasil_survei_id_pertanyaan_foreign` (`id_pertanyaan`),
  ADD KEY `hasil_survei_id_survei_foreign` (`id_survei`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responden`
--
ALTER TABLE `responden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responden_id_survei_foreign` (`id_survei`),
  ADD KEY `responden_id_prodi_foreign` (`id_prodi`),
  ADD KEY `responden_id_fakultas_foreign` (`id_fakultas`);

--
-- Indexes for table `survei`
--
ALTER TABLE `survei`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survei_id_pertanyaan_foreign` (`id_pertanyaan`),
  ADD KEY `survei_id_unit_placeholder_foreign` (`id_unit_placeholder`);

--
-- Indexes for table `survei_pertanyaan`
--
ALTER TABLE `survei_pertanyaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survei_pertanyaan_id_pertanyaan_foreign` (`id_pertanyaan`),
  ADD KEY `survei_pertanyaan_id_survei_foreign` (`id_survei`);

--
-- Indexes for table `tipe_pertanyaan`
--
ALTER TABLE `tipe_pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_placeholder_pertanyaan`
--
ALTER TABLE `unit_placeholder_pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hasil_survei`
--
ALTER TABLE `hasil_survei`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `responden`
--
ALTER TABLE `responden`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survei`
--
ALTER TABLE `survei`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survei_pertanyaan`
--
ALTER TABLE `survei_pertanyaan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipe_pertanyaan`
--
ALTER TABLE `tipe_pertanyaan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `unit_placeholder_pertanyaan`
--
ALTER TABLE `unit_placeholder_pertanyaan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_survei`
--
ALTER TABLE `hasil_survei`
  ADD CONSTRAINT `hasil_survei_id_pertanyaan_foreign` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_survei_id_responden_foreign` FOREIGN KEY (`id_responden`) REFERENCES `responden` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_survei_id_survei_foreign` FOREIGN KEY (`id_survei`) REFERENCES `survei` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `responden`
--
ALTER TABLE `responden`
  ADD CONSTRAINT `responden_id_fakultas_foreign` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responden_id_prodi_foreign` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responden_id_survei_foreign` FOREIGN KEY (`id_survei`) REFERENCES `survei` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `survei`
--
ALTER TABLE `survei`
  ADD CONSTRAINT `survei_id_pertanyaan_foreign` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `survei_id_unit_placeholder_foreign` FOREIGN KEY (`id_unit_placeholder`) REFERENCES `unit_placeholder_pertanyaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `survei_pertanyaan`
--
ALTER TABLE `survei_pertanyaan`
  ADD CONSTRAINT `survei_pertanyaan_id_pertanyaan_foreign` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `survei_pertanyaan_id_survei_foreign` FOREIGN KEY (`id_survei`) REFERENCES `survei` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
