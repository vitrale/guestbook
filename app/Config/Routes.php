<?php namespace Config;

use App\Controllers\AuthenticationController;
use App\Controllers\PostController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('/403', 'AuthenticationController::notAuthorizedPage', ['as' => AuthenticationController::NOT_AUTHORIZED_PAGE_ROUTE_ALIAS]);
$routes->get('/register', 'AuthenticationController::registerPage', ['as' => AuthenticationController::REGISTER_PAGE_ROUTE_ALIAS]);
$routes->post('/register', 'AuthenticationController::register', ['as' => AuthenticationController::REGISTER_ROUTE_ALIAS]);
$routes->get('/login', 'AuthenticationController::loginPage', ['as' => AuthenticationController::LOGIN_PAGE_ROUTE_ALIAS]);
$routes->post('/login', 'AuthenticationController::login', ['as' => AuthenticationController::LOGIN_ROUTE_ALIAS]);
$routes->get('/logout', 'AuthenticationController::logout', ['as' => AuthenticationController::LOGOUT_ROUTE_ALIAS]);

$routes->get('/post', 'PostController::listPage', ['as' => PostController::LIST_PAGE_ROUTE_ALIAS, 'filter' => 'auth:post-read']);
$routes->get('/post-new', 'PostController::addPage', ['as' => PostController::ADD_PAGE_ROUTE_ALIAS, 'filter' => 'auth:post-write']);
$routes->post('/post-add', 'PostController::add', ['as' => PostController::ADD_ROUTE_ALIAS, 'filter' => 'auth:post-write']);
$routes->get('/test', 'CliController::another');


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
