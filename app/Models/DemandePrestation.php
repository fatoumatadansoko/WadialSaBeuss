<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandePrestation extends Model
{
    use HasFactory;

    // Indiquer les attributs qui peuvent être remplis en masse
    protected $fillable = [
        'prestataire_id',
        'user_id',
        'message',
        'etat',
    ];

    // Définir la relation avec le modèle Prestataire
    public function prestataire()
    {
        return $this->belongsTo(Prestataire::class);
    }

    // Définir la relation avec le modèle User (client)
    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
