# Informasi Mahasiswa
```
Nama          : Jafar Siddik Aulia Rahman  
NIM           : 301220005  
Fakultas/Prodi: FTI / Pemrograman Internet (Semester 6)  
Universitas   : Universitas Bale Bandung  
```

Tugas ini merupakan pengembangan aplikasi berbasis web yang merujuk dan mengadaptasi dari skripsi berjudul:
"Rancang Bangun Aplikasi VStock Menggunakan Codeigniter Untuk Mengelola Data Barang di TB Putra Jaya Perkasa II"
Karya: Teja Kusumah (NPM 301200033) – Program Studi Teknik Informatika, FTI, Universitas Bale Bandung, 2024.

---

# Requirement Sistem

- PHP >= 7.4
- Codeigniter 4
- MySQL/MariaDB
- Composer
- Web server (XAMPP/Laragon/Apache/Nginx)
- Browser modern (Chrome, Firefox, Edge, dsb)

---

# Petunjuk Penggunaan di GitHub

Berikut langkah-langkah untuk menjalankan aplikasi ini secara lokal:

1. **Clone repository**
   ```bash
   git clone https://github.com/USERNAME/REPO-NAME.git
   cd REPO-NAME
   ```
2. **Install dependency PHP (composer)**
   ```bash
   composer install
   ```
3. **Buat database dan import file SQL**
   - Buat database baru di MySQL/MariaDB (misal: `vstock`).
   - Import file `database.sql` ke database tersebut.
4. **Atur konfigurasi database**
   - Edit file `app/Config/Database.php` dan sesuaikan username, password, dan nama database sesuai environment lokal Anda.
5. **Jalankan aplikasi**
   - Jika menggunakan XAMPP/Laragon, letakkan folder project di `htdocs`/`www`.
   - Akses melalui browser: `http://localhost/REPO-NAME/public` atau sesuai setup Anda.
6. **Login dengan akun default** (lihat bagian Akun Default Demo di bawah).

> Untuk kontributor: silakan fork, buat branch baru untuk fitur/bugfix, lalu ajukan pull request.

---

# Tentang Website VStock

**VStock** adalah aplikasi web untuk manajemen stok dan distribusi barang pada toko bangunan. Website ini memudahkan admin dan petugas dalam mengelola data barang, pemasukan, pengeluaran, supplier, customer, serta monitoring stok secara real-time.

## Fitur Utama
- **Manajemen Barang**: Tambah, edit, hapus, dan pencarian data barang.
- **Barang Masuk & Keluar**: Pencatatan transaksi barang masuk dan keluar, dengan filter tanggal, pencarian, dan export data (Excel, PDF, CSV).
- **Manajemen Supplier & Customer**: Kelola data supplier dan customer, termasuk pencarian dan filter kota.
- **Manajemen Petugas**: Kelola data petugas toko beserta jabatan.
- **Dashboard**: Statistik ringkas, grafik stok, dan aktivitas terakhir.
- **Profil Toko**: Informasi profil toko dapat diubah oleh admin.
- **Autentikasi Multi-Role**: Login sebagai admin atau user (petugas), dengan tampilan dan akses berbeda.
- **Reset Password**: Fitur reset password untuk keamanan akun.
- **Pagination & Pencarian**: Semua data utama mendukung pencarian dan pagination.
- **Export & Cetak**: Data dapat diexport ke Excel, PDF, CSV, dan dicetak langsung.

## Halaman-Halaman Utama
- **Login**: Halaman masuk untuk admin dan user.
- **Dashboard**: Statistik, grafik, dan ringkasan aktivitas.
- **Stok Barang**: Daftar barang beserta stok dan detailnya.
- **Barang Masuk**: Riwayat dan input barang masuk.
- **Barang Keluar**: Riwayat dan input barang keluar.
- **Data Supplier**: Manajemen data supplier.
- **Data Customer**: Manajemen data customer.
- **Data Petugas**: Manajemen data petugas toko.
- **Profil Toko**: Informasi dan pengaturan profil toko.
- **Reset Password**: Ubah password akun.

## Akun Default Demo
Untuk keperluan demo/testing, berikut akun default yang dapat digunakan:

**Admin**
- Username: `admin`
- Password: `password`

**User/Petugas**
- Username: `petugas`
- Password: `password`

---

Website ini dikembangkan untuk membantu digitalisasi manajemen stok (gudang) pada toko bangunan, serta memudahkan monitoring dan pelaporan bagi pemilik maupun petugas.

---

## Kontak & Media Sosial

- 📧 Email: difarcy [@] gmail.com
- 🌐 Facebook: https://www.facebook.com/difarcy/
- 📸 Instagram: https://www.instagram.com/difarcy/
