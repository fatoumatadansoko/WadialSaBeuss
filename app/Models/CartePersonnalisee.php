<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartePersonnalisee extends Model
{
    use HasFactory;

    protected $fillable = ['carte_invitation_id', 'client_id','nom','image','contenu'];

    // Relation avec CarteInvitation
    public function user()
{
    return $this->belongsTo(User::class);
}
    public function carteInvitation()
    {
        return $this->belongsTo(CarteInvitation::class);
    }

    // Relation avec Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function invites()
{
    return $this->hasMany(Invite::class, 'carte_personnalisee_id');
}

}
