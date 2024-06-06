<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuthentication;
use App\Http\Middleware\isAdmin;

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

Route::get('/admin/orders', [AdminController::class, 'index'])->name('admin.orders.index')->middleware([isAdmin::class]);;
Route::post('/admin/orders/{order}/status', [AdminController::class, 'updateStatus'])->name('admin.orders.updateStatus')->middleware([isAdmin::class]);;
Route::get('/admin/users', [AdminController::class, 'getAllUser'])->name('admin.users')->middleware([isAdmin::class]);


// User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/track', [OrderController::class, 'track'])->name('orders.track');

});




// Test

