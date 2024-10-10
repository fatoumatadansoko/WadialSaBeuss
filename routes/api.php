<?php

use App\Http\Controllers\PrestataireController;
use Illuminate\Support\Facades\Mail;
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
use App\Http\Controllers\CartePersonnaliseeController;
use App\Http\Controllers\CategoriePrestataireController;

// Routes publiques
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Routes sécurisées par l'authentification
Route::group(['middleware' => ['auth:api']], function () {

    // Déconnexion et rafraîchissement du token
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);



    // Utilisateurs
   
    Route::get('/profile', [AuthController  ::class, 'profile']);

    // CATEGORIES DES EVENEMENTS
    Route::get('categories', [CategorieController::class, 'index']);
    Route::post('categories', [CategorieController::class, 'store']);
    Route::get('categories/{id}', [CategorieController::class, 'show']);
    Route::put('categories/{id}', [CategorieController::class, 'update']);
    Route::delete('categories/{id}', [CategorieController::class, 'destroy']);

    // CATEGORIES DES PRESTATAIRES
    Route::post('categoriesprestataires', [CategoriePrestataireController::class, 'store']);
    Route::get('categoriesprestataires/{id}', [CategoriePrestataireController::class, 'show']);
    Route::put('categoriesprestataires/{id}', [CategoriePrestataireController::class, 'update']);
    Route::delete('categoriesprestataires/{id}', [CategoriePrestataireController::class, 'destroy']);

    // EVENEMENTS
    Route::get('evenements/utilisateur/{id}', [EvenementController::class, 'getUserEvents']);
    Route::get('evenements', [EvenementController::class, 'index']);
    Route::post('evenements', [EvenementController::class, 'store']);
    Route::get('evenements/{id}', [EvenementController::class, 'show']);
    Route::put('evenements/{id}', [EvenementController::class, 'update']);
    Route::delete('evenements/{id}', [EvenementController::class, 'destroy']);

    // Cartes d'invitation
  
    Route::get('cartes/{id}', [CarteInvitationController::class, 'show']);
    Route::post('cartes/{id}', [CarteInvitationController::class, 'update']);
    Route::delete('cartes/{id}', [CarteInvitationController::class, 'destroy']);

    // Commentaires
   
    Route::put('commentaires/{id}', [CommentaireController::class, 'update']);
    Route::delete('commentaires/{id}', [CommentaireController::class, 'destroy']);

    // Votes
    Route::get('votes', [VoteController::class, 'index']);
    Route::post('votes', [VoteController::class, 'store']);
    Route::get('votes/{id}', [VoteController::class, 'show']);
    Route::put('votes/{id}', [VoteController::class, 'update']);
    Route::delete('votes/{id}', [VoteController::class, 'destroy']);

    // Cartes personnalisées
    Route::post('/cartes-personnalisees/invitation/{id}/create', [CartePersonnaliseeController::class, 'createFromInvitation']);
    Route::post('/cartes-personnalisees/invitation/{id}/update', [CartePersonnaliseeController::class, 'updateFromInvitation']);
    Route::get('/cartes-personnalisees', [CartePersonnaliseeController::class,'index']);
    Route::delete('/cartes-personnalisees/{id}', [CartePersonnaliseeController::class, 'destroy']);

    Route::get('/cartes-personnalisees', [CartePersonnaliseeController::class, 'index']);
    Route::post('/cartes-personnalisees', [CartePersonnaliseeController::class, 'store']);
    Route::get('/cartes-personnalisees/{id}', [CartePersonnaliseeController::class, 'show']);
    Route::put('/cartes-personnalisees/{id}', [CartePersonnaliseeController::class, 'update']);
    Route::delete('/cartes-personnalisees/{id}', [CartePersonnaliseeController::class, 'destroy']);
    });
    Route::get('commentaires/{id}', [CommentaireController::class, 'show']);

    Route::get('commentaires', [CommentaireController::class, 'index']);
    Route::post('commentaires', [CommentaireController::class, 'store']);
    Route::get('categoriesprestataires', [CategoriePrestataireController::class, 'index']);
    Route::get('commentaires/prestataire/{id}', [CommentaireController::class, 'getCommentairesByPrestataire']);
    Route::apiResource('prestataires', PrestataireController::class);
    Route::get('/prestataires/category/{id}', [PrestataireController::class, 'getPrestatairesByCategory']);
    Route::get('cartes', [CarteInvitationController::class, 'index']);
    Route::post('cartes', [CarteInvitationController::class, 'store']);
    Route::get('users/{id}', [UserController::class,'show']);
    Route::apiResource('users', UserController::class);
