<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Modo sin sesión
$routes->get('/visitante', 'CVisitante::modoVisitante');
$routes->get('/visitante/lineasHorarios', 'CVisitante::lineasHorarios');    // pasar a la vista lineasHorarios
$routes->post('/visitante/lineasHorarios', 'CVisitante::lineasHorarios');    // Submit consulta de horarios
$routes->get('/visitante/tarifas', 'CVisitante::tarifas');      // pasar a la vista tarifas


// Autenticación de clientes
$routes->match(['GET', 'POST'], '/autenticacion', 'CLogin::index');

// Cerrar sesión
$routes->get('cerrarSession', 'CLogin::cerrarSession');

// Modificar datos cliente
$routes->get('modificarCliente', 'CClientes::modificarCliente'); //pasar a la vista modificar
$routes->post('modificarCliente', 'CClientes::modificarCliente'); //Click submit modificar
