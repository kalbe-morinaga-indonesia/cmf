<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\SubdepartmentController;
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
    return view('auth.login');
});

Route::prefix('back')->middleware('auth')->group(function(){

    Route::get('/dashboard', function(){
        return view('back.dashboard');
    })->name('dashboard');

    Route::prefix('divisi')->middleware('role:admin')->group(function(){
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

    Route::prefix('department')->middleware('role:admin')->group(function(){
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

    Route::prefix('subdepartment')->middleware('role:admin')->group(function(){
        Route::get('/',[SubdepartmentController::class,'index'])
        ->name('subdepartment.index');
        Route::post('/',[SubdepartmentController::class,'store'])
        ->name('subdepartment.store');
        Route::get('/{subdepartment}/edit',[SubdepartmentController::class,'edit'])
        ->name('subdepartment.edit');
        Route::put('/{subdepartment}/update',[SubdepartmentController::class,'update'])
        ->name('subdepartment.update');
        Route::delete('/{subdepartment}/delete',[SubdepartmentController::class,'destroy'])
        ->name('subdepartment.destroy');
    });

    Route::prefix('users')->middleware('role:admin')->group(function (){
        Route::get('/',[\App\Http\Controllers\UserController::class,'index'])
            ->name('users.index');
        Route::get('/create', [\App\Http\Controllers\UserController::class,'create'])
            ->name('users.create');
        Route::post('/create', [\App\Http\Controllers\UserController::class,'store'])
            ->name('users.store');
        Route::get('/{user}/edit',[\App\Http\Controllers\UserController::class,'edit'])
            ->name('users.edit');
        Route::put('/{user}/edit',[\App\Http\Controllers\UserController::class,'update'])
            ->name('users.update');
        Route::delete('/{user}/destroy',[\App\Http\Controllers\UserController::class,'destroy'])
            ->name('users.destroy');
    });

    Route::prefix('role-and-permission')->middleware('role:admin')->group(function (){
       Route::prefix('roles')->name('roles.')->group(function (){
           Route::get('/', [\App\Http\Controllers\RoleController::class,'index'])
           ->name('index');
           Route::post('/',[\App\Http\Controllers\RoleController::class,'store'])
               ->name('store');
           Route::get('/{role}/edit',[\App\Http\Controllers\RoleController::class,'edit'])
               ->name('edit');
           Route::put('/{role}/edit',[\App\Http\Controllers\RoleController::class,'update'])
               ->name('update');
           Route::delete('/{role}/delete',[\App\Http\Controllers\RoleController::class,'destroy'])
               ->name('destroy');
       });

        Route::prefix('permissions')->name('permissions.')->group(function (){
            Route::get('/', [\App\Http\Controllers\PermissionController::class,'index'])
                ->name('index');
            Route::post('/',[\App\Http\Controllers\PermissionController::class,'store'])
                ->name('store');
            Route::get('/{permission}/edit',[\App\Http\Controllers\PermissionController::class,'edit'])
                ->name('edit');
            Route::put('/{permission}/edit',[\App\Http\Controllers\PermissionController::class,'update'])
                ->name('update');
            Route::delete('/{permission}/delete',[\App\Http\Controllers\PermissionController::class,'destroy'])
                ->name('destroy');
        });

        Route::prefix('assign-permission')->name('assign-permissions.')->group(function (){
            Route::get('/', [\App\Http\Controllers\AssignPermissionController::class,'index'])
                ->name('index');
            Route::post('/',[\App\Http\Controllers\AssignPermissionController::class,'store'])
                ->name('store');
            Route::get('/{role}/edit',[\App\Http\Controllers\AssignPermissionController::class,'sync'])
                ->name('sync');
            Route::put('/{role}/edit',[\App\Http\Controllers\AssignPermissionController::class,'update'])
                ->name('update');
        });

        Route::prefix('assign-user')->name('assign-users.')->group(function (){
            Route::get('/', [\App\Http\Controllers\AssignUserController::class,'index'])
                ->name('index');
            Route::post('/',[\App\Http\Controllers\AssignUserController::class,'store'])
                ->name('store');
            Route::get('/{user}/edit',[\App\Http\Controllers\AssignUserController::class,'sync'])
                ->name('sync');
            Route::put('/{user}/edit',[\App\Http\Controllers\AssignUserController::class,'update'])
                ->name('update');
        });
    });

    Route::prefix('my-profile')->group(function (){
        Route::get('/',[\App\Http\Controllers\UserController::class,'profile'])
            ->name('profiles.index');
        Route::put('/',[\App\Http\Controllers\UserController::class,'updateProfile'])
            ->name('profiles.update');
    });

    Route::prefix('setting')->group(function (){
        Route::get('/',[\App\Http\Controllers\UserController::class,'setting'])
            ->name('settings.index');
        Route::put('/',[\App\Http\Controllers\UserController::class,'changePassword'])
            ->name('settings.change-password');
    });

    Route::prefix('cmf')->group(function (){
        Route::get('/',[\App\Http\Controllers\CmfController::class,'index'])
            ->name('cmf.index');
        Route::get('/create',[\App\Http\Controllers\CmfController::class,'create'])
            ->name('cmf.create');
        Route::post('/create',[\App\Http\Controllers\CmfController::class,'store'])
            ->name('cmf.store');
        Route::get('/{slug}/detail',[\App\Http\Controllers\CmfController::class,'detail'])
            ->name('cmf.detail');
        Route::get('/{slug}/status',[\App\Http\Controllers\CmfController::class,'status'])
            ->name('cmf.status');
        Route::post('/{slug}/signature',[\App\Http\Controllers\CmfController::class,'signature'])
            ->name('cmf.signature');
        Route::post('/{slug}/revised',[\App\Http\Controllers\CmfController::class,'revised'])
            ->name('cmf.revised');
        Route::get('/{slug}/review',[\App\Http\Controllers\CmfController::class,'review'])
            ->name('cmf.review');
        Route::post('/{slug}/review',[\App\Http\Controllers\CmfController::class,'activity'])
            ->name('cmf.activity');
        Route::get('/{slug}/print',[\App\Http\Controllers\CmfController::class,'print'])
            ->name('cmf.print');
    });

});

Route::get('lacak/',[\App\Http\Controllers\CmfController::class,'lacak'])
    ->name('cmf.lacak');

Auth::routes();
