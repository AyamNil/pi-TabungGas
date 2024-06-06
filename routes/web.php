<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuthentication;

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
    return redirect('/login');
});

// Authentication Routes
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Routes

Route::middleware(['auth', \App\Http\Middleware\IsAdmin\IsAdmin::class])->group(function () {
    Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/admin/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/admin/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
});



// User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/track', [OrderController::class, 'track'])->name('orders.track');
    Route::get('/admin/orders', [OrderController::class, 'orders'])->name('admin.orders');
    Route::put('admin/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});


// Test
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    // Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    // Add more admin routes here
});
