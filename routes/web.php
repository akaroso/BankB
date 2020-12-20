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
Route::POST('addMoney/post', 'App\Http\Controllers\MoneyWebController@depositMoney')->middleware(['auth'])->name('transfer.depositMoney');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/transfer', function () {
    return view('transfer');
})->middleware(['auth'])->name('transfer');

Route::patch('transfer/post', 'App\Http\Controllers\MoneyWebController@internalTransfer')->middleware(['auth'])->name('transfer.internalTransfer');

Route::get('/addMoney', function () {
    return view('addMoney');
})->middleware(['auth'])->name('addMoney');



Route::resource('users', 'App\Http\Controllers\UserController');

require __DIR__.'/auth.php';
