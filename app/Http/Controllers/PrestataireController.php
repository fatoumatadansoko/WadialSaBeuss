<?php

namespace App\Http\Controllers;

use App\Mail\DemandePrestationClientMail;
use App\Mail\DemandePrestationPrestataireMail;
use App\Models\Prestataire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DemandePrestation; // Ajoutez cette ligne en haut de votre fichier
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemandeStatusChanged;


class PrestataireController extends Controller
{
    
    public function index()
    {
        $prestataires = Prestataire::all();
        return response()->json($prestataires);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ninea' => 'required',
            'user_id' => 'required',
            'categorie_prestataire_id' => 'required|min:6',
            'logo' => 'required',
        ]);

        $prestataire = prestataire::create([
            'user_id' => $request->user_id,
            'categorie_prestataire_id' => $request->categorie_prestataire_id,
            'ninea' => $request->ninea,
            'logo' => $request->logo,
        ]);

        return response()->json($prestataire, 201);
    }
    // Méthode pour récupérer un prestataire et ses commentaires
    public function show($id)
    {
        // Récupérer le prestataire par ID avec ses commentaires
        $prestataire = Prestataire::with(['commentaires','user'])->find($id);

        if (!$prestataire) {
            return response()->json([
                'status' => false,
                'message' => 'Prestataire non trouvé ici'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Détails du prestataire et ses commentaires',
            'data' => $prestataire
        ]);
    }
    public function getPrestatairesByCategory($id)
    {
        try {
            // Récupérer les prestataires appartenant à la catégorie donnée
            $prestataires = Prestataire::where('categorie_prestataire_id', $id)->with('user')->get();

            if ($prestataires->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Aucun prestataire trouvé pour cette catégorie.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $prestataires,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des prestataires.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function demandePrestation(Request $request)
    {
        try {
            // Récupérer l'utilisateur authentifié (client)
            $client = Auth::user();
    
            if (!$client) {
                return response()->json(['error' => 'Utilisateur non authentifié'], 401);
            }
    
            // Validation des données
            $validatedData = $request->validate([
                'prestataire_id' => 'required|exists:prestataires,id',
            ]);
    
            // Récupérer le prestataire avec l'utilisateur
            $prestataire = Prestataire::with('user')->findOrFail($validatedData['prestataire_id']);
    
            // Vérifier si l'utilisateur associé existe
            if (!$prestataire->user) {
                return response()->json(['error' => 'Aucun utilisateur associé à ce prestataire.'], 404);
            }
    
            // Créer une nouvelle demande dans la table `demandeprestation`
            $demande = DemandePrestation::create([
                'prestataire_id' => $prestataire->id,
                'user_id' => $client->id,
            ]);
    
            // Récupérer les emails
            $clientEmail = $client->email;
            $prestataireEmail = $prestataire->user->email;
    
            // Envoyer un email au prestataire
            Mail::to($prestataireEmail)
                ->send(new DemandePrestationPrestataireMail($prestataire->user, $client, $validatedData));
    
            // Envoyer un email au client
            Mail::to($clientEmail)
                ->send(new DemandePrestationClientMail($prestataire->user, $client, $validatedData));
    
            return response()->json(['message' => 'Demande de prestation envoyée avec succès.'], 200);
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Prestataire non trouvé : ' . $e->getMessage()], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Erreur de validation : ' . $e->validator->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Échec de l\'envoi de la demande : ' . $e->getMessage()], 500);
        }
    }
    
    public function getDemandesForPrestataire()
    {
        try {
            // Récupérer l'utilisateur authentifié (prestataire)
            $user = Auth::user();
    
            if (!$user) {
                return response()->json(['error' => 'Utilisateur non authentifié'], 401);
            }
    
            // Vérifier si l'utilisateur a bien le rôle de prestataire
            if (!$user->hasRole('prestataire')) {
                return response()->json(['error' => 'Utilisateur non autorisé'], 403);
            }
    
            // Récupérer le prestataire associé à cet utilisateur et ses demandes avec les clients (users)
            $prestataire = Prestataire::where('user_id', $user->id)
                ->with(['demandes.client']) // Charge la relation "client" sur chaque demande
                ->first();
    
            if (!$prestataire) {
                return response()->json([
                    'success' => false,
                    'message' => 'Prestataire non trouvé.',
                ], 404);
            }
    
            // Si le prestataire n'a pas de demandes
            if ($prestataire->demandes->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Aucune demande trouvée pour ce prestataire.',
                    'demandes' => []
                ], 404);
            }
    
            return response()->json([
                'success' => true,
                'prestataire' => $prestataire,
                'demandes' => $prestataire->demandes, // Chaque demande aura le client (user) inclus
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des demandes : ' . $e->getMessage()], 500);
        }
    }
       

    public function getPrestatairesByRating()
    {
        try {
            $prestataires = Prestataire::with('user')
                ->withCount(['commentaires as moyenne_note' => function ($query) {
                    $query->select(DB::raw('coalesce(avg(note),0)'));
                }])
                ->orderByDesc('moyenne_note')
                ->get();
    
            // Vérifier si des prestataires ont été trouvés
            if ($prestataires->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Aucun prestataire trouvé.'
                ], 404);
            }
    
            return response()->json([
                'status' => true,
                'data' => $prestataires
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la récupération des prestataires.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
     // Accepter une demande
     public function accepterDemande($demandeId)
{
    try {
        // Charger la demande avec toutes les relations nécessaires
        $demande = DemandePrestation::with(['prestataire.user', 'client'])
            ->findOrFail($demandeId);
            $prestataireNom = $demande->prestataire->user->nom ?? 'Prestataire inconnu';


        // Vérification de l'état actuel de la demande
        if ($demande->etat === 'approuve') {
            return response()->json(['error' => 'La demande est déjà approuvée'], 400);
        }

        // Mise à jour de l'état de la demande
        $demande->etat = 'approuvée';
        $demande->save();

        // Récupération du client directement via la relation
        $client = $demande->client;

        // Vérification du client
        if (!$client || !$client->hasRole('client')) {
            return response()->json(['error' => 'Client non trouvé ou rôle non valide'], 404);
        }

        // Envoi de l'email
        Mail::to($client->email)->send(new DemandeStatusChanged(
            $demande, 
            $prestataireNom,
            $demande->etat
        ));

        return response()->json([
            'success' => true,
            'message' => 'Demande approuvée avec succès',
        ], 200);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Erreur lors de l\'acceptation de la demande : ' . $e->getMessage()], 500);
    }
}

public function refuserDemande($demandeId)
{
    try {
        // Utiliser findOrFail au lieu de find
        $demande = DemandePrestation::with(['prestataire.user', 'client'])
            ->findOrFail($demandeId);

            $prestataireNom = $demande->prestataire->user->nom ?? 'Prestataire inconnu';

        // Vérification de l'état actuel de la demande
        if ($demande->etat === 'rejete') {
            return response()->json(['error' => 'La demande est déjà rejetée'], 400);
        }

        // Mise à jour de l'état de la demande
        $demande->etat = 'rejetée';
        $demande->save();

        // Récupération du client directement via la relation
        $client = $demande->client;

        // Vérification du client
        if (!$client || !$client->hasRole('client')) {
            return response()->json(['error' => 'Client non trouvé ou rôle non valide'], 404);
        }

        // Envoi de l'email
        Mail::to($client->email)->send(new DemandeStatusChanged(
            $demande,
            $prestataireNom, // Assurez-vous que c'est le bon champ pour le nom
            $demande->prestataire->user->name, // Assurez-vous que c'est le bon champ pour le nom
            $demande->etat
        ));

        return response()->json([
            'success' => true,
            'message' => 'Demande rejetée avec succès',
        ], 200);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Erreur lors du rejet de la demande : ' . $e->getMessage()], 500);
    }
}
     
     
}