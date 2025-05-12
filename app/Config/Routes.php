<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
//$routes->get('codeigniter4', 'Home::index');
//$routes->get('Pelicula', 'Pelicula::index');
$routes->group('dashboard', function ($routes) {

    $routes->get ('Pelicula/etiquetas/(:num)', 'Dashboard\Pelicula::etiquetas/$1');
    $routes->post ('Pelicula/etiquetas/(:num)', 'Dashboard\Pelicula::etiquetas_post/$1');
    //$routes->post('pelicula/(:num)/etiqueta_delete/(:num)/delete','Dashboard\Pelicula::etiqueta_delete/$1/$2',['as'=>'pelicula.etiqueta_delete']);
    //$routes->post('Pelicula/(:num)/etiquetas/(:num)/delete', 'Dashboard\Pelicula::etiqueta_delete/$1/$2', ['as' => 'pelicula.etiqueta_delete']);
    $routes->post('Pelicula/(:num)/etiqueta_delete/(:num)/delete','Dashboard\Pelicula::etiqueta_delete/$1/$2');
   
   
   // $routes->get('register', '\App\Controllers\Web\Usuario::register');
    $routes->presenter('Pelicula', ['controller' => 'Dashboard\Pelicula']);
    $routes->presenter('Etiqueta', ['controller'=>'Dashboard\Etiqueta']);

    $routes->presenter('Categoria', ['controller' => 'Dashboard\Categoria']);


    $routes->get('usuario/crear', '\App\Controllers\Web\Usuario::crear_usuario');
    $routes->get('usuario/probar/contrasena', '\App\Controllers\Web\Usuario::probar_contrasena');
});


/////api
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->resource('pelicula');
    $routes->resource('categoria');
});

//parte del controlador App\Controllers\Web
//controlador Usuario
//funcion login iniciar session
//$routes->get('login','\App\Controllers\Web\Usuario::login',['as'=>'usuario.login']);
$routes->get('login', '\App\Controllers\Web\Usuario::login');
$routes->post('login_post', '\App\Controllers\Web\Usuario::login_post');

//registrar usuario 
$routes->get('register', '\App\Controllers\Web\Usuario::register');
$routes->post('register_post', '\App\Controllers\Web\Usuario::register_post');

//cerrar session
$routes->get('logout', '\App\Controllers\Web\Usuario::logout');
