<?php
/**
 * Datahan Test-Case 1
 * V1.0
 *
 *  Created by Seçkin Kılınç.
 */
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');

/* giriş rotaları */
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');
/* giriş rotaları */

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/admin', 'Dashboard::index'); // panel route

    // Profil
    $routes->get('admin/profile', 'Admin\Profile::index');
    $routes->post('admin/profile', 'Admin\Profile::update');

    // Varyant CRUD işlemleri (resource route kullanarak)
    $routes->presenter('admin/variants', ['namespace' => 'App\Controllers']);
    $routes->get('admin/variants/delete/(:num)', 'Admin\Variants::delete/$1');

    // Ürün işlemleri
    $routes->presenter('admin/products', ['namespace' => 'App\Controllers']);

    $routes->get('admin/productsList', 'Admin\Products::list');

    // Live search için AJAX route'u

    $routes->get('products/search', 'Admin\Product::search');

});
