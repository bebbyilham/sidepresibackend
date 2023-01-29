<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\CreatorController;
use App\Http\Controllers\API\NurseController;

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


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('user/changepassword', [UserController::class, 'changePassword']);
    Route::post('user/photo', [UserController::class, 'updatePhoto']);
    Route::get('transaction', [TransactionController::class, 'all']);
    Route::post('transaction/{id}', [TransactionController::class, 'update']);
    Route::post('checkout', [TransactionController::class, 'checkout']);
    Route::post('logout', [UserController::class, 'logout']);
    //nurse
    Route::post('nurses', [NurseController::class, 'create']);
    Route::post('nurses/createidentitasprofesi', [NurseController::class, 'createidentitasprofesi']);
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

//creator
Route::get('creators', [CreatorController::class, 'index']);
Route::get('creators/{id}', [CreatorController::class, 'show']);
Route::post('creators', [CreatorController::class, 'create']);
Route::put('creators/{id}', [CreatorController::class, 'update']);
Route::delete('creators/{id}', [CreatorController::class, 'destroy']);

//blog
Route::post('blogs', [BlogController::class, 'create']);
Route::put('blogs/{id}', [BlogController::class, 'update']);
Route::get('blogs/{id}', [BlogController::class, 'show']);
Route::get('blogs', [BlogController::class, 'index']);
Route::delete('blogs/{id}', [BlogController::class, 'destroy']);

//nurse
Route::get('nurses', [NurseController::class, 'index']);
Route::get('nurses/{id}', [NurseController::class, 'show']);
// Route::post('nurses', [NurseController::class, 'create']);
Route::put('nurses/{id}', [NurseController::class, 'update']);
Route::delete('nurses/{id}', [NurseController::class, 'destroy']);
Route::get('nurses/showidentitasprofesi/{id}', [NurseController::class, 'showidentitasprofesi']);
