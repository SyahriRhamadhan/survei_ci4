<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Landing Page
$routes->get('/', 'Home::index');

// Authentication Routes
$routes->group('auth', function($routes) {
    $routes->get('login', 'Login::index');
    $routes->post('login', 'Login::login_action');
    $routes->get('logout', 'Login::logout');
});


// Admin Routes
$routes->group('admin', function($routes) {
    $routes->get('admin', 'Admin\Dashboard::index');

    $routes->get('pertanyaan', 'Pertanyaan::index');
    $routes->get('pertanyaan/create', 'Pertanyaan::create');
    $routes->post('pertanyaan/store', 'Pertanyaan::store');
    $routes->get('pertanyaan/edit/(:segment)', 'Pertanyaan::edit/$1');
    $routes->post('pertanyaan/update/(:segment)', 'Pertanyaan::update/$1');
    $routes->get('pertanyaan/delete/(:segment)', 'Pertanyaan::delete/$1');
});

$routes->group('pimpinan', function($routes) {
    $routes->get('pimpinan', 'Pimpinan\Dashboard::index');

});

$routes->group('unit', function($routes) {
    $routes->get('unit', 'Unit\Dashboard::index');
});