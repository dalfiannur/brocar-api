<?php

use App\Modules\Auth\Controllers\LoginController;
use Illuminate\Support\Facades\Route;


Route::post('/login', LoginController::class);
    // Route::post('/register', [AuthController::class, 'register']);

    // Route::get('/otp', [OtpController::class, 'request']);
    // Route::post('/otp', [OtpController::class, 'verify']);
