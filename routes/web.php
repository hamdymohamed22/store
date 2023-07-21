<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckOutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('front.home');


Route::get('/dash', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dash');

Route::group([
    "as" => 'front.',
    'prefix' => 'home/'

],function(){
    Route::get('products',[ProductController::class, 'index'])->name('products.index');
    Route::get('products/show/{product:slug}',[ProductController::class, 'show'])->name('products.show');
    Route::resource('cart', CartController::class);
    Route::get('order/checkout',[CheckOutController::class , 'go_checkout'])->name('checkout.form');
    Route::post('order/checkout',[CheckOutController::class , 'store'])->name('checkout.store');
});




require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
