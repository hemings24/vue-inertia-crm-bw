<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\StatusItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/',function(){
   return Inertia::render('Welcome',[
      'canLogin' => Route::has('login'),
      'canRegister' => Route::has('register'),
      'laravelVersion' => Application::VERSION,
      'phpVersion' => PHP_VERSION
   ]);
});

Route::middleware(['auth','verified'])->group(function(){
   Route::inertia('/dashboard','Dashboard')->name('dashboard');
   Route::resource('/customers',CustomerController::class);
   Route::resource('/projects',ProjectController::class);
   Route::resource('/emails',EmailController::class);
   Route::resource('/status_items',StatusItemController::class);
   Route::inertia('/about','About')->name('about');
   Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');
   Route::patch('/profile',[ProfileController::class,'update'])->name('profile.update');
   Route::delete('/profile',[ProfileController::class,'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';