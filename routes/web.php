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
Route::group(['middleware' => 'auth'], function () {
Route::get('/home', 'JenisBukuController@index')->name('home');
//Jenis 
Route::get('/jsonjenis','JenisBukuController@jsonjenis');
Route::resource('/jenis','JenisBukuController');
Route::post('storejenis','JenisBukuController@store')->name('tambah');
Route::get('ajaxdata/removedatajenis', 'JenisBukuController@removedata')->name('ajaxdata');
Route::post('jenis/edit/{id}','JenisBukuController@update');
Route::get('jenis/getedit/{id}','JenisBukuController@edit');
//Anggota 
Route::get('/jsonanggota','AnggotaController@jsonanggota');
Route::resource('/anggota','AnggotaController');
Route::post('storeanggota','AnggotaController@store')->name('tambah');
Route::get('ajaxdata/removedataanggota', 'AnggotaController@removedata')->name('ajaxdata.removedataanggota');
Route::post('anggota/edit/{id}','AnggotaController@update');
Route::get('anggota/getedit/{id}','AnggotaController@edit');
//Buku 
Route::get('/jsonbuku','BukuController@jsonbuku');
Route::resource('/buku','BukuController');
Route::post('storebuku','BukuController@store')->name('tambah');
Route::get('ajaxdata/removedatabuku', 'BukuController@removedata')->name('ajaxdata.removedatabuku');
Route::post('buku/edit/{id}','BukuController@update');
Route::get('buku/getedit/{id}','BukuController@edit');
//Pinjam
Route::get('/jsonpinjam2','PinjamBukuController@jsonpinjam2');
Route::resource('/pinjam','PinjamBukuController');
Route::post('storepinjam','PinjamBukuController@store')->name('tambah');
Route::post('pinjam/edit/{id}','PinjamBukuController@update');
Route::get('pinjam/getedit/{id}','PinjamBukuController@edit');
//Pengembalian
Route::get('/jsonpinjam3','PinjamBukuController@jsonpinjam3');
Route::get('/pengembalian','PinjamBukuController@index2');
Route::post('storepinjam2','PinjamBukuController@store2')->name('tambah');
Route::get('pinjam/pengembalian/{id}',array('as'=>'myform.ajax','uses'=>'PinjamBukuController@getedit'));
});