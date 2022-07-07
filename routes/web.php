<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\ImportExportController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin views
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(
    function(){
        Route::get('/',[AdminHomeController::class, 'index'])->name('admin.index');
        Route::get('/student',[AdminHomeController::class, 'studentAccount']);
        Route::get('/announcement',[AdminHomeController::class, 'announcement']);
        Route::get('/account',[AdminHomeController::class, 'adminAccount']);

        //Student Account CRUD route
        //create
        Route::post('/student/create',[AdminStudentController::class, 'createStudent'])->name('createStudent');
        
        //update
        Route::get('/student/edit/{username}',[AdminStudentController::class, 'editStudent']);
        Route::put('/student/update/{username}',[AdminStudentController::class, 'updateStudent']);

        //delete 
        Route::get('/student/delete/{username}',[AdminStudentController::class, 'deleteStudent']);


        //Admin Import and Export route
        Route::get('/student/import', [ImportExportController::class, 'index']);
        Route::post('/student/importData', [ImportExportController::class, 'import'])->name('studentImport');
        Route::get('/student/exportExcel',[ImportExportController::class,'exportExcel']);
        Route::get('/student/exportCSV',[ImportExportController::class,'exportCSV']);
        Route::get('/student/exportPDF',[ImportExportController::class,'exportPDF']);
        Route::get('/student/savePDF',[ImportExportController::class,'savePDF']);
    }   
);

//user views
Route::prefix('user')->middleware(['auth','isUser'])->group(
    function () {
        Route::get('/',[UserHomeController::class, 'index'])->name('user.index');
    }
);

Route::get('/student',[studentController::class, 'index']);
