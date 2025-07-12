<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/register', 'AuthController::register');
$routes->post('/proses-login', 'AuthController::prosesLogin');
$routes->post('/proses-register', 'AuthController::prosesRegister');
$routes->get('/hash', 'AuthController::hash');

$routes->group('user', ['filter' => 'auth:user'], function ($routes) {
    $routes->get('dashboard', 'AuthController::tesU');
});

$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('dashboard', 'AuthController::tesA');
});
