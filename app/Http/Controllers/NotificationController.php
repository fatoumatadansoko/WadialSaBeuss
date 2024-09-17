<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;
use App\Models\Vote;
use App\Notifications\CommentNotification;
use App\Notifications\VoteNotification;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    // Après la création d'un commentaire
    public function storeCommentaire(Request $request)
    {
        // Validation des données
        $request->validate([
            'content' => 'required|string',
            'prestataire_id' => 'required|exists:prestataires,id',
        ]);

        // Création du commentaire
        $comment = Commentaire::create([
            'content' => $request->content,
            'prestataire_id' => $request->provider_id,
        ]);

        // Envoyer la notification au prestataire
        $provider = $comment->provider;
        Notification::send($provider, new CommentNotification($comment));

        return response()->json([
            'status' => true,
            'message' => 'Commentaire ajouté avec succès',
            'data' => $comment
        ], 201);
    }

    // Après la création d'un vote
    public function storeVote(Request $request)
    {
        // Validation des données
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'prestataire_id' => 'required|exists:prestataires,id',
        ]);

        // Création du vote
        $vote = Vote::create([
            'rating' => $request->rating,
            'prestataire_id' => $request->provider_id,
        ]);

        // Envoyer la notification au prestataire
        $provider = $vote->provider;
        Notification::send($provider, new VoteNotification($vote));

        return response()->json([
            'status' => true,
            'message' => 'Vote ajouté avec succès',
            'data' => $vote
        ], 201);
    }
}
