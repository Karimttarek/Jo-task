<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Middleware\RedirectIfNotAdmin;
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


Route::middleware([RedirectIfNotAdmin::class])->prefix('admin')->group(function () {

    Route::get('users' , [UsersController::class , 'index'])->name('admin.users');

    Route::get('users/destroy' , [UsersController::class , 'destroy'])->name('admin.user.destroy');
    Route::get('users/trash' , [UsersController::class , 'trash'])->name('admin.user.trash');
    Route::get('users/undo' , [UsersController::class , 'undo'])->name('admin.user.undo');


    Route::get('user/create' , [UsersController::class , 'create'])->name('admin.user.create');
    Route::post('user/store' , [UsersController::class , 'store'])->name('admin.user.store');

    Route::get('user/edit/{id}' , [UsersController::class , 'edit'])->name('admin.user.edit');
    Route::post('user/update/{id}' , [UsersController::class , 'update'])->name('admin.user.update');

    Route::get('files/upload' ,[FileController::class ,'index'])->name('admin.file');
    Route::post('files/store' ,[FileController::class ,'store'])->name('admin.file.store');
    Route::get('files/id/store' ,[FileController::class ,'getId'])->name('admin.get.id');
});

