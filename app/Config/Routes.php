<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login','LoginController::traerPagina');
$routes->post('/login/acceder','LoginController::iniciarSesion');
$routes->get('/cerrar-sesion','LoginController::cerrarSesion');

$routes->get('/veterinario','Veterinario::index');
$routes->post('/veterinario/guardar','Veterinario::guardar');
$routes->post('/veterinario/guardar_mascota', 'Mascota::guardar');
$routes->get('/veterinario/editar/(:num)','Veterinario::editar/$1');

$routes->get('/veterinario/eliminar/(:num)','Mascota::eliminar/$1');
$routes->get('/propietario/eliminar/(:num)','Veterinario::eliminar/$1');

$routes->post('/historiaClinica/(:num)','HistoriaClinica::index/$1');

$routes->post('/mascota/actualizar/(:num)', 'Mascota::actualizar/$1');

$routes->get('/veterinario/busqueda','Veterinario::buscar');
$routes->get('/mascota/editar_mascota/(:num)','Mascota::editar/$1');
$routes->post('/veterinario/actualizar/(:num)','Veterinario::actualizar/$1');

$routes->get('/propietario', 'Propietario::index');
$routes->get('/propietario/editar/(:num)', 'Propietario::editar/$1');
$routes->post('/propietario/actualizar/(:num)', 'Propietario::actualizar/$1');
$routes->get('/propietario/imprimir/(:num)', 'Propietario::imprimir_historia/$1');
$routes->get('/propietario/exportar-mascotas/(:num)', 'Propietario::exportarExcelMascotas/$1');
$routes->get('/propietario/crearMascota', 'Propietario::crearMascota');
$routes->post('/propietario/guardarMascota', 'Propietario::guardarMascota');
$routes->get('/propietario/eliminarMascota/(:num)', 'Propietario::eliminarMascota/$1');
