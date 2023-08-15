<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

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

// Route::get('users' , [UserController::class  , 'index'])->middleware('auth:sanctum');
Route::apiResource('users' , UserController::class)->middleware('auth:sanctum');

Route::post('/add_to_cart', [CartController::class, 'addToCart']);

Route::post('auth/tokens', [AccessTokensController::class , 'store']);
Route::delete('auth/tokens' , [AccessTokensController::class , 'destroy']);
Route::post('auth/register' , [AccessTokensController::class , 'register']);

Route::post('auth/password/email', [AccessTokensController::class , 'sendPasswordResetLinkEmail'])->name('password.email');
Route::post('auth/password/reset', [AccessTokensController::class , 'resetPassword'])->name('password.reset');

Route::get('auth/refresh', [AccessTokensController::class, 'refresh']);