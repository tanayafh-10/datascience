<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/result', function () {
    return view('result');
})->name('result');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
