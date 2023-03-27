<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/iniciar-sesion', [App\Http\Controllers\Auth\LoginController::class, 'showFormLogin'])->name('iniciar-sesion');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Route::get('/callback', [App\Http\Controllers\Auth\LoginController::class, 'callback']);

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/{vue?}', [AppController::class, 'index'])->middleware('oauth2')->where('vue', '[\/\w\.-]*');

