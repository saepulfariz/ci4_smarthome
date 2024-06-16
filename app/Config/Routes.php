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
    $routes->get('lamps', 'Api\LampController');
    $routes->get('lamps/(:any)', 'Api\LampController::updateLamp/$1');
    $routes->get('histories', 'Api\HistoryController::index');
    $routes->get('status', 'Api\StatusController::index');
});
