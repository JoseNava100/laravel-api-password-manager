<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\Api\WidgetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::resource('passwords', PasswordController::class);
    Route::get('widgetCount', [WidgetController::class, 'widgetCount']);
    Route::post('logout', [AuthController::class, 'logout']);
}); 