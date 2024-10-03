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
                // Validation des données
                $request->validate([
                    'user_id' => 'required|exists:users,id',
                    'categorie_id' => 'required|exists:categories,id',
                    'nom' => 'required|string|max:255',
                    'contenu' => 'required|string',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
                ]);
            
                try {
                    // Création de la carte d'invitation
                    $carteinvitation = new CarteInvitation();
                    $carteinvitation->fill([
                        'user_id' => $request->user_id,
                        'categorie_id' => $request->categorie_id,
                        'nom' => $request->nom,
                        'contenu' => $request->contenu,
                    ]);
            
                    // Vérifier si une image a été téléchargée et la stocker
                    if ($request->hasFile('image')) {
                        $image = $request->file('image');
                        $carteinvitation->image = $image->store('cartes', 'public'); // Stocker l'image
                    }
            
                    // Enregistrer la carte d'invitation
                    $carteinvitation->save();
            
                    // Retourner une réponse JSON avec la carte créée
                    return response()->json([
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
