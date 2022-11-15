<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/login', '\App\Http\Controllers\AuthController@login')->name('auth.login');
Route::post('auth/logout', '\App\Http\Controllers\AuthController@logout')->name('auth.logout');
Route::post('auth/refresh', '\App\Http\Controllers\AuthController@refresh')->name('auth.refresh');
Route::post('auth/me', '\App\Http\Controllers\AuthController@me')->name('auth.me');

Route::apiResource('book-store', '\App\Http\Controllers\BookStoreController');
