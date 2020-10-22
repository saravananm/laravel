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
// Front End 
Route::get('/','FrontEndController@homepage');
Route::get('post/{slug}','FrontEndController@postpage');
Route::get('news-and-features','FrontEndController@newsandfeaturespage');
Route::get('discoveries-and-innovations','FrontEndController@discoveriesandinnovationspage');
Route::get('applications-and-impacts','FrontEndController@applicationsandimpactspage');
Route::get('science-and-society','FrontEndController@scienceandsocietypage');
Route::get('the-scitech-journal/{my?}','FrontEndController@thescitechjournalpage');
Route::get('the-scitech-journal-post/{slug}','FrontEndController@thescitechjournalpostpage');
Route::get('the-scitech-journal-list/{my?}','FrontEndController@thescitechjournallistpage');

// Admin Side
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

	// cover Image
	Route::get('coverimages','CoverImageController@view');
	Route::post('coverimages','CoverImageController@add');
	Route::get('coverimages/{id}','CoverImageController@edit');

	// Sub Category Image
	Route::get('categories','CategoryController@view');
	Route::post('categories','CategoryController@add');
	Route::get('categories/{id}','CategoryController@edit');
	
	// Thescitechjournal Category
	Route::get('thescitechjournalcategories','ThescitechjournalCategoryController@view');
	Route::post('thescitechjournalcategories','ThescitechjournalCategoryController@add');
	Route::get('thescitechjournalcategories/{id}','ThescitechjournalCategoryController@edit');

	// Posts
	Route::get('posts','PostController@view');
	Route::post('posts','PostController@add');
	Route::get('posts/{id}','PostController@edit');

	// The ScitechjournalPosts
	Route::get('thescitechjournalposts','ThescitechjournalpostController@view');
	Route::post('thescitechjournalposts','ThescitechjournalpostController@add');
	Route::get('thescitechjournalposts/{id}','ThescitechjournalpostController@edit');

	//Forthcoming issue Highlights
	Route::get('highlights','HighlightController@view');
	Route::post('highlights','HighlightController@add');

	//Config
	Route::get('configs','ConfigController@view');
	Route::post('configs','ConfigController@add');
});
