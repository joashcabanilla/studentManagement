<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\ImportExportController;
use App\Http\Controllers\Admin\AdminAnnouncementController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

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
        Route::put('/student/update/{username}/{email}',[AdminStudentController::class, 'updateStudent']);

        //delete 
        Route::get('/student/delete/{username}',[AdminStudentController::class, 'deleteStudent']);


        //Admin Import and Export route
        Route::get('/student/import', [ImportExportController::class, 'index']);
        Route::post('/student/importData', [ImportExportController::class, 'import'])->name('studentImport');
        Route::get('/student/exportExcel',[ImportExportController::class,'exportExcel']);
        Route::get('/student/exportCSV',[ImportExportController::class,'exportCSV']);
        Route::get('/student/exportPDF',[ImportExportController::class,'exportPDF']);
        Route::get('/student/savePDF',[ImportExportController::class,'savePDF']);

        //Announcement CRUD Route
         //create
         Route::post('/announcement/create',[AdminAnnouncementController::class, 'createAnnouncement'])->name('createAnnouncement');

        //update
        Route::get('/announcement/edit/{id}',[AdminAnnouncementController::class, 'editAnnouncement']);
        Route::put('/announcement/update/{id}',[AdminAnnouncementController::class, 'updateAnnouncement']);

        //delete 
        Route::get('/announcement/delete/{id}',[AdminAnnouncementController::class, 'deleteAnnouncement']);


        //Admin Account Update Route
        Route::put('/admin/update',[AdminAnnouncementController::class, 'updateAdmin'])->name('updateAdmin');
    }   
);

//user views
Route::prefix('user')->middleware(['auth','isUser'])->group(
    function () {
        Route::get('/',[UserHomeController::class, 'index'])->name('user.index');
        Route::get('/profile/{id}',[UserHomeController::class, 'profile']);
        
        //Student Proflie Update
        Route::put('/update/{username}/{email}',[UserHomeController::class, 'updateStudent']);
    }
);

Route::get('/student',[studentController::class, 'index']);
