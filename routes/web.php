<?php

use App\Http\Controllers\LangController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\LanguageControl;
use Illuminate\Support\Facades\Route;


Route::middleware([LanguageControl::class])->group(function(){
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/lang/{locale}',[LangController::class,'ChangeLang']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});

