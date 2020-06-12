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
Route::view('login','admin.login');
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');

Route::group(['middleware' =>['customAuth']], function(){
	Route::view('admin-dashboard', 'admin.admin_dashboard');

	// Tags
	Route::get('tags','TagController@view');
	Route::post('tags','TagController@add');
	Route::get('tags/{id}','TagController@edit');

	// Advertisement
	Route::get('advertisements','AdvertisementController@view');
	Route::post('advertisements','AdvertisementController@add');
	Route::get('advertisements/{id}','AdvertisementController@edit');
});
