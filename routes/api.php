<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CarteInvitationController;
use App\Http\Controllers\CategoriePrestataireController;

Route::get('/', function () {
    return view('welcome');
});
Route::apiResource('users', UserController::class);


// Route::apiResource('evenements', EvenementController::class)->only('index', 'show');

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
Route::post('register', [AuthController::class, 'register']);


//CATEGORIES DES EVENEMENTS
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


//CATEGORIES DES PRESTATAIRES


// Route pour récupérer toutes les catégories des prestataires
Route::get('categoriesprestataires', [CategoriePrestataireController::class, 'index'])->name('categoriesprestataires.index');
// Route pour créer une nouvelle catégorie des prestataires
Route::post('categoriesprestataires', [CategoriePrestataireController::class, 'store'])->name('categoriesprestataires.store');
// Route pour récupérer une catégorie des prestataires spécifique
Route::get('categoriesprestataires/{id}', [CategoriePrestataireController::class, 'show'])->name('categoriesprestataires.show');
// Route pour mettre à jour une catégorie des prestataires
Route::put('categoriesprestataires/{id}', [CategoriePrestataireController::class, 'update'])->name('categoriesprestataires.update');
// Route pour supprimer une catégorie des prestataires
Route::delete('categoriesprestataires/{id}', [CategoriePrestataireController::class, 'destroy'])->name('categoriesprestataires.destroy');


//ROUTE POUR EVENEMENTS
Route::get('evenements', [EvenementController::class, 'index']);
Route::post('evenements', [EvenementController::class, 'store']);
Route::get('evenements/{id}', [EvenementController::class, 'show']);
Route::put('evenements/{id}', [EvenementController::class, 'update']);
Route::delete('evenements/{id}', [EvenementController::class, 'destroy']);



// Route pour les cartes d'invitation

Route::get('cartes', [CarteInvitationController::class, 'index']);
Route::post('cartes', [CarteInvitationController::class, 'store']);
Route::get('cartes/{id}', [CarteInvitationController::class, 'show']);
Route::put('cartes/{id}', [CarteInvitationController::class, 'update']);
Route::delete('cartes/{id}', [CarteInvitationController::class, 'destroy']);




// Route pour les commentaires
Route::get('commentaires', [CommentaireController::class, 'index']);
Route::post('commentaires', [CommentaireController::class, 'store']);
Route::get('commentaires/{id}', [CommentaireController::class, 'show']);
Route::put('commentaires/{id}', [CommentaireController::class, 'update']);
Route::delete('commentaires/{id}', [CommentaireController::class, 'destroy']);


//ROUTES POUR LES IMAGES
Route::get('images', [ImageController::class, 'index']);
Route::post('images', [ImageController::class, 'store']);
Route::get('images/{id}', [ImageController::class, 'show']);
Route::put('images/{id}', [ImageController::class, 'update']);
Route::delete('images/{id}', [ImageController::class, 'destroy']);



//ROUTES POUR LES VOTES 

Route::get('votes', [VoteController::class, 'index']);
Route::post('votes', [VoteController::class, 'store']);
Route::get('votes/{id}', [VoteController::class, 'show']);
Route::put('votes/{id}', [VoteController::class, 'update']);
Route::delete('votes/{id}', [VoteController::class, 'destroy']);


// Route::post('/commentaires', [NotificationController::class, 'storeCommentaire']);
// Route::post('/votes', [NotificationController::class, 'storeVote']);