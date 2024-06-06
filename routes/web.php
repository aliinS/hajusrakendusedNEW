<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MarkerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/weather', [WeatherController::class, 'getWeather'])->name('weather');

Route::get('/markers', [MarkerController::class, 'index'])->name('markers.index');
Route::get('/markers/create', [MarkerController::class, 'create'])->name('markers.create');
Route::post('/markers', [MarkerController::class, 'store'])->name('markers.store');
Route::get('/markers/{id}/edit', [MarkerController::class, 'edit'])->name('markers.edit');
Route::put('/markers/{id}', [MarkerController::class, 'update'])->name('markers.update');
Route::delete('/markers/{id}', [MarkerController::class, 'destroy'])->name('markers.destroy');

Route::resource('/chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');;


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

Route::get('/payment', function () {
    return view('products.payment');
})->name('payment');

Route::get('/confirmation', function () {
    return view('products.confirmation');
})->name('confirmation');

Route::middleware(['auth', 'verified'])->prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])->name('index');
    Route::post('/sessions', [PaymentController::class, 'checkout'])->name('checkout');
    Route::get('/success', [PaymentController::class, 'success'])->name('success');
    Route::get('/cancel', [PaymentController::class, 'cancel'])->name('cancel');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/api', [ApiController::class, 'index'])->name('api.index');
    Route::get('/api/records', [ApiController::class, 'records'])->name('api.records');
    Route::get('/api/movies', [ApiController::class, 'movies'])->name('api.movies');
    Route::get('/api/makeup', [ApiController::class, 'makeup'])->name('api.makeup');
});

require __DIR__.'/auth.php';
