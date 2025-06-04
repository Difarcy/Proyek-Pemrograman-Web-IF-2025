<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'User') {
    header('Location: index.php');
    exit();
}
// Query jumlah barang
$jumlah_barang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM barang"));
$jumlah_barang = $jumlah_barang ? $jumlah_barang['total'] : 0;
// Query jumlah user
$jumlah_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"));
$jumlah_user = $jumlah_user ? $jumlah_user['total'] : 0;
// Query jumlah pengeluaran
$jumlah_pengeluaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM pengeluaran"));
$jumlah_pengeluaran = $jumlah_pengeluaran ? $jumlah_pengeluaran['total'] : 0;
// Query jumlah penerimaan
$jumlah_penerimaan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM penerimaan"));
$jumlah_penerimaan = $jumlah_penerimaan ? $jumlah_penerimaan['total'] : 0;
// Profil toko (dummy, bisa diubah ke database jika ada tabel profil)
$profil_toko = [
    'nama_toko' => 'Toko Bangunan Putra Jaya Perkasa II',
    'nama_pemilik' => 'Muhammad Inggyan',
    'no_telp' => '08383838323',
    'alamat' => 'pangalegan'
];
// Ambil data user login
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE username = '".$_SESSION['username']."'"));
$user_login = [
    'nama' => isset($user['username']) ? $user['username'] : '-',
    'username' => isset($user['username']) ? $user['username'] : '-',
    'role' => isset($user['role']) ? strtolower($user['role']) : '-',
    'jam_login' => date('H:i:s')
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #fff; }
        .card-stat { border: none; border-radius: 12px; box-shadow: 0 2px 16px rgba(44,62,80,0.06); }
        .card-stat .card-body { padding: 1.2rem 1rem; }
        .icon-box { width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; border-radius: 8px; margin-bottom: 8px; }
        .icon-blue { background: #f2f6fd; }
        .icon-green { background: #eafaf1; }
        .icon-gray { background: #f4f6f8; }
        .icon-orange { background: #fff8ed; }
        .label-stat { font-size: 0.93rem; color: #7b8ca0; font-weight: 500; }
        .value-stat { font-size: 1.4rem; font-weight: 700; color: #3a3a3a; }
        .profile-label { min-width: 120px; color: #7b8ca0; font-size: 0.98rem; }
        .profile-value { background: #f4f6f8; border: none; border-radius: 5px; color: #3a3a3a; font-size: 1rem; padding: 6px 10px; width: 100%; }
    </style>
</head>
<body>
    <div class="container py-4">
        <h2 class="mb-3" style="font-weight:500; color:#3a3a3a;">Halaman Dashboard User</h2>
        <div class="alert alert-success mb-4 py-2" role="alert">Login Berhasil!</div>
        <div class="row g-3 mb-4">
            <div class="col-md-3 col-6">
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="icon-box icon-blue mb-2">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2" fill="#3f72af"/><rect x="7" y="3" width="10" height="4" rx="1" fill="#dbe2ef"/></svg>
                        </div>
                        <div class="label-stat">JUMLAH BARANG</div>
                        <div class="value-stat"><?php echo $jumlah_barang; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="icon-box icon-green mb-2">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" fill="#3bb77e"/><rect x="4" y="16" width="16" height="5" rx="2.5" fill="#dbe2ef"/></svg>
                        </div>
                        <div class="label-stat">JUMLAH USER</div>
                        <div class="value-stat"><?php echo $jumlah_user; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="icon-box icon-gray mb-2">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24"><rect x="5" y="4" width="14" height="16" rx="2" fill="#bfc9d9"/><rect x="8" y="8" width="8" height="2" rx="1" fill="#fff"/><rect x="8" y="12" width="8" height="2" rx="1" fill="#fff"/></svg>
                        </div>
                        <div class="label-stat">JUMLAH PENGELUARAN</div>
                        <div class="value-stat"><?php echo $jumlah_pengeluaran; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="icon-box icon-orange mb-2">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24"><rect x="5" y="4" width="14" height="16" rx="2" fill="#ffb547"/><rect x="8" y="8" width="8" height="2" rx="1" fill="#fff"/><rect x="8" y="12" width="8" height="2" rx="1" fill="#fff"/></svg>
                        </div>
                        <div class="label-stat">JUMLAH PENERIMAAN</div>
                        <div class="value-stat"><?php echo $jumlah_penerimaan; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="card p-3">
                    <div class="mb-2" style="font-weight:500; color:#3a3a3a;">Profil Toko</div>
                    <div class="mb-2 d-flex align-items-center"><span class="profile-label">Nama Toko :</span><input type="text" class="profile-value ms-2" value="<?php echo $profil_toko['nama_toko']; ?>" readonly></div>
                    <div class="mb-2 d-flex align-items-center"><span class="profile-label">Nama Pemilik :</span><input type="text" class="profile-value ms-2" value="<?php echo $profil_toko['nama_pemilik']; ?>" readonly></div>
                    <div class="mb-2 d-flex align-items-center"><span class="profile-label">No Telepon :</span><input type="text" class="profile-value ms-2" value="<?php echo $profil_toko['no_telp']; ?>" readonly></div>
                    <div class="mb-2 d-flex align-items-center"><span class="profile-label">Alamat :</span><input type="text" class="profile-value ms-2" value="<?php echo $profil_toko['alamat']; ?>" readonly></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3">
                    <div class="mb-2" style="font-weight:500; color:#3a3a3a;">User Sedang Login</div>
                    <div class="mb-2 d-flex align-items-center"><span class="profile-label">Nama :</span><input type="text" class="profile-value ms-2" value="<?php echo $user_login['nama']; ?>" readonly></div>
                    <div class="mb-2 d-flex align-items-center"><span class="profile-label">Username :</span><input type="text" class="profile-value ms-2" value="<?php echo $user_login['username']; ?>" readonly></div>
                    <div class="mb-2 d-flex align-items-center"><span class="profile-label">Role :</span><input type="text" class="profile-value ms-2" value="<?php echo $user_login['role']; ?>" readonly></div>
                    <div class="mb-2 d-flex align-items-center"><span class="profile-label">Jam Login :</span><input type="text" class="profile-value ms-2" value="<?php echo $user_login['jam_login']; ?>" readonly></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 