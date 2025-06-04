<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header('Location: index.php');
    exit();
}
// Contoh data customer (bisa diubah ke data pengembalian)
$data_customer = [
    ["kode"=>"CST410","nama"=>"Nizar","telp"=>"085000000000"],
    ["kode"=>"CST224","nama"=>"Suyitno","telp"=>"082244522600"],
    ["kode"=>"CST287","nama"=>"Riski Wijaya","telp"=>"0"],
    ["kode"=>"CST226","nama"=>"Very Adi Wijaya","telp"=>"0"],
    ["kode"=>"CST527","nama"=>"Hadi","telp"=>"0"],
    ["kode"=>"CST943","nama"=>"Zidan","telp"=>"0"],
    ["kode"=>"CST676","nama"=>"Wahyu Widodo","telp"=>"0"],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        body { background: #fff; }
        .dataTables_filter label, .dataTables_length label { font-weight: 400; }
    </style>
</head>
<body>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Data Customer</h4>
        <button class="btn btn-primary">+ Tambah</button>
    </div>
    <div class="card p-3 mb-3">
        <div class="table-responsive">
            <table id="tabel-customer" class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Customer</th>
                        <th>Nama Customer</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($data_customer as $i => $c): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= $c['kode'] ?></td>
                        <td><?= $c['nama'] ?></td>
                        <td><?= $c['telp'] ?></td>
                        <td>
                            <button class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i> Edit</button>
                            <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script>
$(document).ready(function() {
    $('#tabel-customer').DataTable({
        language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: { previous: "Previous", next: "Next" }
        }
    });
});
</script>
</body>
</html> 