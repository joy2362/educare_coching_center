<?php

use App\Http\Controllers\Admin\studentController;
use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SubjectController;
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

    //section crud
    Route::get('/section', [SectionController::class, 'index'])->name('section.index');
    Route::get('/section/show/{id}', [SectionController::class, 'show']);
    Route::get('/section/delete/{id}', [SectionController::class, 'destroy']);
    Route::post('/section/create', [SectionController::class, 'store'])->name('section.create');
    Route::post('/section/update', [SectionController::class, 'update'])->name('section.update');
    //routine crud
    Route::get('/section/routine/{id}', [SubjectController::class, 'index']);
    Route::resource('student', studentController::class);
    Route::get('district/fetch/{id}', [studentController::class, 'districtList']);
    Route::get('section/fetch/{id}', [studentController::class, 'sectionList']);


});

