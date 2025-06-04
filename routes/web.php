<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function(){
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/lang/{locale}',[LangController::class,'ChangeLang']);

    Route::prefix('admin')->middleware([/*'auth', 'verified'*/])->group(function () {
        Route::get('/',function(){
            return redirect()->route('admin-panel');
        });
        Route::get('/panel',[AdminController::class, 'Panel'])->name('admin-panel');
        Route::get('/users',[AdminController::class, 'Users'])->name('admin-users');

        Route::prefix('/samples')->group(function(){
            Route::get('/',[AdminController::class, 'Samples'])->name('admin-samples');
            Route::get('/form/{id}',[AdminController::class, 'FormSamples'])->name('admin-sample-form');
            Route::post('/form/{id}/save',[AdminController::class, 'SaveSampleTest'])->name('admin-sample-form-save');
        });
        
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

   

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});

