<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
//$routes->get('codeigniter4', 'Home::index');
//$routes->get('Pelicula', 'Pelicula::index');
$routes->group('dashboard', function ($routes) {

  $routes->get('Pelicula/etiquetas/(:num)', 'Dashboard\Pelicula::etiquetas/$1');
  $routes->post('Pelicula/etiquetas/(:num)', 'Dashboard\Pelicula::etiquetas_post/$1');
  //$routes->post('pelicula/(:num)/etiqueta_delete/(:num)/delete','Dashboard\Pelicula::etiqueta_delete/$1/$2',['as'=>'pelicula.etiqueta_delete']);
  //$routes->post('Pelicula/(:num)/etiquetas/(:num)/delete', 'Dashboard\Pelicula::etiqueta_delete/$1/$2', ['as' => 'pelicula.etiqueta_delete']);
  $routes->post('Pelicula/(:num)/etiqueta_delete/(:num)/delete', 'Dashboard\Pelicula::etiqueta_delete/$1/$2');
  $routes->post('Pelicula/borrar_imagen/  ', 'Dashboard\Pelicula::borrar_imagen/$1');
  $routes->get('Pelicula/descargar_imagen/(:num)', 'Dashboard\Pelicula::descargar_imagen/$1');




  // $routes->get('register', '\App\Controllers\Web\Usuario::register');
  $routes->presenter('Pelicula', ['controller' => 'Dashboard\Pelicula']);
  $routes->presenter('Etiqueta', ['controller' => 'Dashboard\Etiqueta']);

  $routes->presenter('Categoria', ['controller' => 'Dashboard\Categoria']);
});

$routes->get('usuario/crear', '\App\Controllers\Web\Usuario::crear_usuario');
$routes->get('usuario/probar/contrasena', '\App\Controllers\Web\Usuario::probar_contrasena');

////////////blog
$routes->group('blog', function ($routes) {
  $routes->get('', 'blog\Pelicula::index', ['as' => 'blog.pelicula.index']);
  $routes->get('categorias/(:num)', 'Blog\Pelicula::index_por_categoria/$1', ['as' => 'blog.pelicula.index_por_categoria']);
  $routes->get('etiquetas/(:num)', 'Blog\Pelicula::index_por_etiqueta/$1', ['as' => 'blog.pelicula.index_por_etiqueta']);

  $routes->get('(:num)', 'blog\Pelicula::show/$1', ['as' => 'blog.pelicula.show']);
  $routes->get('etiquetas_por_categoria/(:num)', 'blog\Pelicula::etiquetas_por_categoria/$1', ['as' => 'blog.pelicula.etiquetas_por_categoria']);
});

//$routes->get('sistemapeliculas/blog/(:num)', 'blog\Pelicula::show/$1', ['as' => 'blog.pelicula.show']);


/////api
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
  $routes->get('pelicula/paginado', 'Pelicula::paginado');
  $routes->get('pelicula/paginado_full', 'Pelicula::paginado_full');
  $routes->get('pelicula/index_por_categoria/(:num)', 'Pelicula::index_por_categoria/$1');
  $routes->get('pelicula/index_por_etiqueta/(:num)', 'Pelicula::index_por_etiqueta/$1');
  $routes->delete('Pelicula/(:num)/imagen/delete(:num)', 'Pelicula::borrar_imagen/$1/$2');
  $routes->delete('Pelicula/(:num)/etiqueta_delete/(:num)/delete', 'Pelicula::etiqueta_delete/$1/$2');

  $routes->post('pelicula/etiquetas/(:num)', 'Pelicula::etiquetas_post/$1');
  $routes->post('pelicula/(:num)/imagen/upload', 'Pelicula::upload/$1');


  $routes->resource('pelicula');
  $routes->resource('categoria');
  $routes->resource('etiqueta');
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
