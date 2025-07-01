<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Ini akan menampilkan homepage untuk memenuhi level 1
$routes->get('/level-one-home', 'Home::index');

// Rute Publik
$routes->get('/', 'Pages::index');
$routes->get('menu', 'Pages::menu');
$routes->get('contact', 'Pages::contact');
$routes->post('testimonial/add', 'Pages::addTestimonial');

// Rute Autentikasi
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::attemptRegister');
$routes->get('logout', 'Auth::logout');

// Grup rute yang memerlukan login (User)
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('subscription', 'Subscription::index');
    $routes->post('subscription/process', 'Subscription::process');
    $routes->get('subscription/success', 'Subscription::success');

    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('dashboard/cancel/(:num)', 'Dashboard::cancel/$1');
    $routes->post('dashboard/pause/(:num)', 'Dashboard::pause/$1');
    $routes->get('dashboard/resume/(:num)', 'Dashboard::resume/$1');
});

// Grup rute yang memerlukan login sebagai Admin
$routes->group('admin', ['filter' => ['auth', 'admin']], function($routes) {
    $routes->get('', 'Admin::index');
});





// Jika Anda ingin mengizinkan akses ke method lain secara otomatis (tidak disarankan untuk produksi)
// $routes->setAutoRoute(true);