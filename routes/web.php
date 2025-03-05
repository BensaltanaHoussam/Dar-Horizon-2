<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PayPalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\ownerController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\touristController;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/hello', function () {
    return view('hello');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('admin/adminDashboard', [homeController::class, 'adminIndex'])->middleware(['auth', 'admin'])->name('admin.adminDashboard');
    Route::delete('/admin/listings/{listing}', [HomeController::class, 'deleteListing'])->name('admin.listings.delete');

});






Route::middleware('auth')->group(function () {


    Route::get('/tourist/touristDashboard', [touristController::class, 'touristIndex'])->name('tourist.listings');
    Route::get('/tourist/favorites', [FavoriteController::class, 'index'])->name('tourist.favorites');
    Route::get('/tourist/bookings', [BookingsController::class, 'index'])->name('tourist.bookings');

    Route::get('/tourist/listing/{listingId}/available-dates', [BookingsController::class, 'getAvailableDates']);
    Route::post('/tourist/booking', [BookingsController::class, 'storeBooking'])->name('tourist.booking.store');


    Route::match(['get', 'post'], '/tourist/search', [TouristController::class, 'touristSearch'])->name('search');
    Route::post('/favorites/{listing}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{listing}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');


    Route::post('/paypal/create-payment/{booking}', [PayPalController::class, 'createPayment'])->name('paypal.create');
    Route::get('/paypal/success/{booking}', [PayPalController::class, 'success'])->name('paypal.success');
    Route::get('/paypal/cancel/{booking}', [PayPalController::class, 'cancel'])->name('paypal.cancel');




});



Route::middleware('auth')->group(function () {
    Route::get('/owner/my-posts', [ownerController::class, 'myPosts'])->name('owner.posts');
    Route::get('owner/ownerDashboard', [ownerController::class, 'ownerIndex'])->name('owner.dashboard');
    Route::get('owner/addproperty', [ListingController::class, 'create'])->name('listings.create');
    Route::post('owner/addproperty', [ListingController::class, 'store'])->name('listings.store');
    Route::delete('/owner/listing/{listing}', [ListingController::class, 'destroy'])->name('listings.destroy');
    Route::get('/owner/listing/{listing}/edit', [ListingController::class, 'edit'])->name('listings.edit');
    Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('listings.update');
    Route::get('/owner/bookings', [BookingsController::class, 'ownerBookings'])
        ->name('owner.bookings');

    Route::post('/owner/bookings/{booking}/accept', [BookingsController::class, 'acceptBooking'])
        ->name('owner.bookings.accept');
    Route::post('/owner/bookings/{booking}/reject', [BookingsController::class, 'rejectBooking'])
        ->name('owner.bookings.reject');



});



Route::get('/test-email', function () {
    Mail::raw('Test email', function ($message) {
        $message->to('bensaltana07@gmail.com')
            ->subject('Test Email');
    });
    return 'Email sent!';
});

require __DIR__ . '/auth.php';
