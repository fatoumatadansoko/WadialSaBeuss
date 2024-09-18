<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\Api\AuthController;


Route::get('/', function () {
    return view('welcome');
});

// Route::apiResource('evenements', EvenementController::class)->only('index', 'show');

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
Route::post('register', [AuthController::class, 'register']);
