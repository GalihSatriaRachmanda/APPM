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

	Route::get('datatables/laporan', 'App\Http\Controllers\PengaduanController@datatables')->name('laporan.datatables');
	Route::get('pengaduan/{id}', 'App\Http\Controllers\PengaduanController@show')->name('show.Pengaduan');

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

	Route::group(['middleware' => ['role:petugas|admin']], function () {

		Route::get('datatables/laporan/none', 'App\Http\Controllers\PengaduanController@datatables_none')->name('laporan.datatables.none');
		Route::get('datatables/laporan/selesai', 'App\Http\Controllers\PengaduanController@datatables_selesai')->name('laporan.datatables.selesai');
		Route::get('datatables/laporan/proses', 'App\Http\Controllers\PengaduanController@datatables_proses')->name('laporan.datatables.proses');
        Route::resource('tanggapan', 'App\Http\Controllers\TanggapanController');
	
	});

	Route::group(['middleware' => ['role:user']], function () {

		Route::post('store', 'App\Http\Controllers\PengaduanController@store')->name('pengaduan.store');
		Route::get('laporan', 'App\Http\Controllers\PengaduanController@index')->name('pengaduan');
		Route::get('datatables/laporan/public', 'App\Http\Controllers\PengaduanController@datatables_public')->name('laporan.datatables.public');
		Route::get('datatables/laporan/private', 'App\Http\Controllers\PengaduanController@datatables_private')->name('laporan.datatables.private');

	
	});

});

Auth::routes(['verify' => true]);
