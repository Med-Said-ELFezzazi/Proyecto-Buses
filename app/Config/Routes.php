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

// Modo con sesión 'Cliente'
// Autenticación
$routes->match(['GET', 'POST'], '/autenticacion', 'CLogin::index');
// Home 'bienvenida'
$routes->get('/home', 'CLogin::cargarHome');
// Modificar datos cliente
$routes->get('modificarCliente', 'CClientes::modificarCliente'); //pasar a la vista modificar
$routes->post('modificarCliente', 'CClientes::modificarCliente'); //Click submit modificar
// Consultar horarios
$routes->match(['GET', 'POST'], '/lineasHorarios', 'CVisitante::lineasHorarios');
// Consultar tarifas
$routes->get('/tarifas', 'CVisitante::tarifas');
// Reservar
$routes->match(['GET', 'POST'], '/reserva', 'CReserva::reservar');
$routes->match(['GET', 'POST'], '/reserva/servicios', 'CReserva::servicios');


// Cerrar sesión
$routes->get('cerrarSession', 'CLogin::cerrarSession');

