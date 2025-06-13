<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

// Home route
$routes->get('/', 'Home::index');

// Support Routes
$routes->group('', function($routes) {
    $routes->get('help-center', 'Pages::helpCenter');
    $routes->get('documentation', 'Pages::documentation');
    $routes->get('api-reference', 'Pages::apiReference');
    $routes->get('community', 'Pages::community');
    $routes->get('contact', 'Pages::contact');
});
