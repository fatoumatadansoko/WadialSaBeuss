<?php

namespace App\Models;

use App\Models\Vote;
use App\Models\Image;
use App\Models\Commentaire;
use App\Models\CategoriePrestataire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prestataire extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'categorie_prestataire_id', 'logo', 'ninea', 'disponibilite'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoriePrestataire()
    {
        return $this->belongsTo(CategoriePrestataire::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}