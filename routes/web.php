<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\PlaylistController;
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

    // /genres routes (not really used anymore)
    Route::name('genre.')->prefix('genres')->group(function () {
        Route::get('', [GenreController::class, 'index'])->name('index');
        Route::get('{genre}', [GenreController::class, 'show'])->name('show');
    });

    // /songs routes
    Route::name('song.')->prefix('songs')->group(function () {
        Route::get('{genre?}', [SongController::class, 'index'])->name('index');
        Route::get('{song}/{songname?}', [SongController::class, 'show'])->name('show');
    });

    Route::name('playlist.')->prefix('playlists')->group(function () {
        Route::get('', [PlaylistController::class, 'index'])->name('index');
        Route::get('session', [PlaylistController::class, 'session'])->name('session');
        Route::get('{playlist}/{playlistname?}', [PlaylistController::class, 'show'])->name('show');
    });

    // other routes
    
    // api routes
    Route::prefix('api')->group(function () {
        Route::post('createPlaylist', [PlaylistController::class, 'store'])->name('createPlaylist');
        Route::post('updatePlaylist', [PlaylistController::class, 'update'])->name('updatePlaylist');
        Route::post('deletePlaylist/{playlist}', [PlaylistController::class, 'destroy'])->name('deletePlaylist');

        Route::post('addSongToPlaylist', [PlaylistController::class, 'add'])->name('addSongToPlaylist');
        Route::post('removeSongFromPlaylist', [PlaylistController::class, 'remove'])->name('addSongToPlaylist');


        /**
         * /api/session routes for debugging purposes only!
         */
        Route::get('session', function () {
            dd(session());
        });
        Route::get('session/{value}', function ($value) {
            dd(session($value));
        });
        #####################################################
    });
});