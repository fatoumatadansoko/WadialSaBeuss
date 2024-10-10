<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarteInvitation extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','categorie_id','nom', 'image', 'contenu'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
public function categorie()
{
    return $this->belongsTo(Categorie::class,'categorie_id');
}}