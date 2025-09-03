<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Landing\NavbarController;
use App\Http\Controllers\Dashboard\WorkPlace\Applications\ApplicationController;
use App\Http\Controllers\Dashboard\WorkPlace\Applications\ApplicationsTypeController;
use Illuminate\Support\Facades\Route;


Route::middleware(['role:admin'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Overview
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::prefix('components')->name('components.')->group(function () {

        // start: ============================================= //
        // start: =============== General ===================== //
        // start: ============================================= //

        // ? Navbar --------->

        Route::controller(NavbarController::class)->group(function () {
            Route::get('navbar/datatable', 'datatable')->name('navbar.datatable');
            Route::resource('navbar', NavbarController::class)->names('navbar');
            Route::put('navbar/change-visibility/{id}', 'changeVisibility')->name('navbar.change-visibility');
            Route::get('navbar/get/{id}', 'get')->name('navbar.get');
            Route::post('navbar/edit', 'updateNavbarMenu')->name('navbar.edit');
            Route::post('navbar/update-logo', 'updateLogo')->name('navbar.update-logo');
            Route::post('navbar/update-theme', 'updateTheme')->name('navbar.update-theme');
        });
    });


    // start: ============================================= //
    // start: =============== Application ================= //
    // start: ============================================= //

    // ? Application --------->

    Route::controller(ApplicationController::class)->group(function () {
        Route::name('application.')->prefix('application')->group(function () {
            Route::get('datatable', 'datatable')->name('datatable');
            Route::post('edit', 'editApplication')->name('edit');
            Route::post('createFiles', 'createFiles')->name('createFiles');
            Route::get('get/{id}', 'get')->name('get');
            Route::put('change-visibility/{id}', 'changeVisibility')->name('change-visibility');
            Route::put('change-status/{id}', 'changeStatus')->name('change-status');
            Route::post('icon/upload', 'uploadIcon')->name('icon.upload');
            Route::delete('icon/delete/{icon}', 'deleteIcon')->name('icon.delete');
        });
        Route::resource('application', ApplicationController::class);
    });

    // ? Type --------->

    Route::controller(ApplicationsTypeController::class)->group(function () {
        Route::name('type.application')->prefix('type/application')->group(function () {
            Route::get('datatable', 'datatable')->name('datatable');
            Route::get('get/{id}', 'get')->name('get');
            Route::post('edit', 'editApplicationType')->name('edit');
        });

        Route::resource('type/application', ApplicationsTypeController::class)->names('type.application');
    });
});
