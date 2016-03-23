<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
 */

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::resourceparameters([
        'categories' => 'category',
        'words' => 'word',
        'lessons' => 'lesson',
    ]);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/home', 'HomeController@index');

        Route::group(['middleware' => 'admin'], function () {
            Route::resource('categories', 'CategoryController');
            Route::resource('words', 'WordController');
        });
        Route::group(['middleware' => 'member'], function () {
            Route::resource('lessons', 'LessonController');
            Route::get('lessons/{lesson}/results', 'LessonController@showResults');
            Route::get('wordlists', 'WordController@show');
            Route::post('wordlist', 'WordController@search');
        });
    });
});
