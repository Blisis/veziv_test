<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/appointments')->group(function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('appointments.index');
    // ajax
    Route::get('/get-hours', [App\Http\Controllers\HomeController::class, 'getHours'])->name('appointments.get.hours');

    Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('appointments.create');
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('appointments.store');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('appointments.edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('appointments.update');
    Route::get('/destroy/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('appointments.destroy');
});

Route::prefix('/admin')->middleware('is.admin')->group(function(){
    Route::prefix('/appointments')->group(function(){
        Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.appointments.index');
        Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('admin.appointments.edit');
    });
});

