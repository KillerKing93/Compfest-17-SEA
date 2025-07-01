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

// Rute untuk controller Subscription
$routes->get('subscription', 'Subscription::index');
$routes->post('subscription/process', 'Subscription::process');
$routes->get('subscription/success', 'Subscription::success');

// Jika Anda ingin mengizinkan akses ke method lain secara otomatis (tidak disarankan untuk produksi)
// $routes->setAutoRoute(true);