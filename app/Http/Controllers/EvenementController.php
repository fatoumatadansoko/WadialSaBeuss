<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvenementController extends Controller
{
    // Récupérer tous les événements
    public function index()
    {
        // Récupérer l'ID de l'utilisateur connecté
        $userId = Auth::id();

        // Récupérer les événements où le user_id est égal à l'utilisateur connecté
        $evenements = Evenement::where('user_id', $userId)->get();

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
        $userId = Auth::id(); // Cela vous donnera l'ID de l'utilisateur authentifié

        $evenement = Evenement::create(array_merge($request->all(), ['user_id' => $userId]));

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
public function getUserEvents($userId)
{
    $evenements = Evenement::where('user_id', $userId)->get();

    return response()->json([
        'status' => true,
        'message' => 'Événements récupérés avec succès',
        'data' => $evenements
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
