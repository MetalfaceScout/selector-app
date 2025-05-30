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
Route::post('/remove_player_from_pool/{id}', [SelectorController::class,'remove_player_from_pool'])->name('remove_player_from_pool');
Route::get('/add_new_player_to_pool', [SelectorController::class,'add_new_player_to_pool'])->name('add_new_player_to_pool');
Route::get('/add_position_modifier', [SelectorController::class,'add_position_modifier'])->name('add_position_modifier');
Route::get('/clear_position_modifiers', [SelectorController::class, 'clear_position_modifiers'])->name('clear_position_modifiers');
Route::post('/remove_position_modifier/{player_id}', [SelectorController::class, 'remove_position_modifier'])->name('remove_position_modifier');

Route::get('/send_selection', [SelectorController::class,'select'])->name('send_selection');

Route::get('/player_pool', [PlayerPoolController::class,'get'])->name('get_player_pool');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
