<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\TestimonialController;
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

Route::get('/', [HomeController::class, 'home']);

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

require __DIR__ . '/auth.php';
