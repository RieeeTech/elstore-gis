<?php

/**
 * ============================================================
 *  ELStore GIS — Routes (CodeIgniter 4)
 *  File: app/Config/Routes.php
 * ============================================================
 */

$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// ---------------------------------------------------------------
// Public routes
// ---------------------------------------------------------------
$routes->get('/',              'Home::index');
$routes->get('/peta',          'Home::peta', ['filter' => 'auth']);
$routes->get('/toko',          'Home::toko', ['filter' => 'auth']);
$routes->get('/toko/(:num)',   'Home::tokoDetail/$1', ['filter' => 'auth']);

// Language switcher
$routes->post('/lang/switch',  'Home::switchLang');

// GeoJSON API (public)
$routes->get('/api/stores',    'Home::apiStores');

// Rating API
$routes->post('/submit-rating', 'Home::submitRating');

// ---------------------------------------------------------------
// Auth routes
// ---------------------------------------------------------------
$routes->group('auth', function ($routes) {
    $routes->get('login',             'Auth::login');
    $routes->post('login-process',    'Auth::loginProcess');
    $routes->get('login-process',     'Auth::login'); // Fallback InfinityFree
    
    $routes->get('register',          'Auth::register');
    $routes->post('register-process', 'Auth::registerProcess');
    $routes->get('register-process',  'Auth::register'); // Fallback InfinityFree
    
    $routes->get('logout',            'Auth::logout');
    $routes->get('forgot-password',   'Auth::forgotPassword');
});

// ---------------------------------------------------------------
// User Dashboard (pengguna biasa)
// ---------------------------------------------------------------
$routes->group('dashboard', ['filter' => 'auth'], function ($routes) {
    $routes->get('/',       'Dashboard::index');
    $routes->get('profil',  'Dashboard::profil');
    $routes->post('profil', 'Dashboard::updateProfil');
});

// ---------------------------------------------------------------
// Pemilik Toko Dashboard
// ---------------------------------------------------------------
$routes->group('dashboard/toko', ['filter' => 'auth'], function ($routes) {
    $routes->get('/',                     'PemilikToko::index');
    $routes->get('tambah',                'PemilikToko::tambah');
    $routes->post('simpan',               'PemilikToko::simpan');
    $routes->get('edit/(:num)',           'PemilikToko::edit/$1');
    $routes->post('update/(:num)',        'PemilikToko::update/$1');
    $routes->get('hapus/(:num)',          'PemilikToko::hapus/$1');
    $routes->get('profil',               'PemilikToko::profil');
    $routes->post('profil',              'PemilikToko::updateProfil');
});

// ---------------------------------------------------------------
// Admin routes (protected)
// ---------------------------------------------------------------
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('/',                        'Admin\Dashboard::index');

    // Kelola Toko
    $routes->get('toko',                     'Admin\Toko::index');
    $routes->get('toko/persetujuan',         'Admin\Toko::persetujuan');
    $routes->get('toko/tambah',              'Admin\Toko::tambah');
    $routes->post('toko/simpan',             'Admin\Toko::simpan');
    $routes->get('toko/edit/(:num)',         'Admin\Toko::edit/$1');
    $routes->post('toko/update/(:num)',      'Admin\Toko::update/$1');
    $routes->get('toko/hapus/(:num)',        'Admin\Toko::hapus/$1');
    $routes->post('toko/toggle/(:num)',      'Admin\Toko::toggleStatus/$1');
    


    // Kelola Users
    $routes->get('users',                    'Admin\Users::index');
    $routes->get('users/edit/(:num)',        'Admin\Users::edit/$1');
    $routes->post('users/update/(:num)',     'Admin\Users::update/$1');
    $routes->get('users/hapus/(:num)',       'Admin\Users::hapus/$1');
    $routes->post('users/toggle/(:num)',     'Admin\Users::toggleStatus/$1');

    // Laporan & Peta Admin
    $routes->get('peta',                     'Admin\Dashboard::peta');
    $routes->get('laporan',                  'Admin\Dashboard::laporan');
    $routes->get('profil',                   'Admin\Dashboard::profil');
    $routes->post('profil',                  'Admin\Dashboard::updateProfil');
});