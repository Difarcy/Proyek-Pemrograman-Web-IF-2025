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

## Tampilan Website

### Halaman Login
![Screenshot (304)](https://github.com/user-attachments/assets/f6eab947-9a38-4522-90ef-6b6baa574170)

### Dashboard
![Screenshot (305)](https://github.com/user-attachments/assets/63989a70-8c45-4688-bb53-72df89d7948e)
![Screenshot (306)](https://github.com/user-attachments/assets/13d4f543-c943-4af5-a4f2-b4a0c4d09e2e)
![Screenshot (309)](https://github.com/user-attachments/assets/d6242d86-b813-4bac-8e59-34ae294ff360)
![Screenshot (307)](https://github.com/user-attachments/assets/94c4abda-6eee-482e-8b7b-eec22f2d28a3)

### Stok Barang
![Screenshot (310)](https://github.com/user-attachments/assets/7a9e2320-6c0f-49c5-b31d-3f0a45102af7)
![Screenshot (311)](https://github.com/user-attachments/assets/ce912cb0-509d-4348-90a4-e8700d0c4b1a)

### Barang Masuk
![Screenshot (313)](https://github.com/user-attachments/assets/b3aee8cf-99c7-4e00-b064-50c1504a2823)
![Screenshot (312)](https://github.com/user-attachments/assets/518100ed-78d5-4ea3-bca1-0b6492782167)

### Barang Keluar
![Screenshot (314)](https://github.com/user-attachments/assets/99019e01-69a8-4118-92ed-173e7a4de9f3)
![Screenshot (315)](https://github.com/user-attachments/assets/0d15c0ed-b67c-479e-b752-ca79a5397429)

### Data Customer
![Screenshot (317)](https://github.com/user-attachments/assets/137c7406-41c2-4907-a03c-0bb3e9c45ccb)
![Screenshot (316)](https://github.com/user-attachments/assets/cad42c30-91b4-4674-930f-955acce60ac8)

### Data Supplier
![Screenshot (318)](https://github.com/user-attachments/assets/c09a8fb6-53da-4aa9-a89e-5065b469f95d)
![Screenshot (319)](https://github.com/user-attachments/assets/f74fef4b-f3bd-4d86-af8b-dc23442c5eb4)

### Data Petugas
![Screenshot (320)](https://github.com/user-attachments/assets/d04be7f1-bc12-43ed-98e6-052188265591)
![Screenshot (321)](https://github.com/user-attachments/assets/5d7e4ad1-89c9-4b13-b895-b06c92d6ce39)

### Kelola Pengguna
![Screenshot (322)](https://github.com/user-attachments/assets/3ec82270-dc1b-4b5c-80e0-31252b1b73f9)

### Profil Toko
![Screenshot (323)](https://github.com/user-attachments/assets/c65c4bbe-e01e-4299-a654-d024125c05f1)

### Profil & Reset Password
![Screenshot (324)](https://github.com/user-attachments/assets/e560ef1c-8498-4189-b70b-3fdbba18c467)
![Screenshot (325)](https://github.com/user-attachments/assets/7b0f4294-f247-462f-ba91-87519f4991be)
![Screenshot (327)](https://github.com/user-attachments/assets/290de28a-e6a0-4da9-9a0c-8dce65914c49)
![Screenshot (328)](https://github.com/user-attachments/assets/de3a1494-cce1-4c01-afc7-5bf7b7e93083)
![Screenshot (330)](https://github.com/user-attachments/assets/a858fabd-63d8-4588-8138-436a0aebbad4)
![Screenshot (329)](https://github.com/user-attachments/assets/cd42794a-1b18-4c3d-83ec-1fecb10fd8be)

---

## Kontak & Media Sosial

- 📧 Email: difarcy [@] gmail.com
- 🌐 Facebook: https://www.facebook.com/difarcy/
- 📸 Instagram: https://www.instagram.com/difarcy/
