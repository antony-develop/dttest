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
    return view('home.index');
});

Route::get('/catalog', 'CategoryController@index');

Route::get('/catalog/parse', function () {
    return view('categories.upload');
});

Route::post('/catalog/parse', 'CategoryController@parse');

Route::get('/catalog/{level0}/{level1?}/{level2?}', 'CategoryController@show');