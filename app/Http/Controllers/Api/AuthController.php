<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    // Register API - POST (name, email, password)
    public function register(Request $request)
    {
        // Valider la requête
        $validator = Validator::make($request->all(), [
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'telephone' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:active,inactive'],
            'description' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:client,prestataire'],
        ]);

        // Vérifier si la validation échoue
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors() // Retourner les erreurs
            ], 422);
        }

        // Créer un nouvel utilisateur après validation
        $user = User::create([
            "nom" => $request->nom,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "telephone" => $request->telephone,
            "adresse" => $request->adresse,
            "status" => $request->status,
            "description" => $request->description,
        ]);

        // Assigner un rôle en fonction du champ 'role'
        if ($request->role === 'prestataire') {
            $user->assignRole('prestataire');
        } else {
            $user->assignRole('client');
        }

        return response()->json([
            "status" => true,
            "message" => "User registered successfully as " . $request->role,
        ], 201);
    }

    
    // Login API - POST (email, password)
    public function login(Request $request){

        // Validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $token = auth()->attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        if(!$token){

            return response()->json([
                "status" => false,
                "message" => "Invalid login details"
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "User logged in succcessfully",
            "token" => $token,
            //"expires_in" => auth()->factory()->getTTL() * 60
        ]);

    }

    // Profile API - GET (JWT Auth Token)
    public function profile(){

        //$userData = auth()->user();
        $userData = request()->user();

        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userData,
            //"user_id" => request()->user()->id,
            //"email" => request()->user()->email
        ]);
    }

    // Refresh Token API - GET (JWT Auth Token)
    public function refreshToken(){

        $token = auth()->refresh();

        return response()->json([
            "status" => true,
            "message" => "New access token",
            "token" => $token,
            //"expires_in" => auth()->factory()->getTTL() * 60
        ]);
    }

    // Logout API - GET (JWT Auth Token)
    public function logout(){
        
        auth()->logout();

        return response()->json([
            "status" => true,
            "message" => "User logged out successfully"
        ]);
    }
}
