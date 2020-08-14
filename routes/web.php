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

Route::group(["prefix" => "owners"], function () {
    // add *above* route with URL parameter
    // otherwise 'create' will get included in that
    Route::get('create', "Owners@create");
    Route::post('create', "owners@createOwner");

    Route::get('{owner}', "Owners@show");
});

Route::get('/', "Home@index");

Route::get('/owners', "Owners@index");

// Route::get('/owners/{owner}', "Owners@show");
