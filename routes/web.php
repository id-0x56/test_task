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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// getPresent
Route::post('get-present', [\App\Http\Controllers\PointController::class, 'store'])
    ->middleware(['auth', \App\Http\Middleware\RandomRequestMiddleware::class])
    ->name('get-present');





Route::get('/test', function () {
    dd(
        \App\Models\User::query()
            ->where('id', 1)
            ->first()
//            ->points
//            ->count
    );
});
