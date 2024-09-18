<?php

namespace App\Models;

use App\Models\Prestataire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriePrestataire extends Model
{
    use HasFactory;
    protected $fillable = ['titre', 'description'];

    public function prestataires()
    {
        return $this->hasMany(Prestataire::class);
    }
}
