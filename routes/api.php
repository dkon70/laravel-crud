<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SpotController;
use App\Http\Controllers\Api\FavoritesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResources([
    'users' => UserController::class,
    'spots' => SpotController::class,
]);

Route::any('{path}', function () {
   return response()->json(['errors' => ["route doesn't exist"]], 404);
});
