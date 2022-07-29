<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//CARD ROUTES    
Route::get('/cards', [App\Http\Controllers\CardController::class, 'index']);
Route::get('/cards/id/{id}', [App\Http\Controllers\CardController::class, 'show']);
Route::post('/cards/create', [App\Http\Controllers\CardController::class, 'store']);
Route::put('/cards/edit/{id}', [App\Http\Controllers\CardController::class, 'edit']); //It modifies the entire object
Route::delete('/cards/delete/{id}', [App\Http\Controllers\CardController::class, 'destroy']);
Route::post('/cards/add/tag', [App\Http\Controllers\CardController::class, 'addTag']);
Route::post('/cards/remove/tag', [App\Http\Controllers\CardController::class, 'removeTag']);

//TAGS ROUTES
Route::get('/tags', [App\Http\Controllers\TagController::class, 'index']);
Route::get('/tags/id/{id}', [App\Http\Controllers\TagController::class, 'show']);
Route::post('/tags/create', [App\Http\Controllers\TagController::class, 'store']);
Route::put('/tags/edit/{id}', [App\Http\Controllers\TagController::class, 'edit']); //It modifies the entire object
Route::delete('/tags/delete/{id}', [App\Http\Controllers\TagController::class, 'destroy']);

//DECKS ROUTES
Route::get('/decks', [App\Http\Controllers\DeckController::class, 'index']);
Route::get('/decks/id/{id}', [App\Http\Controllers\DeckController::class, 'show']);
Route::post('/decks/create', [App\Http\Controllers\DeckController::class, 'store']);
Route::put('/decks/edit/{id}', [App\Http\Controllers\DeckController::class, 'edit']); //It modifies the entire object
Route::delete('/decks/delete/{id}', [App\Http\Controllers\DeckController::class, 'destroy']);
Route::post('/decks/add/card', [App\Http\Controllers\DeckController::class, 'addCard']);
Route::post('/decks/remove/card', [App\Http\Controllers\DeckController::class, 'removeCard']);
