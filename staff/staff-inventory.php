<?php
session_start();
require_once 'config.php';

// Cek apakah user sudah login dan rolenya adalah User
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'User') {
    header('Location: index.php');
    exit();
}

// Ambil data barang dari database
$sql = "SELECT * FROM barang";
$result = mysqli_query($conn, $sql);
$barang_data = [];
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $barang_data[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang (User)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 16px rgba(44,62,80,0.06); }
        #barangTable_wrapper .btn { margin-right: 5px; }
        #barangTable_wrapper .dataTables_filter { margin-bottom: 10px; }
        #barangTable_wrapper .dataTables_length { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container py-4">
        <h4 class="mb-3" style="font-weight:500; color:#3a3a3a;">Data Barang</h4>
        <div class="card p-4">
            <div class="mb-3">
                <h6 class="mb-2">Daftar Barang</h6>
                <div class="d-flex flex-column flex-md-row justify-content-between mb-3">
                    <div class="mb-2 mb-md-0">
                        <label for="filterJenis" class="form-label me-2">Filter Jenis Barang</label>
                        <select id="filterJenis" class="form-select form-select-sm d-inline-block w-auto">
                            <option value="">-- Silahkan Pilih --</option>
                            <!-- Options akan ditambahkan via JavaScript/PHP jika ada data jenis barang -->
                        </select>
                    </div>
                    <!-- Search box akan dibuat otomatis oleh DataTables -->
                </div>
            </div>
            <div class="table-responsive">
                <table id="barangTable" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Merek Barang</th>
                            <th>Stok</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($barang_data as $barang): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo ""; // Placeholder for Kode Barang ?></td>
                            <td><?php echo htmlspecialchars($barang['nama_barang']); ?></td>
                            <td><?php echo ""; // Placeholder for Jenis Barang ?></td>
                            <td><?php echo ""; // Placeholder for Merek Barang ?></td>
                            <td><?php echo htmlspecialchars($barang['stok']); ?> PCS</td>
                            <td><?php echo ""; // Placeholder for Keterangan ?></td>
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
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#barangTable').DataTable({
                layout: {
                    topStart: {
                        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
                    }
                },
                // DataTables will automatically create the search input
            });

            // Example of custom filter (requires data in table column 3 - Jenis Barang)
            $('#filterJenis').on('change', function() {
                table.column(3) // 3 is the index for 'Jenis Barang' column (0-indexed)
                      .search(this.value)
                      .draw();
            });
        });
    </script>
</body>
</html> 