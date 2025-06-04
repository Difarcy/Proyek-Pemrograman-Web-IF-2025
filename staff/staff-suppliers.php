<?php
session_start();
require_once 'config.php';

// Cek apakah user sudah login dan rolenya adalah User
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'User') {
    header('Location: index.php');
    exit();
}

// --- Bagian ini perlu diubah untuk mengambil data sumber barang dari database ---
// Contoh data dummy (ganti dengan query database)
$sumber_barang_data = [
    ['kode' => 'SPL001', 'nama' => 'Supplier A', 'telepon' => '081122334455', 'email' => 'supplier.a@example.com', 'alamat' => 'Jl. Contoh No. 1'],
    ['kode' => 'SPL002', 'nama' => 'Supplier B', 'telepon' => '089988776655', 'email' => 'supplier.b@example.com', 'alamat' => 'Jl. Percobaan No. 2'],
    // ... data sumber barang lainnya dari database ...
];
// -------------------------------------------------------------------------------

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sumber Barang (User)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 16px rgba(44,62,80,0.06); }
        #sumberBarangTable_wrapper .dataTables_filter { margin-bottom: 10px; }
        #sumberBarangTable_wrapper .dataTables_length { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container py-4">
        <h4 class="mb-3" style="font-weight:500; color:#3a3a3a;">Data Sumber Barang</h4>
        <div class="card p-4">
            <div class="mb-3">
                <h6 class="mb-2">Daftar Sumber Barang</h6>
                <!-- Search dan Show entries akan dibuat otomatis oleh DataTables -->
            </div>
            <div class="table-responsive">
                <table id="sumberBarangTable" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Supplier</th>
                            <th>Nama Supplier</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($sumber_barang_data as $sumber): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($sumber['kode']); ?></td>
                            <td><?php echo htmlspecialchars($sumber['nama']); ?></td>
                            <td><?php echo htmlspecialchars($sumber['telepon']); ?></td>
                            <td><?php echo htmlspecialchars($sumber['email']); ?></td>
                            <td><?php echo htmlspecialchars($sumber['alamat']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#sumberBarangTable').DataTable({});
        });
    </script>
</body>
</html> 