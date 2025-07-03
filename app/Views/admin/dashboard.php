<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h2 class="dashboard-page-title">Dashboard</h2>
<div class="dashboard-widgets">
    <div class="widget widget-blue">
        <div class="widget-title">Total Barang</div>
        <div class="widget-row">
            <div class="widget-icon"><i class="fa-solid fa-box"></i></div>
            <div class="widget-value">0</div>
        </div>
        <div class="widget-footer">
            <span>Hari Ini</span>
            <span class="widget-small">10</span>
        </div>
    </div>
    <div class="widget widget-pink">
        <div class="widget-title">Total Customer</div>
        <div class="widget-row">
            <div class="widget-icon"><i class="fa-solid fa-users"></i></div>
            <div class="widget-value">0</div>
        </div>
        <div class="widget-footer">
            <span>Hari Ini</span>
            <span class="widget-small">12</span>
        </div>
    </div>
    <div class="widget widget-green">
        <div class="widget-title">Total Barang Masuk</div>
        <div class="widget-row">
            <div class="widget-icon"><i class="fa-solid fa-arrow-down"></i></div>
            <div class="widget-value">0</div>
        </div>
        <div class="widget-footer">
            <span>Hari Ini</span>
            <span class="widget-small">3</span>
        </div>
    </div>
    <div class="widget widget-yellow">
        <div class="widget-title">Total Barang Keluar</div>
        <div class="widget-row">
            <div class="widget-icon"><i class="fa-solid fa-arrow-up"></i></div>
            <div class="widget-value">0</div>
        </div>
        <div class="widget-footer">
            <span>Hari Ini</span>
            <span class="widget-small">2</span>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
