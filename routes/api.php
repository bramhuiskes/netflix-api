<?php

use App\Http\Controllers\TokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Test from API route']);
});

Route::post('/validateToken', [TokenController::class, 'validateToken']);

//// Openbare API-routes
//Route::post('/register', [UserController::class, 'register']);
//Route::post('/login', [UserController::class, 'login']);
//
//// Beschermde API-routes (alleen toegankelijk na authenticatie)
//Route::middleware('auth:sanctum')->group(function () {
//    Route::get('/user', function (Request $request) {
//        return $request->user();
//    });
//
//    Route::get('/movies', [MovieController::class, 'index']);
//});
