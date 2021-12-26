<?php

use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\studentController;
use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\RoutineController;
use App\Http\Controllers\Admin\BatchController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    Route::get('/home', function () {
        return view('admin.pages.dashboard');
    })->name('home');

    //class crud
    Route::get('/class', [ClassesController::class, 'index'])->name('class.index');
    Route::get('/class/show/{id}', [ClassesController::class, 'show']);
    Route::get('/class/delete/{id}', [ClassesController::class, 'destroy']);
    Route::post('/class/create', [ClassesController::class, 'store'])->name('class.create');
    Route::post('/class/update', [ClassesController::class, 'update'])->name('class.update');
    //subject crud
    Route::get('/class/subject/{id}', [SubjectController::class, 'index']);
    Route::post('/class/subject/create', [SubjectController::class, 'store'])->name('subject.create');
    Route::get('/subject/delete/{id}', [SubjectController::class, 'destroy']);
    Route::get('/subject/show/{id}', [SubjectController::class, 'show']);
    Route::post('/subject/update', [SubjectController::class, 'update'])->name('subject.update');
    //batch crud
    Route::get('/class/batch/{id}', [BatchController::class, 'index']);
    Route::get('/batch/show/{id}', [BatchController::class, 'show']);
    Route::get('/batch/delete/{id}', [BatchController::class, 'destroy']);
    Route::post('/batch/create', [BatchController::class, 'store'])->name('batch.create');
    Route::post('/batch/update', [BatchController::class, 'update'])->name('batch.update');

    //routine crud
    Route::get('/routine', [RoutineController::class, 'index'])->name('routine.index');
    Route::get('/routine/create/{id}', [RoutineController::class, 'create']);
    Route::post('/routine/store/{id}', [RoutineController::class, 'store'])->name('routine.create');
    Route::get('/routine/show/{id}', [RoutineController::class, 'show']);
    Route::post('/routine/update', [RoutineController::class, 'update'])->name('routine.update');

    //student
    Route::resource('student', studentController::class);
    Route::get('district/fetch/{id}', [studentController::class, 'districtList']);
    Route::get('batch/fetch/{id}', [studentController::class, 'batchList']);

    Route::get('/notice/student', [NoticeController::class, 'create'])->name('notice.student');
    Route::post('/notice/student/send', [NoticeController::class, 'store'])->name('notice.student.store');

});

