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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('Users', 'App\Http\Controllers\UserController@index');
Route::get('Users/{id}', 'App\Http\Controllers\UserController@show');
Route::post('Users', 'App\Http\Controllers\UserController@store');
Route::post('Users/create', 'App\Http\Controllers\UserController@createUser');

//Route::post('produkts/producent/{id}',[ProduktController::class, 'saveforcustromer']);


Route::get('Accounts', 'App\Http\Controllers\AccountController@index');
Route::get('Accounts/{id}', 'App\Http\Controllers\AccountController@show');
Route::put('Accounts/changemoney/{id}', 'App\Http\Controllers\AccountController@update');


Route::get('Operations', 'App\Http\Controllers\OperationController@index');
Route::get('Operations/{id}', 'App\Http\Controllers\OperationController@show');

Route::post('GenerateIban', 'App\Http\Controllers\GeneratorController@generateIban');




