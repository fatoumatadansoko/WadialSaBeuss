<?php

namespace App\Http\Controllers;

use App\Models\CarteInvitation;
use Illuminate\Http\Request;

class CarteInvitationController extends Controller
{
    public function index()
    {
        $cartes = CarteInvitation::all();
        return response()->json([
            'status' => true,
            'message' => 'Cartes récupérées avec succès',
            'data' => $cartes
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            // Validation des données
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'categorie_id' => 'required|exists:categories,id',
                'nom' => 'required|string|max:255',
                'image' => 'required|string|max:255',
                'contenu' => 'required|string',
            ]);
    
            // Création de la carte d'invitation
            $carte = CarteInvitation::create([
                'user_id' => $request->user_id,
                'categorie_id' => $request->categorie_id,
                'nom' => $request->nom,
                'image' => $request->image,
                'contenu' => $request->contenu,
            ]);
    
            // Retourner une réponse JSON avec la carte créée
            return response()->json([
                'message' => 'Carte d\'invitation créée avec succès',
                'carte' => $carte
            ], 201);
    
        } catch (\Exception $e) {
            // Retourner une erreur en cas d'exception
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la création de la carte',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    

    public function show($id)
    {
        $carte = CarteInvitation::find($id);

        if (!$carte) {
            return response()->json([
                'status' => false,
                'message' => 'Carte non trouvée',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Carte récupérée avec succès',
            'data' => $carte
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $carte = CarteInvitation::find($id);

        if (!$carte) {
            return response()->json([
                'status' => false,
                'message' => 'Carte non trouvée',
            ], 404);
        }

        $request->validate([
            'user_id' => 'exists:users,id',
            'categorie_id' => 'exists:categories,id',
            'nom' => 'string|max:255',
            'image' => 'string',
            'contenu' => 'string',
        ]);

        $carte->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Carte mise à jour avec succès',
            'data' => $carte
        ], 200);
    }

    public function destroy($id)
    {
        $carte = CarteInvitation::find($id);

        if (!$carte) {
            return response()->json([
                'status' => false,
                'message' => 'Carte non trouvée',
            ], 404);
        }

        $carte->delete();

        return response()->json([
            'status' => true,
            'message' => 'Carte supprimée avec succès',
        ], 200);
    }
}
