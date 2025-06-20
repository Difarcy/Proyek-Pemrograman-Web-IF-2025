# Informasi Mahasiswa

Nama: Jafar Siddik Aulia Rahman  
NIM: 301220005  
Fakultas/Prodi: FTI / Pemrograman Internet (Semester 6)  
Universitas: Universitas Bale Bandung  

Tugas ini merupakan pengembangan aplikasi berbasis web yang merujuk dan mengadaptasi dari skripsi berjudul:
"Rancang Bangun Aplikasi VStock Menggunakan Codeigniter Untuk Mengelola Data Barang di TB Putra Jaya Perkasa II"
Karya: Teja Kusumah (NPM 301200033) – Program Studi Teknik Informatika, FTI, Universitas Bale Bandung, 2024.

## Repository GitHub
Repository ini dapat diakses melalui: [https://github.com/Difarcy/Proyek-Pemrograman-Web-IF-2025.git](https://github.com/Difarcy/Proyek-Pemrograman-Web-IF-2025.git)

### Cara Mengakses Repository
1. Menggunakan Git Clone:
```bash
git clone https://github.com/Difarcy/Proyek-Pemrograman-Web-IF-2025.git
```

2. Menggunakan Download ZIP:
   - Kunjungi [https://github.com/Difarcy/Proyek-Pemrograman-Web-IF-2025](https://github.com/Difarcy/Proyek-Pemrograman-Web-IF-2025)
   - Klik tombol "Code" (tombol hijau)
   - Pilih "Download ZIP"
   - Ekstrak file ZIP yang didownload

# VSTOCK - Sistem Manajemen Stok Barang

VSTOCK adalah sistem manajemen stok barang berbasis web yang dikembangkan menggunakan CodeIgniter 4. Sistem ini dirancang untuk membantu pengelolaan stok barang, data customer, supplier, dan transaksi barang masuk/keluar.

## Fitur Utama

### Admin

#### Dashboard
- Tampilan ringkasan data stok  
- Statistik barang masuk & keluar  
- Grafik penjualan  

#### Stok Barang
- Manajemen data barang  
- Monitoring stok  
- Kategori barang  

#### Barang Masuk
- Pencatatan barang masuk  
- Riwayat barang masuk  
- Laporan barang masuk  

#### Barang Keluar
- Pencatatan barang keluar  
- Riwayat barang keluar  
- Laporan barang keluar  

#### Data Customer
- Daftar customer  
- Riwayat transaksi customer  
- Informasi kontak  

#### Data Supplier
- Daftar supplier  
- Riwayat pembelian  
- Informasi kontak  

#### Data Petugas
- Daftar petugas  
- Informasi petugas  
- Riwayat aktivitas  

#### Laporan
- Laporan stok  
- Laporan penjualan  
- Laporan pembelian  
- Export laporan  

#### Manajemen Pengguna
- Tambah pengguna baru  
- Edit & hapus pengguna  
- Atur hak akses  

#### Profil Toko
- Informasi toko  
- Pengaturan toko  
- Logo & identitas toko  

---

### User

#### Dashboard
- Tampilan ringkasan data stok  
- Statistik barang masuk & keluar  

#### Stok Barang
- Lihat data barang  
- Monitoring stok  

#### Barang Masuk
- Pencatatan barang masuk  
- Riwayat barang masuk  

#### Barang Keluar
- Pencatatan barang keluar  
- Riwayat barang keluar  

#### Data Customer
- Lihat data customer  
- Riwayat transaksi  

#### Data Supplier
- Lihat data supplier  
- Riwayat pembelian  

#### Data Petugas
- Lihat data petugas  
- Informasi petugas  

#### Laporan
- Lihat laporan stok  
- Lihat laporan transaksi  

## Teknologi yang Digunakan

- PHP 7.4 atau lebih tinggi
- CodeIgniter 4
- MySQL
- Bootstrap 5
- Font Awesome
- Google Fonts (Inter)

## Persyaratan Sistem

- PHP >= 7.4
- MySQL >= 5.7
- Web Server (Apache/Nginx)
- Composer

## Instalasi

1. Clone repository
```bash
git clone https://github.com/Difarcy/Proyek-Pemrograman-Web-IF-2025.git
```

2. Install dependencies
```bash
composer install
```

3. Copy file .env.example menjadi .env
```bash
cp .env.example .env
```

4. Konfigurasi database di file .env
```
database.default.hostname = localhost
database.default.database = vstock
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

5. Jalankan migrasi database
```bash
php spark migrate
```

6. Jalankan seeder untuk membuat user default
```bash
php spark db:seed UserSeeder
```

## Akun Default

### Admin
- Username: admin
- Password: password

### User
- Username: user
- Password: password

## Struktur Folder

```
app/
├── Config/         # Konfigurasi aplikasi
├── Controllers/    # Controller
├── Database/       # Migrasi dan seeder
├── Models/         # Model
└── Views/          # View
    ├── admin/      # View untuk admin
    ├── auth/       # View autentikasi
    └── user/       # View untuk user
```

## Kontribusi

Silakan buat pull request untuk kontribusi. Untuk perubahan besar, harap buka issue terlebih dahulu untuk mendiskusikan perubahan yang diinginkan.
