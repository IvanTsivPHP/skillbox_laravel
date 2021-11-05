<?php

use App\Http\Controllers\TagsController;
use App\Services\TagsSynchronizer;
use Illuminate\Support\Facades\Auth;
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
app()->bind(TagsSynchronizer::class, function () {
    return new TagsSynchronizer();
});

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

Route::get('/tags/{tag}', [TagsController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
