<?php
session_start();
require_once 'config.php';

// Cek apakah user sudah login dan rolenya adalah User
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'User') {
    header('Location: index.php');
    exit();
}

// Ambil data user dari database
// Kecualikan password dari hasil query demi keamanan, meskipun di halaman user.
$sql = "SELECT id, username, role FROM users";
$result = mysqli_query($conn, $sql);
$users_data = [];
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $users_data[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User (User)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 16px rgba(44,62,80,0.06); }
        #usersTable_wrapper .dataTables_filter { margin-bottom: 10px; }
        #usersTable_wrapper .dataTables_length { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container py-4">
        <h4 class="mb-3" style="font-weight:500; color:#3a3a3a;">Data User</h4>
        <div class="card p-4">
            <div class="mb-3">
                <h6 class="mb-2">Daftar User</h6>
                <!-- Search dan Show entries akan dibuat otomatis oleh DataTables -->
            </div>
            <div class="table-responsive">
                <table id="usersTable" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID User</th>
                            <th>Username</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($users_data as $user): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['role']); ?></td>
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
            $('#usersTable').DataTable({});
        });
    </script>
</body>
</html> 