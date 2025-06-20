<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Stok Barang<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="mb-4">Stok Barang</h1>
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center border-0">
            <h5 class="mb-0">Daftar Stok Barang</h5>
            <a href="<?= base_url('admin/stok-barang/create') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Barang</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($barang) && is_array($barang)): ?>
                            <?php foreach ($barang as $item): ?>
                                <tr>
                                    <td><?= $item['kode_barang'] ?? 'BRG001' ?></td>
                                    <td><?= $item['nama_barang'] ?? 'Laptop Asus' ?></td>
                                    <td><?= $item['kategori'] ?? 'Elektronik' ?></td>
                                    <td><?= $item['stok'] ?? 5 ?></td>
                                    <td><?= $item['satuan'] ?? 'Unit' ?></td>
                                    <td><?= number_format($item['harga'] ?? 10000000, 0, ',', '.') ?></td>
                                    <td><?= $item['deskripsi'] ?? 'Laptop untuk kerja' ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/stok-barang/edit/' . ($item['id'] ?? 1)) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="<?= base_url('admin/stok-barang/delete/' . ($item['id'] ?? 1)) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus barang ini?')"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td>BRG001</td>
                                <td>Laptop Asus</td>
                                <td>Elektronik</td>
                                <td>5</td>
                                <td>Unit</td>
                                <td>10.000.000</td>
                                <td>Laptop untuk kerja</td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <tr>
                                <td>BRG002</td>
                                <td>Mouse Gaming</td>
                                <td>Elektronik</td>
                                <td>3</td>
                                <td>Unit</td>
                                <td>250.000</td>
                                <td>Mouse untuk gaming</td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>