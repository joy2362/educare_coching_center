<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\Student\AccountController;
use App\Http\Controllers\Admin\studentController;
use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\RoutineController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    Route::get('/home', function () {
        return view('admin.pages.dashboard');
    })->name('home');

    //class crud
    Route::resource('class', ClassesController::class)->parameters([
        'class' => 'id'
    ]);

    //subject fetch
    Route::get('/subject/fetch/{id}', [ClassesController::class, 'subjectList']);

    //routine crud
    Route::get('/routine', [RoutineController::class, 'index'])->name('routine.index');
    Route::post('/routine/store', [RoutineController::class, 'store'])->name('routine.create');
    Route::get('/routine/show/{id}', [RoutineController::class, 'show']);
    Route::post('/routine/update', [RoutineController::class, 'update'])->name('routine.update');

    //exam
    Route::get('/exam', [ExamController::class, 'index'])->name('exam.index');
    Route::post('/exam/store', [ExamController::class, 'store'])->name('exam.create');
    Route::get('/exam/show/{id}', [ExamController::class, 'show']);
    Route::get('/exam/delete/{id}', [ExamController::class, 'destroy']);

    //result
    Route::get('/exam/result/{id}', [ResultController::class, 'index'])->name('result.index');
    Route::get('/exam/result/create/{id}', [ResultController::class, 'create'])->name('result.create');
    Route::get('/exam/result/show/{id}', [ResultController::class, 'show'])->name('result.show');
    Route::post('/exam/result/create', [ResultController::class, 'store'])->name('result.store');
    Route::post('/exam/result/update', [ResultController::class, 'update'])->name('result.update');

    //student
    Route::resource('student', studentController::class)->except('show');
    Route::get('student/{id}/show', [studentController::class, 'show' ]);
    Route::get('student/{id}/print', [studentController::class, 'printAdmissionForm' ]);
    Route::get('district/fetch/{id}', [studentController::class, 'districtList']);
    Route::get('batch/fetch/{id}', [studentController::class, 'batchList']);

    //notice
    Route::get('/notice/student', [NoticeController::class, 'create'])->name('notice.student');
    Route::post('/notice/student/send', [NoticeController::class, 'store'])->name('notice.student.store');

    Route::get('/website/brake/maintain', [AdminController::class, 'brake']);
    Route::get('/website/up/maintain', [AdminController::class, 'up']);

    Route::resource('student-account', AccountController::class)->except('edit','update','destroy');
    Route::get('student-account/payment/{id}/print', [AccountController::class, 'print'])->name('student.payment.print');
    Route::get('/student/account/credit/add', [AccountController::class, 'addCredit'])->name('student.credit.add');
    Route::get('/storage/link', function(){
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        dd("storage link successfully");
    } )->name('storage.link');


});
