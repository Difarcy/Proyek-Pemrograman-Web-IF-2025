--
-- Database: `VSTOCK-App`
--
CREATE DATABASE IF NOT EXISTS `VSTOCK-App` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `VSTOCK-App`;

-- --------------------------------------------------------

--
-- Struktur tabel untuk `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','User') NOT NULL DEFAULT 'User',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'Admin'),
(2, 'user', 'user', 'User');

-- --------------------------------------------------------

--
-- Struktur tabel dummy untuk statistik dashboard (barang)
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang` (dummy)
--

INSERT INTO `barang` (`id`, `nama_barang`, `stok`) VALUES
(1, 'Semen Holcim', 100),
(2, 'Batu Bata Merah', 5000);

-- --------------------------------------------------------

--
-- Struktur tabel dummy untuk statistik dashboard (pengeluaran)
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengeluaran` (dummy)
--

INSERT INTO `pengeluaran` (`id`, `deskripsi`, `jumlah`) VALUES
(1, 'Gaji Karyawan', 2),
(2, 'Pembelian ATK', 1);

-- --------------------------------------------------------

--
-- Struktur tabel dummy untuk statistik dashboard (penerimaan)
--

CREATE TABLE `penerimaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penerimaan` (dummy)
--

INSERT INTO `penerimaan` (`id`, `deskripsi`, `jumlah`) VALUES
(1, 'Penjualan Barang A', 1); 