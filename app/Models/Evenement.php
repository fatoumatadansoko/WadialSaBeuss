<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;
    protected $fillable = ['titre','description', 'event_date', 'lieu', 'type', 'budget', 'user_id', // Assurez-vous d'ajouter cette colonne
];

}
