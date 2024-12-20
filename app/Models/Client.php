<?php

namespace App\Models;

use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory, HasRoles;
    protected $fillable = ['user_id','password','email','adresse','telephone','nom','role','statut'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
