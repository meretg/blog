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
//
// Route::get('/', function () {
//     return view('welcome');
// });
Route::resource('/', 'TestController');
Route::post('getproduct', 'TestController@getproduct');
Route::post('getsubproduct', 'TestController@getsubproduct');


// Route::namespace('App\Http\Controllers')->middleware('guest')->group(function () {
//
//     Route::get('/', 'TestController@index');
//
// });
