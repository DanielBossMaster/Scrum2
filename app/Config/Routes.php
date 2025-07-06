<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login','LoginController::traerPagina');
$routes->post('/login/acceder','LoginController::iniciarSesion');

$routes->get('/veterinario','Veterinario::index');
$routes->post('/veterinario/guardar','Veterinario::guardar');
$routes->post('/veterinario/guardar_mascota', 'Mascota::guardar');
$routes->get('/veterinario/editar/(:num)','Veterinario::editar/$1');
$routes->post('/veterinario/actualizar/(:num)','Veterinario::actualizar/$1');
$routes->get('/veterinario/eliminar/(:num)','Veterinario::eliminar/$1');
$routes->get('/mascota/eliminar/(:num)','Mascota::eliminar/$1');
$routes->get('/propietario','Propietario::index');
$routes->get('/propietario/editar','Propietario::editar');
$routes->post('/mascota/actualizar/(:num)', 'Mascota::actualizar/$1');
