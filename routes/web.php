<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/home', function () {
//    return view('home');
//})->name('home')->middleware('auth');

Route::get('/', [HomeController::class,'index'])->name('home')
    ->middleware('auth:web');

Route::get('/profile/edit', function () {
    return view('profile');
})->middleware('auth')->name('user.profile');

Route::view('password/change','password_change')
    ->middleware('auth')
    ->name('user.password.change');
