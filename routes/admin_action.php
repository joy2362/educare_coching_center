<?php

use App\Http\Controllers\Admin\studentController;
use App\Http\Controllers\Admin\ClassesController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/home', function () {
        return view('admin.pages.dashboard');
    })->name('home');

    Route::get('/class', [ClassesController::class, 'index'])->name('class.index');
    Route::resource('student', studentController::class);


});

