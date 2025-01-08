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
// REalizar la compra
$routes->post('/reserva/servicios/compra', 'CReserva::realizarCompra');


// Cerrar sesión
$routes->get('cerrarSession', 'CLogin::cerrarSession');

// ADMIN
$routes->get('/admin/home', 'CAdmin::index');
// Administración de buses
$routes->get('/admin/buses', 'CAdmin::administracionBuses'); // Cargar vista con datosBuses
$routes->post('/admin/buses', 'CAdmin::administracionBuses'); // Insertar nuevo bus
// $routes->post('/admin/buses/modificar', 'CAdmin::modificarBus'); // Elim

// Gestion de averias
$routes->get('/admin/averias', 'CAverias::gestionAverias'); // Cargar la vista
$routes->post('/admin/averias', 'CAverias::gestionAverias'); // Aplicar filtros 

// Modificar averia
$routes->get('/admin/averias/modificar/(:num)', 'CAverias::modificarAveria/$1');