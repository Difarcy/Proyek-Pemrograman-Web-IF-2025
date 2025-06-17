<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin');

// Admin routes
$routes->get('/admin/dashboard', 'Admin::dashboard');

// Pegawai routes
$routes->get('/pegawai/dashboard', 'Pegawai::dashboard');
