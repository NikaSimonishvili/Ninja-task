<?php

use App\Http\Controllers\Auth\TokenAuthController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [TokenAuthController::class, 'register']);
Route::post('/login', [TokenAuthController::class, 'login']);

Route::middleware(['auth:custom_token', 'log_requests'])->group(function () {
    Route::get('/me', [TokenAuthController::class, 'me']);

    Route::apiResource('/tokens', TokenController::class);
});
