<?= $this->extend('layouts/user') ?>
<?= $this->section('title') ?>Barang Masuk<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="v-content-wrapper">
    <div class="v-content-header">
        <div class="v-container-fluid">
            <div class="v-row v-mb-2">
                <div class="v-col-sm-6">
                    <h1 class="v-m-0">Barang Masuk</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="v-content">
        <div class="v-container-fluid">
            <div class="v-card">
                <div class="v-card-header">
                    <h3 class="v-card-title">Filter</h3>
                </div>
                <div class="v-card-body">
                    <form action="<?= base_url('user/barang-masuk') ?>" method="get">
                        <div class="v-row">
                            <div class="v-col-md-3">
                                <div class="v-form-group">
                                    <label>Status</label>
                                    <select class="v-form-control" name="status">
                                        <!-- options -->
                                    </select>
                                </div>
                            </div>
                            <div class="v-col-md-3">
                                <div class="v-form-group">
                                    <label>Pencarian</label>
                                    <input type="text" class="v-form-control" name="search" placeholder="Cari barang masuk...">
                                </div>
                            </div>
                            <div class="v-col-md-3">
                                <div class="v-form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="v-btn v-btn-primary v-btn-block">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="v-card">
                <div class="v-card-header">
                    <h3 class="v-card-title">Data Barang Masuk</h3>
                    <div class="v-card-tools">
                        <button type="button" class="v-btn v-btn-success" onclick="exportExcel()">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        <button type="button" class="v-btn v-btn-danger" onclick="exportPDF()">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>
                </div>
                <div class="v-card-body">
                    <div class="v-table-responsive">
                        <table class="v-table v-table-bordered v-table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Supplier</th>
                                    <th>Total Item</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Petugas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data item akan diisi melalui JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="v-modal v-fade" id="modal-detail">
                <div class="v-modal-dialog">
                    <div class="v-modal-content">
                        <div class="v-modal-header">
                            <h4 class="v-modal-title">Detail Barang Masuk</h4>
                            <button type="button" class="v-btn v-btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                        <div class="v-modal-body">
                            <table class="v-table">
                                <tr><th>No. Transaksi</th><td id="detail-no-transaksi"></td></tr>
                                <tr><th>Tanggal</th><td id="detail-tanggal"></td></tr>
                                <tr><th>Supplier</th><td id="detail-supplier"></td></tr>
                                <tr><th>Status</th><td id="detail-status"></td></tr>
                                <tr><th>Total Item</th><td id="detail-total-item"></td></tr>
                                <tr><th>Total Harga</th><td id="detail-total-harga"></td></tr>
                                <tr><th>Petugas</th><td id="detail-petugas"></td></tr>
                                <tr><th>Keterangan</th><td id="detail-keterangan"></td></tr>
                            </table>
                            <div id="detail-items"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    // Initialize DataTables
    $('.v-table').DataTable({
        "responsive": true,
        "autoWidth": false
    });
    // Function to show detail
    window.showDetail = function(noTransaksi) {
        // Simulate API call
        const transaksi = {
            noTransaksi: 'TRX-20240220-001',
            tanggal: '20 Feb 2024',
            supplier: 'PT Supplier Jaya',
            status: '<span class="v-badge v-badge-success">Selesai</span>',
            totalItem: 5,
            totalHarga: 'Rp 5.000.000',
            petugas: 'Andi',
            keterangan: 'Barang masuk untuk stok',
            items: [
                { nama: 'Laptop Asus', jumlah: 2 },
                { nama: 'Mouse Logitech', jumlah: 3 }
            ]
        };
        $('#detail-no-transaksi').text(transaksi.noTransaksi);
        $('#detail-tanggal').text(transaksi.tanggal);
        $('#detail-supplier').text(transaksi.supplier);
        $('#detail-status').html(transaksi.status);
        $('#detail-total-item').text(transaksi.totalItem);
        $('#detail-total-harga').text(transaksi.totalHarga);
        $('#detail-petugas').text(transaksi.petugas);
        $('#detail-keterangan').text(transaksi.keterangan);
        let html = '<ul>';
        transaksi.items.forEach(item => {
            html += `<li>${item.nama} (${item.jumlah})</li>`;
        });
        html += '</ul>';
        $('#detail-items').html(html);
        $('#modal-detail').modal('show');
    }
    // Function to export to Excel
    window.exportExcel = function() {
        // Simulate export process
        alert('Export ke Excel berhasil!');
    }
    // Function to export to PDF
    window.exportPDF = function() {
        alert('Export ke PDF berhasil!');
    }
});
</script>
<?= $this->endSection() ?> 