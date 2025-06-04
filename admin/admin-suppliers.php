<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header('Location: index.php');
    exit();
}
// Contoh data supplier (nanti bisa diambil dari database)
$data_supplier = [
    ["kode"=>"SPL118","nama"=>"Asep","telp"=>"085000000000","email"=>"asep@gmail.com","alamat"=>"Banajaran"],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier</title>
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
        <h4 class="mb-0">Data Supplier</h4>
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
        <div class="table-responsive">
            <table id="tabel-supplier" class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($data_supplier as $i => $s): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= $s['kode'] ?></td>
                        <td><?= $s['nama'] ?></td>
                        <td><?= $s['telp'] ?></td>
                        <td><?= $s['email'] ?></td>
                        <td><?= $s['alamat'] ?></td>
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
    var table = $('#tabel-supplier').DataTable({
        dom: 'lfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
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