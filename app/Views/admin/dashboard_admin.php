<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <h1 class="mb-4">Dashboard</h1>
        <div class="row tight-widgets">
            <div class="col-12 col-md-6 col-xl-3 mb-2">
                <div class="widget-gradient bg1">
                    <div class="widget-title">Total Barang</div>
                    <div class="widget-row">
                        <span class="widget-icon"><i class="bi bi-box"></i></span>
                    <span class="widget-value"><?= $totalBarang ?? 150 ?></span>
                    </div>
                    <div class="widget-footer">
                        <span class="widget-footer-label">Hari Ini</span>
                        <span class="widget-footer-value">10</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3 mb-2">
                <div class="widget-gradient bg2">
                    <div class="widget-title">Total Barang Masuk</div>
                    <div class="widget-row">
                        <span class="widget-icon"><i class="bi bi-box-arrow-in-down"></i></span>
                        <span class="widget-value">25</span>
                    </div>
                    <div class="widget-footer">
                        <span class="widget-footer-label">Hari Ini</span>
                        <span class="widget-footer-value">3</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3 mb-2">
                <div class="widget-gradient bg3">
                    <div class="widget-title">Total Barang Keluar</div>
                    <div class="widget-row">
                        <span class="widget-icon"><i class="bi bi-box-arrow-up"></i></span>
                        <span class="widget-value">15</span>
                    </div>
                    <div class="widget-footer">
                        <span class="widget-footer-label">Hari Ini</span>
                        <span class="widget-footer-value">2</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3 mb-2">
                <div class="widget-gradient bg4">
                    <div class="widget-title">Jumlah Customer</div>
                    <div class="widget-row">
                        <span class="widget-icon"><i class="bi bi-people"></i></span>
                    <span class="widget-value"><?= $totalCustomer ?? 50 ?></span>
                    </div>
                    <div class="widget-footer">
                        <span class="widget-footer-label">Hari Ini</span>
                        <span class="widget-footer-value">1</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header bg-white border-0"><h5 class="mb-0">Barang Terbaru</h5></div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>BRG001</td>
                                        <td>Laptop Asus</td>
                                        <td>Elektronik</td>
                                        <td>5</td>
                                        <td>2024-03-20</td>
                                        <td><span class="badge-status badge-status-tersedia">tersedia</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>BRG002</td>
                                        <td>Mouse Gaming</td>
                                        <td>Elektronik</td>
                                        <td>0</td>
                                        <td>2024-03-19</td>
                                        <td><span class="badge-status badge-status-habis">habis</span></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>BRG003</td>
                                        <td>Keyboard Mechanical</td>
                                        <td>Elektronik</td>
                                        <td>1</td>
                                        <td>2024-03-18</td>
                                        <td><span class="badge-status-hampirhabis">hampir habis</span></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>BRG004</td>
                                        <td>Printer Epson</td>
                                        <td>Elektronik</td>
                                        <td>10</td>
                                        <td>2024-03-17</td>
                                        <td><span class="badge-status badge-status-barumasuk">baru masuk</span></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>BRG005</td>
                                        <td>Flashdisk 32GB</td>
                                        <td>Aksesoris</td>
                                        <td>0</td>
                                        <td>2024-03-16</td>
                                        <td><span class="badge-status badge-status-tidakaktif">tidak aktif</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-center border-0 p-2">
                        <a href="<?= base_url('admin/stok-barang') ?>" class="d-inline-block" style="color:inherit;text-decoration:none;font-weight:500;">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header bg-white border-0"><h5 class="mb-0">Transaksi Barang Masuk Terbaru</h5></div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Supplier</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2024-03-20</td>
                                        <td>BRG001</td>
                                        <td>Laptop Asus</td>
                                        <td>10</td>
                                        <td>PT Supplier Jaya</td>
                                        <td><span class="badge-status-menunggu">Menunggu</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2024-03-19</td>
                                        <td>BRG002</td>
                                        <td>Mouse Gaming</td>
                                        <td>0</td>
                                        <td>PT Supplier Jaya</td>
                                        <td><span class="badge-status-diproses">Diproses</span></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>2024-03-18</td>
                                        <td>BRG003</td>
                                        <td>Keyboard Mechanical</td>
                                        <td>5</td>
                                        <td>PT Supplier Makmur</td>
                                        <td><span class="badge-status-selesai">Selesai</span></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>2024-03-17</td>
                                        <td>BRG004</td>
                                        <td>Printer Epson</td>
                                        <td>0</td>
                                        <td>PT Supplier Makmur</td>
                                        <td><span class="badge-status-dibatalkan">Dibatalkan</span></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>2024-03-16</td>
                                        <td>BRG005</td>
                                        <td>Flashdisk 32GB</td>
                                        <td>15</td>
                                        <td>PT Supplier Jaya</td>
                                        <td><span class="badge-status-pending">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>2024-03-15</td>
                                        <td>BRG006</td>
                                        <td>Monitor LG</td>
                                        <td>2</td>
                                        <td>PT Supplier Makmur</td>
                                        <td><span class="badge-status-retur">Retur</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-center border-0 p-2">
                        <a href="<?= base_url('admin/barang-masuk') ?>" class="d-inline-block" style="color:inherit;text-decoration:none;font-weight:500;">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header bg-white border-0"><h5 class="mb-0">Transaksi Barang Keluar Terbaru</h5></div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tujuan Pengguna</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2024-03-20</td>
                                        <td>BRG001</td>
                                        <td>Laptop Asus</td>
                                        <td>2</td>
                                        <td>PT Customer Sejahtera</td>
                                        <td><span class="badge-status-menunggu">Menunggu</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2024-03-19</td>
                                        <td>BRG002</td>
                                        <td>Mouse Gaming</td>
                                        <td>1</td>
                                        <td>PT Customer Sejahtera</td>
                                        <td><span class="badge-status-diproses">Diproses</span></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>2024-03-18</td>
                                        <td>BRG003</td>
                                        <td>Keyboard Mechanical</td>
                                        <td>1</td>
                                        <td>PT Customer Makmur</td>
                                        <td><span class="badge-status-dikirim">Dikirim</span></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>2024-03-17</td>
                                        <td>BRG004</td>
                                        <td>Printer Epson</td>
                                        <td>1</td>
                                        <td>PT Customer Makmur</td>
                                        <td><span class="badge-status-selesai">Selesai</span></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>2024-03-16</td>
                                        <td>BRG005</td>
                                        <td>Flashdisk 32GB</td>
                                        <td>5</td>
                                        <td>PT Customer Jaya</td>
                                        <td><span class="badge-status-ditolak">Ditolak</span></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>2024-03-15</td>
                                        <td>BRG006</td>
                                        <td>Monitor LG</td>
                                        <td>1</td>
                                        <td>PT Customer Jaya</td>
                                        <td><span class="badge-status-dibatalkan">Dibatalkan</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-center border-0 p-2">
                        <a href="<?= base_url('admin/barang-keluar') ?>" class="d-inline-block" style="color:inherit;text-decoration:none;font-weight:500;">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-8 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-white border-0"><h5 class="mb-0">Grafik Barang Masuk/Keluar</h5></div>
                    <div class="card-body">
                        <canvas id="chartMasukKeluar" height="120"></canvas>
                        <div class="custom-legend-masukkeluar">
                            <div class="legend-line">
                                <span class="legend-shape">
                                    <span class="legend-circle" style="--legend-color:#4e9af1"></span>
                                    <span class="legend-bar" style="--legend-color:#4e9af1"></span>
                                    <span class="legend-circle" style="--legend-color:#4e9af1"></span>
                                </span>
                                <span style="margin-left:0.6rem;">Barang Masuk</span>
                            </div>
                            <div class="legend-line">
                                <span class="legend-shape">
                                    <span class="legend-circle" style="--legend-color:#28a745"></span>
                                    <span class="legend-bar" style="--legend-color:#28a745"></span>
                                    <span class="legend-circle" style="--legend-color:#28a745"></span>
                                </span>
                                <span style="margin-left:0.6rem;">Barang Keluar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-white border-0"><h5 class="mb-0">Grafik Stok Barang per Kategori</h5></div>
                    <div class="card-body">
                        <canvas id="chartKategori" height="180"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Grafik Barang Masuk/Keluar
    const ctxMasukKeluar = document.getElementById('chartMasukKeluar').getContext('2d');
    new Chart(ctxMasukKeluar, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [
                {
                    label: 'Barang Masuk',
                    data: [12, 19, 15, 17, 22, 18, 25, 20, 23, 19, 21, 24],
                    borderColor: '#4e9af1',
                    backgroundColor: 'rgba(78,154,241,0.12)',
                    tension: 0.35,
                    pointRadius: 3,
                    pointBackgroundColor: '#4e9af1',
                    fill: true
                },
                {
                    label: 'Barang Keluar',
                    data: [8, 14, 10, 13, 16, 12, 18, 15, 17, 13, 15, 18],
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40,167,69,0.10)',
                    tension: 0.35,
                    pointRadius: 3,
                    pointBackgroundColor: '#28a745',
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                x: { grid: { display: false } },
                y: { beginAtZero: true, grid: { color: '#f0f2f7' } }
            }
        }
    });
    
    // Grafik Stok Barang per Kategori
    const ctxKategori = document.getElementById('chartKategori').getContext('2d');
    new Chart(ctxKategori, {
        type: 'pie',
        data: {
            labels: ['Elektronik', 'Aksesoris', 'ATK', 'Lainnya'],
            datasets: [{
                data: [40, 25, 20, 15],
                backgroundColor: [
                    '#4e9af1', // biru
                    '#28a745', // hijau
                    '#ffc107', // kuning
                    '#ff6a8d'  // pink
                ],
                borderWidth: 2,
                borderColor: '#fff',
                hoverOffset: 6
            }]
        },
        options: {
            plugins: {
                legend: { display: true, position: 'bottom' },
                tooltip: { enabled: true }
            }
        }
    });
</script>
<?= $this->endSection() ?>
