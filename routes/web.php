<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/method', function () {
    return view('method');
});

Route::get('/check', function () {
    return view('check');
});

Route::get('/result', function () {
    return view('result');
});

Route::get('/contact', function () {
    return view('contact');
});
