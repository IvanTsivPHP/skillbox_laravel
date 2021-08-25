<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;

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

Route::get('/',[ArticlesController::class, 'index']);

Route::get('/about', [MainController::class, 'about']);

Route::get('/contacts', [MainController::class, 'contacts']);

Route::post('/contacts', [MainController::class, 'sendFeedback']);

Route::get('/admin/feedback', [AdminController::class, 'feedback']);

Route::get('/articles/create', [ArticlesController::class, 'create']);

Route::get('/articles/{article}',[ArticlesController::class, 'show']);

Route::patch('/articles/{article}',[ArticlesController::class, 'update']);

Route::delete('/articles/{article}',[ArticlesController::class, 'destroy']);

Route::get('/articles/{article}/edit',[ArticlesController::class, 'edit']);

Route::post('/articles', [ArticlesController::class, 'store']);

require __DIR__.'/auth.php';
