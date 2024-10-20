<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Route::group(
//     [
//         'prefix' => LaravelLocalization::setLocale(),
//         'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
//     ], function(){
//         Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//          //user routes
//         Route::get('/users/data', [UserController::class,'data'])->name('users.data');
//         Route::delete('/users/bulk_delete', [UserController::class,'bulkDelete'])->name('users.bulk_delete');
//         Route::resource('users', UserController::class);

//         // Route::controller(UserController::class)->group(function(){
//         //     Route::get('/users/data','data')->name('users.data');
//         //     Route::get('/users/bulk_delete','bulkDelete')->name('users.bulk_delete');
//         //     Route::resource('users');
//         // });
// });




