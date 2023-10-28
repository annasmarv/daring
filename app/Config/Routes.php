<?php namespace Config;

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
$routes->get('/setting', 'Setting\Website::index');
$routes->get('/data/modul', 'Data\Modul::index');
$routes->get('/data/modul/(:num)', 'Data\Modul::detail/$1');
$routes->get('/data/classgroup', 'Data\Classgroup::index', ['filter' => 'role:admin']);
$routes->get('/data/classgroup/(:num)', 'Data\Classgroup::detail/$1', ['filter' => 'role:admin']);
$routes->get('/data/subject', 'Data\Subject::index', ['filter' => 'role:admin']);
$routes->get('/learn/correction/(:num)/(:num)', 'Learn\Correction::index/$1/$2', ['filter' => 'role:admin,teacher']);
$routes->get('/correction/(:num)/(:num)', 'Correction::index/$1/$2', ['filter' => 'role:admin,teacher']);
$routes->get('/learn/task/(:num)', 'Learn\Task::detail/$1');
$routes->get('/learn/classes/(:num)/(:num)/(:num)', 'Learn\Classes::detail/$1/$2/$3');
$routes->get('/questbank', 'Questbank::index');
$routes->get('/questbank/(:num)', 'Questbank::detail/$1');
$routes->get('/quest/(:num)', 'Quest::index/$1');
$routes->get('/student/classes/(:num)/(:num)/(:num)', 'Student\Classes::detail/$1/$2/$3');
$routes->get('/student/modul/(:num)', 'Student\Modul::index/$1');
$routes->get('/student/tasks/', 'Student\Tasks::index');
$routes->get('/student/tasks/(:num)', 'Student\Tasks::detail/$1');
$routes->get('/student/exam/(:num)', 'Student\Exam::index/$1');
$routes->get('/ujian/(:num)', 'Ujian::detail/$1');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
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
