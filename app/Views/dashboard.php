<?= $this->extend($role === 'admin' ? 'layouts/admin' : 'layouts/user') ?>
<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>
<?= $this->section('content') ?>

<h2 class="main-page-title">Dashboard</h2>

<div class="main-container">
    <!-- Widget top -->
    <div class="dashboard-widgets">
        <div class="widget widget-blue">
            <div class="widget-title">Total Barang</div>
            <div class="widget-row">
                <div class="widget-icon"><i class="fa-solid fa-box"></i></div>
                <div class="widget-value"><?= esc($totalBarang ?? 0) ?></div>
            </div>
            <div class="widget-footer">
                <span>Hari Ini</span>
            </div>
        </div>
        <div class="widget widget-pink">
            <div class="widget-title">Total Customer</div>
            <div class="widget-row">
                <div class="widget-icon"><i class="fa-solid fa-users"></i></div>
                <div class="widget-value"><?= esc($totalCustomer ?? 0) ?></div>
            </div>
            <div class="widget-footer">
                <span>Hari Ini</span>
            </div>
        </div>
        <div class="widget widget-green">
            <div class="widget-title">Total Barang Masuk</div>
            <div class="widget-row">
                <div class="widget-icon"><i class="fa-solid fa-arrow-down"></i></div>
                <div class="widget-value"><?= esc($totalBarangMasuk ?? 0) ?></div>
            </div>
            <div class="widget-footer">
                <span>Hari Ini</span>
            </div>
        </div>
        <div class="widget widget-yellow">
            <div class="widget-title">Total Barang Keluar</div>
            <div class="widget-row">
                <div class="widget-icon"><i class="fa-solid fa-arrow-up"></i></div>
                <div class="widget-value"><?= esc($totalBarangKeluar ?? 0) ?></div>
            </div>
            <div class="widget-footer">
                <span>Hari Ini</span>
            </div>
        </div>
    </div>

    <!-- Tabel Stok Barang -->
    <div class="main-card">
        <div class="main-content">
            <div class="dashboard-tabel-title">Tabel Stok Barang</div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($stokBarang ?? [])): ?>
                            <?php $no = 1; foreach (array_slice($stokBarang, 0, 5) as $barang): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($barang['kode_barang'] ?? '') ?></td>
                                    <td><?= esc($barang['nama_barang'] ?? '') ?></td>
                                    <td><?= esc($barang['kategori_barang'] ?? '') ?></td>
                                    <td><?= esc($barang['stok'] ?? '') ?></td>
                                    <td><?= esc($barang['satuan'] ?? '') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="empty-table-message">Tidak ada data barang.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="lihat-semua-bar">
                <a href="<?= base_url(($role ?? 'admin') . '/stok-barang') ?>" class="lihat-semua-link">Lihat semua</a>
            </div>
        </div>
    </div>

    <!-- Tabel Barang Masuk -->
    <div class="main-card">
        <div class="main-content">
            <div class="dashboard-tabel-title">Tabel Barang Masuk</div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No Surat Jalan</th>
                            <th>Tanggal Terima</th>
                            <th>Supplier</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($barangMasuk ?? [])): ?>
                            <?php $no = 1; foreach (array_slice($barangMasuk, 0, 5) as $barang): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($barang['no_surat_jalan'] ?? '') ?></td>
                                    <td><?= esc($barang['tanggal_terima'] ?? '') ?></td>
                                    <td><?= esc($barang['supplier'] ?? '') ?></td>
                                    <td><?= esc($barang['nama_barang'] ?? '') ?></td>
                                    <td><?= esc($barang['jumlah'] ?? '') ?></td>
                                    <td><?= esc($barang['satuan'] ?? '') ?></td>
                                    <td><?= esc($barang['petugas'] ?? '') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="empty-table-message">Tidak ada data barang masuk.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="lihat-semua-bar">
                <a href="<?= base_url(($role ?? 'admin') . '/barang-masuk') ?>" class="lihat-semua-link">Lihat semua</a>
            </div>
        </div>
    </div>

    <!-- Tabel Barang Keluar -->
    <div class="main-card">
        <div class="main-content">
            <div class="dashboard-tabel-title">Tabel Barang Keluar</div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No Surat Jalan</th>
                            <th>Tanggal Keluar</th>
                            <th>Customer</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($barangKeluar ?? [])): ?>
                            <?php $no = 1; foreach (array_slice($barangKeluar, 0, 5) as $barang): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($barang['no_surat_jalan'] ?? '') ?></td>
                                    <td><?= esc($barang['tanggal_keluar'] ?? '') ?></td>
                                    <td><?= esc($barang['customer'] ?? '') ?></td>
                                    <td><?= esc($barang['nama_barang'] ?? '') ?></td>
                                    <td><?= esc($barang['jumlah'] ?? '') ?></td>
                                    <td><?= esc($barang['satuan'] ?? '') ?></td>
                                    <td><?= esc($barang['petugas'] ?? '') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="empty-table-message">Tidak ada data barang keluar.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="lihat-semua-bar">
                <a href="<?= base_url(($role ?? 'admin') . '/barang-keluar') ?>" class="lihat-semua-link">Lihat semua</a>
            </div>
        </div>
    </div>

    <!-- Grafik Dashboard -->
    <div class="main-card">
        <div class="dashboard-graph-row">
            <div class="dashboard-graph-kiri">
                <div class="main-content">
                    <div class="dashboard-tabel-title">Grafik Barang Masuk/Keluar</div>
                    <canvas id="chartMasukKeluar"></canvas>
                </div> 
            </div>
            <div class="dashboard-graph-kanan">
                <div class="main-content">
                    <div class="dashboard-tabel-title">Grafik Total</div>
                    <canvas id="chartKategori" height="180"></canvas>
                </div>     
            </div>
        </div>
    </div>
</div>

<?php if (isset($chartData)): ?>
<script>
window.chartData = <?= json_encode($chartData) ?>;
</script>
<?php endif; ?>
<?= $this->endSection() ?> 