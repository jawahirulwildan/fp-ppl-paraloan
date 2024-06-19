<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(true);
$routes->get('/', 'Home::index');
$routes->post('/', 'Home::login_user');

$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/profile', 'DashboardController::profile');

$routes->get('/register', 'UserController::index');
$routes->post('/register', 'UserController::register_user');

$routes->get('/request-loan', 'LoanController::index');
$routes->post('/request-loan', 'LoanController::continue');
$routes->post('/confirmation-loan', 'LoanController::confirm');

$routes->get('/pay/(:num)', 'LoanController::indexPay/$1');
$routes->post('/pay/(:num)', 'LoanController::payment/$1');

