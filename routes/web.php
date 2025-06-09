<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\ClientLoginController;
use App\Http\Controllers\Auth\ClientRegisterController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function(){
    Route::get('/',function(){
        return redirect()->route('login');
    });

    Route::get('/lang/{locale}',[LangController::class,'ChangeLang']);

    // Client Normal Routes 
    Route::middleware('auth:client')->group(function () {
        Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    });


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/',function(){
            return redirect()->route('admin.login');
        });

        Route::middleware(['auth:web', 'verified'])->group(function(){
            Route::get('/panel',[AdminController::class, 'Panel'])->name('panel');
            Route::get('/users',[AdminController::class, 'Users'])->name('users');

            Route::prefix('/samples')->group(function(){
                Route::get('/',[AdminController::class, 'Samples'])->name('samples');
                Route::get('/form/{id}',[AdminController::class, 'FormSamples'])->name('sample-form');
                Route::post('/form/{id}/save',[AdminController::class, 'SaveSampleTest'])->name('sample-form-save');
            });
        });
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // All Auth Routes
    require __DIR__.'/auth.php';
});

