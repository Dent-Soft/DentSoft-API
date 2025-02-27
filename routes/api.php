<?php

use App\Interface\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json([ 'status' => 'ok', 'time' => now() ]);
});

Route::post('/user', [ UserController::class, 'store' ]);
