<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	return view('welcome');
});

/*-----------------Admin Routes---------------------*/
Route::get('/admin', 'LoginController@getAdminLogin');
Route::post('/admin', 'LoginController@adminLogin');
Route::get('/admin/dashboard', 'AdminController@home');
Route::get('/admin/systemUsers', 'AdminController@systemUsers');
Route::get('/admin/add_user', 'AdminController@add_user');
Route::post('/admin/add_user', 'AdminController@post_add_user');
Route::get('/admin/user_roles', 'AdminController@user_roles');



/*-----------------User Routes---------------------*/
Route::get('/login', 'LoginController@getLogin');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@getSignOut');
Route::get('/user/dashboard', 'EmployeeController@home');
Route::get('/user/apply_leave', 'EmployeeController@apply_leave');
Route::post('/user/apply_leave', 'EmployeeController@post_apply_leave');
Route::get('/user/my_leave', 'EmployeeController@my_leave');
Route::get('/user/leave_report', 'EmployeeController@leave_report');
Route::get('/user/leave_calender', 'EmployeeController@leave_calender');
