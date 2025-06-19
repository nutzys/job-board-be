<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'getRegisterData']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/industries', [PostsController::class, 'getIndustries']);
Route::get('/posts/{id}', [PostsController::class, 'show']);

Route::get('/jobs', [PostsController::class, 'getPosts']);
Route::get('/jobs/data', [PostsController::class, 'getFilterData']);
Route::get('/jobs/industry/{industryId}', [PostsController::class, 'getPostsByIndustry']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'show']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    
    Route::post('/posts/create', [PostsController::class, 'store']);
    Route::get('/posts/create-data', [PostsController::class, 'getPostCreateData']);
    Route::put('/posts/update/{id}', [PostsController::class, 'update']);
    Route::delete('/posts/delete/{id}', [PostsController::class, 'destroy']);
});

