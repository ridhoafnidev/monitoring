-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2020 at 12:17 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggaran`
--

CREATE TABLE `anggaran` (
  `id_anggaran` int(11) NOT NULL,
  `program_studi` varchar(100) NOT NULL,
  `tahun_anggaran` int(11) NOT NULL,
  `anggaran_tersedia` int(11) NOT NULL,
  `total_anggaran` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggaran`
--

INSERT INTO `anggaran` (`id_anggaran`, `program_studi`, `tahun_anggaran`, `anggaran_tersedia`, `total_anggaran`, `keterangan`) VALUES
(31, 'Teknik Industri', 2019, 500000, 500000, 'Himpunan'),
(33, 'Dema', 2020, 25000000, 25000000, 'Sema & Dema'),
(34, 'Sistem Informasi', 2020, 12500000, 15000000, 'Himpunan'),
(35, 'Teknik Informatika', 2020, 12500000, 15000000, 'Himpunan');

-- --------------------------------------------------------

--
-- Table structure for table `birokrasi`
--

CREATE TABLE `birokrasi` (
  `id_birokrasi` int(11) NOT NULL,
  `tahun_birokrasi` varchar(50) NOT NULL,
  `jenis_birokrasi` varchar(50) NOT NULL,
  `file_pdf` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `birokrasi`
--

INSERT INTO `birokrasi` (`id_birokrasi`, `tahun_birokrasi`, `jenis_birokrasi`, `file_pdf`) VALUES
(6, '2019', 'Program Kerja', 'FORMAT PROKER UKM FASTE.docx'),
(7, '2019', 'Proposal', 'FORMAT PROPOSAL UKM FASTE.docx'),
(8, '2019', 'LPJ', 'FORMAT LPJ UKM FASTE.docx');

-- --------------------------------------------------------

--
-- Table structure for table `detail_proker`
--

CREATE TABLE `detail_proker` (
  `id_detail` int(11) NOT NULL,
  `id_proker` int(11) NOT NULL,
  `tgl_sub` date NOT NULL,
  `nama_sub` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `persentase` int(11) NOT NULL,
  `bukti` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_proker`
--

INSERT INTO `detail_proker` (`id_detail`, `id_proker`, `tgl_sub`, `nama_sub`, `keterangan`, `persentase`, `bukti`, `status`) VALUES
(21, 6, '2019-09-16', 'fds', 'ghj', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(22, 6, '2019-09-20', 'cvbn', 'vbn', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(23, 6, '2019-09-24', 'cvbn', 'bn', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(24, 6, '2019-09-27', 'fghj', 'ghj', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(25, 6, '2019-09-29', 'gbnm', 'gh', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(26, 7, '2019-09-16', 'sdfbn', 'cvbnm', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(27, 7, '2019-09-25', 'dfghjkl', 'lkjhg', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(28, 7, '2019-09-27', 'efghn', 'okjhg', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(30, 7, '2019-09-28', 'efgbn', 'cvbnm', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(31, 7, '2019-09-30', 'rfgbnm', 'asdfgh', 20, 'SURAT AKTIF KULIAH0188.pdf', 'Telah Tercapai'),
(32, 11, '2019-10-01', 'adf', 'fasdfa', 20, '227286-penerapan-metode-k-nearest-neighbor-pada-99', 'Telah Tercapai'),
(33, 11, '2019-10-01', 'adsf', 'fdaf', 20, '1229-2860-1-SM.pdf', 'Telah Tercapai'),
(34, 11, '2019-10-01', 'fadsf', 'fda', 20, '293-Article Text-735-1-10-20180301.pdf', 'Telah Tercapai'),
(35, 11, '2019-10-01', 'adfa', 'fdafa', 20, '227286-penerapan-metode-k-nearest-neighbor-pada-99', 'Telah Tercapai'),
(36, 11, '2019-10-01', 'adf', 'fsadf', 20, '227286-penerapan-metode-k-nearest-neighbor-pada-99', 'Telah Tercapai'),
(37, 1, '2019-10-07', 'adsf', 'fdsf', 20, '227286-penerapan-metode-k-nearest-neighbor-pada-99', 'Telah Tercapai'),
(38, 1, '2019-10-07', 'adf', 'fas', 20, '227286-penerapan-metode-k-nearest-neighbor-pada-99', 'Telah Tercapai'),
(39, 1, '2019-10-07', 'asdf', 'fdsaf', 20, '227286-penerapan-metode-k-nearest-neighbor-pada-99', 'Telah Tercapai'),
(40, 1, '2019-10-07', 'asdfasdf', 'fdasfa', 20, '227286-penerapan-metode-k-nearest-neighbor-pada-99', 'Telah Tercapai'),
(41, 1, '2019-10-07', 'asdfasd', 'fdsaf', 20, '227286-penerapan-metode-k-nearest-neighbor-pada-99', 'Telah Tercapai'),
(42, 2, '2019-10-07', 'asdfa', 'fdasf', 20, '227286-penerapan-metode-k-nearest-neighbor-pada-99', 'Telah Tercapai'),
(43, 2, '2019-10-07', 'asdf', 'fdasf', 20, '227286-penerapan-metode-k-nearest-neighbor-pada-99', 'Telah Tercapai'),
(44, 2, '2019-10-07', 'adsf', 'fadsf', 20, '227286-penerapan-metode-k-nearest-neighbor-pada-99', 'Telah Tercapai'),
(45, 2, '2019-10-10', 'adf', 'fadsf', 20, '227286-penerapan-metode-k-nearest-neighbor-pada-99', 'Telah Tercapai'),
(46, 2, '2019-10-07', 'adfadf', 'fadsf', 20, '227286-penerapan-metode-k-nearest-neighbor-pada-99', 'Telah Tercapai'),
(47, 3, '2019-10-31', 'a', 'a', 20, 'HAJI.docx', 'Telah Tercapai'),
(48, 3, '2019-10-31', 'sd', 'd', 20, 'HAJI.docx', 'Telah Tercapai'),
(49, 3, '2019-11-07', 'wc', 'dfff', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(50, 3, '2019-11-09', 'yuu', 'fh', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(51, 3, '2019-11-03', 'ggh', 'nhf', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(52, 5, '2019-11-18', 'saf', 'af', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(53, 5, '2019-11-27', 'ag', 'af', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(54, 5, '2019-11-21', 'sdg', 'sfs', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(55, 5, '2019-11-22', 'sdg', 'gse', 20, 'SURAT AKTIF KULIAH018.pdf', 'Telah Tercapai'),
(56, 5, '2019-11-25', 'sdg', 'sg', 20, 'Anotasi 2019-12-22 204414.png', 'Belum Tercapai'),
(57, 9, '2019-12-05', 'qaf', 'qwf', 20, 'Belum Dikirim', 'Belum Tercapai');

-- --------------------------------------------------------

--
-- Table structure for table `himpunan`
--

CREATE TABLE `himpunan` (
  `id_himpunan` int(11) NOT NULL,
  `nama_himpunan` varchar(50) NOT NULL,
  `logo_himpunan` varchar(50) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `pdf` varchar(50) NOT NULL,
  `visi` varchar(50) NOT NULL,
  `misi` varchar(50) NOT NULL,
  `ketua` varchar(50) NOT NULL,
  `nim_ketua` varchar(50) NOT NULL,
  `wakil_ketua` varchar(50) NOT NULL,
  `nim_wk` varchar(50) NOT NULL,
  `sekretaris` varchar(50) NOT NULL,
  `nim_sekre` varchar(50) NOT NULL,
  `bendahara` varchar(50) NOT NULL,
  `nim_bendahara` varchar(50) NOT NULL,
  `oleh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `himpunan`
--

INSERT INTO `himpunan` (`id_himpunan`, `nama_himpunan`, `logo_himpunan`, `periode`, `pdf`, `visi`, `misi`, `ketua`, `nim_ketua`, `wakil_ketua`, `nim_wk`, `sekretaris`, `nim_sekre`, `bendahara`, `nim_bendahara`, `oleh`) VALUES
(11, 'Himpunan Mhasiswa Teknik Informatika', 'W1kgK1Lc.jpg', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'himatif'),
(16, 'HIMASI', 'uinsif.jpg', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'himasi');

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner`
--

CREATE TABLE `kuesioner` (
  `id_kuesioner` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pertanyaan` varchar(255) NOT NULL,
  `SB` int(11) DEFAULT NULL,
  `B` int(11) DEFAULT NULL,
  `C` int(11) DEFAULT NULL,
  `K` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kuesioner`
--

INSERT INTO `kuesioner` (`id_kuesioner`, `user_id`, `pertanyaan`, `SB`, `B`, `C`, `K`) VALUES
(5, 1, 'Apakah program kerja yang disusun dan dijalankan sudah sejalan dengan visi dan misi UIN SUSKA Riau?', 0, 0, 0, 0),
(6, 1, 'Apakah program kerja yang disusun dan dijalankan sudah sejalan dengan visi dan misi Fakultas?', 0, 0, 0, 0),
(7, 1, 'Apakah program kerja yang disusun dan dijalankan sudah sejalan dengan visi dan misi Program Studi?', 0, 0, 0, 0),
(8, 1, 'Bagaimana menurut anda kienrja UKM pada priode ini?', 0, 0, 0, 0),
(9, 1, 'Bagaimana menurut anda tentang keaktifan pengurus menjalankan organisasi?', 0, 0, 0, 0),
(10, 1, 'Bagaimana menurut anda tentang kinerja pengurus UK dalam menjalankan menghadirkan solusi terhadap permasalahan yang ada?', 0, 0, 0, 0),
(11, 1, 'Bagaimana menurut anda anggaran kerja dari Universitas sudah sesuai dengan UKM?', 0, 0, 0, 0),
(12, 1, 'Bagaimana menurut anda tentang ketetapan pengguna dana anggaran oleh UKM?', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner_detail`
--

CREATE TABLE `kuesioner_detail` (
  `id_kue_detail` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `kuesioner_id` int(11) NOT NULL,
  `SB` int(11) DEFAULT NULL,
  `B` int(11) DEFAULT NULL,
  `C` int(11) DEFAULT NULL,
  `K` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kuesioner_detail`
--

INSERT INTO `kuesioner_detail` (`id_kue_detail`, `user_id`, `user`, `kuesioner_id`, `SB`, `B`, `C`, `K`, `tahun`) VALUES
(273, '62', 'himasi', 5, 5, 0, 0, 0, 2020),
(274, '62', 'himasi', 6, 5, 0, 0, 0, 2020),
(275, '62', 'himasi', 7, 5, 0, 0, 0, 2020),
(276, '62', 'himasi', 8, 5, 0, 0, 0, 2020),
(277, '62', 'himasi', 9, 5, 0, 0, 0, 2020),
(278, '62', 'himasi', 10, 5, 0, 0, 0, 2020),
(279, '62', 'himasi', 11, 5, 0, 0, 0, 2020),
(280, '62', 'himasi', 12, 5, 0, 0, 0, 2020),
(281, '62', 'himatif', 5, 0, 4, 0, 0, 2020),
(282, '62', 'himatif', 6, 0, 4, 0, 0, 2020),
(283, '62', 'himatif', 7, 0, 4, 0, 0, 2020),
(284, '62', 'himatif', 8, 0, 4, 0, 0, 2020),
(285, '62', 'himatif', 9, 0, 4, 0, 0, 2020),
(286, '62', 'himatif', 10, 0, 4, 0, 0, 2020),
(287, '62', 'himatif', 11, 0, 4, 0, 0, 2020),
(288, '62', 'himatif', 12, 0, 4, 0, 0, 2020),
(289, '62', 'himate', 5, 0, 0, 3, 0, 2020),
(290, '62', 'himate', 6, 0, 0, 3, 0, 2020),
(291, '62', 'himate', 7, 0, 0, 3, 0, 2020),
(292, '62', 'himate', 8, 0, 0, 3, 0, 2020),
(293, '62', 'himate', 9, 0, 0, 3, 0, 2020),
(294, '62', 'himate', 10, 0, 0, 3, 0, 2020),
(295, '62', 'himate', 11, 0, 0, 3, 0, 2020),
(296, '62', 'himate', 12, 0, 0, 3, 0, 2020),
(297, '62', 'hmjmt', 5, 0, 4, 0, 0, 2020),
(298, '62', 'hmjmt', 6, 0, 4, 0, 0, 2020),
(299, '62', 'hmjmt', 7, 0, 4, 0, 0, 2020),
(300, '62', 'hmjmt', 8, 0, 4, 0, 0, 2020),
(301, '62', 'hmjmt', 9, 0, 4, 0, 0, 2020),
(302, '62', 'hmjmt', 10, 0, 4, 0, 0, 2020),
(303, '62', 'hmjmt', 11, 0, 4, 0, 0, 2020),
(304, '62', 'hmjmt', 12, 0, 4, 0, 0, 2020),
(305, '62', 'hmjti', 5, 5, 0, 0, 0, 0),
(306, '62', 'hmjti', 6, 5, 0, 0, 0, 0),
(307, '62', 'hmjti', 7, 5, 0, 0, 0, 0),
(308, '62', 'hmjti', 8, 5, 0, 0, 0, 0),
(309, '62', 'hmjti', 9, 5, 0, 0, 0, 0),
(310, '62', 'hmjti', 10, 5, 0, 0, 0, 0),
(311, '62', 'hmjti', 11, 5, 0, 0, 0, 0),
(312, '62', 'hmjti', 12, 5, 0, 0, 0, 0),
(313, '62', 'sema', 5, 0, 0, 3, 0, 0),
(314, '62', 'sema', 6, 0, 0, 3, 0, 0),
(315, '62', 'sema', 7, 0, 0, 3, 0, 0),
(316, '62', 'sema', 8, 0, 0, 3, 0, 0),
(317, '62', 'sema', 9, 0, 0, 3, 0, 0),
(318, '62', 'sema', 10, 0, 0, 3, 0, 0),
(319, '62', 'sema', 11, 0, 0, 3, 0, 0),
(320, '62', 'sema', 12, 0, 0, 3, 0, 0),
(321, '62', 'dema', 5, 0, 0, 0, 2, 0),
(322, '62', 'dema', 6, 0, 0, 0, 2, 0),
(323, '62', 'dema', 7, 0, 0, 0, 2, 0),
(324, '62', 'dema', 8, 0, 0, 0, 2, 0),
(325, '62', 'dema', 9, 0, 0, 0, 2, 0),
(326, '62', 'dema', 10, 0, 0, 0, 2, 0),
(327, '62', 'dema', 11, 0, 0, 0, 2, 0),
(328, '62', 'dema', 12, 0, 0, 0, 2, 0),
(329, '55', 'himasi', 5, 0, 4, 0, 0, 0),
(330, '55', 'himasi', 6, 0, 4, 0, 0, 0),
(331, '55', 'himasi', 7, 0, 4, 0, 0, 0),
(332, '55', 'himasi', 8, 0, 4, 0, 0, 0),
(333, '55', 'himasi', 9, 0, 4, 0, 0, 0),
(334, '55', 'himasi', 10, 0, 4, 0, 0, 0),
(335, '55', 'himasi', 11, 0, 4, 0, 0, 0),
(336, '55', 'himasi', 12, 0, 4, 0, 0, 0),
(337, '55', 'himatif', 5, 0, 4, 0, 0, 0),
(338, '55', 'himatif', 6, 0, 4, 0, 0, 0),
(339, '55', 'himatif', 7, 0, 4, 0, 0, 0),
(340, '55', 'himatif', 8, 0, 4, 0, 0, 0),
(341, '55', 'himatif', 9, 0, 4, 0, 0, 0),
(342, '55', 'himatif', 10, 0, 4, 0, 0, 0),
(343, '55', 'himatif', 11, 0, 4, 0, 0, 0),
(344, '55', 'himatif', 12, 0, 4, 0, 0, 0),
(345, '55', 'himate', 5, 0, 0, 3, 0, 0),
(346, '55', 'himate', 6, 0, 0, 3, 0, 0),
(347, '55', 'himate', 7, 0, 0, 3, 0, 0),
(348, '55', 'himate', 8, 0, 0, 3, 0, 0),
(349, '55', 'himate', 9, 0, 0, 3, 0, 0),
(350, '55', 'himate', 10, 0, 0, 3, 0, 0),
(351, '55', 'himate', 11, 0, 0, 3, 0, 0),
(352, '55', 'himate', 12, 0, 0, 3, 0, 0),
(353, '55', 'hmjmt', 5, 0, 0, 0, 2, 0),
(354, '55', 'hmjmt', 6, 0, 0, 0, 2, 0),
(355, '55', 'hmjmt', 7, 0, 0, 0, 2, 0),
(356, '55', 'hmjmt', 8, 0, 0, 0, 2, 0),
(357, '55', 'hmjmt', 9, 0, 0, 0, 2, 0),
(358, '55', 'hmjmt', 10, 0, 0, 0, 2, 0),
(359, '55', 'hmjmt', 11, 0, 0, 0, 2, 0),
(360, '55', 'hmjmt', 12, 0, 0, 0, 2, 0),
(361, '55', 'hmjti', 5, 0, 0, 3, 0, 0),
(362, '55', 'hmjti', 6, 0, 0, 3, 0, 0),
(363, '55', 'hmjti', 7, 0, 0, 3, 0, 0),
(364, '55', 'hmjti', 8, 0, 0, 3, 0, 0),
(365, '55', 'hmjti', 9, 0, 0, 3, 0, 0),
(366, '55', 'hmjti', 10, 0, 0, 3, 0, 0),
(367, '55', 'hmjti', 11, 0, 0, 3, 0, 0),
(368, '55', 'hmjti', 12, 0, 0, 3, 0, 0),
(369, '55', 'sema', 5, 0, 4, 0, 0, 0),
(370, '55', 'sema', 6, 0, 4, 0, 0, 0),
(371, '55', 'sema', 7, 0, 4, 0, 0, 0),
(372, '55', 'sema', 8, 0, 4, 0, 0, 0),
(373, '55', 'sema', 9, 0, 4, 0, 0, 0),
(374, '55', 'sema', 10, 0, 4, 0, 0, 0),
(375, '55', 'sema', 11, 0, 4, 0, 0, 0),
(376, '55', 'sema', 12, 0, 4, 0, 0, 0),
(377, '55', 'dema', 5, 5, 0, 0, 0, 0),
(378, '55', 'dema', 6, 5, 0, 0, 0, 0),
(379, '55', 'dema', 7, 5, 0, 0, 0, 0),
(380, '55', 'dema', 8, 5, 0, 0, 0, 0),
(381, '55', 'dema', 9, 5, 0, 0, 0, 0),
(382, '55', 'dema', 10, 5, 0, 0, 0, 0),
(383, '55', 'dema', 11, 5, 0, 0, 0, 0),
(384, '55', 'dema', 12, 5, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner_ukm`
--

CREATE TABLE `kuesioner_ukm` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `workshop` int(11) DEFAULT NULL,
  `nama_workshop` varchar(100) DEFAULT NULL,
  `seminar` int(11) DEFAULT NULL,
  `nama_seminar` varchar(100) DEFAULT NULL,
  `pelatihan` int(11) DEFAULT NULL,
  `nama_pelatihan` varchar(100) DEFAULT NULL,
  `karya_tulis_ilmiah` int(11) DEFAULT NULL,
  `nama_karya_tulis_ilmiah` varchar(100) DEFAULT NULL,
  `lomba` int(11) DEFAULT NULL,
  `nama_lomba` varchar(100) DEFAULT NULL,
  `pengabdian_masyarakat` int(11) DEFAULT NULL,
  `nama_pengabdian_masyarakat` varchar(100) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kuesioner_ukm`
--

INSERT INTO `kuesioner_ukm` (`id`, `username`, `workshop`, `nama_workshop`, `seminar`, `nama_seminar`, `pelatihan`, `nama_pelatihan`, `karya_tulis_ilmiah`, `nama_karya_tulis_ilmiah`, `lomba`, `nama_lomba`, `pengabdian_masyarakat`, `nama_pengabdian_masyarakat`, `tahun`) VALUES
(2, 'himasi', 0, '1', 1, 'b', 1, 'c', 0, '', 0, '', 0, '', 2020),
(3, 'himatif', 0, '1', 1, 'd', 2, 'r', 1, 'd', 3, 'f', 0, '', 2020),
(4, 'himate', 0, '1', 1, 'd', 2, 'r', 1, 'd', 3, 'f', 0, '', 2020),
(5, 'hmjmt', 0, '1', 1, 'd', 2, 'r', 1, 'd', 3, 'f', 0, '', 2020),
(6, 'hmjti', 0, '1', 1, 'd', 2, 'r', 1, 'd', 3, 'f', 0, '', 2020),
(7, 'sema', 0, '1', 1, 'd', 2, 'r', 1, 'd', 3, 'f', 0, '', 2020),
(8, 'dema', 0, '1', 1, 'd', 2, 'r', 1, 'd', 3, 'f', 0, '', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `lpj`
--

CREATE TABLE `lpj` (
  `id_lpj` int(11) NOT NULL,
  `id_proker` int(11) NOT NULL,
  `file_lpj` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lpj`
--

INSERT INTO `lpj` (`id_lpj`, `id_proker`, `file_lpj`) VALUES
(9, 6, 'SURAT AKTIF KULIAH018.pdf'),
(10, 7, 'SURAT AKTIF KULIAH018.pdf'),
(11, 1, '227286-penerapan-metode-k-nearest-neighbor-pada-9908ebd9.pdf'),
(12, 2, '227286-penerapan-metode-k-nearest-neighbor-pada-9908ebd9.pdf'),
(13, 3, 'SURAT AKTIF KULIAH018.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `masa_jabatan`
--

CREATE TABLE `masa_jabatan` (
  `id_masa_jabatan` int(11) NOT NULL,
  `tahun_priode` varchar(50) NOT NULL,
  `tgl_akhir_priode` date NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masa_jabatan`
--

INSERT INTO `masa_jabatan` (`id_masa_jabatan`, `tahun_priode`, `tgl_akhir_priode`, `status`) VALUES
(1, '2020-2021', '2020-01-04', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `id_ps` int(11) NOT NULL,
  `program_studi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`id_ps`, `program_studi`) VALUES
(2, 'Teknik Industri'),
(4, 'Teknik Elektro'),
(5, 'Matematika Terapan'),
(6, 'Sistem Informasi'),
(7, 'Teknik Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `proker`
--

CREATE TABLE `proker` (
  `id_proker` int(11) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `tahun_anggaran` varchar(10) NOT NULL,
  `ketua_pelaksana` varchar(100) NOT NULL,
  `tgl_realisasi` date NOT NULL,
  `rancangan_biaya` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `progress` int(11) NOT NULL,
  `status_proker` varchar(50) NOT NULL,
  `status_proposal` varchar(50) NOT NULL,
  `status_lpj` varchar(50) NOT NULL,
  `oleh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proker`
--

INSERT INTO `proker` (`id_proker`, `nama_kegiatan`, `tahun_anggaran`, `ketua_pelaksana`, `tgl_realisasi`, `rancangan_biaya`, `file`, `progress`, `status_proker`, `status_proposal`, `status_lpj`, `oleh`) VALUES
(1, 'asdf', '2020', 'asdf', '2019-10-07', '2342232', '227286-penerapan-metode-k-nearest-neighbor-pada-9908ebd9.pdf', 0, 'Telah Disetujui', 'Telah Disetujui', 'Telah Disetujui', 'dema'),
(2, 'proker 2', '2020', 'asdfa', '2019-10-07', '3000000', '17801.pdf', 0, 'Telah Disetujui', 'Telah Disetujui', 'Telah Disetujui', 'himatif'),
(3, 'FORTASI', '2020', 'Rusdi hidayah', '2019-11-25', '1000000', 'SURAT AKTIF KULIAH018.pdf', 0, 'Telah Disetujui', 'Telah Disetujui', 'Telah Disetujui', 'himasi'),
(4, 'hv', '989', 'ou', '2019-11-18', '658', 'SURAT AKTIF KULIAH018.pdf', 0, 'Telah Disetujui', 'Tidak Ada', 'Tidak Ada', 'himasi'),
(5, 'BUMASI', '2019', 'rusdi', '2019-11-30', '2000000', 'SURAT AKTIF KULIAH018.pdf', 0, 'Telah Disetujui', 'Telah Disetujui', 'Tidak Ada', 'himasi'),
(6, 'BUMASI', '2019', 'rusdi', '2019-11-30', '2000000', 'SURAT AKTIF KULIAH018.pdf', 0, 'Telah Disetujui', 'Tidak Ada', 'Tidak Ada', 'himasi'),
(7, 'PASSION TECHNO', '2019', 'Diko', '2019-12-02', '5000000', 'SURAT AKTIF KULIAH018.pdf', 0, 'Menunggu', 'Tidak Ada', 'Tidak Ada', 'himasi'),
(8, 'PO', '2019', 'rusdi', '2019-11-29', '1000000', 'SURAT AKTIF KULIAH018.pdf', 0, 'Telah Disetujui', 'Telah Disetujui', 'Tidak Ada', 'himasi'),
(9, 'rusd', 'wrgIOH', 'iowhgohw', '0038-04-10', '2324442', 'SURAT AKTIF KULIAH018.pdf', 0, 'Telah Disetujui', 'Tidak Ada', 'Tidak Ada', 'himasi');

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `id_proposal` int(11) NOT NULL,
  `id_proker` int(11) NOT NULL,
  `file_proposal` varchar(500) NOT NULL,
  `status_proposal` varchar(200) NOT NULL,
  `bantuan_awal` int(11) NOT NULL,
  `realisasi_bantuan` int(11) NOT NULL,
  `status_anggaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id_proposal`, `id_proker`, `file_proposal`, `status_proposal`, `bantuan_awal`, `realisasi_bantuan`, `status_anggaran`) VALUES
(1, 1, '227286-penerapan-metode-k-nearest-neighbor-pada-9908ebd9.pdf', 'Telah Disetujui', 1000000, 1000000, 'Telah Dianggarkan'),
(2, 2, '227286-penerapan-metode-k-nearest-neighbor-pada-9908ebd9.pdf', 'Telah Disetujui', 1000000, 1000000, 'Telah Dicairkan'),
(3, 3, 'SURAT AKTIF KULIAH018.pdf', 'Telah Disetujui', 500000, 500000, 'Telah Dicairkan'),
(4, 5, 'SURAT AKTIF KULIAH018.pdf', 'Telah Disetujui', 500000, 1000000, 'Telah Dicairkan'),
(5, 8, 'SURAT AKTIF KULIAH018.pdf', 'Telah Disetujui', 0, 0, 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `semadema`
--

CREATE TABLE `semadema` (
  `id_sema` int(11) NOT NULL,
  `nama_sema` varchar(50) NOT NULL,
  `logo_sema` varchar(50) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `pdf` varchar(50) NOT NULL,
  `visi` varchar(50) NOT NULL,
  `misi` varchar(50) NOT NULL,
  `ketua` varchar(50) NOT NULL,
  `nim_ketua` varchar(50) NOT NULL,
  `wakil_ketua` varchar(50) NOT NULL,
  `nim_wk` varchar(50) NOT NULL,
  `sekretaris` varchar(50) NOT NULL,
  `nim_sekre` varchar(50) NOT NULL,
  `bendahara` varchar(50) NOT NULL,
  `nim_bendahara` varchar(50) NOT NULL,
  `oleh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semadema`
--

INSERT INTO `semadema` (`id_sema`, `nama_sema`, `logo_sema`, `periode`, `pdf`, `visi`, `misi`, `ketua`, `nim_ketua`, `wakil_ketua`, `nim_wk`, `sekretaris`, `nim_sekre`, `bendahara`, `nim_bendahara`, `oleh`) VALUES
(1, 'Senat Mahasiswa FST', 'sema.PNG', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'sema'),
(2, 'Dewan Mahasiswa FST', '55813371_341380043156294_8293164987640184832_n.jpg', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'dema'),
(3, 'Ifo ffdsf', 'haji2.jpg', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'Belum Diisi', 'demass');

-- --------------------------------------------------------

--
-- Table structure for table `syarat`
--

CREATE TABLE `syarat` (
  `id_syarat` int(11) NOT NULL,
  `id_proker` int(11) NOT NULL,
  `surat` varchar(100) NOT NULL,
  `lembaran` varchar(100) NOT NULL,
  `kelengkapan` varchar(100) NOT NULL,
  `rancangan` varchar(100) NOT NULL,
  `lampiran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `syarat`
--

INSERT INTO `syarat` (`id_syarat`, `id_proker`, `surat`, `lembaran`, `kelengkapan`, `rancangan`, `lampiran`) VALUES
(1, 1, '1', '1', '1', '1', '1'),
(2, 2, '1', '1', '1', '1', '1'),
(3, 3, '1', '1', '1', '1', '1'),
(4, 5, '1', '1', '1', '1', '1'),
(5, 8, '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `program_studi` varchar(50) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `login_terakhir` datetime NOT NULL,
  `image` varchar(50) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `program_studi`, `nip`, `username`, `password`, `login_terakhir`, `image`, `keterangan`, `status`) VALUES
(1, 'miau', 'miau', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2019-06-26 00:00:00', 'admin', 'Admin', 'aktif'),
(47, 'Muhammad Nasir, S.Ag', ' ', '123', 'kabag', '1a50ef14d0d75cd795860935ee0918af', '0000-00-00 00:00:00', '4s.jpg', 'Kabag', 'aktif'),
(50, 'Himpunan Mahasiswa TIF', 'Teknik Informatika', ' ', 'himatif', '23abc39caa54c738db2e54511dac4e96', '0000-00-00 00:00:00', 'W1kgK1Lc.jpg', 'Himpunan', 'aktif'),
(53, 'Senat Mahasiswa FST', 'Matematika', ' ', 'sema', '089ac4682a780fd36a19a6279c977758', '0000-00-00 00:00:00', 'sema.PNG', 'Sema & Dema', 'tidak aktif'),
(54, 'Dewan Mahasiswa FST', 'Matematika', ' ', 'dema', 'a09e4da82336680af1e258083b1dea79', '0000-00-00 00:00:00', '55813371_341380043156294_8293164987640184832_n.jpg', 'Sema & Dema', 'aktif'),
(55, 'Idria Maita, S.Kom., M.Sc', 'Sistem Informasi', '197905132007102005', 'sisteminformasi', '67165953cd3e222901f292661e3b2e4b', '0000-00-00 00:00:00', 'buk id.jpg', 'Ketua Prodi', 'aktif'),
(56, 'Dr. Elin Haerani', 'Teknik Informatika', '198105232007102003', 'teknikinformatika', '5cccabfcbf00b1db39836ceb2486b959', '0000-00-00 00:00:00', 'a6.jpg', 'Ketua Prodi', 'aktif'),
(58, 'Ewi Ismaredah, S. Kom., M. Kom', 'Teknik Elektro', '197509222009122002', 'teknikelektro', '81c80e0630d75252d91e291cf7c1daa1', '0000-00-00 00:00:00', 'teeee.JPG', 'Ketua Prodi', 'aktif'),
(59, 'Fitrah Lestari, Ph.D', 'Teknik Industri', '198506162011011016', 'teknikindustri', '0097f86e13bb4122a39b0a9714da7411', '0000-00-00 00:00:00', 'fitah.JPG', 'Ketua Prodi', 'aktif'),
(60, 'Ari Pani Desvina, S.Si., M.Sc', 'Matematika Terapan', '198112252006042003', 'matematika', '824761ecd9045f8c48bc853d0449c145', '0000-00-00 00:00:00', 'Ari-Pani-Desvina.jpg', 'Ketua Prodi', 'aktif'),
(61, 'Drs. H. Promadi, MA., Pd.D.,', 'WR III', '196408271991031009', 'wr', 'f3151d23f9c88ea74e0229bcdd321cde', '0000-00-00 00:00:00', 'wr.jpg', 'WR III', 'aktif'),
(62, 'Dr. Zaitun, S.Ag., M.Ag', 'WD III', '197205101998032006', 'wd', 'dd3ba2cca7da8526615be73d390527ac', '0000-00-00 00:00:00', '130-0.jpg', 'WD III', 'aktif'),
(65, 'Dr. Drs. H. Masâ€™ud Zein, M.P', 'Dekan', '19631214 198803 1 002', 'dekan ', '3da2f457ad7c0edf1c94e1ea87b0818d', '0000-00-00 00:00:00', 'dekan.jpg', 'Dekan', 'aktif'),
(66, 'HIMASI', 'Sistem Informasi', ' ', 'himasi', 'ff727cddcbafbf83178e5e91d4a86cf6', '0000-00-00 00:00:00', 'uinsif.jpg', 'Himpunan', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggaran`
--
ALTER TABLE `anggaran`
  ADD PRIMARY KEY (`id_anggaran`);

--
-- Indexes for table `birokrasi`
--
ALTER TABLE `birokrasi`
  ADD PRIMARY KEY (`id_birokrasi`);

--
-- Indexes for table `detail_proker`
--
ALTER TABLE `detail_proker`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `himpunan`
--
ALTER TABLE `himpunan`
  ADD PRIMARY KEY (`id_himpunan`);

--
-- Indexes for table `kuesioner`
--
ALTER TABLE `kuesioner`
  ADD PRIMARY KEY (`id_kuesioner`);

--
-- Indexes for table `kuesioner_detail`
--
ALTER TABLE `kuesioner_detail`
  ADD PRIMARY KEY (`id_kue_detail`);

--
-- Indexes for table `kuesioner_ukm`
--
ALTER TABLE `kuesioner_ukm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lpj`
--
ALTER TABLE `lpj`
  ADD PRIMARY KEY (`id_lpj`);

--
-- Indexes for table `masa_jabatan`
--
ALTER TABLE `masa_jabatan`
  ADD PRIMARY KEY (`id_masa_jabatan`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id_ps`);

--
-- Indexes for table `proker`
--
ALTER TABLE `proker`
  ADD PRIMARY KEY (`id_proker`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id_proposal`);

--
-- Indexes for table `semadema`
--
ALTER TABLE `semadema`
  ADD PRIMARY KEY (`id_sema`);

--
-- Indexes for table `syarat`
--
ALTER TABLE `syarat`
  ADD PRIMARY KEY (`id_syarat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggaran`
--
ALTER TABLE `anggaran`
  MODIFY `id_anggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `birokrasi`
--
ALTER TABLE `birokrasi`
  MODIFY `id_birokrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_proker`
--
ALTER TABLE `detail_proker`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `himpunan`
--
ALTER TABLE `himpunan`
  MODIFY `id_himpunan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kuesioner`
--
ALTER TABLE `kuesioner`
  MODIFY `id_kuesioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kuesioner_detail`
--
ALTER TABLE `kuesioner_detail`
  MODIFY `id_kue_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT for table `kuesioner_ukm`
--
ALTER TABLE `kuesioner_ukm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lpj`
--
ALTER TABLE `lpj`
  MODIFY `id_lpj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `masa_jabatan`
--
ALTER TABLE `masa_jabatan`
  MODIFY `id_masa_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `id_ps` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `proker`
--
ALTER TABLE `proker`
  MODIFY `id_proker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id_proposal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `semadema`
--
ALTER TABLE `semadema`
  MODIFY `id_sema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `syarat`
--
ALTER TABLE `syarat`
  MODIFY `id_syarat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
