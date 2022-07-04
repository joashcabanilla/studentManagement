<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\User\UserHomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin views
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(
    function(){
        Route::get('/',[AdminHomeController::class, 'index'])->name('admin.index');
        Route::get('/dashboard',[AdminHomeController::class, 'index']);
        Route::get('/student',[AdminHomeController::class, 'studentAccount']);
        Route::get('/announcement',[AdminHomeController::class, 'announcement']);
        Route::get('/account',[AdminHomeController::class, 'adminAccount']);
    }   
);

//user views
Route::prefix('user')->middleware(['auth','isUser'])->group(
    function () {
        Route::get('/',[UserHomeController::class, 'index'])->name('user.index');
    }
);