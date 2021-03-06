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

$router->get('holiday', 'Holiday\Controllers\HolidayController@holiday', 'restricted');

$router->get('expenses', 'Expenses\Controllers\ExpensesController@expenses', 'restricted');

$router->get('expensesAdd', 'Expenses\Controllers\ExpensesController@expensesAdd', 'restricted');


/*
 * POST routes
 */
$router->post('loginPost', 'Login\Controllers\IndexController@loginPost');

$router->post('startAt', 'Attendance\Controllers\AttendanceController@startAt');

$router->post('attendance', 'Attendance\Controllers\AttendanceController@attendance');

$router->post('vacation', 'Vacation\Controllers\VacationController@vacation', 'restricted');

$router->post('pay', 'Expenses\Controllers\ExpensesController@pay', 'restricted');

$router->post('expenses', 'Expenses\Controllers\ExpensesController@expenses', 'restricted');

$router->post('expensesAdd', 'Expenses\Controllers\ExpensesController@expensesAdd', 'restricted');
