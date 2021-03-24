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
	return view('dashboard');
})->name('/');



Route::group(['prefix' => 'dashboard', 'middleware' => ['auth','verified']], function () {
	Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
	
	Route::post('pengaduan', 'App\Http\Controllers\PengaduanController@store')->name('pengaduan');
	Route::get('users-tanggapan', 'App\Http\Controllers\PengaduanController@index')->name('tanggapan');

	Route::get('profile','App\Http\Controllers\ProfileController@edit')->name('profile.edit');
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	
	Route::group(['middleware' => ['role:admin']], function () {
        
        // Users & Roles Routes
        Route::get('users-roles', 'App\Http\Controllers\UserRoleController@index')->name('users-roles');
        Route::resource('users', 'App\Http\Controllers\UserController');
        Route::get('datatables/users', 'App\Http\Controllers\UserController@datatables')->name('users.datatables');
    
        Route::resource('roles', 'App\Http\Controllers\RoleController');
        Route::get('datatables/roles', 'App\Http\Controllers\RoleController@datatables')->name('roles.datatables');
    });
});

Auth::routes(['verify' => true]);
