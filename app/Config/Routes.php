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
    $routes->get('dashboard', 'DashboardController::index');
    // Barang
    $routes->get('stok-barang', 'BarangController::index');
    $routes->get('stok-barang/create', 'BarangController::create');
    $routes->post('stok-barang/store', 'BarangController::store');
    $routes->get('stok-barang/edit/(:num)', 'BarangController::edit/$1');
    $routes->post('stok-barang/update/(:num)', 'BarangController::update/$1');
    $routes->post('stok-barang/delete/(:num)', 'BarangController::delete/$1');
    $routes->get('stok-barang/get/(:num)', 'BarangController::get/$1');
    $routes->get('stok-barang/export', 'BarangController::export');
    $routes->get('stok-barang/kategori-list', 'BarangController::kategoriList');
    $routes->get('stok-barang/search', 'BarangController::search');
    // Customer
    $routes->get('data-customer', 'CustomerController::index');
    $routes->get('data-customer/create', 'CustomerController::create');
    $routes->post('data-customer/store', 'CustomerController::store');
    $routes->get('data-customer/edit/(:num)', 'CustomerController::edit/$1');
    $routes->post('data-customer/update/(:num)', 'CustomerController::update/$1');
    $routes->post('data-customer/delete/(:num)', 'CustomerController::delete/$1');
    $routes->get('data-customer/get/(:num)', 'CustomerController::get/$1');
    $routes->get('data-customer/export', 'CustomerController::export');
    $routes->get('data-customer/search', 'CustomerController::search');
    // Supplier
    $routes->get('data-supplier', 'SupplierController::index');
    $routes->get('data-supplier/create', 'SupplierController::create');
    $routes->post('data-supplier/store', 'SupplierController::store');
    $routes->get('data-supplier/edit/(:num)', 'SupplierController::edit/$1');
    $routes->post('data-supplier/update/(:num)', 'SupplierController::update/$1');
    $routes->post('data-supplier/delete/(:num)', 'SupplierController::delete/$1');
    $routes->get('data-supplier/get/(:num)', 'SupplierController::get/$1');
    $routes->get('data-supplier/export', 'SupplierController::export');
    $routes->get('data-supplier/search', 'SupplierController::search');
    // Petugas
    $routes->get('data-petugas', 'PetugasController::index');
    $routes->get('data-petugas/create', 'PetugasController::create');
    $routes->post('data-petugas/store', 'PetugasController::store');
    $routes->get('data-petugas/edit/(:num)', 'PetugasController::edit/$1');
    $routes->post('data-petugas/update/(:num)', 'PetugasController::update/$1');
    $routes->post('data-petugas/delete/(:num)', 'PetugasController::delete/$1');
    $routes->get('data-petugas/get/(:num)', 'PetugasController::get/$1');
    $routes->get('data-petugas/export', 'PetugasController::export');
    $routes->get('data-petugas/search', 'PetugasController::search');
    // Barang Masuk
    $routes->get('barang-masuk', 'BarangMasukController::index');
    $routes->get('barang-masuk/create', 'BarangMasukController::create');
    $routes->post('barang-masuk/store', 'BarangMasukController::store');
    $routes->get('barang-masuk/edit/(:num)', 'BarangMasukController::edit/$1');
    $routes->post('barang-masuk/update/(:num)', 'BarangMasukController::update/$1');
    $routes->post('barang-masuk/delete/(:num)', 'BarangMasukController::delete/$1');
    $routes->get('barang-masuk/get/(:num)', 'BarangMasukController::get/$1');
    $routes->get('barang-masuk/export', 'BarangMasukController::export');
    $routes->get('barang-masuk/search', 'BarangMasukController::search');
    // Barang Keluar
    $routes->get('barang-keluar', 'BarangKeluarController::index');
    $routes->get('barang-keluar/create', 'BarangKeluarController::create');
    $routes->post('barang-keluar/store', 'BarangKeluarController::store');
    $routes->get('barang-keluar/edit/(:num)', 'BarangKeluarController::edit/$1');
    $routes->post('barang-keluar/update/(:num)', 'BarangKeluarController::update/$1');
    $routes->post('barang-keluar/delete/(:num)', 'BarangKeluarController::delete/$1');
    $routes->get('barang-keluar/get/(:num)', 'BarangKeluarController::get/$1');
    $routes->get('barang-keluar/export', 'BarangKeluarController::export');
    $routes->get('barang-keluar/search', 'BarangKeluarController::search');
    // Kelola Pengguna routes
    $routes->get('kelola-pengguna', 'Admin::kelolaPengguna');
    $routes->post('kelola-pengguna/store', 'Admin::storeUser');
    $routes->get('kelola-pengguna/get/(:num)', 'Admin::getUser/$1');
    $routes->post('kelola-pengguna/update/(:num)', 'Admin::updateUser/$1');
    $routes->post('kelola-pengguna/toggle-status/(:num)', 'Admin::toggleUserStatus/$1');
    $routes->post('kelola-pengguna/delete/(:num)', 'Admin::deleteUser/$1');
    $routes->get('kelola-pengguna/export', 'Admin::exportUsers');
    $routes->get('kelola-pengguna/search', 'Admin::searchUser');
    
    // Test route

    $routes->get('profil-toko', 'Admin::profilToko');
    $routes->post('profil-toko/update', 'Admin::updateProfilToko');
    $routes->post('profil-toko/update-foto', 'Admin::updateFotoToko');

    // Rute untuk profil dan reset password
    $routes->get('profil', 'Admin::profil');
    $routes->post('profil/update', 'Admin::updateProfil');
    $routes->post('profil/update-foto', 'Admin::updateFotoProfil');
    $routes->get('reset-password', 'Admin::resetPassword');
    $routes->post('reset-password-action', 'Admin::resetPasswordAction');
});

