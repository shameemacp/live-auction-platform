<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BidPageController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\MessageController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// ----------------------------
// Authenticated user routes
// ----------------------------
Route::middleware('auth')->group(function () {

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     // Auction browsing
    Route::get('/auctions', [AuctionController::class, 'index'])->name('auctions.index');
    Route::get('/auctions/{product}', [AuctionController::class, 'show'])->name('auctions.show');

    // Bid page (product-specific)
    Route::get('/auction/{product}', [BidPageController::class, 'show'])->name('auction.show');

   // Place bid (AJAX)
    Route::post('/bids', [BidController::class, 'store'])->name('bids.store');

    // Chat messaging (AJAX)
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
});

// Route::get('/dashboard', function () {
//     return view('backend.dashboard');
// })->name('dashboard');


// ----------------------------
// Admin-only routes
// ----------------------------
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';
