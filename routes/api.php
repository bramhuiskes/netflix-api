<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Test from API route']);
});

Route::post("/login", [AuthController::class, 'login']);
Route::get("/login", [AuthController::class, 'loginWithoutPasswordCheck']);
Route::post("/register", [AuthController::class, 'register']);
Route::post("/password-reset", [AuthController::class, 'passwordReset']);

Route::post('/activate-account', [AuthController::class, 'activateAccount'])->middleware('auth:sanctum');
Route::post('/block-account', [AuthController::class, 'blockAccount'])->middleware('auth:sanctum');
Route::post('/unblock-account', [AuthController::class, 'unblockAccount'])->middleware('auth:sanctum');

Route::get('/user/{user?}', [UserController::class, 'getUserDetails'])->middleware('auth:sanctum');

Route::get('/movies', [MovieController::class, 'get'])->middleware('auth:sanctum');
Route::post('/movies', [MovieController::class, 'add'])->middleware('auth:sanctum');
Route::delete('/movies', [MovieController::class, 'delete'])->middleware('auth:sanctum');
Route::patch('/movies', [MovieController::class, 'update'])->middleware('auth:sanctum');

Route::get('/serie', [SerieController::class, 'get'])->middleware('auth:sanctum');
Route::post('/serie', [SerieController::class, 'add'])->middleware('auth:sanctum');
Route::delete('/serie', [SerieController::class, 'delete'])->middleware('auth:sanctum');
Route::patch('/serie', [SerieController::class, 'update'])->middleware('auth:sanctum');


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
