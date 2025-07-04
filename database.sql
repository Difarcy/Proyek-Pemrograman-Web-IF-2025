-- Membuat database
CREATE DATABASE IF NOT EXISTS vstock;
USE vstock;

-- Membuat tabel users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    role ENUM('admin','user') NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Membuat tabel barang
CREATE TABLE IF NOT EXISTS barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(20) NOT NULL UNIQUE,
    nama_barang VARCHAR(100) NOT NULL,
    jenis_barang VARCHAR(50) NOT NULL,
    merek_barang VARCHAR(50),
    stok INT NOT NULL DEFAULT 0,
    keterangan VARCHAR(500),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert akun admin dan user (password: password)
INSERT INTO users (username, password, nama, role) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin'),
('user', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'User Biasa', 'user');

-- Insert data toko bangunan
INSERT INTO barang (kode_barang, nama_barang, jenis_barang, merek_barang, stok, keterangan) VALUES
('TB001', 'Semen Portland', 'Semen', 'Gresik', 150, 'Semen untuk konstruksi umum'),
('TB002', 'Bata Merah', 'Bahan Bangunan', 'Lokal', 2000, 'Bata merah ukuran standar'),
('TB003', 'Pasir Beton', 'Pasir', 'Gunung', 500, 'Pasir untuk campuran beton'),
('TB004', 'Besi Beton', 'Besi', 'Krakatau Steel', 100, 'Besi beton diameter 10mm'),
('TB005', 'Cat Tembok', 'Cat', 'Dulux', 80, 'Cat tembok interior putih'),
('TB006', 'Paku Beton', 'Paku', 'Kencana', 5000, 'Paku beton 3 inch'),
('TB007', 'Kawat Bendrat', 'Kawat', 'Bendrat', 200, 'Kawat untuk pengikat besi'),
('TB008', 'Triplek', 'Kayu', 'Kayu Jati', 50, 'Triplek tebal 3mm'),
('TB009', 'Pipa PVC', 'Pipa', 'Wavin', 300, 'Pipa PVC diameter 4 inch'),
('TB010', 'Keramik Lantai', 'Keramik', 'Roman', 1000, 'Keramik lantai 40x40cm'),
('TB011', 'Semen Mortar', 'Semen', 'MU', 120, 'Semen mortar untuk plester'),
('TB012', 'Bata Ringan', 'Bahan Bangunan', 'Hebel', 800, 'Bata ringan ukuran 60x20x10cm'),
('TB013', 'Pasir Urug', 'Pasir', 'Sungai', 300, 'Pasir untuk urugan'),
('TB014', 'Besi Hollow', 'Besi', 'Galvalum', 150, 'Besi hollow 4x4cm'),
('TB015', 'Cat Kayu', 'Cat', 'Avian', 60, 'Cat kayu warna coklat'),
('TB016', 'Paku Kayu', 'Paku', 'Kencana', 8000, 'Paku kayu 2 inch'),
('TB017', 'Kawat Harmonika', 'Kawat', 'Harmonika', 100, 'Kawat harmonika 1x1m'),
('TB018', 'Multiplek', 'Kayu', 'Kayu Meranti', 80, 'Multiplek tebal 6mm'),
('TB019', 'Pipa Galvanis', 'Pipa', 'Spindo', 200, 'Pipa galvanis diameter 2 inch'),
('TB020', 'Keramik Dinding', 'Keramik', 'Granito', 800, 'Keramik dinding 25x40cm'); 