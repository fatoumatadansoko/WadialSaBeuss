<?php

namespace App\Http\Controllers;

use App\Models\CarteInvitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                'categorie_id' => 'required|exists:categories,id',
                'nom' => 'required|string|max:255',
                'contenu' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
            ]);

            // Ajouter l'ID du client manuellement (l'utilisateur connecté)
            $data = $request->all();
            $data['user_id'] = Auth::id();

            // Gestion de l'image
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('cartes_invitations', 'public'); // Stockage dans le répertoire 'cartes_invitations'
                $data['image'] = $imagePath; // Stocker le chemin dans la base de données
            }

            // Créer la carte d'invitation
            $carteinvitation = CarteInvitation::create($data);

            // Retourner une réponse JSON avec la carte créée
            return response()->json([
                'status' => true,
                'message' => 'Carte d\'invitation créée avec succès',
                'carte' => $carteinvitation
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
            // 'categorie_id' => 'exists:categories,id',
            'nom' => 'string|max:255',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
            'contenu' => 'string',
        ]);

        // Mise à jour des données de la carte
        $data = $request->all();

        // Gestion de l'image lors de la mise à jour
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cartes_invitations', 'public');
            $data['image'] = $imagePath;
        }

        $carte->update($data);

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
