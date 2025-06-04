<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header('Location: index.php');
    exit();
}
// Contoh data transaksi pengeluaran (nanti bisa diambil dari database)
$data_pengeluaran = [
    ["no_keluar"=>"TR1680493850","nama_barang"=>"Pitingan Lampu Bolam","jenis_barang"=>"-","jumlah"=>"1","nama_petugas"=>"Chamidah","nama_pengambil"=>"Ainul Solihin, S.T.","tgl_keluar"=>"2023/03/04","jam_keluar"=>"10:50:50","keterangan"=>"Barang di Lantai 1 Perlengkapan"],
    ["no_keluar"=>"TR1680661543","nama_barang"=>"Lampu TL 18 Watt Putih","jenis_barang"=>"-","jumlah"=>"4","nama_petugas"=>"Chamidah","nama_pengambil"=>"Riski Wijaya","tgl_keluar"=>"2023/05/04","jam_keluar"=>"09:25:43","keterangan"=>"Barang di Lantai 1 Perlengkapan"],
    ["no_keluar"=>"TR1680661597","nama_barang"=>"Gembok besar","jenis_barang"=>"-","jumlah"=>"1","nama_petugas"=>"Chamidah","nama_pengambil"=>"Nizar","tgl_keluar"=>"2023/05/04","jam_keluar"=>"09:26:37","keterangan"=>"Barang dilantai 5"],
    ["no_keluar"=>"TR172325510","nama_barang"=>"MIC Kabel","jenis_barang"=>"-","jumlah"=>"1","nama_petugas"=>"Chamidah","nama_pengambil"=>"barang di perlengkapan","tgl_keluar"=>"2024/10/08","jam_keluar"=>"00:45:10","keterangan"=>"barang di perlengkapan"],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Pengeluaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <style>
        body { background: #fff; }
        .dataTables_filter label, .dataTables_length label { font-weight: 400; }
        .dt-buttons .btn { margin-right: 4px; }
    </style>
</head>
<body>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Transaksi Pengeluaran</h4>
        <div>
            <button class="btn btn-danger btn-export dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Export
            </button>
            <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                <li><a class="dropdown-item" href="#" id="btnCopy">Copy</a></li>
                <li><a class="dropdown-item" href="#" id="btnExcel">Excel</a></li>
                <li><a class="dropdown-item" href="#" id="btnPdf">PDF</a></li>
                <li><a class="dropdown-item" href="#" id="btnCsv">CSV</a></li>
            </ul>
            <button class="btn btn-primary">+ Tambah</button>
        </div>
    </div>
    <div class="card p-3 mb-3">
        <div class="row g-3 mb-3">
            <div class="col-md-3 col-sm-6">
                <label class="form-label">Filter Jenis Barang</label>
                <select class="form-select">
                    <option>-- Silahkan Pilih --</option>
                    <!-- Options will be populated from database -->
                </select>
            </div>
             <div class="col-md-3 col-sm-6">
                <label class="form-label">Filter Tanggal</label>
                <div class="input-group">
                    <input type="date" class="form-control">
                     <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="tabel-pengeluaran" class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>No Keluar</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Jumlah</th>
                        <th>Nama Petugas</th>
                        <th>Nama Pengambil</th>
                        <th>Tanggal Keluar</th>
                        <th>Jam Keluar</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($data_pengeluaran as $i => $d): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= $d['no_keluar'] ?></td>
                        <td><?= $d['nama_barang'] ?></td>
                        <td><?= $d['jenis_barang'] ?></td>
                        <td><?= $d['jumlah'] ?></td>
                        <td><?= $d['nama_petugas'] ?></td>
                        <td><?= $d['nama_pengambil'] ?></td>
                        <td><?= $d['tgl_keluar'] ?></td>
                        <td><?= $d['jam_keluar'] ?></td>
                         <td><?= $d['keterangan'] ?></td>
                        <td>
                            <button class="btn btn-info btn-sm text-white"><i class="bi bi-eye"></i> View</button>
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
    var table = $('#tabel-pengeluaran').DataTable({
        dom: 'lfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        language: {
            search: "Search:",
            lengthMenu: "_MENU_ entries per page",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: { previous: "Previous", next: "Next" }
        }
    });

    // Link DataTables buttons to custom buttons
    $('#btnCopy').on('click', function() { table.button('.buttons-copy').trigger(); });
    $('#btnExcel').on('click', function() { table.button('.buttons-excel').trigger(); });
    $('#btnPdf').on('click', function() { table.button('.buttons-pdf').trigger(); });
    $('#btnCsv').on('click', function() { table.button('.buttons-csv').trigger(); });
});
</script>
</body>
</html> 