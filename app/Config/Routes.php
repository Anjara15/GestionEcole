<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('/login/authenticate', 'Login::authenticate');
$routes->get('/logout', 'Login::logout');
$routes->get('/dashboard', 'Dashboard::dashboard');
$routes->get('/', 'Dashboard::index');

//chemin pour gérer les étudiant
$routes->get('students', 'Students::index');
$routes->get('students/edit/(:num)', 'Students::edit/$1');
$routes->post('students/update/(:num)', 'Students::update/$1');
$routes->get('students/add', 'Students::add');
$routes->post('students/create', 'Students::create');
$routes->get('students/delete/(:num)', 'Students::delete/$1'); 

// chemin pour gérer les profs
$routes->get('/teachers', 'Teachers::index');
$routes->get('/teachers/add', 'Teachers::add');
$routes->post('teachers/create', 'teachers::create');
$routes->get('teachers/edit/(:num)', 'teachers::edit/$1');
$routes->post('teachers/update/(:num)', 'teachers::update/$1');
$routes->get('/teachers/delete/(:num)', 'Teachers::delete/$1');

// chemin pour gérer les matières
$routes->get('/matieres', 'Matiere::index');
$routes->get('/matieres/add', 'Matiere::add');
$routes->post('matieres/store', 'Matiere::store');
$routes->get('matieres/edit/(:num)', 'Matiere::edit/$1');
$routes->post('matieres/update/(:num)', 'Matiere::update/$1');
$routes->get('/matieres/delete/(:num)', 'Matiere::delete/$1');

// chemin pour gérer les salles
$routes->get('/classroom', 'Classroom::index');
$routes->get('/classroom/add', 'Classroom::add');
$routes->post('classroom/store', 'Classroom::store');
$routes->get('classroom/edit/(:num)', 'Classroom::edit/$1');
$routes->post('classroom/update/(:num)', 'Classroom::update/$1');
$routes->get('/classroom/delete/(:num)', 'Classroom::delete/$1');


//chemin pour l'évenement
$routes->get('/schedule', 'Schedule::index');
$routes->get('schedule/create', 'Schedule::create');
$routes->post('schedule/store', 'Schedule::store');
$routes->get('schedule/edit/(:num)', 'Schedule::edit/$1');
$routes->post('schedule/update/(:num)', 'Schedule::update/$1');
$routes->get('/schedule/delete/(:num)', 'Schedule::delete/$1');