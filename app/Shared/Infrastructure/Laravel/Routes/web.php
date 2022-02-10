<?php

use Developez\Back\Shared\Infrastructure\BackController;
use Developez\Front\Shared\Infrastructure\FrontController;
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

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/about-us', [FrontController::class, 'about_us'])->name('about');
Route::get('/gallery', [FrontController::class, 'gallery'])->name('gallery');
Route::get('/gallery/{category}', [FrontController::class, 'gallery_category'])->name('gallery_category');
Route::get('/gallery/{category}/{detail}', [FrontController::class, 'gallery_detail'])->name('gallery_detail');

Route::get('/shop', [FrontController::class, 'shop'])->name('shop');
Route::get('/cart', [FrontController::class, 'cart'])->name('cart');
Route::get('/update-cart', [FrontController::class, 'updateCart'])->name('updateCart');
Route::get('/buy', [FrontController::class, 'savePurchase'])->name('savePurchase');
Route::get('/purchases', [FrontController::class, 'getAllPurchases'])->name('getAllPurchases');
