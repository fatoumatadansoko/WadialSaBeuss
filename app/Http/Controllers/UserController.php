<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,client,prestataire',
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return response()->json($user, 201);
    }

   

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(null, 204);
    }
    public function userDetails()
    {
        // Vérifier si l'utilisateur est authentifié
        if (Auth::check()) {
            // Récupérer les détails de l'utilisateur connecté
            return response()->json(Auth::user(), 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
    public function getUser(Request $request) {
        $user = $request->user();
    
        // Vérification pour s'assurer que l'utilisateur est authentifié
        if (!$user) {
            return response()->json(['message' => 'Non authentifié'], 401);
        }
    
        // Charger le rôle de l'utilisateur
        $userRole = $user->role; // Assurez-vous que le champ 'role' est bien présent dans le modèle User
    
        return response()->json([
            'user' => $user,
            'role' => $userRole,
        ]);
    }
    
}
