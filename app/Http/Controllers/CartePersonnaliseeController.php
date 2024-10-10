<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarteInvitation;
use App\Models\CartePersonnalisee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCartePersonnaliseeRequest;
use App\Http\Requests\UpdateCartePersonnaliseeRequest;

class CartePersonnaliseeController extends Controller
{
    // Méthode pour récupérer toutes les cartes personnalisées
   // Méthode pour afficher uniquement les cartes personnalisées du client connecté
   public function index()
   {
       // Récupérer l'ID de l'utilisateur (client) connecté
       $clientId = Auth::id();

       // Récupérer toutes les cartes personnalisées du client connecté
       $cartes = CartePersonnalisee::where('client_id', $clientId)->get();

       // Retourner la liste des cartes en format JSON
       return response()->json($cartes, 200);
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

    public function createFromInvitation(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            // Validation des champs personnalisés si nécessaire
            'carte_invitation_id' => 'required|exists:carte_invitations,id',
            'nom' => 'required|string|max:25',
            'contenu' => 'required|string|max:30',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
        ]);
    
        // Vérifiez si la carte d'invitation existe
        $carteInvitation = CarteInvitation::find($id);
        if (!$carteInvitation) {
            return response()->json([
                'status' => false,
                'message' => 'Carte d\'invitation non trouvée'
            ], 404);
        }

    // Récupérez l'ID du client connecté
    $clientId = Auth::id();

    // Créez un tableau pour stocker les données de la carte personnalisée
    $data = [
        'carte_invitation_id' => $id,
        'nom' => $request->nom,
        'contenu' => $request->contenu,
        'image' => $request->image, // Utilisation de la valeur du champ image pour stocker l'image si nécessaire,
        'user_id' => Auth::id(), // Utilisation de l'ID de l'utilisateur connecté
        'client_id' => $clientId, // Utilisation de l'ID du client connecté
        // Ajoutez d'autres champs personnalisés si nécessaire
    ];

    // Gestion de l'image
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('cartes_personnalisees', 'public'); // Stockage dans le répertoire 'cartes_personnalisees'
        $data['image'] = $imagePath; // Stocker le chemin dans la base de données
    }

    // Créez la carte personnalisée
    $cartePersonnalisee = CartePersonnalisee::create($data);

    return response()->json([
        'status' => true,
        'message' => 'Carte personnalisée créée avec succès',
        'data' => $cartePersonnalisee
    ], 201);
    
    }

    // Méthode pour mettre à jour une carte personnalisée existante
    public function updateFromInvitation(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'carte_invitation_id' => ['required','exists:carte_invitations,id'],
            'nom' => ['required','string','max:25'],
            'contenu' => ['required','string','max:30'],
            // 'image' => ['nullable','image','mimes:jpeg,png,jpg,gif','max:2048'], // Validation de l'image
        ]);
    
        // Trouver la carte personnalisée à mettre à jour
        $cartePersonnalisee = CartePersonnalisee::find($id);
        if (!$cartePersonnalisee) {
            return response()->json([
                'status' => false,
                'message' => 'Carte personnalisée non trouvée'
            ], 404);
        }
    
        // Récupérez l'ID du client connecté
        $clientId = Auth::id();
    
        // Mettre à jour les données
        $data = [
            'carte_invitation_id' => $request->carte_invitation_id,
            'nom' => $request->nom,
            'contenu' => $request->contenu,
            'client_id' => $clientId, // Utilisation de l'ID du client connecté
        ];
    
        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimez l'ancienne image si elle existe
            if ($cartePersonnalisee->image) {
                Storage::disk('public')->delete($cartePersonnalisee->image);
            }
    
            // Stockage de la nouvelle image
            $imagePath = $request->file('image')->store('cartes_personnalisees', 'public');
            $data['image'] = $imagePath; // Stocker le chemin de la nouvelle image dans la base de données
        }
    
        // Mettre à jour la carte personnalisée
        $cartePersonnalisee->update($data);
    
        return response()->json([
            'status' => true,
            'message' => 'Carte personnalisée mise à jour avec succès',
            'data' => $cartePersonnalisee
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
