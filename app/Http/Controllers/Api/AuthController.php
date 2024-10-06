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
            'nom' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'telephone' => ['required', 'string', 'max:15'],
            'adresse' => ['required', 'string', 'max:225'],
            'description' => ['required', 'string', 'max:255'],
            'logo' => ['required', 'file', 'mimes:jpeg,png,jpg', 'max:3048'],
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
    
        try {
            // Préparer les données de l'utilisateur
            $userData = [
                "nom" => $request->nom,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "telephone" => $request->telephone,
                "adresse" => $request->adresse,
                "description" => $request->description,
                "role" => $request->role,
            ];
    
            // Vérifier si un logo a été uploadé
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $userData['logo'] = $logo->store('users', 'public');  // Enregistre le logo dans 'storage/app/public/users'
            }
    
            // Créer un nouvel utilisateur
            $user = User::create($userData);
    
            // Associer l'utilisateur au rôle
            if ($request->role === 'prestataire') {
                $prestataire = new Prestataire();
                $prestataire->fill([
                    'user_id' => $user->id,
                    'categorie_prestataire_id' => $request->categorie_prestataire_id,
                    'ninea' => $request->ninea,
                ]);
    
                // Le logo est déjà traité dans l'utilisateur, donc inutile de le traiter de nouveau ici
                $prestataire->save();
            } else {
                Client::create([
                    'user_id' => $user->id,
                    // Ajoute ici d'autres champs si nécessaire
                ]);
            }
    
            return response()->json([
                'status' => true,
                'message' => 'Inscription réussi',
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de l\'inscription: ' . $e->getMessage()
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
