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

// Route::get('/users/{id}', function($id){
//   return "This is user " . $id;
// });

// Route::get('/users/{id}/{name}', function($id, $name){
//   return "This is user " . $id . " named " . $name;
// });

// Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::get('/credits', 'PagesController@credits');
Route::post('/contact', 'ContactController@store');

// Dog routes

// Route::resource('dogs', 'DogsController');
Route::get('/', 'DogsController@index');
Route::post('/public', 'DogsController@store');
Route::get('/dogs/create', 'DogsController@create');
Route::get('/dogs/{dog}', 'DogsController@show');
Route::put('/dogs/{dog}', 'DogsController@update');
Route::delete('/dogs/{dog}', 'DogsController@destroy');
Route::get('/dogs/{dog}/edit', 'DogsController@edit');

// Comment routes

// Route::resource('comments', 'CommentsController');
// Route::get('/', 'CommentsController@index');
Route::post('/dogs/{dog}/comments', 'CommentsController@store');
// Route::get('/dogs/create', 'CommentsController@create');
// Route::get('/dogs/{dog}', 'CommentsController@show');
Route::put('/dogs/{dog}/comments/{comment}', 'CommentsController@update');
Route::delete('/dogs/{dog}/comments/{comment}', 'CommentsController@destroy');
// Route::get('/dogs/{dog}/edit', 'CommentsController@edit');

// Like routes

Route::post('/dogs/{dog}/comments/{comment}/like', 'LikesController@index');


Auth::routes();

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/{user}', 'ProfileController@profile');

