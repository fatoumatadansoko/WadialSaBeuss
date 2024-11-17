<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invite extends Model
{
    use HasFactory;
    use Notifiable;
    const STATUT_EN_ATTENTE = 'en_attente';
    const STATUT_ACCEPTE = 'accepte';
    const STATUT_REFUSE = 'refuse';
    protected $fillable = ['carte_personnalisee_id', 'user_id', 'email','nom','statut','id', 'invitation_token',];

    public function cartePersonnalisee()
    {
        return $this->belongsTo(CartePersonnalisee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

