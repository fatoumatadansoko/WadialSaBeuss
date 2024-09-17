<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    public function index()
    {
        $commentaires = Commentaire::all();
        return response()->json([
            'status' => true,
            'message' => 'Commentaires récupérés avec succès',
            'data' => $commentaires
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'prestataire_id' => 'required|exists:prestataires,id',
        ]);

        $commentaire = Commentaire::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Commentaire créé avec succès',
            'data' => $commentaire
        ], 201);
    }

    public function show($id)
    {
        $commentaire = Commentaire::find($id);

        if (!$commentaire) {
            return response()->json([
                'status' => false,
                'message' => 'Commentaire non trouvé',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Commentaire récupéré avec succès',
            'data' => $commentaire
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $commentaire = Commentaire::find($id);

        if (!$commentaire) {
            return response()->json([
                'status' => false,
                'message' => 'Commentaire non trouvé',
            ], 404);
        }

        $request->validate([
            'contenu' => 'string',
            'client_id' => 'exists:clients,id',
            'prestataire_id' => 'exists:prestataires,id',
        ]);

        $commentaire->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Commentaire mis à jour avec succès',
            'data' => $commentaire
        ], 200);
    }

    public function destroy($id)
    {
        $commentaire = Commentaire::find($id);

        if (!$commentaire) {
            return response()->json([
                'status' => false,
                'message' => 'Commentaire non trouvé',
            ], 404);
        }

        $commentaire->delete();

        return response()->json([
            'status' => true,
            'message' => 'Commentaire supprimé avec succès',
        ], 200);
    }
}
