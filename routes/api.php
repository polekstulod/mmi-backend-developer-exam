<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Categories
Route::get('/categories', 'App\Http\Controllers\CategoryController@index');
Route::get('/categories/{id}', 'App\Http\Controllers\CategoryController@show');
Route::post('/categories', 'App\Http\Controllers\CategoryController@store');
Route::put('/categories/{id}', 'App\Http\Controllers\CategoryController@update');
Route::delete('/categories/{id}', 'App\Http\Controllers\CategoryController@destroy');

// Items
Route::get('/items', 'App\Http\Controllers\ItemController@index');
Route::get('/items/{id}', 'App\Http\Controllers\ItemController@show');
Route::post('/items', 'App\Http\Controllers\ItemController@store');
Route::put('/items/{id}', 'App\Http\Controllers\ItemController@update');
Route::delete('/items/{id}', 'App\Http\Controllers\ItemController@destroy');
