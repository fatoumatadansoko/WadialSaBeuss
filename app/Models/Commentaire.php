<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    protected $fillable = ['contenu','note', 'date_ajout','client_id','prestataire_id'];
    
 // Relation vers le prestataire
 public function prestataire()
 {
     return $this->belongsTo(Prestataire::class, 'prestataire_id');
 }
 
 // Relation vers le client qui a laissé le commentaire
 public function client()
 {
     return $this->belongsTo(User::class, 'client_id');
 }

}

