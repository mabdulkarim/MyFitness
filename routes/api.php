<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WorkoutController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::apiResource('exercises', ExerciseController::class)->only(['index', 'show']);
Route::apiResource('users', UserController::class)->only(['index', 'show']);
Route::apiResource('workouts', WorkoutController::class)->only(['index', 'show']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::apiResource('exercises', ExerciseController::class)->except(['index', 'show']);
    Route::apiResource('users', UserController::class)->except(['index', 'show']);
    Route::apiResource('workouts', WorkoutController::class)->except(['index', 'show']);
    Route::post('logout', [AuthController::class, 'logout']);
});
