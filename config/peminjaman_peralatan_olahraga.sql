-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2026 at 08:02 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman_peralatan_olahraga`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id_alat` int NOT NULL,
  `id_kategori` int NOT NULL,
  `nama_alat` varchar(30) NOT NULL,
  `kondisi` enum('Tersedia','Tidak Tersedia','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stok` int NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id_alat`, `id_kategori`, `nama_alat`, `kondisi`, `stok`, `deleted_at`) VALUES
(4, 1, 'Bola Sepak', 'Tersedia', 10, NULL),
(5, 1, 'Bola Basket', 'Tersedia', 10, NULL),
(6, 1, 'Bola Voli', 'Tersedia', 10, NULL),
(7, 1, 'Bola Futsal', 'Tersedia', 10, NULL),
(8, 3, 'Bola Tenis', 'Tersedia', 10, NULL),
(9, 3, 'Bola Pingpong', 'Tersedia', 10, NULL),
(10, 3, 'Bola Kasti', 'Tersedia', 10, NULL),
(11, 3, 'Shuttlecock', 'Tersedia', 10, NULL),
(12, 3, 'Bola Baseball', 'Tersedia', 10, NULL),
(13, 4, 'Net Voli', 'Tersedia', 2, NULL),
(14, 4, 'Gawang Sepak Bola', 'Tersedia', 2, NULL),
(15, 4, 'Ring Basket', 'Tersedia', 2, NULL),
(19, 3, 'Bola Tangan', 'Tersedia', 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Bola Besar'),
(3, 'Bola Kecil'),
(4, 'Alat Lapangan');

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_log` int NOT NULL,
  `id_pengguna` int NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `aktivitas` varchar(50) NOT NULL,
  `waktu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id_log`, `id_pengguna`, `nama_pengguna`, `aktivitas`, `waktu`) VALUES
(1, 1000, 'novia', 'Login ke sistem', '2026-01-29'),
(2, 1000, 'novia', 'Logout dari sistem', '2026-01-29'),
(7, 1000, 'novia', 'Logout dari sistem', '2026-02-03'),
(8, 1000, 'novia', 'Logout dari sistem', '2026-02-11'),
(18, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-11'),
(19, 1000, 'novia', 'Logout dari sistem', '2026-02-11'),
(23, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-11'),
(24, 1000, 'novia', 'Menambah pengguna baru: Keysha Kirana', '2026-02-11'),
(25, 1000, 'novia', 'Mengupdate data pengguna: Keysha Kirana', '2026-02-11'),
(26, 1000, 'novia', 'Mengupdate data pengguna: Keysha Kirana', '2026-02-11'),
(27, 1000, 'novia', 'Menghapus pengguna: Keysha Kirana', '2026-02-11'),
(28, 1000, 'novia', 'Menambah alat baru: Bola Tangan', '2026-02-11'),
(29, 1000, 'novia', 'Logout dari sistem', '2026-02-11'),
(42, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-11'),
(43, 1000, 'novia', 'Logout dari sistem', '2026-02-11'),
(54, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-11'),
(55, 1000, 'novia', 'Menambah pengguna baru: wildan', '2026-02-11'),
(56, 1000, 'novia', 'Menghapus pengguna: wildan', '2026-02-11'),
(57, 1000, 'novia', 'Menambah alat baru: kasti', '2026-02-11'),
(58, 1000, 'novia', 'Menghapus alat: kasti', '2026-02-11'),
(59, 1000, 'novia', 'Logout dari sistem', '2026-02-11'),
(63, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-12'),
(64, 1000, 'novia', 'Logout dari sistem', '2026-02-12'),
(80, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-12'),
(81, 1000, 'novia', 'Logout dari sistem', '2026-02-12'),
(85, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-12'),
(86, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-12'),
(87, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-12'),
(88, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-12'),
(89, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-12'),
(90, 1000, 'novia', 'Logout dari sistem', '2026-02-12'),
(92, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-12'),
(98, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-12'),
(99, 1000, 'novia', 'Logout dari sistem', '2026-02-12'),
(100, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-12'),
(101, 1000, 'novia', 'Logout dari sistem', '2026-02-12'),
(102, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-12'),
(103, 1000, 'novia', 'Logout dari sistem', '2026-02-12'),
(106, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-12'),
(107, 1000, 'novia', 'Logout dari sistem', '2026-02-12'),
(120, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-12'),
(121, 1000, 'novia', 'Logout dari sistem', '2026-02-12'),
(126, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-12'),
(127, 1000, 'novia', 'Menambah pengguna baru: Keysha Kirana', '2026-02-12'),
(128, 1000, 'novia', 'Logout dari sistem', '2026-02-12'),
(137, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-12'),
(138, 1000, 'novia', 'Logout dari sistem', '2026-02-12'),
(144, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-16'),
(154, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-16'),
(155, 1000, 'novia', 'Mengupdate data alat: Bola Tangan', '2026-02-16'),
(156, 1000, 'novia', 'Mengupdate data alat: Bola Kasti', '2026-02-16'),
(157, 1000, 'novia', 'Mengupdate data alat: Bola Basket', '2026-02-16'),
(158, 1000, 'novia', 'Menghapus pengguna: Keysha Kirana', '2026-02-16'),
(159, 1000, 'novia', 'Menghapus pengguna: jihan', '2026-02-16'),
(160, 1000, 'novia', 'Menambah pengguna baru: jihan', '2026-02-16'),
(161, 1000, 'novia', 'Mengupdate data pengguna: jihan', '2026-02-16'),
(162, 1000, 'novia', 'Mengupdate data pengguna: jihan', '2026-02-16'),
(163, 1000, 'novia', 'Logout dari sistem', '2026-02-16'),
(174, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-16'),
(175, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-21'),
(176, 1000, 'novia', 'Logout dari sistem', '2026-02-21'),
(181, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-21'),
(182, 1000, 'novia', 'Logout dari sistem', '2026-02-21'),
(185, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-21'),
(186, 1000, 'novia', 'Menambah pengguna baru: resky', '2026-02-21'),
(187, 1000, 'novia', 'Mengupdate data pengguna: resky', '2026-02-21'),
(188, 1000, 'novia', 'Logout dari sistem', '2026-02-21'),
(189, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-21'),
(190, 1000, 'novia', 'Menghapus pengguna: resky', '2026-02-21'),
(191, 1000, 'novia', 'Logout dari sistem', '2026-02-21'),
(204, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-22'),
(205, 1000, 'novia', 'Mengupdate data alat: Bola Baseball', '2026-02-23'),
(206, 1000, 'novia', 'Logout dari sistem', '2026-02-23'),
(211, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-23'),
(212, 1000, 'novia', 'Mengupdate data alat: Bola Tanga', '2026-02-23'),
(213, 1000, 'novia', 'Menghapus alat: Bola Tanga', '2026-02-23'),
(214, 1000, 'novia', 'Menambah alat baru: Bola Tangan', '2026-02-23'),
(215, 1000, 'novia', 'Menambah pengguna baru: key', '2026-02-23'),
(216, 1000, 'novia', 'Menambah pengguna baru: key', '2026-02-23'),
(217, 1000, 'novia', 'Menghapus pengguna: key', '2026-02-23'),
(218, 1000, 'novia', 'Logout dari sistem', '2026-02-23'),
(237, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-23'),
(238, 1000, 'novia', 'Menghapus pengguna: key', '2026-02-23'),
(239, 1000, 'novia', 'Logout dari sistem', '2026-02-23'),
(240, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-23'),
(241, 1000, 'novia', 'Menghapus pengguna: jihan', '2026-02-23'),
(242, 1000, 'novia', 'Menghapus pengguna: yuslan', '2026-02-23'),
(243, 1000, 'novia', 'Menambah pengguna baru: yuslan', '2026-02-23'),
(244, 1000, 'novia', 'Menambah pengguna baru: jihan', '2026-02-23'),
(245, 1000, 'novia', 'Logout dari sistem', '2026-02-23'),
(246, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-02-23'),
(247, 3014, 'yuslan', 'Logout dari sistem', '2026-02-23'),
(248, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-02-23'),
(249, 3015, 'jihan', 'Logout dari sistem', '2026-02-23'),
(250, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-02-23'),
(251, 3014, 'yuslan', 'Logout dari sistem', '2026-02-23'),
(252, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-02-23'),
(253, 3015, 'jihan', 'Mengajukan peminjaman: Bola Baseball (1 unit)', '2026-02-23'),
(254, 3015, 'jihan', 'Logout dari sistem', '2026-02-23'),
(255, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-02-23'),
(256, 3014, 'yuslan', 'Menyetujui peminjaman ID: 4', '2026-02-23'),
(257, 3014, 'yuslan', 'Logout dari sistem', '2026-02-23'),
(258, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-02-23'),
(259, 3015, 'jihan', 'Mengajukan pengembalian ID: 4', '2026-02-23'),
(260, 3015, 'jihan', 'Logout dari sistem', '2026-02-23'),
(261, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-02-23'),
(262, 3014, 'yuslan', 'Menyetujui pengembalian ID: 4', '2026-02-23'),
(263, 3014, 'yuslan', 'Logout dari sistem', '2026-02-23'),
(264, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-02-23'),
(265, 3015, 'jihan', 'Mengajukan peminjaman: Bola Basket (1 unit)', '2026-02-23'),
(266, 3015, 'jihan', 'Logout dari sistem', '2026-02-23'),
(267, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-02-23'),
(268, 3014, 'yuslan', 'Menyetujui peminjaman ID: 5', '2026-02-23'),
(269, 3014, 'yuslan', 'Logout dari sistem', '2026-02-23'),
(270, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-02-23'),
(271, 3015, 'jihan', 'Mengajukan pengembalian ID: 5', '2026-02-23'),
(272, 3015, 'jihan', 'Logout dari sistem', '2026-02-23'),
(273, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-02-23'),
(274, 3014, 'yuslan', 'Menyetujui pengembalian ID: 5', '2026-02-23'),
(275, 3014, 'yuslan', 'Logout dari sistem', '2026-02-23'),
(276, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-23'),
(277, 1000, 'novia', 'Logout dari sistem', '2026-02-23'),
(278, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-02-23'),
(279, 3015, 'jihan', 'Mengajukan peminjaman: Shuttlecock (1 unit)', '2026-02-23'),
(280, 3015, 'jihan', 'Logout dari sistem', '2026-02-23'),
(281, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-02-23'),
(282, 3014, 'yuslan', 'Menyetujui peminjaman ID: 6', '2026-02-23'),
(283, 3014, 'yuslan', 'Logout dari sistem', '2026-02-23'),
(284, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-02-23'),
(285, 3015, 'jihan', 'Mengajukan pengembalian ID: 6', '2026-02-23'),
(286, 3015, 'jihan', 'Logout dari sistem', '2026-02-23'),
(287, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-02-23'),
(288, 3014, 'yuslan', 'Menyetujui pengembalian ID: 6', '2026-02-23'),
(289, 3014, 'yuslan', 'Logout dari sistem', '2026-02-24'),
(290, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-02-24'),
(291, 3014, 'yuslan', 'Logout dari sistem', '2026-02-24'),
(292, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-02-24'),
(293, 3015, 'jihan', 'Mengajukan peminjaman: Bola Baseball (1 unit)', '2026-02-24'),
(294, 3015, 'jihan', 'Logout dari sistem', '2026-02-24'),
(295, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-02-24'),
(296, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-02-24'),
(297, 3014, 'yuslan', 'Menolak peminjaman ID: 7', '2026-02-24'),
(298, 3014, 'yuslan', 'Menolak peminjaman ID: 7', '2026-02-24'),
(299, 3014, 'yuslan', 'Menolak peminjaman ID: 7', '2026-02-24'),
(300, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-02-24'),
(301, 3014, 'yuslan', 'Menyetujui peminjaman ID: 7', '2026-02-24'),
(302, 3014, 'yuslan', 'Logout dari sistem', '2026-02-24'),
(303, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-02-24'),
(304, 3015, 'jihan', 'Mengajukan pengembalian ID: 7', '2026-02-24'),
(305, 3015, 'jihan', 'Logout dari sistem', '2026-02-24'),
(306, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-02-24'),
(307, 3014, 'yuslan', 'Menolak pengembalian ID: 7', '2026-02-24'),
(308, 3014, 'yuslan', 'Logout dari sistem', '2026-02-24'),
(309, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-02-24'),
(310, 3015, 'jihan', 'Mengajukan pengembalian ID: 7', '2026-02-24'),
(311, 3015, 'jihan', 'Logout dari sistem', '2026-02-24'),
(312, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-02-24'),
(313, 3014, 'yuslan', 'Menolak pengembalian ID: 7', '2026-02-24'),
(314, 3014, 'yuslan', 'Logout dari sistem', '2026-02-24'),
(315, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-02-24'),
(316, 3015, 'jihan', 'Mengajukan pengembalian ID: 7', '2026-02-24'),
(317, 3015, 'jihan', 'Logout dari sistem', '2026-02-24'),
(318, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-02-24'),
(319, 3014, 'yuslan', 'Menyetujui pengembalian ID: 7', '2026-02-24'),
(320, 3014, 'yuslan', 'Logout dari sistem', '2026-02-24'),
(321, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-02-24'),
(322, 1000, 'novia', 'Restore peminjaman ID: 7', '2026-02-24'),
(323, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-03-11'),
(324, 1000, 'novia', 'Logout dari sistem', '2026-03-11'),
(325, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-03-11'),
(326, 3014, 'yuslan', 'Logout dari sistem', '2026-03-11'),
(327, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-03-11'),
(328, 1000, 'novia', 'Logout dari sistem', '2026-03-11'),
(329, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-03-11'),
(330, 3014, 'yuslan', 'Logout dari sistem', '2026-03-11'),
(331, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-03-11'),
(332, 3015, 'jihan', 'Mengajukan peminjaman: Bola Baseball (1 unit)', '2026-03-11'),
(333, 3015, 'jihan', 'Logout dari sistem', '2026-03-11'),
(334, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-03-11'),
(335, 3014, 'yuslan', 'Menyetujui peminjaman ID: 8', '2026-03-11'),
(336, 3014, 'yuslan', 'Logout dari sistem', '2026-03-11'),
(337, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-03-11'),
(338, 3015, 'jihan', 'Mengajukan pengembalian ID: 8', '2026-03-11'),
(339, 3015, 'jihan', 'Mengajukan peminjaman: Bola Basket (1 unit)', '2026-03-11'),
(340, 3015, 'jihan', 'Logout dari sistem', '2026-03-11'),
(341, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-03-11'),
(342, 3014, 'yuslan', 'Logout dari sistem', '2026-03-12'),
(343, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-03-12'),
(344, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-01'),
(345, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-01'),
(346, 1000, 'novia', 'Mengupdate data alat: Bola Basket', '2026-04-01'),
(347, 1000, 'novia', 'Mengupdate data alat: Bola Basket', '2026-04-01'),
(348, 1000, 'novia', 'Logout dari sistem', '2026-04-01'),
(349, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-01'),
(350, 3014, 'yuslan', 'Logout dari sistem', '2026-04-01'),
(351, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-01'),
(352, 1000, 'novia', 'Logout dari sistem', '2026-04-02'),
(353, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-02'),
(354, 3015, 'jihan', 'Mengajukan peminjaman: Bola Baseball (1 unit)', '2026-04-02'),
(355, 3015, 'jihan', 'Logout dari sistem', '2026-04-02'),
(356, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-02'),
(357, 3014, 'yuslan', 'Menyetujui peminjaman ID: 10', '2026-04-02'),
(358, 3014, 'yuslan', 'Menyetujui peminjaman ID: 9', '2026-04-02'),
(359, 3014, 'yuslan', 'Menyetujui pengembalian ID: 8', '2026-04-02'),
(360, 3014, 'yuslan', 'Logout dari sistem', '2026-04-02'),
(361, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-02'),
(362, 3015, 'jihan', 'Mengajukan pengembalian ID: 10', '2026-04-02'),
(363, 3015, 'jihan', 'Mengajukan pengembalian ID: 9', '2026-04-02'),
(364, 3015, 'jihan', 'Logout dari sistem', '2026-04-02'),
(365, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-02'),
(366, 3014, 'yuslan', 'Menyetujui pengembalian ID: 10', '2026-04-02'),
(367, 3014, 'yuslan', 'Menyetujui pengembalian ID: 9', '2026-04-02'),
(368, 3014, 'yuslan', 'Logout dari sistem', '2026-04-02'),
(369, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-02'),
(370, 3015, 'jihan', 'Mengajukan peminjaman: Bola Baseball (1 unit)', '2026-04-02'),
(371, 3015, 'jihan', 'Logout dari sistem', '2026-04-02'),
(372, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-02'),
(373, 1000, 'novia', 'Menambah alat baru: dgg', '2026-04-02'),
(374, 1000, 'novia', 'Mengupdate peminjaman ID: 10', '2026-04-02'),
(375, 1000, 'novia', 'Logout dari sistem', '2026-04-02'),
(376, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-02'),
(377, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-02'),
(378, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-02'),
(379, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-02'),
(380, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-03'),
(381, 1000, 'novia', 'Menghapus alat: dgg', '2026-04-03'),
(382, 1000, 'novia', 'Logout dari sistem', '2026-04-03'),
(383, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-03'),
(384, 3014, 'yuslan', 'Menyetujui peminjaman ID: 11', '2026-04-03'),
(385, 3014, 'yuslan', 'Logout dari sistem', '2026-04-03'),
(386, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-03'),
(387, 3015, 'jihan', 'Mengajukan pengembalian ID: 11', '2026-04-03'),
(388, 3015, 'jihan', 'Logout dari sistem', '2026-04-03'),
(389, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-03'),
(390, 3014, 'yuslan', 'Menyetujui pengembalian ID: 11', '2026-04-03'),
(391, 3014, 'yuslan', 'Logout dari sistem', '2026-04-03'),
(392, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-03'),
(393, 3015, 'jihan', 'Logout dari sistem', '2026-04-03'),
(394, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-03'),
(395, 1000, 'novia', 'Mengupdate peminjaman ID: 10', '2026-04-03'),
(396, 1000, 'novia', 'Mengupdate peminjaman ID: 10', '2026-04-03'),
(397, 1000, 'novia', 'Restore peminjaman ID: 10', '2026-04-03'),
(398, 1000, 'novia', 'Hapus permanent peminjaman ID: 10', '2026-04-03'),
(399, 1000, 'novia', 'Logout dari sistem', '2026-04-03'),
(400, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-03'),
(401, 3015, 'jihan', 'Mengajukan peminjaman: Bola Baseball (1 unit)', '2026-04-03'),
(402, 3015, 'jihan', 'Logout dari sistem', '2026-04-03'),
(403, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-03'),
(404, 3014, 'yuslan', 'Menyetujui peminjaman ID: 12', '2026-04-03'),
(405, 3014, 'yuslan', 'Logout dari sistem', '2026-04-03'),
(406, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-03'),
(407, 3014, 'yuslan', 'Logout dari sistem', '2026-04-03'),
(408, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-03'),
(409, 3015, 'jihan', 'Mengajukan pengembalian ID: 12', '2026-04-03'),
(410, 3015, 'jihan', 'Mengajukan peminjaman: Bola Basket (1 unit)', '2026-04-03'),
(411, 3015, 'jihan', 'Logout dari sistem', '2026-04-03'),
(412, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-03'),
(413, 3014, 'yuslan', 'Menyetujui peminjaman ID: 13', '2026-04-03'),
(414, 3014, 'yuslan', 'Menyetujui pengembalian ID: 12', '2026-04-03'),
(415, 3014, 'yuslan', 'Logout dari sistem', '2026-04-03'),
(416, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-03'),
(417, 3015, 'jihan', 'Mengajukan pengembalian ID: 13', '2026-04-03'),
(418, 3015, 'jihan', 'Logout dari sistem', '2026-04-03'),
(419, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-03'),
(420, 3014, 'yuslan', 'Menyetujui pengembalian ID: 13', '2026-04-03'),
(421, 3014, 'yuslan', 'Logout dari sistem', '2026-04-03'),
(422, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-03'),
(423, 1000, 'novia', 'Hapus permanent alat ID: 17', '2026-04-03'),
(424, 1000, 'novia', 'Menambah pengguna baru: bian', '2026-04-03'),
(425, 1000, 'novia', 'Logout dari sistem', '2026-04-03'),
(426, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-03'),
(427, 3014, 'yuslan', 'Logout dari sistem', '2026-04-03'),
(431, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-03'),
(432, 3014, 'yuslan', 'Menyetujui peminjaman ID: 14', '2026-04-03'),
(433, 3014, 'yuslan', 'Logout dari sistem', '2026-04-03'),
(437, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-03'),
(438, 3014, 'yuslan', 'Menyetujui pengembalian ID: 14', '2026-04-03'),
(439, 3014, 'yuslan', 'Logout dari sistem', '2026-04-03'),
(440, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-03'),
(441, 1000, 'novia', 'Menghapus pengguna: bian', '2026-04-03'),
(442, 1000, 'novia', 'Logout dari sistem', '2026-04-03'),
(443, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-03'),
(444, 1000, 'novia', 'Logout dari sistem', '2026-04-03'),
(445, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-03'),
(446, 3014, 'yuslan', 'Logout dari sistem', '2026-04-03'),
(447, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-03'),
(448, 3015, 'jihan', 'Logout dari sistem', '2026-04-03'),
(449, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-03'),
(450, 1000, 'novia', 'Logout dari sistem', '2026-04-03'),
(451, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-03'),
(452, 3014, 'yuslan', 'Logout dari sistem', '2026-04-03'),
(453, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-03'),
(454, 3015, 'jihan', 'Logout dari sistem', '2026-04-03'),
(455, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-07'),
(456, 1000, 'novia', 'Logout dari sistem', '2026-04-07'),
(457, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-07'),
(458, 1000, 'novia', 'Menambah pengguna baru: bian', '2026-04-07'),
(459, 1000, 'novia', 'Mengupdate data pengguna: bian', '2026-04-07'),
(460, 1000, 'novia', 'Logout dari sistem', '2026-04-07'),
(461, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-07'),
(462, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-09'),
(463, 1000, 'novia', 'Mengupdate data pengguna: biann', '2026-04-09'),
(464, 1000, 'novia', 'Menghapus pengguna: biann', '2026-04-09'),
(465, 1000, 'novia', 'Menambah alat baru: cobain', '2026-04-09'),
(466, 1000, 'novia', 'Mengupdate data alat: cobain', '2026-04-09'),
(467, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-09'),
(468, 1000, 'novia', 'Restore alat ID: 20', '2026-04-10'),
(469, 1000, 'novia', 'Menghapus alat: dgg', '2026-04-10'),
(470, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-10'),
(471, 1000, 'novia', 'Logout dari sistem', '2026-04-10'),
(472, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-10'),
(473, 3014, 'yuslan', 'Logout dari sistem', '2026-04-10'),
(474, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-10'),
(475, 3014, 'yuslan', 'Logout dari sistem', '2026-04-10'),
(476, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-10'),
(477, 1000, 'novia', 'Menambah pengguna baru: bian', '2026-04-10'),
(478, 1000, 'novia', 'Logout dari sistem', '2026-04-10'),
(479, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-10'),
(480, 3014, 'yuslan', 'Logout dari sistem', '2026-04-10'),
(481, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-10'),
(482, 1000, 'novia', 'Menghapus pengguna: bian', '2026-04-10'),
(483, 1000, 'novia', 'Mengupdate data alat: cobain', '2026-04-10'),
(484, 1000, 'novia', 'Menghapus alat: cobain', '2026-04-10'),
(485, 1000, 'novia', 'Menghapus alat: dgg', '2026-04-10'),
(486, 1000, 'novia', 'Logout dari sistem', '2026-04-10'),
(487, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-10'),
(488, 3014, 'yuslan', 'Logout dari sistem', '2026-04-10'),
(489, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-10'),
(490, 3015, 'jihan', 'Mengajukan peminjaman: Bola Baseball (1 unit)', '2026-04-10'),
(491, 3015, 'jihan', 'Logout dari sistem', '2026-04-10'),
(492, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-10'),
(493, 3015, 'jihan', 'Logout dari sistem', '2026-04-10'),
(494, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-10'),
(495, 3014, 'yuslan', 'Logout dari sistem', '2026-04-10'),
(496, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-10'),
(497, 1000, 'novia', 'Menambah pengguna baru: bian', '2026-04-10'),
(498, 1000, 'novia', 'Logout dari sistem', '2026-04-10'),
(499, 3019, 'bian', 'Login ke sistem sebagai Peminjam', '2026-04-10'),
(500, 3019, 'bian', 'Mengajukan peminjaman: Bola Basket (1 unit)', '2026-04-10'),
(501, 3019, 'bian', 'Logout dari sistem', '2026-04-10'),
(502, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-10'),
(503, 3014, 'yuslan', 'Menyetujui peminjaman ID: 15', '2026-04-10'),
(504, 3014, 'yuslan', 'Menolak peminjaman ID: 16', '2026-04-10'),
(505, 3014, 'yuslan', 'Logout dari sistem', '2026-04-10'),
(506, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-10'),
(507, 3015, 'jihan', 'Mengajukan pengembalian ID: 15', '2026-04-10'),
(508, 3015, 'jihan', 'Logout dari sistem', '2026-04-10'),
(509, 3019, 'bian', 'Login ke sistem sebagai Peminjam', '2026-04-10'),
(510, 3019, 'bian', 'Logout dari sistem', '2026-04-10'),
(511, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-10'),
(512, 3014, 'yuslan', 'Menyetujui pengembalian ID: 15', '2026-04-10'),
(513, 3014, 'yuslan', 'Logout dari sistem', '2026-04-10'),
(514, 1000, 'novia', 'Login ke sistem sebagai Admin', '2026-04-10'),
(515, 1000, 'novia', 'Logout dari sistem', '2026-04-10'),
(516, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-10'),
(517, 3014, 'yuslan', 'Logout dari sistem', '2026-04-10'),
(518, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-10'),
(519, 3015, 'jihan', 'Logout dari sistem', '2026-04-10'),
(520, 3015, 'jihan', 'Login ke sistem sebagai Peminjam', '2026-04-10'),
(521, 3015, 'jihan', 'Logout dari sistem', '2026-04-10'),
(522, 3014, 'yuslan', 'Login ke sistem sebagai Petugas', '2026-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int NOT NULL,
  `id_pengguna` int NOT NULL,
  `id_alat` int NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `total_item` int NOT NULL,
  `status` varchar(20) DEFAULT 'Menunggu',
  `kondisi` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_pengguna`, `id_alat`, `tanggal_pinjam`, `tanggal_kembali`, `total_item`, `status`, `kondisi`, `deleted_at`, `keterangan`) VALUES
(4, 3015, 12, '2026-02-23', '2026-02-23', 1, 'Kembali', 'Baik', NULL, NULL),
(5, 3015, 5, '2026-02-23', '2026-02-23', 1, 'Kembali', 'Baik', NULL, NULL),
(6, 3015, 11, '2026-02-23', '2026-02-23', 1, 'Kembali', 'Baik', NULL, NULL),
(7, 3015, 12, '2026-02-23', '2026-02-23', 1, 'Kembali', 'Baik', NULL, 'kondisi tidak sesuai'),
(8, 3015, 12, '2026-03-11', '2026-03-11', 1, 'Kembali', 'Baik', NULL, NULL),
(9, 3015, 5, '2026-03-11', '2026-04-02', 1, 'Kembali', 'Baik', NULL, NULL),
(11, 3015, 12, '2026-04-02', '2026-04-03', 1, 'Kembali', 'Baik', NULL, NULL),
(12, 3015, 12, '2026-04-03', '2026-04-03', 1, 'Kembali', 'Baik', NULL, NULL),
(13, 3015, 5, '2026-04-03', '2026-04-03', 1, 'Kembali', 'Baik', NULL, NULL),
(15, 3015, 12, '2026-04-10', '2026-04-10', 1, 'Kembali', 'Baik', NULL, NULL),
(16, 3019, 5, '2026-04-10', '2026-04-17', 1, 'Di Tolak', NULL, NULL, 'mohon maaf');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` enum('admin','petugas','peminjam') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_handphone` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `username`, `password`, `email`, `role`, `no_handphone`, `alamat`) VALUES
(1000, 'novia', 'admin', '$2y$10$ETQFD0ygV3IZkBHecl7uRufc3Bo3ACqAQTu82UH/Z98HOTEOWZyyG', 'novia@gmail.com', 'admin', '863541741812', 'cimahi'),
(3014, 'yuslan', 'petugas', '$2y$10$3ir0cfhscu.13J3mDEFGrO/c1KhHDd41Y55UbjKA4tY4sPDga6KK.', 'yuslan@gmail.com', 'petugas', '081221200104', 'bandung'),
(3015, 'jihan', 'peminjam', '$2y$10$kT3m3SE60g8Tn0thLpRPJu4vcnFVAjp0o5DLfMgEek3H9jPC.oF5y', 'jihan@gmail.com', 'peminjam', '087645432156', 'padasuka'),
(3019, 'bian', 'bian', '$2y$10$ccmaZDPN6s.jDDWp3uG8lu0JTnEO0AbysSmPp7204zhivLEf/fc/6', 'bian@gmail.com', 'peminjam', '085215528411', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_alat`),
  ADD KEY `id_kategori` (`id_kategori`) USING BTREE;

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `idx_pengguna` (`id_pengguna`),
  ADD KEY `idx_alat` (`id_alat`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id_alat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=523;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3020;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alat`
--
ALTER TABLE `alat`
  ADD CONSTRAINT `alat_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
