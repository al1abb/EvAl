<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Agency;
use App\Models\Flag;
use Facade\FlareClient\Http\Response;
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


/**
 * Public routes
 */

// User api routes
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

// Agencies api routes
Route::get('/agencies', [AgencyController::class, 'index']);
Route::post('/agencies', [AgencyController::class, 'store']);
Route::get('/agencies/{id}', [AgencyController::class, 'show']);
Route::put('/agencies/{id}', [AgencyController::class, 'update']);
Route::delete('/agencies/{id}', [AgencyController::class, 'destroy']);

// Posts api routes
Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);

// Flag api routes
Route::get('/flags', [FlagController::class, 'index']);
Route::post('/flags', [FlagController::class, 'store']);
Route::get('/flags/{id}', [FlagController::class, 'show']);
Route::put('/flags/{id}', [FlagController::class, 'update']);
Route::delete('/flags/{id}', [FlagController::class, 'destroy']);

/**
 * Relationship routes
 */

// User-Post route
Route::get('users/{id}/posts', [UserController::class, 'showUserPosts']);

// Agency-User route
Route::get('agencies/{id}/users', [AgencyController::class, 'showAgencyUsers']);

// User-Flag route
Route::get('users/{id}/flags', [UserController::class, 'showUserFlags']);

// Route::get('posts/{id}/user', [PostController::class, 'showPostUser']);

// Route::get('posts/{id}/flags', [PostController::class, 'showPostFlags']);

// Auth 
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

/**
 * Protected routes
 */

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
});