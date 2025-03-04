<?php

use App\Interface\Http\Controllers\HealthCheckController;
use App\Interface\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/health', [ HealthCheckController::class, 'check' ]);
Route::post('/user', [ UserController::class, 'store' ]);

Route::group([ 'prefix' => 'admin', 'middleware' => [ 'role:admin' ] ], function () {
    Route::get('/', function () {
        return 'middleware with role';
    });
    // Route::get('/manage', [ 'middleware' => [ 'permission:manage-admins' ], 'uses' => 'AdminController@manageAdmins' ]);
});
