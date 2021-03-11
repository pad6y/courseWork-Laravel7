<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'show'])->name('home');

Route::middleware('auth')->group(function(){
   
   Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');
   
});

