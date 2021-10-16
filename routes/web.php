<?php

use App\Http\Controllers\SinglePageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// SinglePageController redirect to vue
Route::get('/{any}', [SinglePageController::class, 'index'])->where('any', '.*');

// DELETE -> PostController
// Route::delete('/post/{id}', [PostController::class, 'destroy']);