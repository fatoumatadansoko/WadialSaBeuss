<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Commentaire;
use App\Models\Prestataire;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Notifications\CommentNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

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
            // Valider les données du formulaire
            $request->validate([
                'contenu' => 'required|string',
                'prestataire_id' => 'required|exists:prestataires,id',
            ]);
    
            // Ajouter l'ID du client manuellement (l'utilisateur connecté)
            $data = $request->all();
            $data['user_id'] = Auth::id();
    
            // Créer le commentaire
            $commentaire = Commentaire::create($data);
    
            // Récupérer le prestataire et envoyer la notification
            $prestataire = Prestataire::find($request->prestataire_id);
            Notification::send($prestataire, new CommentNotification($commentaire));
    
            return response()->json([
                'status' => true,
                'message' => 'Commentaire créé avec succès et notification envoyée',
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
    public function getCommentairesByPrestataire($id)
{
    // Récupérer les commentaires pour le prestataire avec l'ID donné
    try {
        $commentaires = Commentaire::where('prestataire_id', $id)->get();
        return response()->json($commentaires);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Une erreur est survenue lors de la récupération des commentaires.'], 500);
    }
}
}
