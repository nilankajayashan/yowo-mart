<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\WishlistController;
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
//common routes
Route::get('/',[HomePageController::class, 'index'])->name('index');
Route::get('login',[\App\Http\Controllers\PageController::class, 'login'])->name('login')->middleware('auth_user_restrict');
Route::post('login-submit', [LoginController::class, 'loginSubmit'])->name('login-submit');
Route::get('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth_user');
Route::get('register', [\App\Http\Controllers\PageController::class, 'register'])->name('register')->middleware('auth_user_restrict');
Route::get('password-forgot',[\App\Http\Controllers\PageController::class, 'passwordForgot'])->name('password-forgot');
Route::get('password-reset-pin',[\App\Http\Controllers\PageController::class, 'passwordResetPin'])->name('password-reset-pin')->middleware('set_password_reset');
Route::get('password-change',[\App\Http\Controllers\PageController::class, 'changePassword'])->name('password-change')->middleware('valid_password_reset');
Route::post('password-reset-pin-conform', [PasswordResetController::class, 'passwordResetPinConform'])->name('password-reset-pin-conform')->middleware('set_password_reset');
Route::post('password-reset', [PasswordResetController::class, 'passwordResetPinSent'])->name('password-reset');
Route::post('password-update', [PasswordResetController::class, 'passwordUpdate'])->name('password-update')->middleware('valid_password_reset');
Route::post('register-submit',[RegisterController::class, 'registerSubmit'])->name('register-submit');
Route::get('product-details/{product_id}',[ProductController::class, 'index'])->name('product-details');
Route::get('cart', [CartController::class, 'getCart'])->name('cart');
Route::post('update_cart', [CartController::class, 'updateCart'])->name('update_cart');
Route::get('remove-cart/{product_id}', [CartController::class, 'removeCart'])->name('remove-cart');
Route::get('checkout', [checkoutController::class, 'checkout'])->name('checkout');
Route::post('checkout-complete', [checkoutController::class, 'checkoutComplete'])->name('checkout-complete');
Route::get('order-success', function (){ return view('pages.order_success'); })->name('order-success');
Route::post('add-wishlist', [WishlistController::class, 'addWishlist'])->name('add-wishlist');
Route::get('remove-wishlist-product', [WishlistController::class, 'removeWishlistProduct'])->name('remove-wishlist-product');

Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');

Route::post('save-shipping', [CartController::class, 'saveShipping'])->name('save-shipping');
//auth user routes
Route::get('my_account', [AccountController::class, 'accountDashboard'])->name('my_account')->middleware('auth_user');
Route::get('order-view',[OrderController::class, 'viewOrder'])->name('order-view')->middleware('auth_user');
Route::post('update-profile',[AccountController::class, 'updateProfile'])->name('update-profile')->middleware('auth_user');
Route::post('add-address',[UserAddressController::class, 'addAddress'])->name('add-address')->middleware('auth_user');
Route::post('delete-address',[UserAddressController::class, 'deleteAddress'])->name('delete-address')->middleware('auth_user');
Route::post('update-address',[UserAddressController::class, 'updateAddress'])->name('update-address')->middleware('auth_user');



Route::get('/{category}', [ProductController::class, 'findProducts'])->name('find');

Route::post('track-order', [OrderController::class, 'trackOrder'])->name('track-order');
