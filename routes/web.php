<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\SongController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// all other routes other than '/' need to go through auth
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::middleware(['auth:sanctum', 'verified']);
    
    Route::get('/genres', [GenreController::class, 'index'])->name('genre.index');
    Route::get('/genre/{genre}', [GenreController::class, 'show'])->name('genre.show');

    Route::get('/songs/{genre?}', [SongController::class, 'index'])->name('song.index');

    // other routes
});