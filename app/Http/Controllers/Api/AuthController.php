<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Client;
use App\Models\Prestataire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register API - POST (name, email, password, role, etc.)
    public function register(Request $request)
    {
        // Valider la requête
        $validator = Validator::make($request->all(), [
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'telephone' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'role' => ['required', 'string', 'in:client,prestataire'],
        ]);

        // Vérifier si la validation échoue
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }
        // Créer un nouvel utilisateur
        try {
            // Créer un nouvel utilisateur
            $user = User::create([
                "nom" => $request->nom,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "telephone" => $request->telephone,
                "adresse" => $request->adresse,
                "description" => $request->description,
                "role" => $request->role,
            ]);
    
            // Créer une entrée dans la table prestataire ou client selon le rôle
            if ($request->role === 'prestataire') {
                $prestataire = new Prestataire();
                $prestataire->fill([
                    'user_id' => $user->id,
                    'categorie_prestataire_id' => $request->categorie_prestataire_id,
                    'logo' => $request->logo,
                    'ninea' => $request->ninea,
                ]); // Utilise les données validées
                if ($request->hasFile('logo')) {
                    $logo = $request->file('logo');
                    $prestataire->logo = $logo->store('prestataires', 'public');
                }
                // Enregistre la ressource dans la base de données
                $prestataire->save();
            } else {
                Client::create([
                    'user_id' => $user->id,
                    // Ajoute ici d'autres champs si nécessaire
                ]);
            }
        
            return response()->json([
                'status' => true,
                'message' => 'User registered successfully',
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error during registration: ' . $e->getMessage()
            ], 500);
        }
    }        

    // Login API - POST (email, password)
    public function login(Request $request)
    {
        // Validation des données de connexion
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        // Tentative de connexion
        $token = auth()->attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);
$user=auth()->user();
        // Vérification de la validité du token
        if (!$token) {
            return response()->json([
                "status" => false,
                "message" => "Email ou mot de pass incorrect"
            ], 401);
        }

        return response()->json([
            "status" => true,
            "message" => "connexion reussi",
            "token" => $token,
            "user" => $user,
            "expires_in" => auth()->factory()->getTTL() * 60
        ]);
    }

    // Profile API - GET (JWT Auth Token)
    public function profile()
    {
        // Récupération des informations de l'utilisateur connecté
        $userData = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userData
        ]);
    }

    // Refresh Token API - GET (JWT Auth Token)
    public function refreshToken()
    {
        $token = auth()->refresh();

        return response()->json([
            "status" => true,
            "message" => "New access token",
            "token" => $token,
            //"expires_in" => auth()->factory()->getTTL() * 60
        ]);
    }

    // Logout API - GET (JWT Auth Token)
    public function logout()
    {
        auth()->logout();

        return response()->json([
            "status" => true,
            "message" => "deconnexion réussi"
        ]);
    }
}
