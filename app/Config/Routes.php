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
    $routes->get('kamar/pilih/(:num)', 'UserController::pilih/$1');
    $routes->get('pembayaran', 'UserController::pembayaran');
    $routes->post('proses-pembayaran', 'UserController::prosesPembayaran');
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
    $routes->get('penyewa/detail/(:num)', 'AdminController::detailPenyewa/$1');
    // Penyewa CRUD
    $routes->post('penyewa/tambah', 'AdminController::tambahPenyewa');
    $routes->post('penyewa/edit/(:num)', 'AdminController::editPenyewa/$1');
    $routes->post('penyewa/hapus/(:num)', 'AdminController::hapusPenyewa/$1');
    $routes->get('kamar', 'AdminController::kamar');
    $routes->post('kamar/store', 'AdminController::storeKamar');
    $routes->post('kamar/update/(:num)', 'AdminController::updateKamar/$1');
    $routes->post('kamar/delete/(:num)', 'AdminController::deleteKamar/$1');
    $routes->get('pembayaran', 'AdminController::pembayaran');
    $routes->post('pembayaran/update-status', 'AdminController::updateStatusPembayaran');
    $routes->get('pembayaran/detail/(:num)', 'AdminController::detailPembayaran/$1');
    $routes->get('laporan-keuangan', 'AdminController::laporanKeuangan');
    $routes->get('pengaturan-akun', 'AdminController::pengaturanAkun');
    $routes->post('profile-update', 'AdminController::updateProfile');
    $routes->post('password-update', 'AdminController::updatePassword');
    // Pindah Kamar (Admin actions)
    $routes->post('pindah-kamar/approve/(:num)', 'AdminController::approvePindahKamar/$1');
    $routes->post('pindah-kamar/reject/(:num)', 'AdminController::rejectPindahKamar/$1');
});
