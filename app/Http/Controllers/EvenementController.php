<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    // Récupérer tous les événements
    public function index()
    {
        $evenements = Evenement::all();
        return response()->json([
            'status' => true,
            'message' => 'Événements récupérés avec succès',
            'data' => $evenements
        ], 200);
    }

    // Créer un événement
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'event_date' => 'required|date',
            'lieu' => 'required|string|max:255',
            'type' => 'required|in:mariage,anniversaire,autre',
            'budget' => 'required|in:moins de 500000,500000 à 1000000,plus de 1000000',
        ]);

        $evenement = Evenement::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Événement créé avec succès',
            'data' => $evenement
        ], 201);
    }

    // Récupérer un événement spécifique
    public function show($id)
    {
        $evenement = Evenement::find($id);

        if (!$evenement) {
            return response()->json([
                'status' => false,
                'message' => 'Événement non trouvé',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Événement récupéré avec succès',
            'data' => $evenement
        ], 200);
    }

    // Mettre à jour un événement
    public function update(Request $request, $id)
    {
        $evenement = Evenement::find($id);

        if (!$evenement) {
            return response()->json([
                'status' => false,
                'message' => 'Événement non trouvé',
            ], 404);
        }

        $request->validate([
            'titre' => 'string|max:255',
            'event_date' => 'date',
            'lieu' => 'string|max:255',
            'type' => 'in:mariage,anniversaire,autre',
            'budget' => 'in:moins de 500000,500000 à 1000000,plus de 1000000',
        ]);

        $evenement->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Événement mis à jour avec succès',
            'data' => $evenement
        ], 200);
    }

    // Supprimer un événement
    public function destroy($id)
    {
        $evenement = Evenement::find($id);

        if (!$evenement) {
            return response()->json([
                'status' => false,
                'message' => 'Événement non trouvé',
            ], 404);
        }

        $evenement->delete();

        return response()->json([
            'status' => true,
            'message' => 'Événement supprimé avec succès',
        ], 200);
    }
}
