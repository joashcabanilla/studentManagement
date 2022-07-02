<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(
    function(){
        Route::get('/',[DashboardController::class, 'index'])->name('admin.index');
    }   
);

//user
Route::prefix('user')->middleware(['auth','isUser'])->group(
    function () {
        Route::get('/',[HomeController::class, 'index'])->name('user.index');
    }
);