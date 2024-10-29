<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DemandePrestation extends Model
{
    use HasFactory,Notifiable;

    // Indiquer les attributs qui peuvent être remplis en masse
    protected $fillable = [
        'prestataire_id',
        'user_id',
        'message',
        'etat',
    ];

    // Définir la relation avec le modèle Prestatair
    public function prestataire()
    {
        return $this->belongsTo(Prestataire::class, 'prestataire_id');
    }
    
    public function client()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assurez-vous que 'user_id' correspond au modèle User
    }
    
}
