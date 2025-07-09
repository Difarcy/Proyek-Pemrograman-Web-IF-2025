-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2025 at 08:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vstock`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kategori_barang` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `satuan` varchar(20) NOT NULL DEFAULT 'Pcs',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `kategori_barang`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES
(2, 'BRG002', 'Batu Bata Merah', 'Material', 5000, 'Biji', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(3, 'BRG003', 'Pasir Bangunan', 'Material', 20, 'Truk', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(4, 'BRG004', 'Besi Beton 8mm', 'Material', 200, 'Batang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(5, 'BRG005', 'Cat Dulux 5L', 'Cat', 50, 'Kaleng', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(6, 'BRG006', 'Paku 5cm', 'Material', 10000, 'Kg', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(7, 'BRG007', 'Triplek 3mm', 'Kayu', 150, 'Lembar', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(8, 'BRG008', 'Keramik 40x40', 'Keramik', 300, 'Dus', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(9, 'BRG009', 'Kusen Aluminium', 'Aluminium', 80, 'Batang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(10, 'BRG010', 'Kabel NYA 2.5mm', 'Listrik', 500, 'Meter', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(11, 'BRG011', 'Lampu LED 12W', 'Listrik', 200, 'Biji', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(12, 'BRG012', 'Engsel Pintu', 'Aksesoris', 400, 'Biji', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(13, 'BRG013', 'Handle Pintu', 'Aksesoris', 300, 'Biji', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(14, 'BRG014', 'Cat Avian 1L', 'Cat', 100, 'Kaleng', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(15, 'BRG015', 'Pipa PVC 3/4\"', 'Plumbing', 250, 'Batang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(16, 'BRG016', 'Kran Air Plastik', 'Plumbing', 180, 'Biji', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(17, 'BRG017', 'Siku Besi', 'Material', 120, 'Batang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(18, 'BRG018', 'Gergaji Kayu', 'Alat', 60, 'Biji', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(19, 'BRG019', 'Obeng Plus', 'Alat', 90, 'Biji', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(20, 'BRG020', 'Sekop Pasir', 'Alat', 70, 'Biji', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(21, 'BRG021', 'Cat Nippon 5L', 'Cat', 60, 'Kaleng', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(22, 'BRG022', 'Paku 7cm', 'Material', 8000, 'Kg', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(23, 'BRG023', 'Triplek 6mm', 'Kayu', 100, 'Lembar', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(24, 'BRG024', 'Keramik 60x60', 'Keramik', 200, 'Dus', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(25, 'BRG025', 'Kusen Kayu', 'Kayu', 50, 'Batang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(26, 'BRG026', 'Kabel NYM 1.5mm', 'Listrik', 300, 'Meter', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(27, 'BRG027', 'Lampu LED 18W', 'Listrik', 150, 'Biji', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(28, 'BRG028', 'Engsel Jendela', 'Aksesoris', 350, 'Biji', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(29, 'BRG029', 'Handle Jendela', 'Aksesoris', 250, 'Biji', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(30, 'BRG030', 'Pipa PVC 1\"', 'Plumbing', 200, 'Batang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(31, 'TB031', 'Semen', 'Semen Portland', 60, 'Sak', '2025-07-09 04:07:36', '2025-07-09 04:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` int(11) NOT NULL,
  `no_surat_jalan` varchar(30) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `customer` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL DEFAULT 'Pcs',
  `petugas` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `no_surat_jalan`, `tanggal_keluar`, `customer`, `nama_barang`, `jumlah`, `satuan`, `petugas`, `created_at`, `updated_at`) VALUES
(3, 'BK003', '2025-07-02', 'Citra Dewi', 'Pasir Bangunan', 1, 'Truk', 'Cici Paramita', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(4, 'BK004', '2025-07-02', 'Dedi Pratama', 'Besi Beton 8mm', 20, 'Batang', 'Dewi Sartika', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(5, 'BK005', '2025-07-03', 'Eka Putri', 'Cat Dulux 5L', 2, 'Kaleng', 'Eko Prasetyo', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(6, 'BK006', '2025-07-03', 'Fajar Hidayat', 'Paku 5cm', 100, 'Kg', 'Fajar Nugraha', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(7, 'BK007', '2025-07-04', 'Gita Sari', 'Triplek 3mm', 5, 'Lembar', 'Gilang Ramadhan', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(8, 'BK008', '2025-07-04', 'Hadi Saputra', 'Keramik 40x40', 10, 'Dus', 'Hanafi', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(9, 'BK009', '2025-07-05', 'Indah Lestari', 'Kusen Aluminium', 2, 'Batang', 'Indra Lesmana', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(10, 'BK010', '2025-07-05', 'Joko Susilo', 'Kabel NYA 2.5mm', 50, 'Meter', 'Joko Widodo', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(11, 'BK011', '2025-07-06', 'Kiki Amalia', 'Lampu LED 12W', 10, 'Biji', 'Kiki Rizki', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(12, 'BK012', '2025-07-06', 'Lina Marlina', 'Engsel Pintu', 20, 'Biji', 'Lina Marlina', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(13, 'BK013', '2025-07-07', 'Maya Sari', 'Handle Pintu', 15, 'Biji', 'Maya Sari', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(14, 'BK014', '2025-07-07', 'Nina Agustina', 'Cat Avian 1L', 5, 'Kaleng', 'Nina Agustina', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(15, 'BK015', '2025-07-08', 'Oki Setiawan', 'Pipa PVC 3/4\"', 10, 'Batang', 'Oki Setiawan', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(16, 'BK016', '2025-07-08', 'Putri Ayu', 'Kran Air Plastik', 8, 'Biji', 'Putri Ayu', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(17, 'BK017', '2025-07-09', 'Qori Rahman', 'Siku Besi', 6, 'Batang', 'Qori Rahman', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(18, 'BK018', '2025-07-09', 'Rina Oktaviani', 'Gergaji Kayu', 4, 'Biji', 'Rina Oktaviani', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(19, 'BK019', '2025-07-10', 'Sari Dewi', 'Obeng Plus', 10, 'Biji', 'Sari Dewi', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(20, 'BK020', '2025-07-10', 'Tono Prabowo', 'Sekop Pasir', 5, 'Biji', 'Tono Prabowo', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(21, 'BK021', '2025-07-11', 'Umar Sulaiman', 'Cat Nippon 5L', 3, 'Kaleng', 'Ujang Suryana', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(22, 'BK022', '2025-07-11', 'Vina Oktavia', 'Paku 7cm', 200, 'Kg', 'Vera Oktaviani', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(23, 'BK023', '2025-07-12', 'Wawan Hermawan', 'Triplek 6mm', 2, 'Lembar', 'Wahyu Hidayat', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(24, 'BK024', '2025-07-12', 'Xenia Putra', 'Keramik 60x60', 4, 'Dus', 'Xaverius Dwi', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(25, 'BK025', '2025-07-13', 'Yusuf Maulana', 'Kusen Kayu', 1, 'Batang', 'Yani Suryani', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(26, 'BK026', '2025-07-13', 'Zahra Aulia', 'Kabel NYM 1.5mm', 30, 'Meter', 'Zulfan Maulana', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(27, 'BK027', '2025-07-14', 'Bambang Pamungkas', 'Lampu LED 18W', 5, 'Biji', 'Bagus Prakoso', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(28, 'BK028', '2025-07-14', 'Cahya Ramadhan', 'Engsel Jendela', 10, 'Biji', 'Cahya Putra', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(29, 'BK029', '2025-07-15', 'Dewi Lestari', 'Handle Jendela', 8, 'Biji', 'Dian Lestari', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(30, 'BK030', '2025-07-15', 'Erlangga Saputra', 'Pipa PVC 1\"', 12, 'Batang', 'Erlangga Pratama', '2025-07-09 05:39:38', '2025-07-09 05:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(11) NOT NULL,
  `no_surat_jalan` varchar(30) NOT NULL,
  `tanggal_terima` date NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL DEFAULT 'Pcs',
  `petugas` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `no_surat_jalan`, `tanggal_terima`, `supplier`, `nama_barang`, `jumlah`, `satuan`, `petugas`, `created_at`, `updated_at`) VALUES
(3, 'SJ003', '2025-07-02', 'PT. Sinar Terang', 'Pasir Bangunan', 2, 'Truk', 'Cici Paramita', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(4, 'SJ004', '2025-07-02', 'CV. Cahaya Abadi', 'Besi Beton 8mm', 50, 'Batang', 'Dewi Sartika', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(5, 'SJ005', '2025-07-03', 'PT. Mitra Usaha', 'Cat Dulux 5L', 10, 'Kaleng', 'Eko Prasetyo', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(6, 'SJ006', '2025-07-03', 'CV. Karya Bersama', 'Paku 5cm', 500, 'Kg', 'Fajar Nugraha', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(7, 'SJ007', '2025-07-04', 'PT. Sukses Mandiri', 'Triplek 3mm', 20, 'Lembar', 'Gilang Ramadhan', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(8, 'SJ008', '2025-07-04', 'CV. Maju Jaya', 'Keramik 40x40', 30, 'Dus', 'Hanafi', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(9, 'SJ009', '2025-07-05', 'PT. Sentosa', 'Kusen Aluminium', 10, 'Batang', 'Indra Lesmana', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(10, 'SJ010', '2025-07-05', 'CV. Sejahtera', 'Kabel NYA 2.5mm', 100, 'Meter', 'Joko Widodo', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(11, 'SJ011', '2025-07-06', 'PT. Makmur Abadi', 'Lampu LED 12W', 40, 'Biji', 'Kiki Rizki', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(12, 'SJ012', '2025-07-06', 'CV. Sinar Baru', 'Engsel Pintu', 80, 'Biji', 'Lina Marlina', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(13, 'SJ013', '2025-07-07', 'PT. Karya Sukses', 'Handle Pintu', 60, 'Biji', 'Maya Sari', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(14, 'SJ014', '2025-07-07', 'CV. Cahaya Baru', 'Cat Avian 1L', 20, 'Kaleng', 'Nina Agustina', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(15, 'SJ015', '2025-07-08', 'PT. Sumber Rejeki', 'Pipa PVC 3/4\"', 50, 'Batang', 'Oki Setiawan', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(16, 'SJ016', '2025-07-08', 'CV. Maju Bersama', 'Kran Air Plastik', 30, 'Biji', 'Putri Ayu', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(17, 'SJ017', '2025-07-09', 'PT. Sinar Makmur', 'Siku Besi', 15, 'Batang', 'Qori Rahman', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(18, 'SJ018', '2025-07-09', 'CV. Sukses Bersama', 'Gergaji Kayu', 10, 'Biji', 'Rina Oktaviani', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(19, 'SJ019', '2025-07-10', 'PT. Jaya Abadi', 'Obeng Plus', 20, 'Biji', 'Sari Dewi', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(20, 'SJ020', '2025-07-10', 'CV. Makmur Jaya', 'Sekop Pasir', 10, 'Biji', 'Tono Prabowo', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(21, 'SJ021', '2025-07-11', 'PT. Bangun Sejahtera', 'Cat Nippon 5L', 15, 'Kaleng', 'Ujang Suryana', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(22, 'SJ022', '2025-07-11', 'CV. Sumber Rejeki', 'Paku 7cm', 600, 'Kg', 'Vera Oktaviani', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(23, 'SJ023', '2025-07-12', 'PT. Cahaya Mandiri', 'Triplek 6mm', 10, 'Lembar', 'Wahyu Hidayat', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(24, 'SJ024', '2025-07-12', 'CV. Maju Sukses', 'Keramik 60x60', 25, 'Dus', 'Xaverius Dwi', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(25, 'SJ025', '2025-07-13', 'PT. Sinar Abadi', 'Kusen Kayu', 8, 'Batang', 'Yani Suryani', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(26, 'SJ026', '2025-07-13', 'CV. Karya Makmur', 'Kabel NYM 1.5mm', 120, 'Meter', 'Zulfan Maulana', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(27, 'SJ027', '2025-07-14', 'PT. Jaya Bersama', 'Lampu LED 18W', 30, 'Biji', 'Bagus Prakoso', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(28, 'SJ028', '2025-07-14', 'CV. Sukses Makmur', 'Engsel Jendela', 70, 'Biji', 'Cahya Putra', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(29, 'SJ029', '2025-07-15', 'PT. Makmur Sentosa', 'Handle Jendela', 40, 'Biji', 'Dian Lestari', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(30, 'SJ030', '2025-07-15', 'CV. Jaya Sukses', 'Pipa PVC 1\"', 60, 'Batang', 'Erlangga Pratama', '2025-07-09 05:39:38', '2025-07-09 05:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `kode_customer` varchar(20) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `kode_customer`, `nama_customer`, `alamat`, `telepon`, `kota`, `created_at`, `updated_at`) VALUES
(2, 'CUST002', 'Budi Santoso', 'Jl. Mawar No. 2', '0811111112', 'Bandung', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(3, 'CUST003', 'Citra Dewi', 'Jl. Kenanga No. 3', '0811111113', 'Surabaya', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(4, 'CUST004', 'Dedi Pratama', 'Jl. Anggrek No. 4', '0811111114', 'Medan', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(5, 'CUST005', 'Eka Putri', 'Jl. Dahlia No. 5', '0811111115', 'Semarang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(6, 'CUST006', 'Fajar Hidayat', 'Jl. Flamboyan No. 6', '0811111116', 'Palembang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(7, 'CUST007', 'Gita Sari', 'Jl. Cempaka No. 7', '0811111117', 'Makassar', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(8, 'CUST008', 'Hadi Saputra', 'Jl. Teratai No. 8', '0811111118', 'Yogyakarta', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(9, 'CUST009', 'Indah Lestari', 'Jl. Sawo No. 9', '0811111119', 'Denpasar', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(10, 'CUST010', 'Joko Susilo', 'Jl. Mangga No. 10', '0811111120', 'Malang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(11, 'CUST011', 'Kiki Amalia', 'Jl. Rambutan No. 11', '0811111121', 'Padang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(12, 'CUST012', 'Lina Marlina', 'Jl. Durian No. 12', '0811111122', 'Pontianak', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(13, 'CUST013', 'Maya Sari', 'Jl. Apel No. 13', '0811111123', 'Balikpapan', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(14, 'CUST014', 'Nina Agustina', 'Jl. Pisang No. 14', '0811111124', 'Batam', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(15, 'CUST015', 'Oki Setiawan', 'Jl. Pepaya No. 15', '0811111125', 'Pekanbaru', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(16, 'CUST016', 'Putri Ayu', 'Jl. Jambu No. 16', '0811111126', 'Cirebon', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(17, 'CUST017', 'Qori Rahman', 'Jl. Duku No. 17', '0811111127', 'Solo', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(18, 'CUST018', 'Rina Oktaviani', 'Jl. Nangka No. 18', '0811111128', 'Banjarmasin', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(19, 'CUST019', 'Sari Dewi', 'Jl. Alpukat No. 19', '0811111129', 'Palangkaraya', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(20, 'CUST020', 'Tono Prabowo', 'Jl. Sirsak No. 20', '0811111130', 'Manado', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(21, 'CUST021', 'Umar Sulaiman', 'Jl. Kamboja No. 21', '0811111131', 'Bekasi', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(22, 'CUST022', 'Vina Oktavia', 'Jl. Wijaya Kusuma No. 22', '0811111132', 'Depok', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(23, 'CUST023', 'Wawan Hermawan', 'Jl. Palem No. 23', '0811111133', 'Tangerang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(24, 'CUST024', 'Xenia Putra', 'Jl. Cemara No. 24', '0811111134', 'Bogor', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(25, 'CUST025', 'Yusuf Maulana', 'Jl. Pinang No. 25', '0811111135', 'Cilegon', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(26, 'CUST026', 'Zahra Aulia', 'Jl. Akasia No. 26', '0811111136', 'Serang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(27, 'CUST027', 'Bambang Pamungkas', 'Jl. Jati No. 27', '0811111137', 'Samarinda', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(28, 'CUST028', 'Cahya Ramadhan', 'Jl. Beringin No. 28', '0811111138', 'Balikpapan', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(29, 'CUST029', 'Dewi Lestari', 'Jl. Mahoni No. 29', '0811111139', 'Pontianak', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(30, 'CUST030', 'Erlangga Saputra', 'Jl. Pinus No. 30', '0811111140', 'Padang', '2025-07-09 05:39:38', '2025-07-09 05:39:38');

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
(1, '2025-07-09-052701', 'App\\Database\\Migrations\\AddForceLogoutToUser', 'default', 'App', 1752038853, 1);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `kode_petugas` varchar(20) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `kode_petugas`, `nama_petugas`, `jabatan`, `telepon`, `alamat`, `kota`, `created_at`, `updated_at`) VALUES
(2, 'PTG002', 'Bambang Setiawan', 'Petugas', '0812222002', 'Jl. Merdeka No. 2', 'Bandung', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(3, 'PTG003', 'Cici Paramita', 'Petugas', '0812222003', 'Jl. Merdeka No. 3', 'Surabaya', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(4, 'PTG004', 'Dewi Sartika', 'Admin', '0812222004', 'Jl. Merdeka No. 4', 'Medan', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(5, 'PTG005', 'Eko Prasetyo', 'Petugas', '0812222005', 'Jl. Merdeka No. 5', 'Semarang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(6, 'PTG006', 'Fajar Nugraha', 'Petugas', '0812222006', 'Jl. Merdeka No. 6', 'Palembang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(7, 'PTG007', 'Gilang Ramadhan', 'Admin', '0812222007', 'Jl. Merdeka No. 7', 'Makassar', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(8, 'PTG008', 'Hanafi', 'Petugas', '0812222008', 'Jl. Merdeka No. 8', 'Yogyakarta', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(9, 'PTG009', 'Indra Lesmana', 'Petugas', '0812222009', 'Jl. Merdeka No. 9', 'Denpasar', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(10, 'PTG010', 'Joko Widodo', 'Admin', '0812222010', 'Jl. Merdeka No. 10', 'Malang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(11, 'PTG011', 'Kiki Rizki', 'Petugas', '0812222011', 'Jl. Merdeka No. 11', 'Padang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(12, 'PTG012', 'Lina Marlina', 'Petugas', '0812222012', 'Jl. Merdeka No. 12', 'Pontianak', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(13, 'PTG013', 'Maya Sari', 'Admin', '0812222013', 'Jl. Merdeka No. 13', 'Balikpapan', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(14, 'PTG014', 'Nina Agustina', 'Petugas', '0812222014', 'Jl. Merdeka No. 14', 'Batam', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(15, 'PTG015', 'Oki Setiawan', 'Petugas', '0812222015', 'Jl. Merdeka No. 15', 'Pekanbaru', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(16, 'PTG016', 'Putri Ayu', 'Admin', '0812222016', 'Jl. Merdeka No. 16', 'Cirebon', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(17, 'PTG017', 'Qori Rahman', 'Petugas', '0812222017', 'Jl. Merdeka No. 17', 'Solo', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(18, 'PTG018', 'Rina Oktaviani', 'Petugas', '0812222018', 'Jl. Merdeka No. 18', 'Banjarmasin', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(19, 'PTG019', 'Sari Dewi', 'Admin', '0812222019', 'Jl. Merdeka No. 19', 'Palangkaraya', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(20, 'PTG020', 'Tono Prabowo', 'Petugas', '0812222020', 'Jl. Merdeka No. 20', 'Manado', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(21, 'PTG021', 'Ujang Suryana', 'Petugas', '0812222021', 'Jl. Siliwangi No. 21', 'Cimahi', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(22, 'PTG022', 'Vera Oktaviani', 'Admin', '0812222022', 'Jl. Diponegoro No. 22', 'Tasikmalaya', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(23, 'PTG023', 'Wahyu Hidayat', 'Petugas', '0812222023', 'Jl. Ahmad Yani No. 23', 'Garut', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(24, 'PTG024', 'Xaverius Dwi', 'Petugas', '0812222024', 'Jl. Pajajaran No. 24', 'Bogor', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(25, 'PTG025', 'Yani Suryani', 'Admin', '0812222025', 'Jl. Sudirman No. 25', 'Cianjur', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(26, 'PTG026', 'Zulfan Maulana', 'Petugas', '0812222026', 'Jl. Gatot Subroto No. 26', 'Serang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(27, 'PTG027', 'Bagus Prakoso', 'Petugas', '0812222027', 'Jl. Gajah Mada No. 27', 'Solo', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(28, 'PTG028', 'Cahya Putra', 'Admin', '0812222028', 'Jl. Dipatiukur No. 28', 'Bandung', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(29, 'PTG029', 'Dian Lestari', 'Petugas', '0812222029', 'Jl. Cendana No. 29', 'Yogyakarta', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(30, 'PTG030', 'Erlangga Pratama', 'Admin', '0812222030', 'Jl. Mangga No. 30', 'Jakarta', '2025-07-09 05:39:38', '2025-07-09 05:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `profil_toko`
--

CREATE TABLE `profil_toko` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil_toko`
--

INSERT INTO `profil_toko` (`id`, `nama_toko`, `nama_pemilik`, `no_telepon`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Toko Bangunan Putra Jaya Perkasa II', 'Muhammad Inggryan', '081234567888', 'Jl. Pangalengan No. 123, Bandung', '1752033614_a4c19c7eeb152f1c2754.png', '2025-07-09 05:39:38', '2025-07-09 05:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `kode_supplier` varchar(20) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `kode_supplier`, `nama_supplier`, `alamat`, `telepon`, `kota`, `created_at`, `updated_at`) VALUES
(2, 'SUP002', 'CV. Sumber Makmur', 'Jl. Industri No. 2', '0821111102', 'Bandung', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(3, 'SUP003', 'PT. Sinar Terang', 'Jl. Industri No. 3', '0821111103', 'Surabaya', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(4, 'SUP004', 'CV. Cahaya Abadi', 'Jl. Industri No. 4', '0821111104', 'Medan', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(5, 'SUP005', 'PT. Mitra Usaha', 'Jl. Industri No. 5', '0821111105', 'Semarang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(6, 'SUP006', 'CV. Karya Bersama', 'Jl. Industri No. 6', '0821111106', 'Palembang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(7, 'SUP007', 'PT. Sukses Mandiri', 'Jl. Industri No. 7', '0821111107', 'Makassar', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(8, 'SUP008', 'CV. Maju Jaya', 'Jl. Industri No. 8', '0821111108', 'Yogyakarta', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(9, 'SUP009', 'PT. Sentosa', 'Jl. Industri No. 9', '0821111109', 'Denpasar', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(10, 'SUP010', 'CV. Sejahtera', 'Jl. Industri No. 10', '0821111110', 'Malang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(11, 'SUP011', 'PT. Makmur Abadi', 'Jl. Industri No. 11', '0821111111', 'Padang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(12, 'SUP012', 'CV. Sinar Baru', 'Jl. Industri No. 12', '0821111112', 'Pontianak', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(13, 'SUP013', 'PT. Karya Sukses', 'Jl. Industri No. 13', '0821111113', 'Balikpapan', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(14, 'SUP014', 'CV. Cahaya Baru', 'Jl. Industri No. 14', '0821111114', 'Batam', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(15, 'SUP015', 'PT. Sumber Rejeki', 'Jl. Industri No. 15', '0821111115', 'Pekanbaru', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(16, 'SUP016', 'CV. Maju Bersama', 'Jl. Industri No. 16', '0821111116', 'Cirebon', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(17, 'SUP017', 'PT. Sinar Makmur', 'Jl. Industri No. 17', '0821111117', 'Solo', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(18, 'SUP018', 'CV. Sukses Bersama', 'Jl. Industri No. 18', '0821111118', 'Banjarmasin', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(19, 'SUP019', 'PT. Jaya Abadi', 'Jl. Industri No. 19', '0821111119', 'Palangkaraya', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(20, 'SUP020', 'CV. Makmur Jaya', 'Jl. Industri No. 20', '0821111120', 'Manado', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(21, 'SUP021', 'PT. Bangun Sejahtera', 'Jl. Industri No. 21', '0821111121', 'Bekasi', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(22, 'SUP022', 'CV. Sumber Rejeki', 'Jl. Industri No. 22', '0821111122', 'Depok', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(23, 'SUP023', 'PT. Cahaya Mandiri', 'Jl. Industri No. 23', '0821111123', 'Tangerang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(24, 'SUP024', 'CV. Maju Sukses', 'Jl. Industri No. 24', '0821111124', 'Bogor', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(25, 'SUP025', 'PT. Sinar Abadi', 'Jl. Industri No. 25', '0821111125', 'Cilegon', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(26, 'SUP026', 'CV. Karya Makmur', 'Jl. Industri No. 26', '0821111126', 'Serang', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(27, 'SUP027', 'PT. Jaya Bersama', 'Jl. Industri No. 27', '0821111127', 'Samarinda', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(28, 'SUP028', 'CV. Sukses Makmur', 'Jl. Industri No. 28', '0821111128', 'Balikpapan', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(29, 'SUP029', 'PT. Makmur Sentosa', 'Jl. Industri No. 29', '0821111129', 'Pontianak', '2025-07-09 05:39:38', '2025-07-09 05:39:38'),
(30, 'SUP030', 'CV. Jaya Sukses', 'Jl. Industri No. 30', '0821111130', 'Padang', '2025-07-09 05:39:38', '2025-07-09 05:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `force_logout` tinyint(1) DEFAULT 0,
  `no_telepon` varchar(25) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `role`, `status`, `force_logout`, `no_telepon`, `alamat`, `foto`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$sJ7G/UOl8MMPk0a0FHcne.u17oNM3RyGzTCDcpblaDZqabo83qAWm', 'admin', 'admin', 'active', 0, '082280005040', 'Jl. Melati No. 10, Jakarta Selatan', '1752033627_525c9f018e07885189ad.png', '2025-07-09 05:56:10', '2025-07-09 05:39:38', '2025-07-09 05:56:10'),
(2, 'difar', '$2y$10$hutTWoFoKORlx5.WCNiJ6.3wqSxPMI9PRPJiabnzDuXPWP7ldJQ6W', 'difar', 'user', 'active', 0, '082110009877', 'Jl. Kenanga No. 25, Bandung Barat', '1752033444_1ccfc15629d6e017dfb4.png', '2025-07-09 05:46:28', '2025-07-09 05:39:38', '2025-07-09 05:53:51'),
-- Perubahan: role akun 'user' diubah dari 'admin' menjadi 'user' agar muncul di kelola pengguna
(3, 'user', '$2y$10$WDd1pyla2n1OkqFREZGhY.HLI5DkZHsQK9kDvRSlt8BMphs6SYZS.', 'User', 'user', 'active', 0, NULL, NULL, NULL, NULL, '2025-07-09 05:50:20', '2025-07-09 05:50:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_customer` (`kode_customer`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_petugas` (`kode_petugas`);

--
-- Indexes for table `profil_toko`
--
ALTER TABLE `profil_toko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_supplier` (`kode_supplier`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `profil_toko`
--
ALTER TABLE `profil_toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
