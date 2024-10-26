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
 * Grouping untuk misahin route untuk admin, pimpinan & unit (biar kalo routenya dah banyak nggak ribet & lebih rapi)
 */
// admin routes
$routes->group('admin', static function ($routes){
    // Dashboard
    $routes->get('dashboard', 'Admin\Dashboard::index');

});

// pimpinan routes
$routes->group('pimpinan', static function ($routes){
    // dashboard
    $routes->get('dashboard', 'Pimpinan\Dashboard::index');

});

// unit routes
$routes->group('unit', static function ($routes){
    // dashboard
    $routes->get('dashboard', 'Unit\Dashboard::index');

});

