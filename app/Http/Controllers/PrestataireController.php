<?php

namespace App\Http\Controllers;

use App\Models\Prestataire;
use Illuminate\Http\Request;

class PrestataireController extends Controller
{
    
    public function index()
    {
        $prestataires = Prestataire::all();
        return response()->json($prestataires);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ninea' => 'required',
            'user_id' => 'required',
            'categorie_prestataire_id' => 'required|min:6',
            'logo' => 'required',
        ]);

        $prestataire = prestataire::create([
            'user_id' => $request->user_id,
            'categorie_prestataire_id' => $request->categorie_prestataire_id,
            'ninea' => $request->ninea,
            'logo' => $request->logo,
        ]);

        return response()->json($prestataire, 201);
    }
    // Méthode pour récupérer un prestataire et ses commentaires
    public function show($id)
    {
        // Récupérer le prestataire par ID avec ses commentaires
        $prestataire = Prestataire::with(['commentaires','user'])->find($id);

        if (!$prestataire) {
            return response()->json([
                'status' => false,
                'message' => 'Prestataire non trouvé'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Détails du prestataire et ses commentaires',
            'data' => $prestataire
        ]);
    }
}
