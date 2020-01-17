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

Route::get('/',"WelcomeController@index");
Route::get('/view/{id}',"WelcomeController@viewPost")->name('viewPost');


Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['middleware' => ['auth']], function () {
    Route::resource('categories','CategoriesController');

    Route::resource('posts', 'PostsController');

    Route::get('/trash', 'PostsController@trash')->name('trashPost');

    Route::put('/restore/{id}', 'PostsController@restore')->name('restorePost');
});