<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin', function () {
    return view('admin');
});
Route::get('bookcatalogue', function () {
    return view('bookcatalogue');
});
Route::get('profile', function () {
    return view('profile');
});
Route::get('settings', function () {
    return view('settings');
});
Route::get('login', function () {
    return view('login');
});
Route::get('signup', function () {
    return view('signup');
});

