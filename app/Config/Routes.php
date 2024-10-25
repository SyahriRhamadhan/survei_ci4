<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Landing Page
$routes->get('/', 'Home::index');
// Login
$routes->get('auth/login', 'Auth\Login::index');
$routes->post('auth/login', 'Auth\Login::login_action');
$routes->get('auth/logout', 'Auth\Login::logout');
// Dashboard
$routes->get('admin/dashboard', 'Admin\Dashboard::index');
$routes->get('pimpinan/dashboard', 'Pimpinan\Dashboard::index');
$routes->get('unit/dashboard', 'Unit\Dashboard::index');
