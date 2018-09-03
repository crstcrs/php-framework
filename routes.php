<?php

/** @var App\Code\Core\Router $router */


/*
 * GET routes
 */
$router->get('', 'Login\Controllers\IndexController@login', 'login');

$router->get('logout', 'Login\Controllers\IndexController@logout');

$router->get('projects', 'Project\Controllers\ProjectController@projectsList');

$router->get('choose-project', 'Task\Controllers\TaskController@projectsList');

$router->get('board', 'Task\Controllers\TaskController@tasksList');

$router->get('settings', 'Base\Controllers\SettingsController@settings', 'restricted');

$router->get('logout', 'Login\Controllers\IndexController@logout');

$router->get('dashboard', 'Base\Controllers\DashboardController@dashboard', 'restricted');

$router->get('attendance', 'Attendance\Controllers\AttendanceController@attendance', 'restricted');

$router->get('timetrack', 'Timetrack\Controllers\TimetrackController@timetrack', 'restricted');

/*
 * POST routes
 */
$router->post('loginPost', 'Login\Controllers\IndexController@loginPost');

$router->post('startAt', 'Attendance\Controllers\AttendanceController@startAt');

$router->post('attendance', 'Attendance\Controllers\AttendanceController@attendance');
