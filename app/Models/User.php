<?php

namespace App\Models;

use GuzzleHttp\Client;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'nom', 'email', 'password', 'description', 'adresse', 'status', 'telephone'
    ];

    /**
     * Relation avec le modèle Prestataire.
     */
    public function prestataire()
    {
        return $this->hasOne(Prestataire::class);
    }

    /**
     * Relation avec le modèle Client.
     */
    
        public function client()//+
        {//+
            return $this->hasOne(Client::class);//+
        }//+

    /**
     * Relation avec le modèle Admin.
     */
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    /**
     * Méthode requise par JWT pour obtenir l'identifiant stocké dans le JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // retourne l'identifiant de l'utilisateur (id par défaut)
    }

    /**
     * Méthode requise par JWT pour ajouter des revendications personnalisées au JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return []; // vous pouvez ajouter des revendications personnalisées ici si nécessaire
    }
}
