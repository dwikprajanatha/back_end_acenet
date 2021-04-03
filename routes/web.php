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

Route::get('admin_login', 'Admin\Auth\AuthController@login_form')->name('login.view');
Route::post('login', 'Admin\Auth\AuthController@login')->name('admin.login');

Route::get('testNotif', 'HomeController@index');

Route::middleware('auth:admin')->group(function () {

    Route::get('/dashboard', 'Admin\dashboardController@index')->name('dashboard');

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

    //Pencabutan
    Route::get('/jadwal/pencabutan', 'Admin\Jadwal\pencabutanController@index')->name('pencabutan');
    Route::get('/jadwal/pencabutan/create', 'Admin\Jadwal\pencabutanController@create')->name('pencabutan.create');
    Route::get('/jadwal/pencabutan/detail/{id}', 'Admin\Jadwal\pencabutanController@detail')->name('pencabutan.detail');
    Route::get('/jadwal/pencabutan/edit/{id}', 'Admin\Jadwal\pencabutanController@edit')->name('pencabutan.edit');
    Route::get('/jadwal/pencabutan/delete/{id}', 'Admin\Jadwal\pencabutanController@batal')->name('pencabutan.delete');

    Route::post('/jadwal/pencabutan/post', 'Admin\Jadwal\pencabutanController@post')->name('pencabutan.post');
    Route::post('/jadwal/pencabutan/update', 'Admin\Jadwal\pencabutanController@update')->name('pencabutan.update');

    //Maintenance BTS
    Route::get('/jadwal/maintenanceBTS', 'Admin\Jadwal\maintenanceBTSController@index')->name('bts');
    Route::get('/jadwal/maintenanceBTS/create', 'Admin\Jadwal\maintenanceBTSController@create')->name('bts.create');
    Route::get('/jadwal/maintenanceBTS/detail/{id}', 'Admin\Jadwal\maintenanceBTSController@detail')->name('bts.detail');
    Route::get('/jadwal/maintenanceBTS/edit/{id}', 'Admin\Jadwal\maintenanceBTSController@edit')->name('bts.edit');
    Route::get('/jadwal/maintenanceBTS/delete/{id}', 'Admin\Jadwal\maintenanceBTSController@delete')->name('bts.delete');

    Route::post('/jadwal/maintenanceBTS/post', 'Admin\Jadwal\maintenanceBTSController@post')->name('bts.post');
    Route::post('/jadwal/maintenanceBTS/update', 'Admin\Jadwal\maintenanceBTSController@update')->name('bts.update');

    //Selesaikan dan Batalkan
    Route::get('/listSPK', 'Admin\Jadwal\SelesaikanJadwalController@list_jadwal')->name('jadwal.list');
    Route::get('/listSPK/selesaikan/{id}', 'Admin\Jadwal\SelesaikanJadwalController@selesaikan')->name('jadwal.selesaikan');
    Route::get('/listSPK/batalkan/{id}', 'Admin\Jadwal\SelesaikanJadwalController@batalkan')->name('jadwal.batalkan');

    //Arsip selesai
    Route::get('/arsip/selesai', 'Admin\Arsip\arsipController@selesai')->name('arsip.selesai');

    //Arsip dibatalkan
    Route::get('/arsip/dibatalkan', 'Admin\Arsip\arsipController@dibatalkan')->name('arsip.dibatalkan');

    //Manajemen Akun
    Route::get('/teknisi', 'Admin\Teknisi\ManajemenAkunController@index')->name('teknisi.index');
    // Route::get('/teknisi/detail/{id}', 'Admin\Teknisi\ManajemenAkunController@detail')->name('teknisi.detail');
    Route::get('/teknisi/create', 'Admin\Teknisi\ManajemenAkunController@create')->name('teknisi.create');
    Route::get('/teknisi/edit/{id}', 'Admin\Teknisi\ManajemenAkunController@edit')->name('teknisi.edit');
    Route::get('/teknisi/delete/{id}', 'Admin\Teknisi\ManajemenAkunController@delete')->name('teknisi.delete');

    Route::get('/teknisi/password/{id}', 'Admin\Teknisi\ManajemenAkunController@password')->name('teknisi.password');

    Route::post('/teknisi/submit', 'Admin\Teknisi\ManajemenAkunController@submit')->name('teknisi.submit');
    Route::post('/teknisi/update', 'Admin\Teknisi\ManajemenAkunController@update')->name('teknisi.update');

    Route::post('/teknisi/password/reset', 'Admin\Teknisi\ManajemenAkunController@reset_password')->name('teknisi.reset_password');


    //Laporan
    Route::get('/laporan/tahunan', 'Admin\Laporan\laporanController@laporanTahunan')->name('laporan.tahunan');
    Route::get('/laporan/bulanan', 'Admin\Laporan\laporanController@laporanBulanan')->name('laporan.bulanan');
    Route::get('/laporan/mingguan', 'Admin\Laporan\laporanController@laporanMingguan')->name('laporan.mingguan');

    //EXPORT PDF & EXCEL
    Route::get('/exportExcel', 'Admin\Laporan\laporanController@exportExcel')->name('laporan.export.excel');
    Route::get('/exportPDF', 'Admin\Laporan\laporanController@exportPDF')->name('laporan.export.pdf');

    // Route::get('/laporan', 'Admin\Laporan\laporanController@index')->name('laporan.index');

    Route::get('/laporan/test', 'Admin\Laporan\laporanController@test');



    //Line Chart Laporan API 
    Route::get('chart/laporan/tahunan', 'Admin\Laporan\laporanController@lineChartTahunan')->name('lineChart.tahunan');
    Route::get('chart/laporan/bulanan', 'Admin\Laporan\laporanController@lineChartBulanan')->name('lineChart.bulanan');
    Route::get('chart/laporan/mingguan', 'Admin\Laporan\laporanController@lineChartMingguan')->name('lineChart.mingguan');

    //Doughnut Chart Laporan API
    Route::get('donut/laporan/tahunan', 'Admin\Laporan\laporanController@donutChartTahunan')->name('donutChart.tahunan');
    Route::get('donut/laporan/bulanan', 'Admin\Laporan\laporanController@donutChartBulanan')->name('donutChart.bulanan');
    Route::get('donut/laporan/mingguan', 'Admin\Laporan\laporanController@donutChartMingguan')->name('donutChart.mingguan');



    Route::get('/laporan/test', 'Admin\Laporan\laporanController@test');


    //logout
    Route::get('logout', 'Admin\Auth\AuthController@logout')->name('admin.logout');
});
