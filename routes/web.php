<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('frontend.pages.home');
// });

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/shop', [HomeController::class, 'shopPage'])->name('shop.page');
Route::get('/single-product/{product_slug}', [HomeController::class, 'productDetails'])->name('productdetails.page');
Route::get('/shopping-cart', [CartController::class, 'cartPage'])->name('cart.page');
Route::post('/add-to-cart', [CartController::class, 'addTocart'])->name('add-to.cart');
Route::get('/remove-from-cart/{cart_id}', [CartController::class, 'removeFromCart'])->name('removefrom.cart');

// Authenticatation routes for customer/guert
Route::get('/customer-register', [RegisterController::class, 'registerPage'])->name('register.page');
Route::post('/customer-register', [RegisterController::class, 'registerStore'])->name('register.store');
Route::get('/customer-login', [RegisterController::class, 'loginPage'])->name('login.page');
Route::post('/customer-login', [RegisterController::class, 'loginStore'])->name('login.store');

Route::prefix('customer/')->middleware('auth')->group(function () {
    Route::get('dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('logout', [RegisterController::class, 'logout'])->name('customer.logout');
});

Route::get('/dashboard', function () {
    return view('backend.layouts.pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resource Route
Route::resource('category', CategoryController::class);
Route::resource('testimonial', TestimonialController::class);
Route::resource('product', ProductController::class);
Route::resource('coupon', CouponController::class);

require __DIR__ . '/auth.php';