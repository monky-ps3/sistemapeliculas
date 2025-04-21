<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
//$routes->get('codeigniter4', 'Home::index');
//$routes->get('Pelicula', 'Pelicula::index');
$routes->group('dashboard', function ($routes) {
    $routes->presenter('Pelicula',['controller'=>'Dashboard\Pelicula']);
    $routes->presenter('Categoria',['controller'=>'Dashboard\Categoria']);
});
