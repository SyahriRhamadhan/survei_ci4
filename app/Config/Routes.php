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

//Admin pertanyaan
$routes->get('admin/pertanyaan', 'Admin\Pertanyaan::index');
$routes->get('admin/pertanyaan/create', 'Admin\Pertanyaan::create');
$routes->post('admin/pertanyaan/store', 'Admin\Pertanyaan::store');
$routes->get('admin/pertanyaan/edit/(:segment)', 'Admin\Pertanyaan::edit/$1',);
$routes->post('admin/pertanyaan/update/(:segment)', 'Admin\Pertanyaan::update/$1');
$routes->get('admin/pertanyaan/delete/(:segment)', 'Admin\Pertanyaan::delete/$1');
