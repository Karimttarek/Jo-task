<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FilesController;
use App\Http\Middleware\RedirectIfNotAuthenticated;
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


Route::get('/' , function(){ return view('index'); })->middleware([RedirectIfNotAuthenticated::class])->name('HOME');

Route::get('/login' , [AuthController::class , 'index'])->name('loginView');
Route::post('/login' , [AuthController::class , 'login'])->name('login');
Route::post('/logout' , [AuthController::class , 'logout'])->name('logout');
Route::post('/credential/validate' , [AuthController::class , 'credentialValidate'])->name('credentialValidate');


Route::get('/register' , [RegisterController::class , 'index'])->name('registerView');
Route::post('/register' , [RegisterController::class , 'store'])->name('register');

Route::middleware([RedirectIfNotAuthenticated::class])->controller(FilesController::class)->prefix('files')->group(function () {

    Route::get('/' ,'index')->name('files');
    Route::get('/uploud' ,'create')->name('filesUpload');
    Route::post('/uploadFiles' , 'store')->name('uploadFiles');
    Route::get('/destroy' , 'destroy')->name('filesDestroy');
    Route::get('/filters' ,'filters')->name('fileFilters');
    Route::get('/retrieve' , 'retrieveFiles')->name('retrieveFiles');
});


