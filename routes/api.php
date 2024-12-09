<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Test from API route']);
});

Route::post("/login", [AuthController::class, 'login']);
Route::post("/register", [AuthController::class, 'register']);
Route::post("/logout", [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post("/password-reset", [AuthController::class, 'passwordReset']);
Route::post("/password-reset/confirm", [AuthController::class, 'confirmPasswordReset']);

Route::post('/activate-account', [AuthController::class, 'activateAccount']);
Route::post('/block-account', [AuthController::class, 'blockAccount'])->middleware('auth:sanctum');


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
