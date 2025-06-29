<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Ini akan menampilkan homepage untuk memenuhi level 1
$routes->get('/level-one-home', 'Home::index');
