<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LampController::index');
$routes->get('/lamps/(:any)', 'LampController::updateLamp/$1');
$routes->post('/lamps/(:any)', 'LampController::updateLamp/$1');
