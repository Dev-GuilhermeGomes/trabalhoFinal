<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/games', GameApiController::class)->names([
    'index' => 'api.games.index',
    'store' => 'api.games.store',
    'show' => 'api.games.show',
    'update' => 'api.games.update',
    'destroy' => 'api.games.destroy',
]);
