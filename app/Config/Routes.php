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

$routes->get('/user', 'AuthController::tesU');
$routes->get('/admin', 'AuthController::tesA');
