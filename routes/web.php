<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('home')->middleware('auth:web');
Route::get('/exam-date', [HomeController::class,'exam_date'])->name('exam-date')->middleware('auth:web');
Route::get('/exam-result', [HomeController::class,'exam_result'])->name('exam-result')->middleware('auth:web');

Route::post('student/forgot-password',[HomeController::class,'forgot_password'])->name('student.forgot-password');


Route::get('/profile/edit', function () {
    return view('profile');
})->middleware('auth')->name('user.profile');

Route::view('password/change','password_change')
    ->middleware('auth')
    ->name('user.password.change');

Route::get('/test',function(){
   
       $pdf = app('dompdf.wrapper');
       $pdf->loadView('pdf.test');

       return $pdf->stream("test.pdf");
});