// User routes
$routes->group('user', ['filter' => 'auth:user'], function($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    // Barang
    $routes->get('stok-barang', 'BarangController::index');
    $routes->get('stok-barang/create', 'BarangController::create');
    $routes->post('stok-barang/store', 'BarangController::store');
    $routes->get('stok-barang/edit/(:num)', 'BarangController::edit/$1');
    $routes->post('stok-barang/update/(:num)', 'BarangController::update/$1');
    $routes->post('stok-barang/delete/(:num)', 'BarangController::delete/$1');
    $routes->get('stok-barang/get/(:num)', 'BarangController::get/$1');
    $routes->get('stok-barang/export', 'BarangController::export');
    $routes->get('stok-barang/kategori-list', 'BarangController::kategoriList');
    $routes->get('stok-barang/search', 'BarangController::search');
    // Customer
    $routes->get('data-customer', 'CustomerController::index');
    $routes->get('data-customer/create', 'CustomerController::create');
    $routes->post('data-customer/store', 'CustomerController::store');
    $routes->get('data-customer/edit/(:num)', 'CustomerController::edit/$1');
    $routes->post('data-customer/update/(:num)', 'CustomerController::update/$1');
    $routes->post('data-customer/delete/(:num)', 'CustomerController::delete/$1');
    $routes->get('data-customer/get/(:num)', 'CustomerController::get/$1');
    $routes->get('data-customer/export', 'CustomerController::export');
    $routes->get('data-customer/search', 'CustomerController::search');
    // Supplier
    $routes->get('data-supplier', 'SupplierController::index');
    $routes->get('data-supplier/create', 'SupplierController::create');
    $routes->post('data-supplier/store', 'SupplierController::store');
    $routes->get('data-supplier/edit/(:num)', 'SupplierController::edit/$1');
    $routes->post('data-supplier/update/(:num)', 'SupplierController::update/$1');
    $routes->post('data-supplier/delete/(:num)', 'SupplierController::delete/$1');
    $routes->get('data-supplier/get/(:num)', 'SupplierController::get/$1');
    $routes->get('data-supplier/export', 'SupplierController::export');
    $routes->get('data-supplier/search', 'SupplierController::search');
    // Petugas
    $routes->get('data-petugas', 'PetugasController::index');
    $routes->get('data-petugas/create', 'PetugasController::create');
    $routes->post('data-petugas/store', 'PetugasController::store');
    $routes->get('data-petugas/edit/(:num)', 'PetugasController::edit/$1');
    $routes->post('data-petugas/update/(:num)', 'PetugasController::update/$1');
    $routes->post('data-petugas/delete/(:num)', 'PetugasController::delete/$1');
    $routes->get('data-petugas/get/(:num)', 'PetugasController::get/$1');
    $routes->get('data-petugas/export', 'PetugasController::export');
    $routes->get('data-petugas/search', 'PetugasController::search');
    // Barang Masuk
    $routes->get('barang-masuk', 'BarangMasukController::index');
    $routes->get('barang-masuk/create', 'BarangMasukController::create');
    $routes->post('barang-masuk/store', 'BarangMasukController::store');
    $routes->get('barang-masuk/edit/(:num)', 'BarangMasukController::edit/$1');
    $routes->post('barang-masuk/update/(:num)', 'BarangMasukController::update/$1');
    $routes->post('barang-masuk/delete/(:num)', 'BarangMasukController::delete/$1');
    $routes->get('barang-masuk/get/(:num)', 'BarangMasukController::get/$1');
    $routes->get('barang-masuk/export', 'BarangMasukController::export');
    $routes->get('barang-masuk/search', 'BarangMasukController::search');
    // Barang Keluar
    $routes->get('barang-keluar', 'BarangKeluarController::index');
    $routes->get('barang-keluar/create', 'BarangKeluarController::create');
    $routes->post('barang-keluar/store', 'BarangKeluarController::store');
    $routes->get('barang-keluar/edit/(:num)', 'BarangKeluarController::edit/$1');
    $routes->post('barang-keluar/update/(:num)', 'BarangKeluarController::update/$1');
    $routes->post('barang-keluar/delete/(:num)', 'BarangKeluarController::delete/$1');
    $routes->get('barang-keluar/get/(:num)', 'BarangKeluarController::get/$1');
    $routes->get('barang-keluar/export', 'BarangKeluarController::export');
    $routes->get('barang-keluar/search', 'BarangKeluarController::search');
    // Rute untuk profil dan reset password user
    $routes->get('profil', 'User::profil');
    $routes->post('profil/update', 'User::updateProfil');
    $routes->post('profil/update-foto', 'User::updateFotoProfil');
    $routes->get('reset-password', 'User::resetPassword');
    $routes->post('reset-password-action', 'User::resetPasswordAction');
});