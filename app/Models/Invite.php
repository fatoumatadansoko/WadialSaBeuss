<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $fillable = ['carte_personnalisee_id', 'user_id', 'email','nom'];

    public function cartePersonnalisee()
    {
        return $this->belongsTo(CartePersonnalisee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

