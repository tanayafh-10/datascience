<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HeartAttackPredictionController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AllController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/home', [AllController::class, 'home'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/method', function () {
    return view('method');
})->name('method');

Route::get('/check', function () {
    return view('check');
})->name('check');

Route::get('/result', [HeartAttackPredictionController::class, 'result'])->name('result');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'login_action']);

Route::get('/forgot-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm2'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

Route::get('/daftar', [RegisterController::class, 'daftar'])->name('daftar');
Route::post('/daftar', [RegisterController::class, 'register'])->name('register');

Route::get('/upload', [HeartAttackPredictionController::class, 'showUploadForm'])->name('upload.form');
Route::post('/upload', [HeartAttackPredictionController::class, 'uploadFile'])->name('upload.file');

Route::resource('books', BookController::class);