<?php

use App\Http\Controllers\ExportPDFController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/signup', [SignUpController::class, 'showSignUpForm'])->name('signup.form');
// Route::post('/signup', [SignUpController::class, 'store'])->name('signup.store');

Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('auth.redirect');

Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('auth.callback');
Route::get('/export-pdf', [ExportPDFController::class, 'index'])->name('download.test');
