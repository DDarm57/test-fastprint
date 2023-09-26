<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('auth/login', 'Auth::index');
$routes->get('/', 'Produk::index');
$routes->get("produk/(:any)", "Produk::$1");
$routes->get('kategoriProduk', 'KategoriProduk::index');
$routes->get('kategoriProduk/(:any)', 'KategoriProduk::$1');
$routes->setAutoRoute(true);
