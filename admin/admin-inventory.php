<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header('Location: index.php');
    exit();
}
// Contoh data barang (nanti bisa diambil dari database)
$data_barang = [
    ["kode"=>"274759466","nama"=>"Kabel Roll","jenis"=>"-","merek"=>"-","stok"=>"15 PCS","ket"=>"Barang di Lantai Dasar KRT"],
    ["kode"=>"62316066","nama"=>"Kran 1/2","jenis"=>"-","merek"=>"-","stok"=>"6 PCS","ket"=>"Barang di Perlengkapan lemari depan"],
    ["kode"=>"52976740","nama"=>"Stop kontak tanam","jenis"=>"-","merek"=>"-","stok"=>"5 PCS","ket"=>"Barang di Lantai 1 Perlengkapan"],
    ["kode"=>"16329521","nama"=>"Suzuki Ertiga","jenis"=>"-","merek"=>"-","stok"=>"1 PCS","ket"=>"Di garasi"],
    ["kode"=>"73719811","nama"=>"Lampu Outbow 12w","jenis"=>"-","merek"=>"-","stok"=>"6 PCS","ket"=>"Barang di Lantai 1 Perlengkapan"],
    ["kode"=>"10425327","nama"=>"Innova Reborn","jenis"=>"-","merek"=>"-","stok"=>"1 PCS","ket"=>"Di garasi"],
    ["kode"=>"21057455","nama"=>"Bendera Indonesia","jenis"=>"-","merek"=>"-","stok"=>"1 PCS","ket"=>"-"],
    ["kode"=>"72468785","nama"=>"Bendera Unisma","jenis"=>"-","merek"=>"-","stok"=>"1 PCS","ket"=>"-"],
    ["kode"=>"93063082","nama"=>"Bendera NU","jenis"=>"-","merek"=>"-","stok"=>"1 PCS","ket"=>"-"],
    ["kode"=>"65297257","nama"=>"Bendera FAI","jenis"=>"-","merek"=>"-","stok"=>"1 PCS","ket"=>"-"],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <style>
        body { background: #fff; }
        .btn-export { margin-right: 8px; }
        .dataTables_filter label { font-weight: 400; }
        .dataTables_length label { font-weight: 400; }
        .dt-buttons .btn { margin-right: 4px; }
    </style>
</head>
<body>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Data Barang</h4>
        <div>
            <button class="btn btn-danger btn-export">Export</button>
            <button class="btn btn-primary">+ Tambah</button>
        </div>
    </div>
    <div class="card p-3 mb-3">
        <div class="row g-2 align-items-center mb-2">
            <div class="col-md-3 col-12">
                <label class="form-label mb-1">Filter Jenis Barang</label>
                <select class="form-select">
                    <option>-- Silahkan Pilih --</option>
                    <option>Listrik</option>
                    <option>Otomotif</option>
                    <option>Perlengkapan</option>
                </select>
            </div>
        </div>
        <div class="table-responsive">
            <table id="tabel-barang" class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Merk Barang</th>
                        <th>Stok</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($data_barang as $i => $b): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= $b['kode'] ?></td>
                        <td><?= $b['nama'] ?></td>
                        <td><?= $b['jenis'] ?></td>
                        <td><?= $b['merek'] ?></td>
                        <td><?= $b['stok'] ?></td>
                        <td><?= $b['ket'] ?></td>
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
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script>
$(document).ready(function() {
    $('#tabel-barang').DataTable({
        dom: 'Blfrtip',
        buttons: [
            { extend: 'copy', className: 'btn btn-light btn-sm' },
            { extend: 'excel', className: 'btn btn-light btn-sm' },
            { extend: 'pdf', className: 'btn btn-light btn-sm' },
            { extend: 'csv', className: 'btn btn-light btn-sm' }
        ],
        language: {
            search: "Search:",
            lengthMenu: "_MENU_ entries per page",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: { previous: "<", next: ">" }
        }
    });
});
</script>
</body>
</html> 