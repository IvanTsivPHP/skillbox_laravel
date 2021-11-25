<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\TagsController;
use App\Services\TagsSynchronizer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ArticlesController as AdminArticlesController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;

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


Route::prefix('admin')->group(function () {

    Route::get('/', [AdminArticlesController::class, 'index'])->name('admin');

    Route::get('feedback', [AdminController::class, 'feedback']);

    Route::get('/articles/create', [AdminArticlesController::class, 'create']);

    Route::get('/articles/{article}',[AdminArticlesController::class, 'show']);

    Route::patch('/articles/{article}',[AdminArticlesController::class, 'update']);

    Route::delete('/articles/{article}',[AdminArticlesController::class, 'destroy']);

    Route::get('/articles/{article}/edit',[AdminArticlesController::class, 'edit']);

    Route::post('/articles', [AdminArticlesController::class, 'store']);

    Route::get('/news', [AdminNewsController::class, 'index'])->name('adminNews');

    Route::get('/news/{news}/edit', [AdminNewsController::class, 'edit']);

    Route::get('/news/create', [AdminNewsController::class, 'create']);

    Route::patch('/news/{news}', [AdminNewsController::class, 'update']);

    Route::delete('/news/{news}', [AdminNewsController::class, 'destroy']);

    Route::post('/news', [AdminNewsController::class, 'store']);

});

Route::get('/',[ArticlesController::class, 'index'])->name('articles');

Route::get('/about', [MainController::class, 'about']);

Route::get('/contacts', [MainController::class, 'contacts']);

Route::post('/contacts', [MainController::class, 'sendFeedback']);


Route::prefix('articles')->group(function () {

    Route::post('/', [ArticlesController::class, 'store']);

    Route::get('/create', [ArticlesController::class, 'create']);

    Route::get('/{article}',[ArticlesController::class, 'show'])->name('article');

    Route::patch('/{article}',[ArticlesController::class, 'update']);

    Route::delete('/{article}',[ArticlesController::class, 'destroy']);

    Route::get('/{article}/edit',[ArticlesController::class, 'edit']);

});

Route::get('/tags/{tag}', [TagsController::class, 'index'])->name('tags');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/news', [NewsController::class, 'index']);

Route::get('/news/{news}', [NewsController::class, 'show']);
