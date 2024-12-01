<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TraderController;
use App\Http\Controllers\WatchlistController;
use GuzzleHttp\Cookie\SessionCookieJar;
use Illuminate\Support\Facades\Mail;
use App\Mail\ListingPosted;

Route::get('/search', SearchController::class)
    ->middleware('auth');

Route::get('/', [ListingController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/listings/create', [ListingController::class, 'create']);
    
    Route::get('/listings/items', [ListingController::class, 'items']);

    Route::get('/listings/watchlist', [WatchlistController::class, 'watchListShow'])
        ->name('watchlist.show');

    Route::post('/listings', [ListingController::class, 'store']);

    Route::get('/listings/{listing}', [ListingController::class, 'show'])
        ->name('listings.show');

    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])
        ->middleware('can:edit-listing,listing');

    Route::patch('/listings/{listing}', [ListingController::class, 'update']);

    Route::get('/listings/destroy-confirmation/{listing}', [ListingController::class, 'destroyConfirmation'])
        ->name('listings.destroy-confirmation');

    Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);
});

Route::middleware('guest')->group(function () {
    // register
    Route::get('/register', [RegisteredController::class, 'create']);

    Route::post('/register', [RegisteredController::class, 'store']);
    // login
    Route::get('/login', [SessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [SessionController::class, 'store']);
});

// logout
Route::post('/logout', [SessionController::class, 'destroy'])
    ->middleware('auth');

Route::get('/auth/edit', [SessionController::class, 'edit'])
    ->middleware('auth');

Route::patch('/auth/profile', [SessionController::class, 'updateProfile'])
    ->middleware('auth')
    ->name('profile.update');

Route::patch('/auth/password', [SessionController::class, 'updatePassword'])
    ->middleware('auth')
    ->name('password.update');

Route::get('/auth/delete-confirmation', [SessionController::class, 'deleteConfirmation'])       
    ->middleware('auth');

Route::delete('/auth/delete', [SessionController::class, 'deleteAccount'])
    ->middleware('auth')
    ->name('account.delete');

// Toggle watchlist item (add if not present, remove if present)
Route::post('/watchlist/toggle', [WatchlistController::class, 'toggleWatchlist'])
    ->name('watchlist.toggle');

Route::post('/mail/contact-me/{listing}', [ContactController::class, 'contactMe'])
    ->name('contact.me');
