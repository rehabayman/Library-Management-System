<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', 'HomeController@index')->name('home');
Route::resource('category', 'CategoryController');
Route::resource('profile', 'UserController')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Route::resource('/admin/users', 'Admin\UsersController', ['except' => ['show', 'create', 'store']]);

//This is for grouping
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']])->middleware('auth');
});

Route::put('admin/{user}/users', 'Admin\UsersController@handleActiveStatus')->name('admin.users.handleActiveStatus')->middleware('auth');
