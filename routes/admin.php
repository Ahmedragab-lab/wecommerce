<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Profile\PasswordController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        //user routes
        // Route::get('/users/data', [UserController::class,'data'])->name('users.data');
        // Route::delete('/users/bulk_delete', [UserController::class,'bulkDelete'])->name('users.bulk_delete');
        // Route::resource('users', UserController::class);
        Route::prefix('admin')->group(function(){
            // the home route
            Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
             //settings routes
             Route::get('/settings/general', [SettingController::class,'general'])->name('settings.general');
             Route::resource('settings', SettingController::class)->only(['store']);
             //profile routes
             Route::get('/profile/edit', [ProfileController::class,'edit'])->name('profile.edit');
             Route::put('/profile/update', [ProfileController::class,'update'])->name('profile.update');
             //profile password routes
             Route::name('profile.')->namespace('Profile')->group(function () {
                Route::get('/password/edit', [PasswordController::class,'edit'])->name('password.edit');
                Route::put('/password/update', [PasswordController::class,'update'])->name('password.update');
            });
             //admin routes
            Route::controller(AdminController::class)->group(function(){
                Route::get('/admins/data','data')->name('admins.data');
                Route::delete('/admins/bulk_delete','bulkDelete')->name('admins.bulk_delete');
                Route::get('/admins/change_status/{id}','change_status')->name('change_status');
                Route::resource('admins',AdminController::class);
            });
             //user routes
            Route::controller(UserController::class)->group(function(){
                Route::get('/users/data','data')->name('users.data');
                Route::delete('/users/bulk_delete','bulkDelete')->name('users.bulk_delete');
                Route::get('/users/change_status/{id}','change_status')->name('users.change_status');
                Route::resource('users',UserController::class);
            });
        });
});




