<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\MyJobApplicationController;
use App\Http\Controllers\MyJobController;
use App\Http\Controllers\UserController;

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

        Route::resource('my-job-applications', MyJobApplicationController::class)
            ->only(['index', 'destroy']);

        Route::resource('employer', EmployerController::class);

        Route::middleware('employer')
            ->resource('my-jobs', MyJobController::class);

        Route::resource('user', UserController::class)
            ->only(['edit', 'update']);
    }
);
