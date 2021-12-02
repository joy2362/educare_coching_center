<?php

use App\Http\Controllers\Admin\studentController;
use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\SectionController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/home', function () {
        return view('admin.pages.dashboard');
    })->name('home');

    Route::get('/class', [ClassesController::class, 'index'])->name('class.index');
    Route::get('/class/show/{id}', [ClassesController::class, 'show']);
    Route::get('/class/delete/{id}', [ClassesController::class, 'destroy']);
    Route::post('/class/create', [ClassesController::class, 'store'])->name('class.create');
    Route::post('/class/update', [ClassesController::class, 'update'])->name('class.update');

    Route::get('/section', [SectionController::class, 'index'])->name('section.index');
    Route::post('/section/create', [SectionController::class, 'store'])->name('section.create');

    Route::resource('student', studentController::class);


});

