<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->get('/', 'Dashboard::index');

// ini contoh restrict manual 

// restrict Kelas
$routes->get('/kelas', 'Kelas::index', ['filter' => 'role:Admin']);
$routes->get('/kelas/index', 'Kelas::index', ['filter' => 'role:Admin']);
$routes->get('/kelas/create', 'Kelas::create', ['filter' => 'role:Admin']);
$routes->get('/kelas/edit/(:num)', 'Kelas::edit/$1', ['filter' => 'role:Admin']);
$routes->get('/kelas/delete/(:num)', 'Kelas::delete/$1', ['filter' => 'role:Admin']);

// restrict spp
$routes->get('/spp', 'Spp::index', ['filter' => 'role:Admin']);
$routes->get('/spp/index', 'Spp::index', ['filter' => 'role:Admin']);
$routes->get('/spp/create', 'Spp::create', ['filter' => 'role:Admin']);
$routes->get('/spp/edit/(:num)', 'Spp::edit/$1', ['filter' => 'role:Admin']);
$routes->get('/spp/delete/(:num)', 'Spp::delete/$1', ['filter' => 'role:Admin']);

// restrict siswa
$routes->get('/siswa', 'Siswa::index', ['filter' => 'role:Admin,Petugas']);
$routes->get('/siswa/index', 'Siswa::index', ['filter' => 'role:Admin']);
$routes->get('/siswa/create', 'Siswa::create', ['filter' => 'role:Admin']);
$routes->get('/siswa/edit/(:num)', 'Siswa::edit/$1', ['filter' => 'role:Admin']);
$routes->get('/siswa/delete/(:num)', 'Siswa::delete/$1', ['filter' => 'role:Admin']);

// restrict petugas
$routes->get('/petugas', 'Petugas::index', ['filter' => 'role:Admin']);
$routes->get('/petugas/index', 'Petugas::index', ['filter' => 'role:Admin']);
$routes->get('/petugas/create', 'Petugas::create', ['filter' => 'role:Admin']);
$routes->get('/petugas/edit/(:num)', 'Petugas::edit/$1', ['filter' => 'role:Admin']);
$routes->get('/petugas/delete/(:num)', 'Petugas::delete/$1', ['filter' => 'role:Admin']);

// restrict petugas-admin

$routes->get('/siswa/akun', 'Siswa::akun', ['filter' => 'role:Admin']);
$routes->get('/petugas/akun', 'Petugas::akun', ['filter' => 'role:Admin']);


// restrict midtrans

// $routes->get('/midtrans/edit/(:num)', 'Midtrans::edit/$1', ['filter' => 'role:Admin,Petugas']);
// $routes->get('/midtrans/delete/(:num)', 'Midtrans::delete/$1', ['filter' => 'role:Admin,Petugas']);
// $routes->get('/midtrans/pembayaran)', 'Midtrans::pembayaran', ['filter' => 'role:Siswa']);






$routes->delete('/kelas/(:num)', 'kelas::delete/$1');
$routes->delete('/spp/(:num)', 'spp::delete/$1');
$routes->delete('/siswa/(:num)', 'siswa::delete/$1');
$routes->delete('/petugas/(:num)', 'petugas::delete/$1');


// harusnya edit pakek ini (contoh)
// $routes->get('/tgs2/edit/(:segment)', 'tgs2::edit/$1');
// $routes->get('/siswa/edit/(:segment)', 'siswa::edit/$1');

$routes->get('/', 'Midtrans::index', ['filter' => 'role:admin,siswa']);
$routes->get('/user', 'User::index', ['filter' => 'role:admin,siswa']);

// Auth Routes
// $routes->get('/login', 'Auth::index');
// $routes->get('/register', 'Auth::register');

// $routes->get('/pembayaran', 'Midtrans::pembayaran', ['filter' => 'role:admin,siswa']);
// $routes->get('/user', 'Midtrands::user', ['filter' => 'role:admin,user']);
// $routes->post('/midtrans/token', 'Midtrans::token', ['filter' => 'role:admin,siswa']);
// $routes->post('/midtrans/excel', 'Midtrans::excel', ['filter' => 'role:admin,siswa']);

$routes->get('/user', 'User::index', ['filter' => 'role:admin,siswa']);



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
