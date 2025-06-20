<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\AnalysisController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function(){
    Route::get('/',function(){
        return redirect()->route('login');
    });

    // Caso a sessão fique presa...aconteceu de forma estupida...
    Route::get('/force-logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    });

    Route::get('/lang/{locale}',[LangController::class,'ChangeLang']);

    Route::get('/waiting-aproval', fn () => view('waiting-aproval'))->name('waiting-aproval');

    // Client Normal Routes 
    Route::middleware(['auth:client','approved'])->group(function () {
        Route::get('/dashboard', fn () => view('client.dashboard'))->name('dashboard');

        Route::get('/analysis',[AnalysisController::class,'Analysis'])->name('analysis');
        Route::get('/analysis/form/{id}',[AnalysisController::class,'AnalysisForm'])->name('analysis.form');
        Route::post('/analysis/form/{id}/save',[AnalysisController::class,'AnalysisSave'])->name('analysis.save');
    });


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/',function(){
            return redirect()->route('admin.login');
        });

        Route::middleware(['auth:web', 'verified'])->group(function(){
            Route::get('/panel',[AdminController::class, 'Panel'])->name('panel');
            Route::get('/users',[AdminController::class, 'Users'])->name('users');
             Route::get('/clients',[AdminController::class, 'Clients'])->name('clients');

            Route::prefix('/samples')->group(function(){
                Route::get('/',[AdminController::class, 'Samples'])->name('samples');
                Route::get('/form/{id}',[AdminController::class, 'FormSamples'])->name('sample-form');
                Route::post('/form/{id}/save',[AdminController::class, 'SaveSampleTest'])->name('sample-form-save');
            });
        });
    });

    // Route::middleware('auth')->group(function () {
    //     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // });

    // All Auth Routes
    require __DIR__.'/auth.php';
});

