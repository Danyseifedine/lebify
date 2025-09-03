


<?php

use App\Http\Controllers\Auth\SocialController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// start: ============================================= //
// start: ================== Auth ===================== //
// start: ============================================= //

Auth::routes(['verify' => true]);

// end: ============================================= //
// end: ================= Auth ====================== //
// end: ============================================= //

// start: ============================================= //
// start: ================ Social ===================== //
// start: ============================================= //

Route::get('/auth/{provider}/redirect', [SocialController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialController::class, 'callback'])->name('social.callback');

// end: ============================================= //
// end: ================ Social ===================== //
// end: ============================================= //

