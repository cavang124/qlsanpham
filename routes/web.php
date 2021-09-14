<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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

Route::get('/', function () {
    return view('welcome');
})->name('form-dang-nhap');


Route::post('/dang-nhap', [UserController::class, 'login'])->name('login');
Route::get('/dang-nhap/facebook', [UserController::class, 'loginFacebook'])->name('loginFacebook');
Route::get('/dang-nhap/facebook/callback', [UserController::class, 'loginFacebookCallback'])->name('loginFacebookCallback');

Route::group(['middleware' => ['auth']], function () {
    // Route::get('/home', 'CategoryController@index')->name('home');
    Route::view('/trang-chu', 'include.dashboard.index')->name('home');
    Route::get('/dang-xuat', [UserController::class, 'logout'])->name('logout');

    Route::prefix('danh-muc')
        ->name('category.')
        ->group(function () {
            Route::get('/danh-sach', [CategoryController::class, 'index'])->name('index');
            Route::post('/them-moi', [CategoryController::class, 'store'])->name('store');
            Route::get('/xoa/{id}', [CategoryController::class, 'delete'])->name('delete');
            Route::put('/cap-nhat/{id}', [CategoryController::class, 'update'])->name('update');
        });

        Route::prefix('san-pham')
        ->name('product.')
        ->group(function () {
            Route::get('/danh-sach', [ProductController::class, 'index'])->name('index');
            Route::post('/them-moi', [ProductController::class, 'store'])->name('store');
            Route::get('/xoa/{id}', [ProductController::class, 'delete'])->name('delete');
            Route::put('/cap-nhat/{id}', [ProductController::class, 'update'])->name('update');
        });

        Route::prefix('don-hang')
        ->name('order.')
        ->group(function () {
            Route::get('/danh-sach', [OrderController::class, 'index'])->name('index');
            Route::get('/form-them-moi', [OrderController::class, 'create'])->name('create');
            Route::post('/them-moi', [OrderController::class, 'store'])->name('store');
            Route::get('/chi-tiet/{id}', [OrderController::class, 'detail'])->name('detail');
            Route::put('/cap-nhat/{id}', [OrderController::class, 'update'])->name('update');
        });

        Route::prefix('nguoi-dung')
        ->name('user.')
        ->group(function () {
            Route::get('/danh-sach', [UserController::class, 'index'])->name('index');
            Route::post('/them-moi', [UserController::class, 'store'])->name('store');
            Route::put('/cap-nhat/{id}', [UserController::class, 'update'])->name('update');
            Route::get('/xoa/{id}', [UserController::class, 'delete'])->name('delete');
        });


    // Route::resource('category', 'CategoryController');

});
