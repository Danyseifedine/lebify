

<?php

use App\Http\Controllers\Dashboard\WorkPlace\Applications\ApplicationController;
use App\Http\Controllers\WorkPlace\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'index'])->name('index');


Route::controller(ApplicationController::class)->group(function () {

    // start: ============================================= //
    // start: ========= Application in the home =========== //
    // start: ============================================= //
    Route::resource('applications', ApplicationController::class);
    Route::get('application/get/{id}', 'get')->name('application.get');
    Route::get('applications/tab/{tab}', 'getTab')->name('applications.tab');
    Route::put('applications/count/{id}', 'count')->name('applications.count');
    // end: ============================================= //
    // end: ========= Application in the home =========== //
    // end: ============================================= //

    // start: ============================================= //
    // start: ============ Applications here ============== //
    // start: ============================================= //
    Route::get('application/{url}', [ApplicationController::class, 'render']);
    // end: ============================================= //
    // end: ============ Applications here ============== //
    // end: ============================================= //

});
