<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\UserApiController;

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
Route::middleware('api')->group(function () {
    Route::get('list', [UserApiController::class, 'index']);
    Route::get('user', [UserApiController::class, 'show']);
    Route::put('user', [UserApiController::class, 'update']);
    Route::delete('user', [UserApiController::class, 'destroy']);

    Route::get('gender', [UserApiController::class, 'getGender']);
    Route::get('province', [UserApiController::class, 'getProvince']);
});