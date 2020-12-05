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

// Auth::routes();

Route::get('dashboard', 'Admin\dashboardController@index');

//Instalasi Baru
Route::get('/jadwal/instalasiBaru', 'Admin\Jadwal\instalasiBaruController@index')->name('instalasiBaru');
Route::get('/jadwal/instalasiBaru/create', 'Admin\Jadwal\instalasiBaruController@create')->name('instalasiBaru.create');
Route::get('/jadwal/instalasiBaru/detail/{id}', 'Admin\Jadwal\instalasiBaruController@detail')->name('instalasiBaru.detail');
Route::get('/jadwal/instalasiBaru/edit/{id}', 'Admin\Jadwal\instalasiBaruController@edit')->name('instalasiBaru.edit');
Route::get('/jadwal/instalasiBaru/delete/{id}', 'Admin\Jadwal\instalasiBaruController@batal')->name('instalasiBaru.delete');

Route::post('/jadwal/instalasiBaru/post', 'Admin\Jadwal\instalasiBaruController@post')->name('instalasiBaru.post');
Route::post('/jadwal/instalasiBaru/update', 'Admin\Jadwal\instalasiBaruController@update')->name('instalasiBaru.update');

//API untuk get customer
Route::get('/getDataCustomer/{id?}', 'Admin\Jadwal\instalasiBaruController@getDataCustomer')->name('getDataCustomer');

//Maintenance
Route::get('/jadwal/maintenance', 'Admin\Jadwal\maintenanceController@index')->name('maintenance');
Route::get('/jadwal/maintenance/create', 'Admin\Jadwal\maintenanceController@create')->name('maintenance.create');
Route::get('/jadwal/maintenance/detail/{id}', 'Admin\Jadwal\maintenanceController@detail')->name('maintenance.detail');
Route::get('/jadwal/maintenance/edit/{id}', 'Admin\Jadwal\maintenanceController@edit')->name('maintenance.edit');
Route::get('/jadwal/maintenance/delete/{id}', 'Admin\Jadwal\maintenanceController@batal')->name('maintenance.delete');

Route::post('/jadwal/maintenance/post', 'Admin\Jadwal\maintenanceController@post')->name('maintenance.post');
Route::post('/jadwal/maintenance/update', 'Admin\Jadwal\maintenanceController@update')->name('maintenance.update');
