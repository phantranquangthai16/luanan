<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WheelController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BlogsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [indexController::class, 'home']);
Route::get('/dich-vu', [indexController::class, 'dichvu']) -> name('dichvu');// tất cả dịch vụ
Route::get('/dich-vu/{slug}', [indexController::class, 'dichvucon']) -> name('dichvucon');// dịch vụ con thuộc dịch vụ
Route::get('/danh-muc-game/{slug}', [indexController::class, 'danhmuc_game']) -> name('danhmucgame');// tất cả dahh mục
Route::get('/danh-muc/{slug}', [indexController::class, 'danhmuccon']) -> name('danhmuccon');// dịch vụ con thuộc dịch vụ
Route::get('/blogs', [indexController::class, 'blogs']) -> name('blogs');

Auth::routes();

Route::get('/home',[homeController::class,'index'])->name( 'home');
//category
Route::resource('/category', CategoryController::class);
//wheel
route::resource('/wheel',WheelController::class);
//slider
route::resource('/slider',SliderController::class);
//blog
route::resource('/blog',BlogsController::class);

Route::get('/blog-detail/{slug}', [indexController::class, 'blogs_detail']);
//Route::get('/blog/{slug}', 'indexController@test');


