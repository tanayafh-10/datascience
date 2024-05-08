<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/upload', function () {
    return view('upload');
});

Route::get('/prediksi', function () {
    return view('prediksi');
});
