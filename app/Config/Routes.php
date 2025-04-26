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
    $routes->get('usuario/crear','\App\Controllers\Web\Usuario::crear_usuario');
    $routes->get('usuario/probar/contrasena','\App\Controllers\Web\Usuario::probar_contrasena');
    $routes->presenter('Categoria',['controller'=>'Dashboard\Categoria']);
});


//parte del controlador App\Controllers\Web
//controlador Usuario
//funcion login iniciar session
//$routes->get('login','\App\Controllers\Web\Usuario::login',['as'=>'usuario.login']);
$routes->get('login','\App\Controllers\Web\Usuario::login');
$routes->post('login_post','\App\Controllers\Web\Usuario::login_post');

//registrar usuario 
$routes->get('register','\App\Controllers\Web\Usuario::register');
$routes->post('register_post','\App\Controllers\Web\Usuario::register_post');

//cerrar session
$routes->get('logout','\App\Controllers\Web\Usuario::logout');
