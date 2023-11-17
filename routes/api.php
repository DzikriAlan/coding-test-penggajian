<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\LoginController@register');

Route::group(['middleware' => 'auth:api'], function() {
  Route::get('/jabatan/{id}/edit', 'API\MstDataJabatanController@show');
  Route::get('/pegawai/{id}/edit', 'API\MstDataPegawaiController@show');
  Route::get('/potongan-gaji/{id}/edit', 'API\MstDataPotonganGajiController@show');
  Route::resource('/jabatan', 'API\MstDataJabatanController');
  Route::resource('/pegawai', 'API\MstDataPegawaiController');
  Route::resource('/potongan-gaji', 'API\MstDataPotonganGajiController');
  Route::resource('/data-gaji', 'API\MstDataGajiController');
});