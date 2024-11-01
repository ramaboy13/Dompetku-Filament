<?php

use App\Http\Controllers\ExportPDFController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/signup', [SignUpController::class, 'showSignUpForm'])->name('signup.form');
// Route::post('/signup', [SignUpController::class, 'store'])->name('signup.store');

Route::get('download', [ExportPDFController::class, 'index'])->name('download.test');
