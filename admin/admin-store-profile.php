<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header('Location: index.php');
    exit();
}
// Contoh data profil toko (nanti bisa diambil dari database jika ada tabelnya)
$profil_toko = [
    'nama_toko' => 'Toko Bangunan Putra Jaya Perkasa II',
    'nama_pemilik' => 'Muhammad Inggyan',
    'no_telp' => '08383838323',
    'alamat' => 'pangalengan'
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 16px rgba(44,62,80,0.06); }
    </style>
</head>
<body>
<div class="container py-4">
    <h4 class="mb-3" style="font-weight:500; color:#3a3a3a;">Profil Toko</h4>
    <div class="card p-4">
        <p class="text-muted">Isi Form Dibawah Ini!</p>
        <form>
            <div class="mb-3">
                <label for="namaToko" class="form-label">Nama Toko :</label>
                <input type="text" class="form-control" id="namaToko" value="<?php echo $profil_toko['nama_toko']; ?>">
            </div>
            <div class="mb-3">
                <label for="namaPemilik" class="form-label">Nama Pemilik :</label>
                <input type="text" class="form-control" id="namaPemilik" value="<?php echo $profil_toko['nama_pemilik']; ?>">
            </div>
            <div class="mb-3">
                <label for="noTelepon" class="form-label">No Telepon :</label>
                <input type="text" class="form-control" id="noTelepon" value="<?php echo $profil_toko['no_telp']; ?>">
            </div>
            <div class="mb-4">
                <label for="alamat" class="form-label">Alamat :</label>
                <input type="text" class="form-control" id="alamat" value="<?php echo $profil_toko['alamat']; ?>">
            </div>
            <div class="d-flex justify-content-start">
                 <button type="submit" class="btn btn-primary me-2"><i class="bi bi-save"></i> Simpan</button>
                 <button type="button" class="btn btn-success me-2"><i class="bi bi-pencil-square"></i> Ubah</button>
                 <button type="button" class="btn btn-danger"><i class="bi bi-x-circle"></i> Batal</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html> 