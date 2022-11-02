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
        return "Homepage";
    });

    Route::get('/test/{name}', function ($name) {
        return $name;
    })->where(['name' => '[A-Za-z]+']);




Route::fallback(function () {
    return abort(404);
});


