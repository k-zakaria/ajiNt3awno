<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentairController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatistiqueController;
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


    Route::get('/admin/statistique', [StatistiqueController::class, 'state'])->name('sattistique.start');     
});



Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/searchtitle', [ArticleController::class, 'searchArticles'])->name('articles.search');
Route::get('/detail/article/{id}', [ArticleController::class, 'showDetail'])->name('detail.showDetail');

Route::post('/detail/article/{article}', [CommentairController::class, 'store'])->name('commentair.store');
Route::put('/detail/article/{commentId}', [CommentairController::class, 'update'])->name('commentair.update');
Route::get('/detail/article/{commentId}/delete', [CommentairController::class, 'delete'])->name('commentair.delete');


Route::get('/profile', [SettingController::class, 'profile'])->name('user.profile');
Route::put('/profile', [SettingController::class,'update'])->name('profile.update');




Route::middleware('author')->group(function () { 
    Route::get('/admin/articles', [ArticleController::class, 'show'])->name('articles.show');
    Route::post('/admin/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::put('/admin/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/admin/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::delete('/admin/articles/section/{article}', [SectionController::class, 'destroy'])->name('sections.destroy');
    
    // Route::get('/admin/articles/create/{id}', [ArticleController::class, 'create'])->name('articles.create');
    Route::get('/admin/articles/create/{id}', [SectionController::class, 'show'])->name('sections.show');
    Route::post('/admin/articles/section', [SectionController::class, 'store'])->name('sections.store');
    Route::put('/admin/articles/section/{id}', [SectionController::class, 'update'])->name('sections.update');
    Route::delete('admin/articles/section/{id}', [SectionController::class, 'destroy'])->name('admin.sections.destroy');
    Route::post('/admin/articles/section/image', [ImageController::class, 'store'])->name('images.store');

});
