<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticleContoller;
use App\Http\Controllers\CommentController;

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

Route::get('/articles',[ArticleContoller::class, 'index']);
Route::get('/articles/detail/{id}', [ArticleContoller::class, 'detail']);
Route::get('/articles/delete/{id}', [ArticleContoller::class, 'delete']);
Route::get('/articles/add',[ArticleContoller::class, 'add']);
Route::post('/articles/add',[ArticleContoller::class, 'create']);
Route::get('/articles/edit/{id}',[ArticleContoller::class, 'edit']);
Route::post('/articles/edit/{id}',[ArticleContoller::class, 'update']);

Route::post('/comments/add',[CommentController::class, 'create']);
Route::get('/comments/delete/{id}', [CommentController::class, 'delete']);

Route::get('/',[ArticleContoller::class, 'index']);

// Route::get('/articles',[ActionContoller::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
