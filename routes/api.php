<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->middleware('role:admin')->group(function () {
    Route::delete('/logout', [LoginController::class, 'logout']);
    Route::prefix('users')->group(function () {
        Route::post('/create-admin', [UserController::class, 'createAdmin']);
        Route::post('/change-password', [UserController::class, 'changePassword']);
        Route::patch('/disable-user', [UserController::class, 'disableUser']);
        Route::patch('/change-role', [UserController::class, 'changeRole']);
        Route::get('/index', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'find']);
        Route::post('/by-email', [UserController::class, 'findByEmail']);
        Route::post('/store', [UserController::class, 'store']);
        Route::patch('/update/{id}', [UserController::class, 'update']);
        Route::delete('/destroy/{id}', [UserController::class, 'destroy']);
    });

    Route::prefix('task')->middleware('role:admin|manager')->group(function () {
        Route::get('/index', [TaskController::class, 'index']);
        Route::get('/{id}', [TaskController::class, 'find']);
        Route::get('/by-user/{id}', [TaskController::class, 'findByUser']);
        Route::post('/store', [TaskController::class, 'store']);
        Route::patch('/update/{id}', [TaskController::class, 'update']);
        Route::delete('/destroy/{id}', [TaskController::class, 'destroy']);
        Route::patch('/change-dline/{id}', [TaskController::class, 'changeDeadline']);
        Route::patch('/status/{id}', [TaskController::class, 'changeStatus']);
        Route::patch('/related/{id}', [TaskController::class, 'changeRelated']);
        Route::patch('/assigned/{id}', [TaskController::class, 'changeAssigned']);
    });

    Route::prefix('deal')->middleware('role:admin|manager|user')->group(function () {
        Route::get('/index', [DealController::class, 'index']);
        Route::get('/{id}', [DealController::class, 'find']);
        Route::get('/by-manager/{id}', [DealController::class, 'findByManager']);
        Route::get('/by-client', [DealController::class, 'findByClient']);
        Route::post('/create', [DealController::class, 'create']);
        Route::patch('/update/{id}', [DealController::class, 'update']);
        Route::delete('/destroy/{id}', [DealController::class, 'destroy']);
        Route::patch('/stage/{id}', [DealController::class, 'changeStage']);
        Route::patch('/amount/{id}', [DealController::class, 'changeAmount']);
    });

    Route::prefix('comment')->middleware('role:admin|manager|user')->group(function () {
        Route::get('/index', [CommentController::class, 'index']);
        Route::get('/{id}', [CommentController::class, 'find']);
        Route::get('/by-user/{id}', [CommentController::class, 'findByUser']);
        Route::post('/create', [CommentController::class, 'create']);
        Route::patch('/update/{id}', [CommentController::class, 'update']);
        Route::delete('/destroy/{id}', [CommentController::class, 'destroy']);
    });

    Route::prefix('client')->middleware('role:admin|manager|user')->group(function () {
        Route::get('/index', [ClientController::class, 'index']);
        Route::post('/create', [ClientController::class, 'create']);
        Route::post('/by-email', [ClientController::class, 'findByEmail']);
        Route::patch('/update/{id}', [ClientController::class, 'update']);
        Route::delete('/destroy/{id}', [ClientController::class, 'destroy']);
        Route::delete('/force-delete/{id}', [ClientController::class, 'forceDelete']);
        Route::patch('/manager/{clientId}/{managerId}', [ClientController::class, 'changeManager']);
    });
});
