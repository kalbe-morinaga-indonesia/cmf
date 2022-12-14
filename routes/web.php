<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DivisiController;
use Illuminate\Support\Facades\Auth;
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



Route::prefix('back')->group(function(){

    Route::get('/dashboard', function(){
        return view('back.dashboard');
    })->name('dashboard');

    Route::prefix('divisi')->group(function(){
        Route::get('/',[DivisiController::class,'index'])
        ->name('divisi.index');
        Route::post('/',[DivisiController::class,'store'])
        ->name('divisi.store');
        Route::get('/{divisi}/edit',[DivisiController::class,'edit'])
        ->name('divisi.edit');
        Route::put('/{divisi}/edit',[DivisiController::class,'update'])
        ->name('divisi.update');
        Route::delete('/{divisi}/delete',[DivisiController::class,'destroy'])
        ->name('divisi.destroy');
    });

    Route::prefix('department')->group(function(){
        Route::get('/',[DepartmentController::class,'index'])
        ->name('department.index');
        Route::post('/',[DepartmentController::class,'store'])
        ->name('department.store');
        Route::get('/{department}/edit',[DepartmentController::class,'edit'])
        ->name('department.edit');
        Route::put('/{department}/update',[DepartmentController::class,'update'])
        ->name('department.update');
        Route::delete('/{department}/delete',[DepartmentController::class,'destroy'])
        ->name('department.destroy');
    });

});

Route::get('/login', function(){
    return view('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
