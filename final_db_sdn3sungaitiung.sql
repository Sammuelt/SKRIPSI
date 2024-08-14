-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Agu 2024 pada 09.38
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_sdn3_sungaitiung`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$edsYdDXpY0ja20keRZCDQOFlKYMz8wglgcmjtIYKRpVqSsrSBjf4a', 'admin', '2024-07-10 18:09:45', '2024-07-10 18:09:45'),
(2, 'user@gmail.com', 'user123', 'user', '2024-07-10 18:10:12', '2024-07-10 18:10:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `capaian_fases`
--

CREATE TABLE `capaian_fases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `element` varchar(255) NOT NULL,
  `sub_elemen` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `capaian_fases`
--

INSERT INTO `capaian_fases` (`id`, `element`, `sub_elemen`, `created_at`, `updated_at`) VALUES
(2, 'Beriman, Bertakwa Kepada Tuhan Yang Maha Esa, dan Berakhlak Mulia ', 'Mengenali sifat-sifat utama Tuhan bahwa Ia Maha Esa dan Ia adalah Sang Pencipta yang Maha Pengasih dan Maha Penyayang dan mengenali kebaikan dirinya sebagai cerminan sifat Tuhan', '2024-07-23 21:53:37', '2024-07-23 21:53:37'),
(3, 'Berkebhinekaan Global', 'Mengidentifikasi dan mendeskripsikan praktik keseharian diri dan budayanya				\r\n				\r\n				', '2024-07-23 21:56:44', '2024-07-23 21:56:44'),
(4, 'Kreatif A', 'Menghasilkan gagasan yang orisinal- Menggabungkan beberapa gagasan menjadi ide atau gagasan imajinatif yang bermakna untuk mengekspresikan pikiran dan/atau perasaannya.', '2024-07-31 17:46:53', '2024-07-31 17:46:53'),
(5, 'Kreatif B', 'Menghasilkan karya dan tindakan yang orisinal- Mengeksplorasi dan mengekspresikan pikiran dan/atau perasaannya dalam bentuk karya dan/atau tindakan serta mengapresiasi karya dan tindakan yang dihasilkan.', '2024-07-31 17:47:19', '2024-07-31 17:47:19'),
(6, 'Bergotong Royong', 'Kerja sama- Menerima dan melaksanakan tugas serta peran yang diberikan kelompok dalam sebuah kegiatan bersama.', '2024-07-31 17:47:29', '2024-07-31 17:47:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `extrakulikulers`
--

CREATE TABLE `extrakulikulers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ekstrakulikuler` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `extrakulikulers`
--

INSERT INTO `extrakulikulers` (`id`, `ekstrakulikuler`, `created_at`, `updated_at`) VALUES
(1, 'Pramuka', NULL, NULL),
(2, 'Marching Band', NULL, NULL),
(3, 'Bola Volly', NULL, NULL),
(7, 'Sabung Ayam', '2024-08-12 16:10:25', '2024-08-12 16:10:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `inventaris_barangs`
--

CREATE TABLE `inventaris_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `id_barang` bigint(20) UNSIGNED DEFAULT NULL,
  `dana_pembelian` enum('Dana Bos','lain-lain') NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kondisi` enum('sangat_bagus','bagus','cukup bagus','tidak_bagus','rusak') NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `total_biaya` int(11) DEFAULT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `inventaris_barangs`
--

INSERT INTO `inventaris_barangs` (`id`, `tgl_pembelian`, `id_barang`, `dana_pembelian`, `jumlah`, `kondisi`, `lokasi`, `total_biaya`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, '2023-06-13', 1, 'Dana Bos', 10, 'sangat_bagus', 'kelas 1', 30000, 'pembelian tongsampah untuk kelas', '2024-08-13 15:15:56', '2024-08-13 15:15:56'),
(2, '2024-08-13', 2, 'Dana Bos', 10, 'sangat_bagus', 'kelas 1', 500000, 'pembelian kursi panjang untuk kelas', '2024-08-13 15:16:25', '2024-08-13 15:16:25'),
(3, '2025-11-13', 1, 'Dana Bos', 5, 'sangat_bagus', 'kelas 1', 15000, 'pembelian tong sampah untuk kelas', '2024-08-13 15:16:50', '2024-08-13 15:16:50'),
(4, '2024-08-13', 1, 'Dana Bos', 5, 'bagus', 'kelas 1', 15000, 'pembelian tong sampah untuk kelas', '2024-08-13 15:20:14', '2024-08-13 15:20:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_pelajarans`
--

CREATE TABLE `jadwal_pelajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_mapel` bigint(20) UNSIGNED DEFAULT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_guru` bigint(20) UNSIGNED DEFAULT NULL,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kalender__sekolah`
--

CREATE TABLE `kalender__sekolah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_semester` bigint(20) UNSIGNED NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_tahun_ajaran` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kalender__sekolah`
--

INSERT INTO `kalender__sekolah` (`id`, `id_semester`, `keterangan`, `id_tahun_ajaran`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ujian Akhir Semester', 4, '2024-08-12', '2024-08-12 13:52:08', '2024-08-12 13:52:08'),
(2, 1, 'masuk Tahun Ajaran Baru', 4, '2024-12-20', '2024-08-12 13:52:49', '2024-08-12 13:52:49'),
(3, 2, 'Event', 4, '2024-08-31', '2024-08-12 13:53:11', '2024-08-12 13:53:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kehadirans`
--

CREATE TABLE `kehadirans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_semester` bigint(20) UNSIGNED NOT NULL,
  `id_tahun_ajar` bigint(20) UNSIGNED NOT NULL,
  `sakit` varchar(255) NOT NULL,
  `izin` varchar(255) NOT NULL,
  `alpha` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kehadirans`
--

INSERT INTO `kehadirans` (`id`, `id_siswa`, `id_kelas`, `id_semester`, `id_tahun_ajar`, `sakit`, `izin`, `alpha`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 4, '3', '2', '1', '2024-07-23 13:19:23', '2024-07-23 13:19:23'),
(2, 5, 1, 2, 4, '0', '0', '0', '2024-07-23 13:20:29', '2024-07-23 13:20:29'),
(3, 1, 1, 1, 1, '4', '3', '4', '2024-08-12 22:00:30', '2024-08-12 22:00:30'),
(4, 2, 1, 1, 1, '1', '1', '1', '2024-08-12 22:01:03', '2024-08-12 22:01:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `id_walikelas` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `id_walikelas`, `created_at`, `updated_at`) VALUES
(1, 'Kelas 1', 6, '2024-07-13 08:06:40', '2024-07-13 08:06:40'),
(2, 'Kelas 2', 9, '2024-07-13 08:06:40', '2024-08-14 07:38:08'),
(3, 'Kelas 3', 1, '2024-07-13 08:06:40', '2024-08-14 07:37:57'),
(4, 'Kelas 4', 11, '2024-07-13 08:06:40', '2024-08-12 21:08:43'),
(5, 'Kelas 5', 2, '2024-07-13 08:06:40', '2024-08-12 21:14:18'),
(6, 'Kelas 6', 7, '2024-07-13 08:06:40', '2024-08-14 07:38:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_keuangan`
--

CREATE TABLE `laporan_keuangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_transaksi` enum('uang_masuk','uang_keluar') NOT NULL,
  `dana` enum('Dana Bos','lain-lain') NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan_keuangan`
--

INSERT INTO `laporan_keuangan` (`id`, `tanggal`, `jenis_transaksi`, `dana`, `jumlah`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, '2024-08-08', 'uang_masuk', 'Dana Bos', 100000000, 'Penerimaan dana BOS', '2024-08-07 13:24:56', '2024-08-07 13:24:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajarans`
--

CREATE TABLE `mata_pelajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pelajaran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mata_pelajarans`
--

INSERT INTO `mata_pelajarans` (`id`, `nama_pelajaran`, `created_at`, `updated_at`) VALUES
(2, 'Matematika', NULL, NULL),
(3, 'Pendidikan kewarganegaraan', NULL, NULL),
(4, 'Ilmu pengetahuan Alam', NULL, NULL),
(5, 'Ilmu Pengetahuan Sosial', NULL, NULL),
(6, 'Seni Budaya', NULL, NULL),
(7, 'Penjas', NULL, NULL),
(8, 'Bahasa inggris', NULL, NULL),
(9, 'Bahasa Indonesia', NULL, NULL),
(12, 'Pendidikan Agama', '2024-08-12 16:09:37', '2024-08-12 16:09:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mbkm_siswas`
--

CREATE TABLE `mbkm_siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `capaian_proses` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mbkm_siswas`
--

INSERT INTO `mbkm_siswas` (`id`, `judul`, `description`, `capaian_proses`, `created_at`, `updated_at`) VALUES
(2, 'BERKARYA DENGAN GEMBIRA', 'Menciptakan karya yang tidak hanya berkualitas tetapi juga membawa kebahagiaan dan kepuasan bagi penciptanya.', 'Mengidentifikasi cara-cara untuk menjaga semangat dan kegembiraan selama proses berkarya.', '2024-07-23 21:54:29', '2024-08-12 18:19:25'),
(3, 'Kreasi Alam: Membuat Taman Mini dari Barang Bekas', 'siswa akan belajar tentang lingkungan dan kreativitas dengan cara membuat taman mini dari barang bekas yang dapat ditemukan di sekitar mereka.', 'Memahami pentingnya daur ulang, belajar tentang tanaman, dan mengembangkan keterampilan kreatif & belajar tentang daur ulang dan lingkungan.', '2024-07-31 10:59:04', '2024-08-12 18:20:11');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_28_140927_create_gurus_table', 1),
(6, '2024_06_28_141348_create_siswas_table', 2),
(7, '2024_06_28_142307_create_kalender__sekolahs_table', 2),
(8, '2024_06_28_144228_create_inventaris_sekolahs_table', 2),
(9, '2024_06_28_150055_create_laporan__perpustakaans_table', 3),
(10, '2024_06_28_150246_create_data_buku_perpustakaans_table', 3),
(11, '2024_06_28_151521_create_laporan__kehadirans_table', 3),
(12, '2024_06_30_040121_create_kelas_table', 4),
(13, '2024_06_30_040537_create_kehadians_table', 5),
(14, '2024_06_30_041028_create_kehadirans_table', 6),
(15, '2024_06_30_041224_create_laporan_keuangans_table', 7),
(16, '2024_06_30_041945_create_mata__pelajarans_table', 8),
(17, '2024_06_30_042820_create_mata__pelajarans_table', 9),
(18, '2024_06_30_043352_create_surat__tugas_table', 10),
(19, '2024_06_30_043815_create_surat__tugas_table', 11),
(20, '2024_06_30_044024_create_surat__tugas_table', 12),
(21, '2024_06_30_061012_add__n_i_p_column_to_surat_tugas_table', 13),
(22, '2024_06_30_061916_add_nip_column_to_surat_tugas_table', 14),
(23, '2024_06_30_063308_create_raport_siswas_table', 15),
(24, '2024_06_30_063903_add_idsiswa_column_to_raport_table', 16),
(25, '2024_06_30_065919_create_mata_pelajarans_table', 17),
(26, '2024_06_30_070923_create_mata_pelajarans_table', 18),
(27, '2024_06_30_071401_create_mata_pelajarans_table', 19),
(28, '2024_06_30_072639_add_mapel_column_to_raport_table', 20),
(29, '2024_06_30_073600_create_jadwal_pelajarans_table', 21),
(30, '2024_06_30_074037_add_guru_column_to_jadwal_pelajarans_table', 22),
(31, '2024_06_30_074210_add_mapel_column_to_jadwal_pelajarans_table', 23),
(32, '2024_06_30_074724_create_inventaris_barangs_table', 24),
(33, '2024_06_30_074923_create_inventaris_barangs_table', 25),
(34, '2024_06_30_080110_create_kelas_table', 26),
(35, '2024_06_30_080539_add_kelas_column_to_jadwal_pelajarans_table', 27),
(36, '2024_06_30_080800_add_kelas_column_to_raport_siswas_table', 28),
(37, '2024_06_30_090006_create_tbl_gurus_table', 29),
(39, '2024_07_02_065648_add_role_to_users', 30),
(40, '2024_07_02_082221_add_jenis_dana_pembelian_dan_tanggal_pembelian_to_inventaris_barangs', 31),
(41, '2024_07_02_082902_add_dana_pembelian_to_inventaris_barangs', 32),
(42, '2024_07_02_084308_add_kelebihan_kompetensi_to_raport_siswas', 33),
(43, '2024_07_02_084528_add_kekurangan_kompetensi_to_raport_siswas', 33),
(44, '2024_07_02_085344_create_extrakulikulers_table', 34),
(45, '2024_07_02_090639_create_raport_ekstrakulikuler_siswas_table', 34),
(46, '2024_07_02_091250_create_semesters_table', 35),
(47, '2024_07_02_091301_create_tahun_ajarans_table', 35),
(48, '2024_07_02_092200_add_semester_dan_tahun_ajaran', 36),
(49, '2024_07_02_092759_add_ekstrakulikuler_to_raport_ekstrakulikuler', 37),
(50, '2024_07_02_094120_create_output__raport__siswas_table', 38),
(51, '2024_07_02_095059_create_kehadirans_table', 38),
(52, '2024_07_02_095346_add_tahun_ajaran,_semester,_siswa', 39),
(53, '2024_07_02_113007_create_rsport__mbkms_table', 40),
(54, '2024_07_02_114121_create_raport__mbkms_table', 41),
(55, '2024_07_02_114534_add_siswa,kelas,_semester,tahun_ajaran', 42),
(56, '2024_07_03_115438_add_id_kelas_to_raport_ekstrakulikuler', 43),
(57, '2024_07_03_125109_add_no_hp_to_data_guru', 44),
(58, '2024_07_03_125914_change_no_hp_column_in_guru_table', 45),
(59, '2024_07_03_130201_add_no_hp_to_data_guru', 46),
(60, '2024_07_03_131207_add_no_hp_ortu_to_data_siswa', 47),
(61, '2024_07_04_142437_change_kode_barang_to_varchar_in_inventaris_barangs_table', 48),
(62, '2024_07_04_161302_change__n_i_k_to_biginteger_in_tbl_guru', 49),
(63, '2024_07_05_063141_change_keterangan_to_string_in_raport_siswas', 50),
(64, '2024_07_06_052947_change_nilai_column_type_in_raport_siswas_table', 51),
(65, '2024_07_06_080617_add_id_kelas_to_kehadirans', 52),
(66, '2024_07_06_081920_change_nisn_column_type_in_data_siswa', 53),
(67, '2024_07_09_135414_create_surat_tugas_table', 54),
(68, '2024_07_09_135502_create_surat_mutasi_siswas_table', 54),
(69, '2024_07_09_141500_add_id_guru', 55),
(70, '2024_07_09_141648_add_id_siswa', 55),
(71, '2024_07_09_180834_add_column_in_kalender', 56),
(72, '2024_07_09_200635_add_tbl_guru', 57),
(73, '2024_07_10_180330_create_accounts_table', 58),
(74, '2024_07_10_184130_change_password_length_in_accounts_table', 59),
(75, '2024_07_13_063040_add_kelas_set_foreign_key_to_data_siswa', 60),
(76, '2024_07_13_075640_add_wali_kelas_set_foreign_key_to_data_kelas', 61),
(77, '2024_07_20_070157_modify_id_walikelas_nullable', 62),
(78, '2024_07_22_130353_modify_id_mapel_dan_id_guru_nullable', 63),
(79, '2024_07_22_133254_modify_id_mapel_nullable', 64),
(80, '2024_07_22_133844_modify_id_ekstrakulikuler_dan_id_siswa_nullable', 65),
(81, '2024_07_22_134122_modify_id_siswa_nullable', 66),
(82, '2024_07_22_134924_modify_id_siswa_nullable', 67),
(83, '2024_07_23_152653_create_capaian_fases_table', 68),
(84, '2024_07_23_161658_create_mbkm_siswas_table', 69),
(85, '2024_07_23_162453_add_id_capaian_fases', 70),
(86, '2024_07_23_163026_add_id_mbkmsiswa_dan_nilai', 71),
(87, '2024_07_23_164551_add_id_mbkmsiswa_dan_nilai', 72),
(88, '2024_07_23_185651_add_deskripsi', 73),
(89, '2024_07_23_201432_create_capaian_fases_table', 74),
(90, '2024_07_23_205913_create_raport_mbkm_siswas_table', 75),
(91, '2024_07_23_213137_add_id_nilai', 76),
(92, '2024_07_25_112252_add_id_user', 77),
(93, '2024_07_26_142944_create_t_p_c_p_s_table', 78),
(94, '2024_07_26_143444_add_foreign', 79),
(95, '2024_07_26_144740_add_foreign', 80),
(96, '2024_08_07_140417_create_standart_hargas_table', 81),
(97, '2024_08_07_141506_create_standart_hargas_table', 82),
(98, '2024_08_07_152019_add_nama_barang', 83),
(99, '2024_08_07_152410_add_id_barang', 84),
(100, '2024_08_07_191236_create_saldo_keuangans_table', 85),
(101, '2024_08_07_192048_add_id_barang', 86),
(102, '2024_08_07_195135_add_dana_barang', 87),
(103, '2024_08_09_081546_create_prestasis_table', 88),
(104, '2024_08_09_082348_add_idsiswa_inprestasi', 89),
(105, '2024_08_09_155659_modify_role_column_in_users_table', 90),
(106, '2024_08_11_185313_create_perencanaan_danas_table', 91),
(107, '2024_08_11_185536_add_id_brang_and_id_tahun_in_perencanaan', 92),
(108, '2024_08_12_053739_add_id_wali', 93),
(109, '2024_08_13_220353_add_total_harga_in_inventarsi', 94);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_projek`
--

CREATE TABLE `nilai_projek` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nilai` enum('BB','MB','BSH','SB') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nilai_projek`
--

INSERT INTO `nilai_projek` (`id`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 'BB', '2024-07-23 21:41:02', '2024-07-23 21:41:02'),
(2, 'MB', '2024-07-23 21:41:29', '2024-07-23 21:41:29'),
(3, 'BSH', '2024-07-23 21:41:29', '2024-07-23 21:41:29'),
(4, 'SB', '2024-07-23 21:41:29', '2024-07-23 21:41:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `output_raport_siswas`
--

CREATE TABLE `output_raport_siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perencanaan_danas`
--

CREATE TABLE `perencanaan_danas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_barang` bigint(20) UNSIGNED DEFAULT NULL,
  `id_tahun` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total_biaya` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `perencanaan_danas`
--

INSERT INTO `perencanaan_danas` (`id`, `id_barang`, `id_tahun`, `qty`, `total_biaya`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 10, 30000, '2024-08-11 13:12:31', '2024-08-11 13:12:31'),
(2, 1, 5, 100, 300000, '2024-08-11 13:14:14', '2024-08-11 13:14:14'),
(3, 1, 3, 1, 3000, '2024-08-11 20:17:55', '2024-08-11 20:17:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasis`
--

CREATE TABLE `prestasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub` varchar(255) NOT NULL,
  `ket` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `prestasis`
--

INSERT INTO `prestasis` (`id`, `id_siswa`, `date`, `title`, `sub`, `ket`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-08-12', 'JUARA 1', 'POPDA CABANG BULUTANGKIS 2024', 'menjuarai Popda Cabang bulutangkis tingkat kabupaten, dilaksanaan di banjarbaru', '2024-08-12 13:48:55', '2024-08-12 13:48:55'),
(2, 2, '2024-08-12', 'JUARA 1', 'OLYMPIADE SAINS NASIONAL 2024', 'menjuarai olimpiade sains tingkat nasional , yang di selenggarakan di jakarta', '2024-08-12 13:50:16', '2024-08-12 13:50:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `raport_ekstrakulikuler_siswas`
--

CREATE TABLE `raport_ekstrakulikuler_siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_ekstrakulikuler` bigint(20) UNSIGNED DEFAULT NULL,
  `id_siswa` bigint(20) UNSIGNED DEFAULT NULL,
  `id_semester` bigint(20) UNSIGNED NOT NULL,
  `id_tahun_ajar` bigint(20) UNSIGNED NOT NULL,
  `predikat` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `raport_ekstrakulikuler_siswas`
--

INSERT INTO `raport_ekstrakulikuler_siswas` (`id`, `id_kelas`, `id_ekstrakulikuler`, `id_siswa`, `id_semester`, `id_tahun_ajar`, `predikat`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 4, 'A', 'sss', '2024-07-22 16:09:44', '2024-07-22 16:09:44'),
(2, 1, 2, 1, 2, 4, 'A', 's', '2024-07-23 13:06:53', '2024-07-23 13:06:53'),
(5, 2, 2, 8, 1, 2, 'A', NULL, '2024-07-28 13:39:45', '2024-07-28 13:39:45'),
(6, 2, 2, 8, 2, 3, 'A', NULL, '2024-07-28 13:40:39', '2024-07-28 13:40:39'),
(8, 3, 2, 9, 2, 4, 'A', NULL, '2024-07-30 08:22:43', '2024-07-30 08:22:43'),
(9, 3, 1, 9, 2, 4, 'A', NULL, '2024-07-30 08:43:05', '2024-07-30 08:43:05'),
(11, 2, 1, 12, 1, 1, 'A', NULL, '2024-08-13 13:39:42', '2024-08-13 13:39:42'),
(12, 1, 1, 1, 1, 3, 'A', NULL, '2024-08-13 13:45:33', '2024-08-13 13:45:33'),
(13, 1, 1, 1, 2, 1, 'A', NULL, '2024-08-13 13:51:39', '2024-08-13 13:52:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `raport_mbkm`
--

CREATE TABLE `raport_mbkm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED DEFAULT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_semester` bigint(20) UNSIGNED NOT NULL,
  `id_tahun_ajar` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_project` bigint(20) UNSIGNED DEFAULT NULL,
  `id_capaian` bigint(20) UNSIGNED DEFAULT NULL,
  `id_nilai` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `raport_mbkm`
--

INSERT INTO `raport_mbkm` (`id`, `id_siswa`, `id_kelas`, `id_semester`, `id_tahun_ajar`, `created_at`, `updated_at`, `id_project`, `id_capaian`, `id_nilai`) VALUES
(1, 1, 1, 2, 4, '2024-08-02 07:04:34', '2024-08-03 10:53:48', 2, 2, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `raport_siswas`
--

CREATE TABLE `raport_siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tahun_ajar` bigint(20) UNSIGNED NOT NULL,
  `id_semester` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED DEFAULT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_mapel` bigint(20) UNSIGNED DEFAULT NULL,
  `nilai` int(11) NOT NULL,
  `kekurangan_kompetensi` varchar(255) NOT NULL,
  `kelebihan_kompetensi` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `raport_siswas`
--

INSERT INTO `raport_siswas` (`id`, `id_tahun_ajar`, `id_semester`, `id_siswa`, `id_kelas`, `id_mapel`, `nilai`, `kekurangan_kompetensi`, `kelebihan_kompetensi`, `keterangan`, `created_at`, `updated_at`) VALUES
(5, 4, 1, 2, 1, 8, 21, 'Ananda Rahmat Suryanta sangat menguasai dalam terbiasa dan senang membaca Al-Qur’an dengan tartil dan dapat membaca QS. al-Falaq dengan tartil.						', 'Ananda Rahmat Suryanta sangat menguasai dalam terbiasa dan senang membaca Al-Qur’an dengan tartil dan dapat membaca QS. al-Falaq dengan tartil.						', 'sad', '2024-08-05 10:36:40', '2024-08-05 10:36:40'),
(6, 1, 1, 1, 1, 2, 70, 'Ananda Rahmat Suryanta sangat menguasai dalam terbiasa dan senang membaca Al-Qur’an dengan tartil dan dapat membaca QS. al-Falaq dengan tartil.						', 'Ananda Rahmat Suryanta sangat menguasai dalam terbiasa dan senang membaca Al-Qur’an dengan tartil dan dapat membaca QS. al-Falaq dengan tartil.						', 'sadsa', '2024-08-05 11:47:02', '2024-08-05 11:47:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saldo_keuangans`
--

CREATE TABLE `saldo_keuangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Saldo_semua` bigint(20) DEFAULT NULL,
  `Saldo_bos` bigint(20) DEFAULT NULL,
  `Saldo_lain` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `saldo_keuangans`
--

INSERT INTO `saldo_keuangans` (`id`, `Saldo_semua`, `Saldo_bos`, `Saldo_lain`, `created_at`, `updated_at`) VALUES
(1, 98344000, 98344000, 0, '2024-08-07 13:24:56', '2024-08-13 15:20:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `semester` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `semesters`
--

INSERT INTO `semesters` (`id`, `semester`, `created_at`, `updated_at`) VALUES
(1, 'Ganjil', NULL, NULL),
(2, 'Genap', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `standart_hargas`
--

CREATE TABLE `standart_hargas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `jumlah_beli` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `standart_hargas`
--

INSERT INTO `standart_hargas` (`id`, `kode`, `nama_barang`, `harga_satuan`, `jumlah_beli`, `total_harga`, `created_at`, `updated_at`) VALUES
(1, 'S001', 'Tong sampah', 3000, 20, 60000, '2024-08-07 13:31:27', '2024-08-13 15:20:14'),
(2, 'A001', 'kursi panjang', 50000, 10, 500000, '2024-08-12 16:14:37', '2024-08-13 15:16:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_mutasi_siswas`
--

CREATE TABLE `surat_mutasi_siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kelas_ditinggalkan` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_tugas`
--

CREATE TABLE `surat_tugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `tujuan_penugasan` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajarans`
--

CREATE TABLE `tahun_ajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahun_ajarans`
--

INSERT INTO `tahun_ajarans` (`id`, `tahun_ajaran`, `created_at`, `updated_at`) VALUES
(1, '2020/2021', NULL, NULL),
(2, '2021/2022', NULL, NULL),
(3, '2023/2024', NULL, NULL),
(4, '2024/2025', NULL, NULL),
(5, '2025/2026', NULL, NULL),
(6, '2026/2027', NULL, NULL),
(7, '2027/2028', NULL, NULL),
(8, '2028/2029', NULL, NULL),
(9, '2029/2030', NULL, NULL),
(11, '2050/2071', '2024-07-06 00:27:26', '2024-07-06 00:27:26'),
(12, '2030/2031', '2024-07-08 06:45:38', '2024-07-08 06:45:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_data_siswa`
--

CREATE TABLE `tbl_data_siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nisn` bigint(20) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_kelas_now` bigint(20) UNSIGNED NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nama_orang_tua` varchar(255) NOT NULL,
  `no_hp_ortu` varchar(13) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_data_siswa`
--

INSERT INTO `tbl_data_siswa` (`id`, `nisn`, `nama_lengkap`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `id_kelas_now`, `alamat`, `nama_orang_tua`, `no_hp_ortu`, `created_at`, `updated_at`) VALUES
(1, 1234567890, 'Ahmad Firdaus', 'laki-laki', 'Jakarta', '2005-01-15', 1, 'Jl. Mawar No. 10', 'Budi Santoso', '08123456789', '2024-08-12 14:26:13', '2024-08-12 14:26:13'),
(2, 1234567891, 'Siti Aisyah', 'perempuan', 'Bandung', '2005-02-20', 1, 'Jl. Melati No. 5', 'Rina Aulia', '08123456790', '2024-08-12 14:26:13', '2024-08-12 14:26:13'),
(3, 1234567892, 'Bambang Prasetyo', 'laki-laki', 'Surabaya', '2005-03-25', 1, 'Jl. Anggrek No. 8', 'Sumarno', '08123456791', '2024-08-12 14:26:13', '2024-08-12 14:26:13'),
(4, 1234567893, 'Dewi Kurniawati', 'perempuan', 'Semarang', '2005-04-30', 1, 'Jl. Kenanga No. 12', 'Agus Susanto', '08123456792', '2024-08-12 14:26:13', '2024-08-12 14:26:13'),
(5, 1234567894, 'Joko Widodo', 'laki-laki', 'Yogyakarta', '2005-05-10', 1, 'Jl. Cempaka No. 4', 'Supriyadi', '081234567895', '2024-08-12 14:26:13', '2024-08-13 14:09:19'),
(6, 1234567895, 'Nia Ramadhani', 'perempuan', 'Medan', '2005-06-15', 1, 'Jl. Bougenville No. 7', 'Rini Suryani', '08123456794', '2024-08-12 14:26:13', '2024-08-12 14:26:13'),
(7, 1234567896, 'Agus Salim', 'laki-laki', 'Bali', '2005-07-20', 1, 'Jl. Kamboja No. 2', 'Eko Prasetyo', '08123456795', '2024-08-12 14:26:13', '2024-08-12 14:26:13'),
(8, 1234567897, 'Indah Puspita', 'perempuan', 'Makassar', '2005-08-25', 1, 'Jl. Durian No. 3', 'Hendrianto', '08123456796', '2024-08-12 14:26:13', '2024-08-12 14:26:13'),
(9, 1234567898, 'Reza Akbar', 'laki-laki', 'Batam', '2005-09-30', 1, 'Jl. Anggrek No. 6', 'Rahmawati', '08123456797', '2024-08-12 14:26:13', '2024-08-12 14:26:13'),
(10, 1234567899, 'Fitria Novita', 'perempuan', 'Palembang', '2005-10-05', 1, 'Jl. Puri No. 15', 'Aminah', '08123456798', '2024-08-12 14:26:13', '2024-08-12 14:26:13'),
(11, 2234567890, 'Budi Setiawan', 'laki-laki', 'Jakarta', '2005-11-15', 2, 'Jl. Melati No. 11', 'Ratna Sarii', '08123456800', '2024-08-12 14:26:29', '2024-08-13 13:21:55'),
(12, 2234567891, 'Lina Hartati', 'perempuan', 'Bandung', '2005-12-20', 2, 'Jl. Mawar No. 12', 'Ahmad Yani', '08123456801', '2024-08-12 14:26:29', '2024-08-12 14:26:29'),
(13, 2234567892, 'Suryo Prabowo', 'laki-laki', 'Surabaya', '2005-01-25', 2, 'Jl. Anggrek No. 13', 'Sri Mulyani', '08123456802', '2024-08-12 14:26:29', '2024-08-12 14:26:29'),
(14, 2234567893, 'Maya Dewi', 'perempuan', 'Semarang', '0000-00-00', 2, 'Jl. Kenanga No. 14', 'Budi Santoso', '08123456803', '2024-08-12 14:26:29', '2024-08-12 14:26:29'),
(15, 2234567894, 'Andi Nugroho', 'laki-laki', 'Yogyakarta', '2005-03-10', 2, 'Jl. Cempaka No. 15', 'Nurul Huda', '08123456804', '2024-08-12 14:26:29', '2024-08-12 14:26:29'),
(16, 2234567895, 'Anisa Putri', 'perempuan', 'Medan', '2005-04-15', 2, 'Jl. Bougenville No. 16', 'Dedi Purnama', '08123456805', '2024-08-12 14:26:29', '2024-08-12 14:26:29'),
(17, 2234567896, 'Fajar Prasetya', 'laki-laki', 'Bali', '2005-05-20', 2, 'Jl. Kamboja No. 17', 'Yuliati', '08123456806', '2024-08-12 14:26:29', '2024-08-12 14:26:29'),
(18, 2234567897, 'Dian Pertiwi', 'perempuan', 'Makassar', '2005-06-25', 2, 'Jl. Durian No. 18', 'Suparno', '08123456807', '2024-08-12 14:26:29', '2024-08-12 14:26:29'),
(19, 2234567898, 'Roni Saputra', 'laki-laki', 'Batam', '2005-07-30', 2, 'Jl. Anggrek No. 19', 'Siti Hawa', '08123456808', '2024-08-12 14:26:29', '2024-08-12 14:26:29'),
(20, 2234567899, 'Neni Kusuma', 'perempuan', 'Palembang', '2005-08-05', 2, 'Jl. Puri No. 20', 'Sumarno', '08123456809', '2024-08-12 14:26:29', '2024-08-12 14:26:29'),
(21, 3234567890, 'Ria Anggraini', 'perempuan', 'Jakarta', '2005-09-15', 3, 'Jl. Melati No. 20', 'Joko Widodo', '08123456900', '2024-08-12 14:26:47', '2024-08-12 14:26:47'),
(22, 3234567891, 'Bimo Setiawan', 'laki-laki', 'Bandung', '2005-10-20', 3, 'Jl. Mawar No. 21', 'Siti Aisyah', '08123456901', '2024-08-12 14:26:47', '2024-08-12 14:26:47'),
(23, 3234567892, 'Tariq Hadi', 'laki-laki', 'Surabaya', '2005-11-25', 3, 'Jl. Anggrek No. 22', 'Ahmad Yani', '08123456902', '2024-08-12 14:26:47', '2024-08-12 14:26:47'),
(24, 3234567893, 'Wati Sari', 'perempuan', 'Semarang', '2005-12-30', 3, 'Jl. Kenanga No. 23', 'Rina Aulia', '08123456903', '2024-08-12 14:26:47', '2024-08-12 14:26:47'),
(25, 3234567894, 'Rizky Fadli', 'laki-laki', 'Yogyakarta', '2005-01-10', 3, 'Jl. Cempaka No. 24', 'Sumarno', '08123456904', '2024-08-12 14:26:47', '2024-08-12 14:26:47'),
(26, 3234567895, 'Citra Putri', 'perempuan', 'Medan', '2005-02-15', 3, 'Jl. Bougenville No. 25', 'Supriyadi', '08123456905', '2024-08-12 14:26:47', '2024-08-12 14:26:47'),
(27, 3234567896, 'Deni Kurniawan', 'laki-laki', 'Bali', '2005-03-20', 3, 'Jl. Kamboja No. 26', 'Eko Prasetyo', '08123456906', '2024-08-12 14:26:47', '2024-08-12 14:26:47'),
(28, 3234567897, 'Fani Kurnia', 'perempuan', 'Makassar', '2005-04-25', 3, 'Jl. Durian No. 27', 'Hendrianto', '08123456907', '2024-08-12 14:26:47', '2024-08-12 14:26:47'),
(29, 3234567898, 'Agus Jatmiko', 'laki-laki', 'Batam', '2005-05-30', 3, 'Jl. Anggrek No. 28', 'Rahmawati', '08123456908', '2024-08-12 14:26:47', '2024-08-12 14:26:47'),
(30, 3234567899, 'Nina Rahma', 'perempuan', 'Palembang', '2005-06-05', 3, 'Jl. Puri No. 29', 'Aminah', '08123456909', '2024-08-12 14:26:47', '2024-08-12 14:26:47'),
(31, 4234567890, 'Adi Saputra', 'laki-laki', 'Jakarta', '2005-07-15', 4, 'Jl. Melati No. 30', 'Siti Aisyah', '08123457000', '2024-08-12 14:27:01', '2024-08-12 14:27:01'),
(32, 4234567891, 'Winda Citra', 'perempuan', 'Bandung', '2005-08-20', 4, 'Jl. Mawar No. 31', 'Ahmad Yani', '08123457001', '2024-08-12 14:27:01', '2024-08-12 14:27:01'),
(33, 4234567892, 'Budi Harjanto', 'laki-laki', 'Surabaya', '2005-09-25', 4, 'Jl. Anggrek No. 32', 'Sri Mulyani', '08123457002', '2024-08-12 14:27:01', '2024-08-12 14:27:01'),
(34, 4234567893, 'Rina Wulandari', 'perempuan', 'Semarang', '2005-10-30', 4, 'Jl. Kenanga No. 33', 'Budi Santoso', '08123457003', '2024-08-12 14:27:01', '2024-08-12 14:27:01'),
(35, 4234567894, 'Dodi Prabowo', 'laki-laki', 'Yogyakarta', '2005-11-10', 4, 'Jl. Cempaka No. 34', 'Nurul Huda', '08123457004', '2024-08-12 14:27:01', '2024-08-12 14:27:01'),
(36, 4234567895, 'Maya Dwi', 'perempuan', 'Medan', '2005-12-15', 4, 'Jl. Bougenville No. 35', 'Dedi Purnama', '08123457005', '2024-08-12 14:27:01', '2024-08-12 14:27:01'),
(37, 4234567896, 'Joko Putra', 'laki-laki', 'Bali', '2005-01-20', 4, 'Jl. Kamboja No. 36', 'Yuliati', '08123457006', '2024-08-12 14:27:01', '2024-08-12 14:27:01'),
(38, 4234567897, 'Evi Rahmawati', 'perempuan', 'Makassar', '2005-02-25', 4, 'Jl. Durian No. 37', 'Suparno', '08123457007', '2024-08-12 14:27:01', '2024-08-12 14:27:01'),
(39, 4234567898, 'Arif Hidayat', 'laki-laki', 'Batam', '2005-03-30', 4, 'Jl. Anggrek No. 38', 'Siti Hawa', '08123457008', '2024-08-12 14:27:01', '2024-08-12 14:27:01'),
(40, 4234567899, 'Nisa Kamilah', 'perempuan', 'Palembang', '2005-04-05', 4, 'Jl. Puri No. 39', 'Sumarno', '08123457009', '2024-08-12 14:27:01', '2024-08-12 14:27:01'),
(41, 5234567890, 'Riko Aditya', 'laki-laki', 'Jakarta', '2005-05-15', 5, 'Jl. Melati No. 40', 'Joko Widodo', '08123457100', '2024-08-12 14:27:18', '2024-08-12 14:27:18'),
(42, 5234567891, 'Dian Puspita', 'perempuan', 'Bandung', '2005-06-20', 5, 'Jl. Mawar No. 41', 'Siti Aisyah', '08123457101', '2024-08-12 14:27:18', '2024-08-12 14:27:18'),
(43, 5234567892, 'Andre Salim', 'laki-laki', 'Surabaya', '2005-07-25', 5, 'Jl. Anggrek No. 42', 'Ahmad Yani', '08123457102', '2024-08-12 14:27:18', '2024-08-12 14:27:18'),
(44, 5234567893, 'Tia Kurniawati', 'perempuan', 'Semarang', '2005-08-30', 5, 'Jl. Kenanga No. 43', 'Rina Aulia', '08123457103', '2024-08-12 14:27:18', '2024-08-12 14:27:18'),
(45, 5234567894, 'Doni Hadi', 'laki-laki', 'Yogyakarta', '2005-09-10', 5, 'Jl. Cempaka No. 44', 'Sumarno', '08123457104', '2024-08-12 14:27:18', '2024-08-12 14:27:18'),
(46, 5234567895, 'Nita Aulia', 'perempuan', 'Medan', '2005-10-15', 5, 'Jl. Bougenville No. 45', 'Supriyadi', '08123457105', '2024-08-12 14:27:18', '2024-08-12 14:27:18'),
(47, 5234567896, 'Hadi Setiawan', 'laki-laki', 'Bali', '2005-11-20', 5, 'Jl. Kamboja No. 46', 'Eko Prasetyo', '08123457106', '2024-08-12 14:27:18', '2024-08-12 14:27:18'),
(48, 5234567897, 'Rina Amalia', 'perempuan', 'Makassar', '2005-12-25', 5, 'Jl. Durian No. 47', 'Hendrianto', '08123457107', '2024-08-12 14:27:18', '2024-08-12 14:27:18'),
(49, 5234567898, 'Alif Pratama', 'laki-laki', 'Batam', '2005-01-30', 5, 'Jl. Anggrek No. 48', 'Rahmawati', '08123457108', '2024-08-12 14:27:18', '2024-08-12 14:27:18'),
(50, 5234567899, 'Naila Sari', 'perempuan', 'Palembang', '2005-02-05', 5, 'Jl. Puri No. 49', 'Aminah', '08123457109', '2024-08-12 14:27:18', '2024-08-12 14:27:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_guru`
--

CREATE TABLE `tbl_guru` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_induk_pegawai` bigint(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `golongan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_guru`
--

INSERT INTO `tbl_guru` (`id`, `nomor_induk_pegawai`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `pendidikan`, `golongan`, `status`, `jabatan`, `no_hp`, `email`, `created_at`, `updated_at`) VALUES
(1, 123456789012345678, 'Andi Suryadi', 'Jl. Raya No.1, Jakarta', 'Jakarta', '1980-05-15', 'laki-laki', 'S1 Pendidikan Matematika', 'III/a', 'PNS', 'Guru Matematika', '081234567890', 'andisuryadi@gmail.com', NULL, '2024-08-12 17:32:53'),
(2, 123456789012345679, 'Budi Santoso', 'Jl. Merdeka No.10, Bandung', 'Bandung', '1985-07-22', 'laki-laki', 'S1 Pendidikan Bahasa Inggris', 'IV/b', 'PNS', 'Guru Bahasa Inggris', '081234567891', 'budi.santoso@example.com', NULL, NULL),
(3, 123456789012345680, 'Citra Dewi', 'Jl. Kebangsaan No.15, Surabaya', 'Surabaya', '1990-02-10', 'perempuan', 'S1', 'II/a', 'PNS', 'Staff', '081234567892', 'admin@sdn3sungaitiung.ac.id', NULL, '2024-08-14 07:36:35'),
(4, 123456789012345681, 'Dedi Hartono', 'Jl. Pahlawan No.20, Yogyakarta', 'Yogyakarta', '1982-11-30', 'laki-laki', 'S1 Pendidikan Fisika', 'III/b', 'PNS', 'Guru Fisika', '081234567893', 'dedi.hartono@example.com', NULL, NULL),
(5, 123456789012345682, 'Evi Rahmawati', 'Jl. Jenderal No.5, Medan', 'Medan', '1988-09-14', 'perempuan', 'S1 Management', 'IV/a', 'PNS', 'Staff', '081234567894', 'staff@sdn3sungaitiung.ac.id', NULL, '2024-08-14 07:34:41'),
(6, 123456789012345683, 'Fajar Prasetyo', 'Jl. Soekarno Hatta No.8, Malang', 'Malang', '1993-03-25', 'laki-laki', 'S1 Pendidikan Sejarah', 'II/b', 'PNS', 'Guru Sejarah', '081234567895', 'fajar.prasetyo@example.com', NULL, NULL),
(7, 123456789012345684, 'Gita Puspitasari', 'Jl. Diponegoro No.12, Semarang', 'Semarang', '1986-06-07', 'perempuan', 'S2 Pendidikan Pancasila', 'III/a', 'PNS', 'Guru Pancasila', '081234567896', 'gita.puspitasari@example.com', NULL, NULL),
(8, 123456789012345685, 'Haris Yulianto', 'Jl. Ahmad Yani No.3, Palembang', 'Palembang', '1991-08-18', 'laki-laki', 'S2  Ekonomi', 'IV/b', 'PNS', 'Kepala Sekolah', '081234567897', 'kepala.sekolah@sdn3sungaitiung.ac.id', NULL, '2024-08-14 07:33:05'),
(9, 123456789012345686, 'Ika Lestari', 'Jl. Sutan Syahrir No.25, Batam', 'Batam', '1987-10-12', 'perempuan', 'S1 Pendidikan Seni', 'II/a', 'PNS', 'Guru Seni', '081234567898', 'ika.lestari@example.com', NULL, NULL),
(10, 123456789012345687, 'Joko Widodo', 'Jl. Merpati No.6, Kupang', 'Kupang', '1994-12-20', 'laki-laki', 'S1 Pendidikan Olahraga', 'III/b', 'PNS', 'Guru Olahraga', '081234567899', 'joko.widodo@example.com', NULL, NULL),
(11, 123456789012345688, 'Kirana Dewi', 'Jl. Pembangunan No.7, Pontianak', 'Pontianak', '1983-04-03', 'perempuan', 'S2 Pendidikan Agama', 'IV/a', 'PNS', 'Guru Agama', '081234567900', 'kirana.dewi@example.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_tugas`
--

CREATE TABLE `tbl_surat_tugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `nomor_surat` int(11) NOT NULL,
  `unit_kerja` varchar(255) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpcp`
--

CREATE TABLE `tpcp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_semester` bigint(20) UNSIGNED DEFAULT NULL,
  `id_mapel` bigint(20) UNSIGNED DEFAULT NULL,
  `id_kelas` bigint(20) UNSIGNED DEFAULT NULL,
  `CP` varchar(255) DEFAULT NULL,
  `lingkup_materi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tpcp`
--

INSERT INTO `tpcp` (`id`, `id_semester`, `id_mapel`, `id_kelas`, `CP`, `lingkup_materi`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'Perkaliansada', 'Berhitung', '2024-08-12 17:40:57', '2024-08-12 19:11:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `id_wali` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','wali') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `id_user`, `id_wali`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(18, '081234567895', NULL, 5, NULL, '$2y$10$6VyymQnTHTtag17G6.IPLOo9O8c7nDKzwPl9qWvKY0fLxPWXtuknS', 'wali', NULL, '2024-08-11 22:56:27', '2024-08-13 14:09:19'),
(20, 'andisuryadi@gmail.com', 1, NULL, NULL, '$2y$10$hQr1EdHuPmih9iBYPbjC0e.5pWECToIpnZuRy7EwP/SC4EOCVBgsG', 'user', NULL, '2024-08-12 17:31:23', '2024-08-12 17:32:53'),
(25, 'kepala.sekolah@sdn3sungaitiung.ac.id', 8, NULL, NULL, '$2y$10$MWVapMy2fdi48B6jwuFuCupERHHVel.08JGSCmYII0xWA/5bGRTQu', 'admin', NULL, '2024-08-14 07:33:51', '2024-08-14 07:33:51'),
(26, 'staff@sdn3sungaitiung.ac.id', 5, NULL, NULL, '$2y$10$egHdfDUmvVTXKI4zxB1heu3h3dprjfj6gWgCqfFifk9QmJmdY8mRO', 'admin', NULL, '2024-08-14 07:35:13', '2024-08-14 07:35:13'),
(27, 'admin@sdn3sungaitiung.ac.id', 3, NULL, NULL, '$2y$10$GmmjMLUnYi2m4wDAnihLuu54ofAf7z/I3MjtIGpPI5TK0WP9XPe72', 'admin', NULL, '2024-08-14 07:37:17', '2024-08-14 07:37:17');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accounts_email_unique` (`email`);

--
-- Indeks untuk tabel `capaian_fases`
--
ALTER TABLE `capaian_fases`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `extrakulikulers`
--
ALTER TABLE `extrakulikulers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `inventaris_barangs`
--
ALTER TABLE `inventaris_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventaris_barangs_id_barang_foreign` (`id_barang`);

--
-- Indeks untuk tabel `jadwal_pelajarans`
--
ALTER TABLE `jadwal_pelajarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_pelajarans_id_kelas_foreign` (`id_kelas`),
  ADD KEY `jadwal_pelajarans_id_mapel_foreign` (`id_mapel`),
  ADD KEY `jadwal_pelajarans_id_guru_foreign` (`id_guru`);

--
-- Indeks untuk tabel `kalender__sekolah`
--
ALTER TABLE `kalender__sekolah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kalender__sekolah_id_tahun_ajaran_foreign` (`id_tahun_ajaran`),
  ADD KEY `kalender__sekolah_id_semester_foreign` (`id_semester`);

--
-- Indeks untuk tabel `kehadirans`
--
ALTER TABLE `kehadirans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kehadirans_id_tahun_ajar_foreign` (`id_tahun_ajar`),
  ADD KEY `kehadirans_id_semester_foreign` (`id_semester`),
  ADD KEY `kehadirans_id_siswa_foreign` (`id_siswa`),
  ADD KEY `kehadirans_id_kelas_foreign` (`id_kelas`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_id_walikelas_foreign` (`id_walikelas`);

--
-- Indeks untuk tabel `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mbkm_siswas`
--
ALTER TABLE `mbkm_siswas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_projek`
--
ALTER TABLE `nilai_projek`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `output_raport_siswas`
--
ALTER TABLE `output_raport_siswas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `perencanaan_danas`
--
ALTER TABLE `perencanaan_danas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perencanaan_danas_id_tahun_foreign` (`id_tahun`),
  ADD KEY `perencanaan_danas_id_barang_foreign` (`id_barang`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `prestasis`
--
ALTER TABLE `prestasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prestasis_id_siswa_foreign` (`id_siswa`);

--
-- Indeks untuk tabel `raport_ekstrakulikuler_siswas`
--
ALTER TABLE `raport_ekstrakulikuler_siswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `raport_ekstrakulikuler_siswas_id_tahun_ajar_foreign` (`id_tahun_ajar`),
  ADD KEY `raport_ekstrakulikuler_siswas_id_semester_foreign` (`id_semester`),
  ADD KEY `raport_ekstrakulikuler_siswas_id_kelas_foreign` (`id_kelas`),
  ADD KEY `raport_ekstrakulikuler_siswas_id_ekstrakulikuler_foreign` (`id_ekstrakulikuler`),
  ADD KEY `raport_ekstrakulikuler_siswas_id_siswa_foreign` (`id_siswa`);

--
-- Indeks untuk tabel `raport_mbkm`
--
ALTER TABLE `raport_mbkm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `raport_mbkm_id_tahun_ajar_foreign` (`id_tahun_ajar`),
  ADD KEY `raport_mbkm_id_semester_foreign` (`id_semester`),
  ADD KEY `raport_mbkm_id_kelas_foreign` (`id_kelas`),
  ADD KEY `raport_mbkm_id_siswa_foreign` (`id_siswa`),
  ADD KEY `raport_mbkm_id_project_foreign` (`id_project`),
  ADD KEY `raport_mbkm_id_capaian_foreign` (`id_capaian`),
  ADD KEY `raport_mbkm_id_nilai_foreign` (`id_nilai`);

--
-- Indeks untuk tabel `raport_siswas`
--
ALTER TABLE `raport_siswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `raport_siswas_id_kelas_foreign` (`id_kelas`),
  ADD KEY `raport_siswas_id_semester_foreign` (`id_semester`),
  ADD KEY `raport_siswas_id_tahun_ajar_foreign` (`id_tahun_ajar`),
  ADD KEY `raport_siswas_id_mapel_foreign` (`id_mapel`),
  ADD KEY `raport_siswas_id_siswa_foreign` (`id_siswa`);

--
-- Indeks untuk tabel `saldo_keuangans`
--
ALTER TABLE `saldo_keuangans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `standart_hargas`
--
ALTER TABLE `standart_hargas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_mutasi_siswas`
--
ALTER TABLE `surat_mutasi_siswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_mutasi_siswas_id_siswa_foreign` (`id_siswa`),
  ADD KEY `surat_mutasi_siswas_id_kelas_ditinggalkan_foreign` (`id_kelas_ditinggalkan`);

--
-- Indeks untuk tabel `surat_tugas`
--
ALTER TABLE `surat_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_tugas_id_guru_foreign` (`id_guru`);

--
-- Indeks untuk tabel `tahun_ajarans`
--
ALTER TABLE `tahun_ajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_data_siswa`
--
ALTER TABLE `tbl_data_siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_data_siswa_nisn_unique` (`nisn`),
  ADD KEY `tbl_data_siswa_id_kelas_foreign` (`id_kelas_now`);

--
-- Indeks untuk tabel `tbl_guru`
--
ALTER TABLE `tbl_guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_guru_nomor_induk_pegawai_unique` (`nomor_induk_pegawai`);

--
-- Indeks untuk tabel `tbl_surat_tugas`
--
ALTER TABLE `tbl_surat_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_surat_tugas_id_guru_foreign` (`id_guru`);

--
-- Indeks untuk tabel `tpcp`
--
ALTER TABLE `tpcp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tp/cp_id_kelas_foreign` (`id_kelas`),
  ADD KEY `tp/cp_id_mapel_foreign` (`id_mapel`),
  ADD KEY `tp/cp_id_semester_foreign` (`id_semester`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_user_foreign` (`id_user`),
  ADD KEY `users_id_wali_foreign` (`id_wali`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `capaian_fases`
--
ALTER TABLE `capaian_fases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `extrakulikulers`
--
ALTER TABLE `extrakulikulers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `inventaris_barangs`
--
ALTER TABLE `inventaris_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jadwal_pelajarans`
--
ALTER TABLE `jadwal_pelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kalender__sekolah`
--
ALTER TABLE `kalender__sekolah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kehadirans`
--
ALTER TABLE `kehadirans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `mbkm_siswas`
--
ALTER TABLE `mbkm_siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT untuk tabel `nilai_projek`
--
ALTER TABLE `nilai_projek`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `output_raport_siswas`
--
ALTER TABLE `output_raport_siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `perencanaan_danas`
--
ALTER TABLE `perencanaan_danas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `prestasis`
--
ALTER TABLE `prestasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `raport_ekstrakulikuler_siswas`
--
ALTER TABLE `raport_ekstrakulikuler_siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `raport_mbkm`
--
ALTER TABLE `raport_mbkm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `raport_siswas`
--
ALTER TABLE `raport_siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `saldo_keuangans`
--
ALTER TABLE `saldo_keuangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `standart_hargas`
--
ALTER TABLE `standart_hargas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `surat_mutasi_siswas`
--
ALTER TABLE `surat_mutasi_siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `surat_tugas`
--
ALTER TABLE `surat_tugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajarans`
--
ALTER TABLE `tahun_ajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_data_siswa`
--
ALTER TABLE `tbl_data_siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `tbl_guru`
--
ALTER TABLE `tbl_guru`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_tugas`
--
ALTER TABLE `tbl_surat_tugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tpcp`
--
ALTER TABLE `tpcp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `inventaris_barangs`
--
ALTER TABLE `inventaris_barangs`
  ADD CONSTRAINT `inventaris_barangs_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `standart_hargas` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `jadwal_pelajarans`
--
ALTER TABLE `jadwal_pelajarans`
  ADD CONSTRAINT `jadwal_pelajarans_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `tbl_guru` (`id`),
  ADD CONSTRAINT `jadwal_pelajarans_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `jadwal_pelajarans_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajarans` (`id`);

--
-- Ketidakleluasaan untuk tabel `kalender__sekolah`
--
ALTER TABLE `kalender__sekolah`
  ADD CONSTRAINT `kalender__sekolah_id_semester_foreign` FOREIGN KEY (`id_semester`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `kalender__sekolah_id_tahun_ajaran_foreign` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajarans` (`id`);

--
-- Ketidakleluasaan untuk tabel `kehadirans`
--
ALTER TABLE `kehadirans`
  ADD CONSTRAINT `kehadirans_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `kehadirans_id_semester_foreign` FOREIGN KEY (`id_semester`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `kehadirans_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `tbl_data_siswa` (`id`),
  ADD CONSTRAINT `kehadirans_id_tahun_ajar_foreign` FOREIGN KEY (`id_tahun_ajar`) REFERENCES `tahun_ajarans` (`id`);

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_id_walikelas_foreign` FOREIGN KEY (`id_walikelas`) REFERENCES `tbl_guru` (`id`);

--
-- Ketidakleluasaan untuk tabel `perencanaan_danas`
--
ALTER TABLE `perencanaan_danas`
  ADD CONSTRAINT `perencanaan_danas_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `standart_hargas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `perencanaan_danas_id_tahun_foreign` FOREIGN KEY (`id_tahun`) REFERENCES `tahun_ajarans` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `prestasis`
--
ALTER TABLE `prestasis`
  ADD CONSTRAINT `prestasis_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `tbl_data_siswa` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `raport_ekstrakulikuler_siswas`
--
ALTER TABLE `raport_ekstrakulikuler_siswas`
  ADD CONSTRAINT `raport_ekstrakulikuler_siswas_id_ekstrakulikuler_foreign` FOREIGN KEY (`id_ekstrakulikuler`) REFERENCES `extrakulikulers` (`id`),
  ADD CONSTRAINT `raport_ekstrakulikuler_siswas_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `raport_ekstrakulikuler_siswas_id_semester_foreign` FOREIGN KEY (`id_semester`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `raport_ekstrakulikuler_siswas_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `tbl_data_siswa` (`id`),
  ADD CONSTRAINT `raport_ekstrakulikuler_siswas_id_tahun_ajar_foreign` FOREIGN KEY (`id_tahun_ajar`) REFERENCES `tahun_ajarans` (`id`);

--
-- Ketidakleluasaan untuk tabel `raport_mbkm`
--
ALTER TABLE `raport_mbkm`
  ADD CONSTRAINT `raport_mbkm_id_capaian_foreign` FOREIGN KEY (`id_capaian`) REFERENCES `capaian_fases` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `raport_mbkm_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `raport_mbkm_id_nilai_foreign` FOREIGN KEY (`id_nilai`) REFERENCES `nilai_projek` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `raport_mbkm_id_project_foreign` FOREIGN KEY (`id_project`) REFERENCES `mbkm_siswas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `raport_mbkm_id_semester_foreign` FOREIGN KEY (`id_semester`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `raport_mbkm_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `tbl_data_siswa` (`id`),
  ADD CONSTRAINT `raport_mbkm_id_tahun_ajar_foreign` FOREIGN KEY (`id_tahun_ajar`) REFERENCES `tahun_ajarans` (`id`);

--
-- Ketidakleluasaan untuk tabel `raport_siswas`
--
ALTER TABLE `raport_siswas`
  ADD CONSTRAINT `raport_siswas_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `raport_siswas_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajarans` (`id`),
  ADD CONSTRAINT `raport_siswas_id_semester_foreign` FOREIGN KEY (`id_semester`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `raport_siswas_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `tbl_data_siswa` (`id`),
  ADD CONSTRAINT `raport_siswas_id_tahun_ajar_foreign` FOREIGN KEY (`id_tahun_ajar`) REFERENCES `tahun_ajarans` (`id`);

--
-- Ketidakleluasaan untuk tabel `surat_mutasi_siswas`
--
ALTER TABLE `surat_mutasi_siswas`
  ADD CONSTRAINT `surat_mutasi_siswas_id_kelas_ditinggalkan_foreign` FOREIGN KEY (`id_kelas_ditinggalkan`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `surat_mutasi_siswas_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `tbl_data_siswa` (`id`);

--
-- Ketidakleluasaan untuk tabel `surat_tugas`
--
ALTER TABLE `surat_tugas`
  ADD CONSTRAINT `surat_tugas_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `tbl_guru` (`id`);

--
-- Ketidakleluasaan untuk tabel `tbl_data_siswa`
--
ALTER TABLE `tbl_data_siswa`
  ADD CONSTRAINT `tbl_data_siswa_id_kelas_foreign` FOREIGN KEY (`id_kelas_now`) REFERENCES `kelas` (`id`);

--
-- Ketidakleluasaan untuk tabel `tbl_surat_tugas`
--
ALTER TABLE `tbl_surat_tugas`
  ADD CONSTRAINT `tbl_surat_tugas_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `tbl_guru` (`id`);

--
-- Ketidakleluasaan untuk tabel `tpcp`
--
ALTER TABLE `tpcp`
  ADD CONSTRAINT `tp/cp_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tp/cp_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajarans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tp/cp_id_semester_foreign` FOREIGN KEY (`id_semester`) REFERENCES `semesters` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `tbl_guru` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_id_wali_foreign` FOREIGN KEY (`id_wali`) REFERENCES `tbl_data_siswa` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
