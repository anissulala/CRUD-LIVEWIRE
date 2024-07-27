<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/users', function () {
    return view('users.index');
})->name('users.home');

Route::get('/user/{id}', [UserController::class,'show'])->name('users.details');
Route::get('/user/{id}/edit', [UserController::class,'edit'])->name('users.edit');

Route::get('/create', function () {
    return view('users.create');
})->name('users.create');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
