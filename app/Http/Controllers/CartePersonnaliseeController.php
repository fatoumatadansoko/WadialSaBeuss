<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartePersonnaliseeRequest;
use App\Http\Requests\UpdateCartePersonnaliseeRequest;
use App\Models\CartePersonnalisee;
use Illuminate\Http\Request;

class CartePersonnaliseeController extends Controller
{
    // Méthode pour récupérer toutes les cartes personnalisées
    public function index()
    {
        $cartes = CartePersonnalisee::all();
        return response()->json([
            'status' => true,
            'message' => 'Cartes personnalisées récupérées avec succès',
            'data' => $cartes
        ], 200);
    }

    // Méthode pour récupérer une carte personnalisée spécifique
    public function show($id)
    {
        $carte = CartePersonnalisee::find($id);
        if (!$carte) {
            return response()->json([
                'status' => false,
                'message' => 'Carte personnalisée non trouvée'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Carte personnalisée récupérée avec succès',
            'data' => $carte
        ], 200);
    }

    // Méthode pour créer une nouvelle carte personnalisée
    public function store(StoreCartePersonnaliseeRequest $request)
    {
        $validated = $request->validated();

        $carte = CartePersonnalisee::create([
            'carte_invitation_id' => $validated['carte_invitation_id'],
            'client_id' => $validated['client_id'],
            // Ajoute d'autres champs personnalisés si nécessaire
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Carte personnalisée créée avec succès',
            'data' => $carte
        ], 201);
    }

    // Méthode pour mettre à jour une carte personnalisée existante
    public function update(UpdateCartePersonnaliseeRequest $request, $id)
    {
        $carte = CartePersonnalisee::find($id);
        if (!$carte) {
            return response()->json([
                'status' => false,
                'message' => 'Carte personnalisée non trouvée'
            ], 404);
        }

        $validated = $request->validated();
        $carte->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Carte personnalisée mise à jour avec succès',
            'data' => $carte
        ], 200);
    }

    // Méthode pour supprimer une carte personnalisée
    public function destroy($id)
    {
        $carte = CartePersonnalisee::find($id);
        if (!$carte) {
            return response()->json([
                'status' => false,
                'message' => 'Carte personnalisée non trouvée'
            ], 404);
        }

        $carte->delete();

        return response()->json([
            'status' => true,
            'message' => 'Carte personnalisée supprimée avec succès'
        ], 200);
    }
}
