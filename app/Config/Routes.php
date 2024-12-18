<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Modo sin sesión 'el visitante puede consultar viajes,horario,tarifas
$routes->get('/visitante', ''); //bienvenida maybe

// Autenticación de clientes
$routes->match(['GET', 'POST'], '/autenticacion', 'CLogin::index');

// Cerrar sesión
$routes->get('cerrarSession', 'CLogin::cerrarSession');

// Modificar datos cliente
$routes->get('modificarCliente', 'CClientes::modificarCliente'); //pasar a la vista modificar
$routes->post('modificarCliente', 'CClientes::modificarCliente'); //Click submit modificar

