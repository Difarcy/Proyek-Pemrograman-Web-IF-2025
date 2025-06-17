-- Create database
CREATE DATABASE IF NOT EXISTS vstock;
USE vstock;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- Create barang table
CREATE TABLE IF NOT EXISTS barang (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(50) NOT NULL UNIQUE,
    nama_barang VARCHAR(100) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    satuan VARCHAR(20) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    deskripsi TEXT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- Create customer table
CREATE TABLE IF NOT EXISTS customer (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kode_customer VARCHAR(50) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    no_telp VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    status ENUM('aktif', 'nonaktif') NOT NULL DEFAULT 'aktif',
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- Create supplier table
CREATE TABLE IF NOT EXISTS supplier (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kode_supplier VARCHAR(50) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    no_telp VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    status ENUM('aktif', 'nonaktif') NOT NULL DEFAULT 'aktif',
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- Create petugas table
CREATE TABLE IF NOT EXISTS petugas (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nip VARCHAR(50) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jabatan VARCHAR(50) NOT NULL,
    no_telp VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    status ENUM('aktif', 'nonaktif') NOT NULL DEFAULT 'aktif',
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- Create barang_masuk table
CREATE TABLE IF NOT EXISTS barang_masuk (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    no_transaksi VARCHAR(50) NOT NULL UNIQUE,
    tanggal DATE NOT NULL,
    supplier_id INT UNSIGNED NOT NULL,
    barang_id INT UNSIGNED NOT NULL,
    jumlah INT NOT NULL,
    harga_beli DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    status ENUM('proses', 'selesai') NOT NULL DEFAULT 'proses',
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create barang_keluar table
CREATE TABLE IF NOT EXISTS barang_keluar (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    no_transaksi VARCHAR(50) NOT NULL UNIQUE,
    tanggal DATE NOT NULL,
    customer_id INT UNSIGNED NOT NULL,
    barang_id INT UNSIGNED NOT NULL,
    jumlah INT NOT NULL,
    harga_jual DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    status ENUM('proses', 'selesai') NOT NULL DEFAULT 'proses',
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    FOREIGN KEY (customer_id) REFERENCES customer(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create transaksi table
CREATE TABLE IF NOT EXISTS transaksi (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    no_transaksi VARCHAR(50) NOT NULL UNIQUE,
    tanggal DATE NOT NULL,
    jenis_transaksi ENUM('masuk', 'keluar') NOT NULL,
    customer_id INT UNSIGNED NULL,
    supplier_id INT UNSIGNED NULL,
    petugas_id INT UNSIGNED NOT NULL,
    total_items INT NOT NULL,
    total_harga DECIMAL(10,2) NOT NULL,
    status ENUM('proses', 'selesai') NOT NULL DEFAULT 'proses',
    keterangan TEXT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    FOREIGN KEY (customer_id) REFERENCES customer(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (petugas_id) REFERENCES petugas(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Insert default admin and user accounts
INSERT INTO users (username, password, role, created_at, updated_at) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NOW(), NOW()),
('user', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NOW(), NOW()); 