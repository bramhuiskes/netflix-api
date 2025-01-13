<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewHistoryController;
use App\Http\Controllers\WatchlistController;
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

Route::get('/view_history', [ViewHistoryController::class, 'get'])->middleware('auth:sanctum');
Route::post('/view_history', [ViewHistoryController::class, 'add'])->middleware('auth:sanctum');
Route::delete('/view_history', [ViewHistoryController::class, 'delete'])->middleware('auth:sanctum');
Route::patch('/view_history', [ViewHistoryController::class, 'update'])->middleware('auth:sanctum');

Route::get('/watchlist', [WatchlistController::class, 'get'])->middleware('auth:sanctum');
Route::post('/watchlist', [WatchlistController::class, 'add'])->middleware('auth:sanctum');
Route::delete('/watchlist', [WatchlistController::class, 'delete'])->middleware('auth:sanctum');
Route::patch('/watchlist', [WatchlistController::class, 'update'])->middleware('auth:sanctum');

Route::get('/profile', [ProfileController::class, 'get'])->middleware('auth:sanctum');
Route::post('/profile', [ProfileController::class, 'add'])->middleware('auth:sanctum');
Route::delete('/profile', [ProfileController::class, 'delete'])->middleware('auth:sanctum');
Route::patch('/profile', [ProfileController::class, 'update'])->middleware('auth:sanctum');

Route::get('/subscription', [SubscriptionController::class, 'get'])->middleware('auth:sanctum');
Route::post('/subscription', [SubscriptionController::class, 'add'])->middleware('auth:sanctum');
Route::delete('/subscription', [SubscriptionController::class, 'delete'])->middleware('auth:sanctum');
Route::patch('/subscription', [SubscriptionController::class, 'update'])->middleware('auth:sanctum');

Route::get('/subscription_type', [SubscriptionTypeController::class, 'get'])->middleware('auth:sanctum');
Route::post('/subscription_type', [SubscriptionTypeController::class, 'add'])->middleware('auth:sanctum');
Route::delete('/subscription_type', [SubscriptionTypeController::class, 'delete'])->middleware('auth:sanctum');
Route::patch('/subscription_type', [SubscriptionTypeController::class, 'update'])->middleware('auth:sanctum');

Route::get('/referral', [ReferralController::class, 'get'])->middleware('auth:sanctum');
Route::post('/referral', [ReferralController::class, 'add'])->middleware('auth:sanctum');
Route::delete('/referral', [ReferralController::class, 'delete'])->middleware('auth:sanctum');
Route::patch('/referral', [ReferralController::class, 'update'])->middleware('auth:sanctum');

Route::get('/preferences', [PreferenceController::class, 'get'])->middleware('auth:sanctum');
Route::post('/preferences', [PreferenceController::class, 'add'])->middleware('auth:sanctum');
Route::delete('/preferences', [PreferenceController::class, 'delete'])->middleware('auth:sanctum');
Route::patch('/preferences', [PreferenceController::class, 'update'])->middleware('auth:sanctum');
