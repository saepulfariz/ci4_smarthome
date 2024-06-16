<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LampController::index');
$routes->get('/lamps/(:any)', 'LampController::updateLamp/$1');
$routes->post('/lamps/(:any)', 'LampController::updateLamp/$1');

$routes->get('/histories', 'HistoryController::index');

// no filter, set Config/Filters.php
// $routes->group('api', ['filter' => 'csrf'], function ($routes) {
$routes->group('api', function ($routes) {
    $routes->get('lamps', 'Api\LampsController');
});
