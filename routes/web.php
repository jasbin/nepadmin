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

//Route::get('/', 'PostsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::post('posts/store', 'PostsController@store')->name('posts.store');
// Route::post('posts/update','PostsController@update')->name('posts.update');
// Route::post('posts/delete', 'PostsController@delete')->name('posts.delete');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('posts/index','PostsController@index')->name('posts.index');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::post('posts/store', 'PostsController@store')->name('posts.store');
    Route::get('posts/getByID/{id}', 'PostsController@getByID')->name('posts.getByID');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::post('posts/update', 'PostsController@update')->name('posts.update');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::post('posts/delete', 'PostsController@delete')->name('posts.delete');
});

//services
//display services
Route::get('/services', 'ServicesController@index')->name('services');
//displayservices tables in backend
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard/services', 'ServicesController@index')->name('services.index');
});
//store services in tables in backend
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::post('/services/store', 'ServicesController@store')->name('services.store');
});
//update services in tables in backend
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::post('/services/update', 'ServicesController@update')->name('services.update');
    Route::get('/services/getByID/{id}', 'ServicesController@getByID')->name('services.getByID');
});
//deletes services in tables in backend
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::post('services/delete', 'ServicesController@delete')->name('services.delete');
});


//galery
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard/gallery', 'GalleryController@index')->name('gallery.index');
});
//create gallery image category
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::post('/dashboard/store', 'GalleryController@store')->name('gallery.store');
    Route::get('/gallery/getByID/{id}', 'GalleryController@getByID')->name('gallery.getByID');
});

//update gallery in tables in backend
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::post('/dashboard/gallery/update', 'GalleryController@update')->name('gallery.update');
});

//deletes gallery in tables in backend
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::post('/dashboard/gallery/delete', 'GalleryController@delete')->name('gallery.delete');
});

//logout
Route::get('logout', 'AdminController@logout')->name('logout');
