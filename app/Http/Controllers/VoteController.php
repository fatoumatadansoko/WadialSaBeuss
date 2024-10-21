<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    // Récupérer tous les votes
    public function index()
    {
        $votes = Vote::all();
        return response()->json([
            'status' => true,
            'message' => 'Votes récupérés avec succès',
            'data' => $votes
        ], 200);
    }

    // Créer un vote
    public function store(Request $request)
{
    $request->validate([
        'note' => 'required|integer|min:1|max:5',
        'client_id' => 'required|exists:clients,id',
        'prestataire_id' => 'required|exists:prestataires,id',
    ]);

    // dd($request->all()); // Affiche les données de la requête

    $vote = Vote::create($request->all());

    return response()->json([
        'status' => true,
        'message' => 'Vote créé avec succès',
        'data' => $vote
    ], 201);
}


    // Récupérer un vote spécifique
    public function show($id)
    {
        $vote = Vote::find($id);

        if (!$vote) {
            return response()->json([
                'status' => false,
                'message' => 'Vote non trouvé',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Vote récupéré avec succès',
            'data' => $vote
        ], 200);
    }

    // Mettre à jour un vote
    public function update(Request $request, $id)
    {
        $vote = Vote::find($id);
    
        if (!$vote) {
            return response()->json([
                'status' => false,
                'message' => 'Vote non trouvé',
            ], 404);
        }
    
        $request->validate([
            'note' => 'nullable|integer|min:1|max:5',
            'client_id' => 'nullable|exists:clients,id',
            'prestataire_id' => 'nullable|exists:prestataires,id',
        ]);
    
        $vote->update($request->only(['note', 'client_id', 'prestataire_id']));
    
        return response()->json([
            'status' => true,
            'message' => 'Vote mis à jour avec succès',
            'data' => $vote
        ], 200);
    }
    

    // Supprimer un vote
    public function destroy($id)
    {
        $vote = Vote::find($id);

        if (!$vote) {
            return response()->json([
                'status' => false,
                'message' => 'Vote non trouvé',
            ], 404);
        }

        $vote->delete();

        return response()->json([
            'status' => true,
            'message' => 'Vote supprimé avec succès',
        ], 200);
    }
}
