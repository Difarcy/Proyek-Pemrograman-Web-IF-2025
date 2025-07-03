<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Auth routes
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin');
$routes->get('/logout', 'Auth::logout');
$routes->get('auth/logout', 'Auth::logout');

// Admin routes
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('dashboard', 'Admin::index');
    
    // Barang routes
    $routes->get('stok-barang', 'Admin::barang');
    $routes->get('stok-barang/create', 'Admin::createBarang');
    $routes->post('stok-barang/store', 'Admin::storeBarang');
    $routes->get('stok-barang/edit/(:num)', 'Admin::editBarang/$1');
    $routes->post('stok-barang/update/(:num)', 'Admin::updateBarang/$1');
    $routes->get('stok-barang/delete/(:num)', 'Admin::deleteBarang/$1');
    
    // Customer routes
    $routes->get('data-customer', 'Admin::customer');
    $routes->get('data-customer/create', 'Admin::createCustomer');
    $routes->post('data-customer/store', 'Admin::storeCustomer');
    $routes->get('data-customer/edit/(:num)', 'Admin::editCustomer/$1');
    $routes->post('data-customer/update/(:num)', 'Admin::updateCustomer/$1');
    $routes->get('data-customer/delete/(:num)', 'Admin::deleteCustomer/$1');
    
    // Supplier routes
    $routes->get('data-supplier', 'Admin::supplier');
    $routes->get('data-supplier/create', 'Admin::createSupplier');
    $routes->post('data-supplier/store', 'Admin::storeSupplier');
    $routes->get('data-supplier/edit/(:num)', 'Admin::editSupplier/$1');
    $routes->post('data-supplier/update/(:num)', 'Admin::updateSupplier/$1');
    $routes->get('data-supplier/delete/(:num)', 'Admin::deleteSupplier/$1');

    // Petugas routes
    $routes->get('data-petugas', 'Admin::petugas');
    $routes->get('data-petugas/create', 'Admin::createPetugas');
    $routes->post('data-petugas/store', 'Admin::storePetugas');
    $routes->get('data-petugas/edit/(:num)', 'Admin::editPetugas/$1');
    $routes->post('data-petugas/update/(:num)', 'Admin::updatePetugas/$1');
    $routes->get('data-petugas/delete/(:num)', 'Admin::deletePetugas/$1');
    
    // Barang Masuk routes
    $routes->get('barang-masuk', 'Admin::barangMasuk');
    $routes->get('barang-masuk/create', 'Admin::createBarangMasuk');
    $routes->post('barang-masuk/store', 'Admin::storeBarangMasuk');
    $routes->get('barang-masuk/edit/(:num)', 'Admin::editBarangMasuk/$1');
    $routes->post('barang-masuk/update/(:num)', 'Admin::updateBarangMasuk/$1');
    $routes->get('barang-masuk/delete/(:num)', 'Admin::deleteBarangMasuk/$1');
    
    // Barang Keluar routes
    $routes->get('barang-keluar', 'Admin::barangKeluar');
    $routes->get('barang-keluar/create', 'Admin::createBarangKeluar');
    $routes->post('barang-keluar/store', 'Admin::storeBarangKeluar');
    $routes->get('barang-keluar/edit/(:num)', 'Admin::editBarangKeluar/$1');
    $routes->post('barang-keluar/update/(:num)', 'Admin::updateBarangKeluar/$1');
    $routes->get('barang-keluar/delete/(:num)', 'Admin::deleteBarangKeluar/$1');
    
    // Laporan routes
    $routes->get('laporan', 'Admin::laporan');
    $routes->get('laporan/export/excel', 'Admin::exportExcel');
    $routes->get('laporan/export/pdf', 'Admin::exportPdf');

    // Kelola Pengguna routes
    $routes->get('kelola-pengguna', 'Admin::kelolaPengguna');
    $routes->get('profil-toko', 'Admin::profilToko');

    // Rute untuk profil dan ubah password
    $routes->get('profil', 'Admin::profil');
    $routes->get('ubah-password', 'Admin::ubahPassword');
});

// User routes
$routes->group('user', ['filter' => 'auth:user'], function($routes) {
    $routes->get('dashboard', 'User::index');
    
    // Barang routes
    $routes->get('stok-barang', 'User::barang');
    $routes->get('stok-barang/create', 'User::createBarang');
    $routes->post('stok-barang/store', 'User::storeBarang');
    $routes->get('stok-barang/edit/(:num)', 'User::editBarang/$1');
    $routes->post('stok-barang/update/(:num)', 'User::updateBarang/$1');
    $routes->get('stok-barang/delete/(:num)', 'User::deleteBarang/$1');
    
    // Customer routes
    $routes->get('data-customer', 'User::customer');
    $routes->get('data-customer/create', 'User::createCustomer');
    $routes->post('data-customer/store', 'User::storeCustomer');
    $routes->get('data-customer/edit/(:num)', 'User::editCustomer/$1');
    $routes->post('data-customer/update/(:num)', 'User::updateCustomer/$1');
    $routes->get('data-customer/delete/(:num)', 'User::deleteCustomer/$1');
    
    // Supplier routes
    $routes->get('data-supplier', 'User::supplier');
    $routes->get('data-supplier/create', 'User::createSupplier');
    $routes->post('data-supplier/store', 'User::storeSupplier');
    $routes->get('data-supplier/edit/(:num)', 'User::editSupplier/$1');
    $routes->post('data-supplier/update/(:num)', 'User::updateSupplier/$1');
    $routes->get('data-supplier/delete/(:num)', 'User::deleteSupplier/$1');
    
    // Petugas routes
    $routes->get('data-petugas', 'User::petugas');
    $routes->get('data-petugas/create', 'User::createPetugas');
    $routes->post('data-petugas/store', 'User::storePetugas');
    $routes->get('data-petugas/edit/(:num)', 'User::editPetugas/$1');
    $routes->post('data-petugas/update/(:num)', 'User::updatePetugas/$1');
    $routes->get('data-petugas/delete/(:num)', 'User::deletePetugas/$1');
    
    // Barang Masuk routes
    $routes->get('barang-masuk', 'User::barangMasuk');
    $routes->get('barang-masuk/create', 'User::createBarangMasuk');
    $routes->post('barang-masuk/store', 'User::storeBarangMasuk');
    $routes->get('barang-masuk/edit/(:num)', 'User::editBarangMasuk/$1');
    $routes->post('barang-masuk/update/(:num)', 'User::updateBarangMasuk/$1');
    $routes->get('barang-masuk/delete/(:num)', 'User::deleteBarangMasuk/$1');
    
    // Barang Keluar routes
    $routes->get('barang-keluar', 'User::barangKeluar');
    $routes->get('barang-keluar/create', 'User::createBarangKeluar');
    $routes->post('barang-keluar/store', 'User::storeBarangKeluar');
    $routes->get('barang-keluar/edit/(:num)', 'User::editBarangKeluar/$1');
    $routes->post('barang-keluar/update/(:num)', 'User::updateBarangKeluar/$1');
    $routes->get('barang-keluar/delete/(:num)', 'User::deleteBarangKeluar/$1');
    
    // Laporan routes
    $routes->get('laporan', 'User::laporan');
    $routes->get('laporan/export/excel', 'User::exportExcel');
    $routes->get('laporan/export/pdf', 'User::exportPdf');
});