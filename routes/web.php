<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('presensi','PresenceController@store');
Route::get('/cuti', 'PermitController@indexCuti')->name('cuti');
Route::post('/sendCuti', 'PermitController@storeCuti')->name('sendCuti');
Route::get('/sakit', 'PermitController@indexSakit')->name('sakit');
Route::post('/sendSakit', 'PermitController@storeSakit')->name('sendSakit');
Route::get('/report', 'ReportController@indexReport')->name('report');
Route::post('/reportSearch', 'ReportController@Search')->name('reportSearch');

Route::get('/approval', 'PermitController@approval')->name('approval');
Route::post('/storeApproval', 'PermitController@storeApproval')->name('storeApproval');





