<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->get('/register', 'AuthController::register');
$routes->post('/proses-login', 'AuthController::prosesLogin');
$routes->post('/proses-register', 'AuthController::prosesRegister');
$routes->get('/hash', 'AuthController::hash');

// User
$routes->group('user', ['filter' => 'auth:user'], function ($routes) {
    $routes->get('dashboard', 'UserController::dashUser');
    $routes->get('pilih-kamar', 'UserController::pilihKamar');
    $routes->get('pembayaran', 'UserController::pembayaran');
    $routes->get('pindah-kamar', 'UserController::pindahKamar');
    $routes->post('proses-pindah-kamar', 'UserController::prosesPindah');
    $routes->get('history', 'UserController::riwayat');
    $routes->get('profile', 'UserController::profile');
    $routes->post('profile-update', 'UserController::updateProfile');
    $routes->post('password-update', 'UserController::updatePassword');
});

// Admin
$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('dashboard', 'AdminController::dashAdmin');
    $routes->get('penyewa', 'AdminController::penyewa');
    $routes->get('kamar', 'AdminController::kamar');
    $routes->get('pembayaran', 'AdminController::pembayaran');
    $routes->get('laporan-keuangan', 'AdminController::laporanKeuangan');
    $routes->get('pengaturan-akun', 'AdminController::pengaturanAkun');
    $routes->post('profile-update', 'AdminController::updateProfile');
    $routes->post('password-update', 'AdminController::updatePassword');
});
