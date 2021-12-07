<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;

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

/*  For clear cache */
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [productController::class, 'allproduct'])->name('allproduct');



Route::get('home', [productController::class, 'index'])->name('home');
Route::get('addproduct', [productController::class, 'addproduct'])->name('addproduct');
Route::post('saveproduct', [productController::class, 'saveproduct'])->name('saveproduct');
Route::get('allproduct', [productController::class, 'allproduct'])->name('allproduct');
Route::get('addproduct/{id}', [productController::class, 'addproduct'])->name('addproduct');


Route::get('deleteproduct/{id}', [productController::class, 'deleteproduct'])->name('deleteproduct');


Route::get('cart', [productController::class, 'cart'])->name('cart');

Route::get('addtocart/{id}', [productController::class, 'addToCart'])->name('addtocart');


Route::patch('update-cart', [productController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [productController::class, 'remove'])->name('remove.from.cart');



