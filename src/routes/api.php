<?php

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\RegisterApiController;
use App\Http\Controllers\TaskApiController;
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
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/register', [RegisterApiController::class, 'register']);
Route::group([
    'as' => 'api.',
    'middleware' => ['auth:sanctum']
], function () {
    Route::apiResource('tasks', TaskApiController::class);
});