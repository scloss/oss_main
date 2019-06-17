<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

/////// Route for login and process login ///////
Route::get('/','MainController@login');
Route::post('process_login','MainController@process_login');

/////// Route for view all user ///////
Route::get('view_all', 'MainController@view_all');

/////// Route for edit form(edit_view) and process that form(edit_post) ///////
Route::get('edit_view', 'MainController@edit_view');
Route::post('edit_post', 'MainController@edit_post');

/////// Route for change password form(change_password_view) and process that form(change_password) ///////
Route::get('change_password_view', 'MainController@change_password_view');
Route::post('change_password', 'MainController@change_password');

/////// Route for error page ////////////
Route::get('error_page', 'MainController@error_page');

/////// Route for logout ////////////
Route::get('logout', 'MainController@logout');

////// Route for Live search /////////
Route::get('/view_all/action', 'MainController@action')->name('live_search.action');

////// Route for Test login /////////
Route::get('test_login','MainController@test_login');
Route::post('process_test_login','MainController@process_test_login');

///// Route for admin dashboard ////////
Route::get('dashboard','MainController@dashboard');

///// Route for User Registration ////////
Route::get('user_register', 'MainController@user_register');
Route::post('process_register_user', 'MainController@process_register_user');
Route::post('process_email_body_generator','MainController@process_email_body_generator');

