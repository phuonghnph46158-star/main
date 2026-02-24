<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clients\HomeController;
use App\Http\Controllers\clients\AboutController;
use App\Http\Controllers\clients\ServicesController;
use App\Http\Controllers\clients\DestinationsController;
use App\Http\Controllers\clients\ContactsController;
use App\Http\Controllers\BookingController;

// Admin Controllers
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GuideController;
use App\Http\Controllers\Admin\TripController;

/*
|--------------------------------------------------------------------------
| CLIENT ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServicesController::class, 'index'])->name('service');
Route::get('/destinations', [DestinationsController::class, 'index'])->name('destination');
Route::get('/contact', [ContactsController::class, 'index'])->name('contact');

// Tìm kiếm & chi tiết tour
Route::get('/search', [TourController::class, 'clientSearch'])->name('client.search');
Route::get('/tour/{id}', [App\Http\Controllers\TourController::class, 'show'])->name('tour.show');

// Booking (User phải đăng nhập)
Route::middleware('auth')->group(function () {
    Route::get('/booking/create/{id}', [BookingController::class, 'create'])->name('booking.form');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/history', [BookingController::class, 'history'])->name('booking.history');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

// Login / Logout
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);

Route::post('/admin/logout', function () {
    auth()->logout();
    return redirect()->route('home');
})->name('admin.logout');

// Nhóm admin (cần đăng nhập)
Route::middleware('auth')->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | BOOKINGS
    |--------------------------------------------------------------------------
    */
    Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('admin.bookings.show');
    Route::post('/bookings/{id}/status', [BookingController::class, 'updateStatus'])
        ->name('admin.bookings.updateStatus');

    /*
    |--------------------------------------------------------------------------
    | RESOURCE MANAGEMENT
    |--------------------------------------------------------------------------
    */
    Route::resource('categories', CategoryController::class);
    Route::resource('tours', TourController::class);
    Route::resource('users', UserController::class);
    Route::resource('guides', GuideController::class);

    /*
    |--------------------------------------------------------------------------
    | TRIPS
    |--------------------------------------------------------------------------
    */
    Route::get('/trips', [TripController::class, 'index'])->name('admin.trips.index');
    Route::get('/trips/{id}', [TripController::class, 'show'])->name('admin.trips.show');
    Route::post('/trips/{id}/assign-guide', [TripController::class, 'assignGuide'])
        ->name('admin.trips.assignGuide');

    Route::get('/tour-schedule', [TripController::class, 'tourSchedule'])
        ->name('admin.tourSchedule');
});