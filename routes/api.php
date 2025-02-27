<?php

use App\Interface\Http\Controllers\HealthCheckController;
use App\Interface\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/health', [ HealthCheckController::class, 'check' ]);
Route::post('/user', [ UserController::class, 'store' ]);
