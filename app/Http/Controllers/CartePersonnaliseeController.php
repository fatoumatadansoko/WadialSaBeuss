<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Invite;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use App\Models\CarteInvitation;
use App\Models\CartePersonnalisee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Client;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Utilisateur non authentifié.'
            ], 401);
        }
    
        $userName = $user->nom;
    
        $request->validate([
            'invites' => 'required|array',
            'invites.*.nom' => 'required|string',
            'invites.*.email' => 'required|email'
        ]);
    
        $cartePersonnalisee = CartePersonnalisee::find($id);
        if (!$cartePersonnalisee) {
            return response()->json([
                'status' => false,
                'message' => 'Carte personnalisée non trouvée'
            ], 404);
        }
    
        $data = [
            'carte' => $cartePersonnalisee,
            'image' => $cartePersonnalisee->image,
            'contenu' => $cartePersonnalisee->contenu,
            
        ];
    
        foreach ($request->invites as $invite) {
            $nom = $invite['nom'];
            $email = $invite['email'];
            
    
            $invite = Invite::create([
                'carte_personnalisee_id' => $cartePersonnalisee->id,
                'user_id' => Auth::id(),
                'email' => $email,
                'nom' => $nom
            ]);
    
            $data['nom'] = $nom;
            $data['invite'] = $invite;
            
    
            try {
                Mail::send('emails.carte_personnalisee', $data, function ($message) use ($email, $cartePersonnalisee, $userName) {
                    $message->to($email)
                        ->subject("Vous avez reçu une carte personnalisée de " . $userName);
                });
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
        $user = Auth::user();
        $client = Client::where('user_id', $user->id)->first();
    
        // Vérifier si la carte existe
        if (!$carte) {
            return response()->json(['message' => 'Carte non trouvée'], 404);
        }
    
        // Vérifier si le client existe
        if (!$client) {
            return response()->json(['message' => 'Client non trouvé'], 404);
        }
    
        // Vérifier si la carte appartient au client
        if ($carte->client_id !== $client->id) {
            return response()->json(['message' => 'Carte non autorisée'], 403);
        }
    
        // Récupérer les invités associés à la carte
        $invites = $carte->invites; // Récupère tous les invités avec toutes leurs informations
    
        return response()->json($invites, 200); // Retourne les données complètes des invités
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
public function accepterInvitation($id)
{
    // Trouver l'invité par son ID
    $invite = Invite::find($id);

    if (!$invite) {
        return response()->json(['message' => 'Invitation non trouvée'], 404);
    }

    // Mettre à jour le statut de l'invité en "accepté"
    $invite->statut = 1; // Passer à true pour accepté
    $invite->save();

    return response()->json([
        'status' => true,
        'message' => 'Invitation accepté avec succes',
    ], 200);
}

public function refuserInvitation($id)
{
    // Trouver l'invité par son ID
    $invite = Invite::find($id);

    if (!$invite) {
        return response()->json(['message' => 'Invitation non trouvée'], 404);
    }

    // Mettre à jour le statut de l'invité en "refusé"
    $invite->statut = 0; // Passer à false pour refusé
    $invite->save();

    // Rediriger vers une page de confirmation ou une autre page
    return response()->json([
        'status' => true,
        'message' => 'Invitation refusée avec succes',
    ], 200);}


}
