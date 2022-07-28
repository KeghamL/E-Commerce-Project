<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;

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

Route::get('/register', [UserController::class, 'registration']);
Route::get('/login', [UserController::class, 'login']);

Route::group(['middleware' => 'web'], function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/userinfo', [UserController::class, 'userInfo'])->withoutMiddleware('auth');
    Route::post('/register-user', [UserController::class, 'registerUser'])->name('register-user');
    Route::get('/dashboard', [ProductController::class, 'index'])->middleware('auth')->name('product-dashboard');
    Route::post('/dashboard', [UserController::class, 'loginUser'])->withoutMiddleware('auth')->name('login-user');
    Route::get('/productcreate', [ProductController::class, 'create'])->name('product-create');
    Route::post('/productstore', [ProductController::class, 'store'])->name('product-store');
    Route::get('/productshow/{product}', [ProductController::class, 'show'])->name('product-show');
    Route::get('/productedit/{product}', [ProductController::class, 'edit'])->name('product-edit');
    Route::put('/productupdate/{product}', [ProductController::class, 'update'])->name('product-update');
    Route::delete('/productdelete/{product}', [ProductController::class, 'destroy'])->name('product-delete');
    Route::get('/productsearch', [ProductController::class, 'search'])->name('product-search');
    Route::post('/addstar', [ReviewController::class, 'add'])->name('add-star');
    Route::delete('/reviewdelete/{review}', [ReviewController::class, 'delete'])->name('review-delete');
    Route::get('/livesearch', [ProductController::class, 'livesearch'])->name('live-search');
});
