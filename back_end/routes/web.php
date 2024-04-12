<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;

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
// login et Register 
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
Route::get('/register', [AuthController::class, 'create']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

Route::get('/category/{category}', [ArticleController::class, 'showArticlesByCategory'])->name('articles.category');
Route::middleware('admin')->group(function () {
    Route::get('/admin/categories', [CategoryController::class, 'get'])->name('categories.index');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/admin/categories/{categorie}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/admin/categories/{categorie}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/admin/users', [AuthController::class, 'get'])->name('users.get');
    Route::put('/admin/users/{id}', [AuthController::class, 'update'])->name('users.update');
    
    Route::get('/admin/statusArticles',[ArticleController::class,'showArticleAdmin'])->name('showarticles.admin');
    Route::get('/admin/archivedArticles',[ArticleController::class,'showArchivedArticles'])->name('showArchivedArticles.admin');
    Route::get('/admin/refusedarticle',[ArticleController::class,'showRefusedArticles'])->name('showRefusedArticles.admin');

    Route::get('/admin/acceptarticle/{id}',[ArticleController::class,'acceptarticle'])->name('acceptarticle.admin');
    Route::get('/admin/archivedarticle/{id}',[ArticleController::class,'archivedarticle'])->name('archivedarticle.admin');
    Route::get('/admin/refusedarticle/{id}',[ArticleController::class,'refusedarticle'])->name('refusedarticle.admin');
    Route::get('/admin/deArchivedarticle/{id}',[ArticleController::class,'deArchivedarticle'])->name('deArchivedarticle.admin');
});


Route::get('/detai/{id}', [ArticleController::class, 'showDetai'])->name('articles.showDetai');
Route::middleware('author')->group(function () { 
    Route::get('/admin/articles', [ArticleController::class, 'show'])->name('articles.show');
    Route::post('/admin/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::put('/admin/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/admin/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

});
