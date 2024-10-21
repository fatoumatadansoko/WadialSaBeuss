<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Models\Invite;
use Illuminate\Http\Request;
use App\Models\CarteInvitation;
use App\Models\CartePersonnalisee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\CartePersonnaliseeEnvoyee;
use App\Http\Requests\StoreCartePersonnaliseeRequest;
use App\Http\Requests\UpdateCartePersonnaliseeRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;

class CartePersonnaliseeController extends Controller
{
    // Méthode pour récupérer toutes les cartes personnalisées
   // Méthode pour afficher uniquement les cartes personnalisées du client connecté
   public function index()
   {
       // Récupérer l'ID de l'utilisateur (client) connecté
       $user = Auth::user();
       $client = Client::where('user_id', $user->id)->first();

       // Récupérer toutes les cartes personnalisées du client connecté
       $cartes = CartePersonnalisee::where('client_id', $client->id)->get();

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
    // Vérification de l'authentification
    if (!Auth::check()) {
        return response()->json([
            'status' => false,
            'message' => 'Non authentifié. Veuillez vous connecter.'
        ], 401);
    }

    // Vérifiez si l'utilisateur a le rôle 'client'
    $user = Auth::user();
    if (!$user->hasRole('client')) {
        return response()->json([
            'status' => false,
            'message' => 'Accès refusé. Vous devez être un client pour personnaliser cette carte.'
        ], 403);
    }

    // Valider les données
    $request->validate([
        'nom' => 'required|string|max:255',
        'contenu' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Vérifier l'existence de la carte d'invitation
    $carteInvitation = CarteInvitation::find($id);
    if (!$carteInvitation) {
        return response()->json([
            'status' => false,
            'message' => 'Carte d\'invitation non trouvée'
        ], 404);
    }

    // Conservez ou remplacez l'image
    $imagePath = $carteInvitation->image;
    if ($request->hasFile('image')) {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath); // Supprimer l'ancienne image
        }
        $imagePath = $request->file('image')->store('cartes_personnalisees', 'public');
    }

    // Récupérer le client_id de l'utilisateur connecté
    $client = Client::where('user_id', $user->id)->first();
    if (!$client) {
        return response()->json([
            'status' => false,
            'message' => 'Client non trouvé pour cet utilisateur.'
        ], 404);
    }

    // Créez la carte personnalisée
    $cartePersonnalisee = CartePersonnalisee::create([
        'carte_invitation_id' => $id,
        'nom' => $request->nom,
        'contenu' => $request->contenu,
        'image' => $imagePath,
        'client_id' => $client->id, // ID du client
    ]);

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
    
    // Dans le contrôleur
    public function envoyerCarte(Request $request, $id)
    {
        $user = Auth::user();
        if ($user) {
            $userName = $user->nom; // Utiliser $user->name uniquement si $user n'est pas nul
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Utilisateur non authentifié.'
            ], 401);
        }
        
        // Valider les données
        $request->validate([
            'invites' => 'required|array',
            'invites.*.nom' => 'required|string',
            'invites.*.email' => 'required|email'
        ]);
    
        // Récupérer la carte personnalisée sélectionnée
        $cartePersonnalisee = CartePersonnalisee::find($id);
        if (!$cartePersonnalisee) {
            return response()->json([
                'status' => false,
                'message' => 'Carte personnalisée non trouvée'
            ], 404);
        }
    
        // Préparer les données à envoyer dans l'e-mail
        $data = [
            'carte' => $cartePersonnalisee,
            'image' => $cartePersonnalisee->image, // Ajoutez l'image ici
            'contenu' => $cartePersonnalisee->contenu, // Ajoutez le contenu ici
        ];
    
        // Parcourir les emails et envoyer la carte à chaque invité
        foreach ($request->invites as $invite) {
            $nom = $invite['nom'];
            $email = $invite['email'];
    
            try {
                Mail::send('emails.carte_personnalisee', array_merge($data, ['nom' => $nom]), function ($message) use ($email, $cartePersonnalisee, $nom) {
                    $message->to($email)
                            ->subject('Vous avez reçu une carte personnalisée de ' . Auth::user()->nom);
    
                    // Ajouter l'image de la carte en pièce jointe si elle existe
                    if ($cartePersonnalisee->image) {
                        $imagePath = storage_path('app/public/' . $cartePersonnalisee->image);
                        $message->attach($imagePath, [
                            'as' => 'carte_personnalisee.jpg', 
                            'mime' => 'image/jpeg'
                        ]);
                    }
                });
    
                // Enregistrer l'invité dans la base de données
                Invite::create([
                    'carte_personnalisee_id' => $cartePersonnalisee->id,
                    'user_id' => Auth::id(), // Optionnel, si vous voulez lier l'invité à un utilisateur
                    'email' => $email,
                    'nom' => $nom, // N'oubliez pas d'ajouter le nom
                ]);
                
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur lors de l\'envoi de l\'email à ' . $email . ': ' . $e->getMessage()
                ], 500);
            }
        }
     
        return response()->json([
            'status' => true,
            'message' => 'Carte personnalisée envoyée avec succès aux invités.'
        ], 200);
    }
    
    
public function afficherInvites($id)
{
    // Récupérer la carte personnalisée par son ID
    $carte = CartePersonnalisee::find($id);
    $user = Auth::user(); // Récupération de l'ID de l'utilisateur authentifié
    $client = Client::where('user_id', $user->id)->first();

  
    // Vérifier si la carte existe
    if (!$carte) {
        return response()->json(['message' => 'Carte non trouvée'], 404);
    } elseif ($carte->client_id !== $client->id) {
        return response()->json(['message' => 'Carte non autorisée'], 403);
    }

    // Récupérer les invités associés à la carte
    $invites = $carte->invites;

    // Extraire les e-mails des invités
    $emails = $invites->pluck('email'); // Utiliser pluck pour obtenir uniquement les e-mails

    return response()->json($emails, 200); // Retourner uniquement les e-mails
}



public function getCartesPersonnaliseesByClientId($id)
{
    // Récupérer l'utilisateur authentifié
    $user = Auth::user();

    // Vérifier si l'utilisateur est authentifié
    if (!$user) {
        return response()->json(['status' => false, 'message' => 'Utilisateur non authentifié'], 401);
    }

    // Récupérer les cartes personnalisées liées à cet utilisateur par client_id
    $cartes = CartePersonnalisee::where('client_id', $id)->get();

    // Vérifier si des cartes ont été trouvées
    if ($cartes->isEmpty()) {
        return response()->json([
            'status' => false,
            'message' => 'Aucune carte trouvée pour ce client.',
        ], 404);
    }

    // Retourner les cartes sous forme de JSON
    return response()->json([
        'status' => true,
        'message' => 'Cartes récupérées avec succès',
        'data' => $cartes,
    ], 200);
}


}
