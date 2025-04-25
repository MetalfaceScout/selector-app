<?php

use App\Http\Controllers\PlayerPoolController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SelectorController;
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

Route::get('/', function () {
    return view('main');
});

Route::get('/editor', function () { 
    return view('editor');
})->name('editor');


Route::get('/selector', [SelectorController::class,'get'])->name('selector'); 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/search_player', [SelectorController::class,'search_player'])->name('search_player');

Route::post('/add_player_to_pool/{id}', [SelectorController::class, 'add_player_to_pool'])->name('add_player_to_pool');
Route::get('/player_pool', [PlayerPoolController::class,'get'])->name('get_player_pool');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
