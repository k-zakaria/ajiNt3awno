<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/article',[ArticleController::class,'index']);
Route::post('/article',[ ArticleController::class, 'store']);
Route::post('/article/{id}',[ ArticleController::class, 'destroy']);

//CRUD category
Route::resource('/categorie', CategoryController::class);

// Route::put('updateProduct',[ProductsController::class,'updateProduct']);
// Route::post('addProduct',[ProductsController::class,'addProduct']);
// Route::delete('deleteProduct',[ProductsController::class,'deleteProduct']);
// Route::get('getProductById/{id}',[ProductsController::class,'getProductById']);
// Route::get('getProductInProduct/{id}',[ProductsController::class,'getProductInProduct']);