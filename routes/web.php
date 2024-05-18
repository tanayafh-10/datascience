<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HeartAttackPredictionController;


Route::get('/', function () {
    return view('home');
})->name('home');

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


Route::get('/upload', [HeartAttackPredictionController::class, 'showUploadForm'])->name('upload.form');
Route::post('/upload', [HeartAttackPredictionController::class, 'uploadFile'])->name('upload.file');

Route::resource('books', BookController::class);
