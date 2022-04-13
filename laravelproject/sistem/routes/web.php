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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mahasiswa', 'MahasiswaController@index');
Route::get('/mahasiswa-cari', 'MahasiswaController@cari');
Route::post('/simpan-data-mahasiswa', 'MahasiswaController@simpan');

Route::get('{id}/edit-mahasiswa', 'MahasiswaController@edit');
Route::post('update-mahasiswa/{id}', 'MahasiswaController@update');

Route::get('{id}/hapus-mahasiswa', 'MahasiswaController@hapus');
Route::post('hapus-mahasiswa-checklist/{id}', 'MahasiswaController@hapuschecklist');

Route::get('downloaddatamahasiswa', 'MahasiswaController@download');
Route::post('uploaddatamahasiswa', 'MahasiswaController@upload');

Route::get('/penjualan', 'PenjualanController@index');
Route::get('/penjualan-serverside', 'PenjualanController@serverside');
Route::get('/penjualan/json', 'PenjualanController@json');
Route::get('/download-penjualan-pdf', 'PenjualanController@downloadpdf');
Route::get('/grafik-penjualan', 'PenjualanController@grafik');

