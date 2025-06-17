<?= $this->include('components/header') ?>
<?= $this->include('components/sidebar_admin') ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Stok</span>
                            <span class="info-box-number">1,410</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Barang Masuk</span>
                            <span class="info-box-number">93</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-truck"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Barang Keluar</span>
                            <span class="info-box-number">44</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Customer</span>
                            <span class="info-box-number">13</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">
                    <!-- Grafik Penjualan -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-line mr-1"></i>
                                Grafik Penjualan
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="salesChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>

                    <!-- Stok Terendah -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Stok Terendah
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Stok</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>BRG001</td>
                                            <td>Laptop Asus</td>
                                            <td>2</td>
                                            <td><span class="badge badge-danger">Kritis</span></td>
                                        </tr>
                                        <tr>
                                            <td>BRG002</td>
                                            <td>Mouse Gaming</td>
                                            <td>5</td>
                                            <td><span class="badge badge-warning">Rendah</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Right col -->
                <section class="col-lg-5 connectedSortable">
                    <!-- Statistik Barang Masuk/Keluar -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Statistik Barang
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="stockChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>

                    <!-- Transaksi Terbaru -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-history mr-1"></i>
                                Transaksi Terbaru
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Kode</th>
                                            <th>Tipe</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2024-03-20</td>
                                            <td>TRX001</td>
                                            <td>Masuk</td>
                                            <td><span class="badge badge-success">Selesai</span></td>
                                        </tr>
                                        <tr>
                                            <td>2024-03-19</td>
                                            <td>TRX002</td>
                                            <td>Keluar</td>
                                            <td><span class="badge badge-success">Selesai</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Grafik Penjualan
const salesCtx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(salesCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [{
            label: 'Penjualan',
            data: [65, 59, 80, 81, 56, 55],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

// Grafik Statistik Barang
const stockCtx = document.getElementById('stockChart').getContext('2d');
const stockChart = new Chart(stockCtx, {
    type: 'doughnut',
    data: {
        labels: ['Barang Masuk', 'Barang Keluar'],
        datasets: [{
            data: [300, 100],
            backgroundColor: [
                'rgb(40, 167, 69)',
                'rgb(255, 193, 7)'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>

</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE -->
<script src="<?= base_url('assets/dist/js/adminlte.js') ?>"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/dist/js/demo.js') ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url('assets/dist/js/pages/dashboard3.js') ?>"></script>
</body>
</html> 