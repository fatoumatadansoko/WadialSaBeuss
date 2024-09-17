<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Exception;

class CommentaireController extends Controller
{
    public function index()
    {
        try {
            $commentaires = Commentaire::all();
            return response()->json([
                'status' => true,
                'message' => 'Commentaires récupérés avec succès',
                'data' => $commentaires
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la récupération des commentaires',
                'error' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur interne du serveur',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
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
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation échouée',
                'errors' => $e->errors()
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la création du commentaire',
                'error' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur interne du serveur',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
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
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur interne du serveur',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
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
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation échouée',
                'errors' => $e->errors()
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la mise à jour du commentaire',
                'error' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur interne du serveur',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
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
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la suppression du commentaire',
                'error' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur interne du serveur',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
