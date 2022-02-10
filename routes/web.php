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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'points' => auth()->user()->points,
        'moneys' => auth()->user()->moneys,
    ]);
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    // get-present
    Route::post('get-present', [\App\Http\Controllers\PointController::class, 'store'])
        ->middleware(\App\Http\Middleware\RandomRequestMiddleware::class)
        ->name('get-present');

    // moneys
    Route::prefix('moneys')->group(function () {
        // withdraw
        Route::match(['put', 'patch'], '/withdraw', [\App\Http\Controllers\MoneyController::class, 'withdraw'])
            ->name('moneys.withdraw');

        // convert
        Route::match(['put', 'patch'], '/convert', [\App\Http\Controllers\MoneyController::class, 'convert'])
            ->name('moneys.convert');
    });

    // items
    Route::prefix('items')->group(function () {
        // send
        Route::match(['put', 'patch'], '/{item}', [\App\Http\Controllers\ItemController::class, 'update'])
        ->name('items.send');

        // cancel
        Route::delete('/{item}', [\App\Http\Controllers\ItemController::class, 'destroy'])
            ->name('items.cancel');
    });
});
