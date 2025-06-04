<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    $sql = "SELECT * FROM users WHERE username = '$username' AND role = '$role'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password === $row['password']) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            if ($role === 'Admin') {
                header("Location: dashboard.php");
            } else {
                header("Location: dashboard-user.php");
            }
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username atau role tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login VStock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #fff; }
        .login-container { min-height: 100vh; }
        .login-img { max-width: 100%; height: auto; }
        .login-card { border: none; box-shadow: 0 2px 16px rgba(44,62,80,0.06); border-radius: 16px; }
        .form-control:focus { border-color: #3f72af; box-shadow: 0 0 0 0.2rem rgba(63,114,175,.15); }
        .btn-primary { background: #3f72af; border: none; }
        .btn-primary:hover { background: #365f91; }
    </style>
</head>
<body>
    <div class="container-fluid login-container d-flex align-items-center justify-content-center">
        <div class="row w-100 align-items-center justify-content-center">
            <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center">
                <img src="assets/illustration.png" alt="VStock Illustration" class="login-img">
            </div>
            <div class="col-lg-4 col-md-8 col-12">
                <div class="card login-card p-4">
                    <h2 class="text-center mb-1" style="font-weight:600; color:#3a3a3a;">.: VStock (View Stock) :.</h2>
                    <p class="text-center mb-4" style="color:#7b8ca0;">Melihat stok barang yang tersedia</p>
                    <?php if(isset($error)) { ?>
                        <div class="alert alert-danger py-2" role="alert"><?php echo $error; ?></div>
                    <?php } ?>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                        </div>
                        <div class="mb-3">
                            <select name="role" class="form-select" required>
                                <option value="" disabled selected>Masuk Sebagai</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 