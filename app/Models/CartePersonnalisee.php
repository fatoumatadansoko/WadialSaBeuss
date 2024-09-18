<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartePersonnalisee extends Model
{
    use HasFactory;

    protected $fillable = ['carte_invitation_id', 'client_id'];

    // Relation avec CarteInvitation
    public function carteInvitation()
    {
        return $this->belongsTo(CarteInvitation::class);
    }

    // Relation avec Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
