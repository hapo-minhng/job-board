<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

Route::get('/', function () {
    return redirect()->route('jobs.index');
});

Route::resource('jobs', JobController::class)
    ->only(['index', 'show']);

Route::get('login', function () {
    return to_route('auth.create');
})->name('login');

Route::resource('auth', AuthController::class)
    ->only(['create', 'store']);
