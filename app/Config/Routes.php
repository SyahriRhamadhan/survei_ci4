<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Landing Page
$routes->get('/', 'Home::index');

// Authentication Routes
$routes->group('auth', static function ($routes) {
    $routes->get('login', 'Auth\Login::index');
    $routes->post('login', 'Auth\Login::login_action');
    $routes->get('logout', 'Auth\Login::logout');
});

/**
 * Grouping untuk misahin route untuk admin, pimpinan & unit (biar kalo routenya dah banyak nggak ribet & lebih rapi)
 */
// admin routes
$routes->group('admin', static function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('chartfilterunit/(:segment)', 'Admin\Dashboard::hitungIKMUnit/$1');
    $routes->post('update-status', 'Admin\Dashboard::updateStatus');

    // pertanyaan crud
    $routes->get('pertanyaan', 'Admin\Pertanyaan::index');
    $routes->get('pertanyaan/create', 'Admin\Pertanyaan::create');
    $routes->post('pertanyaan/store', 'Admin\Pertanyaan::store');
    $routes->get('pertanyaan/edit/(:segment)', 'Admin\Pertanyaan::edit/$1');
    $routes->post('pertanyaan/update/(:segment)', 'Admin\Pertanyaan::update/$1');
    $routes->get('pertanyaan/delete/(:segment)', 'Admin\Pertanyaan::delete/$1');

    // survei crud
    $routes->group('survei', function ($routes) {
        $routes->get('', 'Admin\Survei::index');
        $routes->get('create', 'Admin\Survei::create');
        $routes->post('store', 'Admin\Survei::store');
        $routes->get('edit/(:segment)', 'Admin\Survei::edit/$1');
        $routes->post('update/(:segment)', 'Admin\Survei::update/$1');
        $routes->get('delete/(:segment)', 'Admin\Survei::delete/$1');
        $routes->get('detail/(:segment)', 'Admin\Survei::detail/$1');
    });

    // survei crud_unit_placeholder_pertanyaan
    $routes->group('placeholder', function ($routes) {
        $routes->get('', 'Admin\Placeholder::index');
        $routes->get('create', 'Admin\Placeholder::create');
        $routes->post('store', 'Admin\Placeholder::store');
        $routes->get('edit/(:segment)', 'Admin\Placeholder::edit/$1');
        $routes->post('update/(:segment)', 'Admin\Placeholder::update/$1');
        $routes->get('delete/(:segment)', 'Admin\Placeholder::delete/$1');
    });

    // survei crud_tipe_pertanyaan
    $routes->group('tipe_pertanyaan', function ($routes) {
        $routes->get('', 'Admin\TipePertanyaan::index');
        $routes->get('create', 'Admin\TipePertanyaan::create');
        $routes->post('store', 'Admin\TipePertanyaan::store');
        $routes->get('edit/(:segment)', 'Admin\TipePertanyaan::edit/$1');
        $routes->post('update/(:segment)', 'Admin\TipePertanyaan::update/$1');
        $routes->get('delete/(:segment)', 'Admin\TipePertanyaan::delete/$1');
    });

    // Prodi
    $routes->group('prodi', function ($routes) {
        $routes->get('', 'Admin\Prodi::index');
        $routes->get('create', 'Admin\Prodi::create');
        $routes->post('store', 'Admin\Prodi::store');
        $routes->get('edit/(:segment)', 'Admin\Prodi::edit/$1');
        $routes->post('update/(:segment)', 'Admin\Prodi::update/$1');
        $routes->get('delete/(:segment)', 'Admin\Prodi::delete/$1');
    });

    // Fakultas
    $routes->group('fakultas', function ($routes) {
        $routes->get('', 'Admin\Fakultas::index');
        $routes->get('create', 'Admin\Fakultas::create');
        $routes->post('store', 'Admin\Fakultas::store');
        $routes->get('edit/(:segment)', 'Admin\Fakultas::edit/$1');
        $routes->post('update/(:segment)', 'Admin\Fakultas::update/$1');
        $routes->get('delete/(:segment)', 'Admin\Fakultas::delete/$1');
    });

    //Unit Kerja
    $routes->group('unit', function ($routes) {
        $routes->get('', 'Admin\Unit::index');
        $routes->get('create', 'Admin\Unit::create');
        $routes->post('store', 'Admin\Unit::store');
        $routes->get('edit/(:segment)', 'Admin\Unit::edit/$1');
        $routes->post('update/(:segment)', 'Admin\Unit::update/$1');
        $routes->get('delete/(:segment)', 'Admin\Unit::delete/$1');
    });

    //Akun
    $routes->group('user', function ($routes) {
        $routes->get('', 'Admin\User::index');
        $routes->get('create', 'Admin\User::create');
        $routes->post('store', 'Admin\User::store');
        $routes->get('edit/(:segment)', 'Admin\User::edit/$1');
        $routes->post('update/(:segment)', 'Admin\User::update/$1');
        $routes->get('delete/(:segment)', 'Admin\User::delete/$1');
    });
});

// pimpinan routes
$routes->group('pimpinan', static function ($routes) {
    // dashboard
    $routes->get('dashboard', 'Pimpinan\Dashboard::index');
});

// unit routes
$routes->group('unit', static function ($routes) {
    // dashboard
    $routes->get('dashboard', 'Unit\Dashboard::index');
});

// Respondent Routes
$routes->group('responden', function ($routes) {
    $routes->get('dashboard', 'Responden\Dashboard::index');
    $routes->get('layanan', 'Responden\Layanan::index');
    $routes->get('survei/detail/(:segment)', 'Responden\Layanan::detail/$1');
    $routes->post('layanan/store', 'Responden\Layanan::store');
    $routes->get('chartfilter/(:segment)', 'Responden\Dashboard::filter/$1');
    // $routes->get('chartfilterunit/(:segment)', 'Responden\Dashboard::filterUnit/$1');
    $routes->get('chartfilterunit/(:segment)', 'Responden\Dashboard::hitungIKMUnit/$1');

});
