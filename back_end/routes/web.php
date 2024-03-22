<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ForgotPasswordController;
use App\Models\Category;
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
// Route::get('/', [CategoryController::class, 'index']);



//CRUD article
Route::get('/article/search/{title}',[ArticleController::class, 'search']);

Route::resource('/article', ArticleController::class);
Route::post('/logout',[AuthController::class, 'logout']);

//CRUD category
Route::resource('/categorie', CategoryController::class);

