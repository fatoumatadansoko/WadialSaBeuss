<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Prestataire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            'logo' => ['required', 'file', 'mimes:jpeg,png,jpg', 'max:4048'],
            'role' => ['nullable', 'string'],
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
                    'categorie_prestataire_id' => json_encode($request->categorie_prestataire_id),
                    // 'categorie_prestataire_id' => $request->categorie_prestataire_id,
                    'ninea' => $request->ninea,
                    'description'=>$request->description,
                ]);
                $user->assignrole('prestataire');
                // Le logo est déjà traité dans l'utilisateur, donc inutile de le traiter de nouveau ici
                $prestataire->save();
            } else {
                Client::create([
                    'user_id' => $user->id,
                    // Ajoute ici d'autres champs si nécessaire
                ]);
                $user->assignrole('client');

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
        $token = Auth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);
    
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();
    
        // Vérification de la validité du token
        if (!$token) {
            return response()->json([
                "status" => false,
                "message" => "Email ou mot de passe incorrect"
            ], 401);
        }
        if($user->HasRole('client')){
            $client = Client::where('user_id', $user->id)->first();
            return response()->json([
                "status" => true,
                "message" => "Connexion réussie",
                "token" => $token,
                "user" => $user,
                "client" => $client, // Ajoutez cette ligne pour renvoyer les rôles de l'utilisateur
            ]);
        }
        if($user->HasRole('prestataire')){
            $prestataire = Prestataire::where('user_id', $user->id)->first();
            return response()->json([
                "status" => true,
                "message" => "Connexion réussie",
                "token" => $token,
                "user" => $user,
                "prestataire" => $prestataire, // Ajoutez cette ligne pour renvoyer les rôles de l'utilisateur
            ]);
        }
        // Renvoyer les rôles en plus de l'utilisateur et du token
        if($user->HasRole('admin')){
            $admin = Admin::where('user_id', $user->id)->first();
            return response()->json([
                "status" => true,
                "message" => "Connexion réussie",
                "token" => $token,
                "user" => $user,
                "admin" => $admin, // Ajoutez cette ligne pour renvoyer les rôles de l'utilisateur
            ]);
        }
        // 
    }
    

    // Profile API - GET (JWT Auth Token)
    public function profile()
    {
        // Récupération des informations de l'utilisateur connecté
        $userData = Auth::user();
        $roles=$userData->getRoleNames();
        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userData,
            "roles"=>$roles
            

        ]);
    }

    // Refresh Token API - GET (JWT Auth Token)
    public function refreshToken()
    {
        $token = Auth::refresh();

        return response()->json([
            "status" => true,
            "message" => "New access token",
            "token" => $token,
            //"expires_in" => auth()->factory()->getTTL() * 60
        ]);
    }
  
    public function updateProfile(Request $request)
    {
        try {
            // Récupérer l'utilisateur connecté
            $user = Auth::user();
            
            // Règles de validation de base
            $validationRules = [];
            
            // Ajouter des règles uniquement pour les champs présents dans la requête
            if ($request->has('nom')) {
                $validationRules['nom'] = 'required|string|max:25';
            }
            if ($request->has('email')) {
                $validationRules['email'] = 'required|email|unique:users,email,' . $user->id;
            }
            if ($request->has('telephone')) {
                $validationRules['telephone'] = 'required|string|max:15';
            }
            if ($request->has('adresse')) {
                $validationRules['adresse'] = 'required|string|max:225';
            }
            if ($request->hasFile('logo')) {
                $validationRules['logo'] = 'image|mimes:jpeg,png,jpg|max:4048';
            }
            
            // Valider uniquement les champs fournis
            $validator = Validator::make($request->all(), $validationRules);
            
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'error' => $validator->errors()->first()
                ], 422);
            }
    
            // Mettre à jour uniquement les champs fournis
            if ($request->has('nom')) {
                $user->nom = $request->nom;
            }
            if ($request->has('email')) {
                $user->email = $request->email;
            }
            if ($request->has('telephone')) {
                $user->telephone = $request->telephone;
            }
            if ($request->has('adresse')) {
                $user->adresse = $request->adresse;
            }
    
            // Gérer le logo si fourni
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $user->logo = $logo->store('users', 'public');
            }
    
            // Si un nouveau mot de passe est fourni
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
    
            $user->save();
    
            // Gérer les informations spécifiques au prestataire
            if ($user->hasRole('prestataire')) {
                $prestataire = Prestataire::where('user_id', $user->id)->first();
                if ($prestataire && $request->filled('description')) {
                    $prestataire->description = $request->description;
                    $prestataire->save();
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Profil mis à jour avec succès',
                    'data' => [
                        'user' => $user,
                        'prestataire' => $prestataire
                    ]
                ]);
            }
    
            // Gérer les informations spécifiques au client
            if ($user->hasRole('client')) {
                $client = Client::where('user_id', $user->id)->first();
                return response()->json([
                    'status' => true,
                    'message' => 'Profil mis à jour avec succès',
                    'data' => [
                        'user' => $user,
                        'client' => $client
                    ]
                ]);
            }
    
            return response()->json([
                'status' => true,
                'message' => 'Profil mis à jour avec succès',
                'data' => [
                    'user' => $user
                ]
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la mise à jour du profil',
                'error' => $e->getMessage()
            ], 500);
        }}
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
