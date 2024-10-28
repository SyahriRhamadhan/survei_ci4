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

/**
 * Grouping for separating routes for admin, pimpinan, and unit
 */

// Admin routes
$routes->group('admin', static function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // Pertanyaan routes
    $routes->get('pertanyaan', 'Admin\Pertanyaan::index');
    $routes->get('pertanyaan/create', 'Admin\Pertanyaan::create');
    $routes->post('pertanyaan/store', 'Admin\Pertanyaan::store');
    $routes->get('pertanyaan/edit/(:segment)', 'Admin\Pertanyaan::edit/$1');
    $routes->post('pertanyaan/update/(:segment)', 'Admin\Pertanyaan::update/$1');
    $routes->get('pertanyaan/delete/(:segment)', 'Admin\Pertanyaan::delete/$1');
});

// Pimpinan routes
$routes->group('pimpinan', static function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Pimpinan\Dashboard::index');
});

// Unit routes
$routes->group('unit', static function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Unit\Dashboard::index');
});