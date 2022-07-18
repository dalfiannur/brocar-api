<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::group(['prefix' => 'auth'], function () {
//     Route::post('/login', [AuthController::class, 'login']);
//     Route::post('/register', [AuthController::class, 'register']);

//     Route::get('/otp', [OtpController::class, 'request']);
//     Route::post('/otp', [OtpController::class, 'verify']);
// });


Route::group(['prefix' => 'banks'], function () {
    Route::get('/', '\App\Actions\Bank\ListBankAction');
});

Route::group(['prefix' => 'profile'], function () {
    Route::get('/', '\App\Actions\Profile\GetCurrentUserAction')->middleware('auth');
});
