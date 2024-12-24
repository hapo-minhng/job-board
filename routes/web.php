<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;

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

Route::delete('logout', function () {
    return to_route('auth.destroy');
})->name('logout');

Route::delete('auth', [AuthController::class, 'destroy'])
    ->name('auth.destroy');

Route::middleware('auth')->group(
    function () {
        Route::resource('job.application', JobApplicationController::class)
            ->only(['create', 'store']);
    }
);
