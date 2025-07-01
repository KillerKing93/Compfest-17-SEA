<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Ini akan menampilkan homepage untuk memenuhi level 1
$routes->get('/level-one-home', 'Home::index');

// Rute untuk controller Pages (halaman statis & menu)
$routes->get('/', 'Pages::index');
$routes->get('menu', 'Pages::menu');
$routes->get('contact', 'Pages::contact');
$routes->post('testimonial/add', 'Pages::addTestimonial');

// Rute untuk Autentikasi
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::attemptRegister');
$routes->get('logout', 'Auth::logout');

// Rute untuk Subscription yang dilindungi oleh filter 'auth'
$routes->group('subscription', ['filter' => 'auth'], function($routes) {
    $routes->get('', 'Subscription::index');
    $routes->post('process', 'Subscription::process');
    $routes->get('success', 'Subscription::success');
});



// Jika Anda ingin mengizinkan akses ke method lain secara otomatis (tidak disarankan untuk produksi)
// $routes->setAutoRoute(true);