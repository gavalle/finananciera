<?php

use App\Http\Controllers\AppController;
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


Route::post('/menu', [AppController::class, 'getMenu'])->middleware('oauth2');


Route::group([
    'middleware' => ['oauth2']
],function () {
    Route::prefix('/paas')->group(function () {
        Route::get('/', [App\Http\Controllers\PAAController::class, 'paas'])->name('paas');
        Route::get('/{id}', [App\Http\Controllers\PAAController::class, 'paa'])->name('paa')->where('id', '[0-9]+');
        Route::post('/', [App\Http\Controllers\PAAController::class, 'paaSave'])->name('paa-save');
        Route::put('/{id}', [App\Http\Controllers\PAAController::class, 'paaUpdate'])->name('paa-update')->where('id', '[0-9]+');
        Route::delete('/{id}', [App\Http\Controllers\PAAController::class, 'paaDelete'])->name('paa-delete')->where('id', '[0-9]+');

        Route::get('{id}/lines', [App\Http\Controllers\PAAController::class, 'paaLines'])->name('paa-lines')->where('id', '[0-9]+');
        Route::get('{id}/lines/{line_id}', [App\Http\Controllers\PAAController::class, 'paaLine'])->name('paa-line')->where(['id'=>'[0-9]+', 'line_id'=>'[0-9]+']);
        Route::post('{id}/lines/', [App\Http\Controllers\PAAController::class, 'paaLineSave'])->name('paa-line-save')->where('id', '[0-9]+');
        Route::put('{id}/lines/{line_id}', [App\Http\Controllers\PAAController::class, 'paaLineUpdate'])->name('paa-line-update')->where(['id'=>'[0-9]+', 'line_id'=>'[0-9]+']);
        Route::delete('{id}/lines/{line_id}', [App\Http\Controllers\PAAController::class, 'paaLineDelete'])->name('paa-line-delete')->where(['id'=>'[0-9]+', 'line_id'=>'[0-9]+']);

        Route::get('/status/select', [App\Http\Controllers\PAAController::class, 'paasStatusSelect'])->name('paas-status-select');

        Route::get('/years', [App\Http\Controllers\PAAYearController::class, 'years'])->name('paa-years');
        Route::get('/years/select', [App\Http\Controllers\PAAYearController::class, 'yearsSelect'])->name('paa-years-select');
        Route::get('/years/{id}', [App\Http\Controllers\PAAYearController::class, 'year'])->name('paa-year')->where('id', '[0-9]+');
        Route::post('/years', [App\Http\Controllers\PAAYearController::class, 'yearSave'])->name('paa-year-save');
        Route::put('/years/{id}', [App\Http\Controllers\PAAYearController::class, 'yearUpdate'])->name('paa-year-update')->where('id', '[0-9]+');
        Route::delete('/years/{id}', [App\Http\Controllers\PAAYearController::class, 'yearDelete'])->name('paa-year-delete')->where('id', '[0-9]+');
    });
});
