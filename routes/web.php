<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;

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

/* Route::resource('players', PlayerController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);

Route::resource('teams', PlayerController::class)
    ->only(['index', 'store']);
    //->middleware(['auth', 'verified']); */

Route::get('/getplayers', function () {
    //get data from lfstats and return it
})
