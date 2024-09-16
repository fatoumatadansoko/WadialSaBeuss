<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CategorieController;

Route::get('/', function () {
    return view('welcome');
});

// Route::apiResource('evenements', EvenementController::class)->only('index', 'show');

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
Route::post('register', [AuthController::class, 'register']);



// Route pour récupérer toutes les catégories
Route::get('categories', [CategorieController::class, 'index'])->name('categories.index');

// Route pour créer une nouvelle catégorie
Route::post('categories', [CategorieController::class, 'store'])->name('categories.store');

// Route pour récupérer une catégorie spécifique
Route::get('categories/{id}', [CategorieController::class, 'show'])->name('categories.show');

// Route pour mettre à jour une catégorie
Route::put('categories/{id}', [CategorieController::class, 'update'])->name('categories.update');

// Route pour supprimer une catégorie
Route::delete('categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');