<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;

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

Route::get('/players', [PlayerController::class, 'index']);             //GET players
Route::get('/players/{id}', [PlayerController::class, 'show']);         //GET players/id
Route::post('/players', [PlayerController::class, 'store']);            //POST players
Route::put('/players/{player}', [PlayerController::class, 'update']);       //PUT players/id
Route::delete('/players/{player}', [PlayerController::class, 'destroy']);   //DELETE players/id