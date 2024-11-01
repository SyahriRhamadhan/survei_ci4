<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Landing Page
$routes->get('/', 'Home::index');

// Authentication Routes
$routes->group('auth', static function($routes) {
    $routes->get('login', 'Auth\Login::index');
    $routes->post('login', 'Auth\Login::login_action');
    $routes->get('logout', 'Auth\Login::logout');
});


// Admin Routes
$routes->group('admin', static function($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // pertanyaan crud
    $routes->get('pertanyaan', 'Admin\Pertanyaan::index');
    $routes->get('pertanyaan/create', 'Admin\Pertanyaan::create');
    $routes->post('pertanyaan/store', 'Admin\Pertanyaan::store');
    $routes->get('pertanyaan/edit/(:segment)', 'Admin\Pertanyaan::edit/$1');
    $routes->post('pertanyaan/update/(:segment)', 'Admin\Pertanyaan::update/$1');
    $routes->get('pertanyaan/delete/(:segment)', 'Admin\Pertanyaan::delete/$1');

    // survei crud
    $routes->group('survei', function($routes){
        $routes->get('', 'Admin\Survei::index');
        $routes->get('create', 'Admin\Survei::create');
        $routes->post('store', 'Admin\Survei::store');
        $routes->get('edit/(:segment)', 'Admin\Survei::edit/$1');
        $routes->post('update/(:segment)', 'Admin\Survei::update/$1');
        $routes->get('delete/(:segment)', 'Admin\Survei::delete/$1');
        
    });

    // survei crud_unit_placeholder_pertanyaan
    $routes->group('placeholder', function($routes){
        $routes->get('', 'Admin\Placeholder::index');
        $routes->get('create', 'Admin\Placeholder::create');
        $routes->post('store', 'Admin\Placeholder::store');
        $routes->get('edit/(:segment)', 'Admin\Placeholder::edit/$1');
        $routes->post('update/(:segment)', 'Admin\Placeholder::update/$1');
        $routes->get('delete/(:segment)', 'Admin\Placeholder::delete/$1');
        
    });

    // survei crud_tipe_pertanyaan
    $routes->group('tipe_pertanyaan', function($routes){
        $routes->get('', 'Admin\TipePertanyaan::index');
        $routes->get('create', 'Admin\TipePertanyaan::create');
        $routes->post('store', 'Admin\TipePertanyaan::store');
        $routes->get('edit/(:segment)', 'Admin\TipePertanyaan::edit/$1');
        $routes->post('update/(:segment)', 'Admin\TipePertanyaan::update/$1');
        $routes->get('delete/(:segment)', 'Admin\TipePertanyaan::delete/$1');
        
    });

});

$routes->group('pimpinan', function($routes) {
    $routes->get('dashboard', 'Pimpinan\Dashboard::index');

});

$routes->group('unit', function($routes) {
    $routes->get('dashboard', 'Unit\Dashboard::index');
});

// Respondent Routes
$routes->group('responden', function($routes) {
    $routes->get('dashboard', 'Responden\Dashboard::index');
});
