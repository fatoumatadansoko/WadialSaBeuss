<?php

namespace App\Http\Controllers;

use App\Models\Prestataire;

class PrestatairesController extends Controller
{
    // Méthode pour récupérer un prestataire et ses commentaires
    public function show($id)
    {
        // Récupérer le prestataire par ID avec ses commentaires
        $prestataire = Prestataire::with('commentaires')->find($id);

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
