<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Ini akan menampilkan homepage untuk memenuhi level 1
$routes->get('/level-one-home', 'Home::index');

// Menggunakan controller Pages sebagai controller utama
$routes->get('/', 'Pages::index');
$routes->get('menu', 'Pages::menu');
$routes->get('subscription', 'Pages::subscription');
$routes->get('contact', 'Pages::contact');

// Rute untuk menangani pengiriman formulir testimoni
$routes->post('testimonial/add', 'Pages::addTestimonial');

// Jika Anda ingin mengizinkan akses ke method lain secara otomatis (tidak disarankan untuk produksi)
// $routes->setAutoRoute(true);