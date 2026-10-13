<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('home'));

Route::get('/home', fn() => view('home'))->name('home');
