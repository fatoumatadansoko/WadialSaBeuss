<?php

namespace Database\Seeders;

use App\Models\CategoriePrestataire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriePrestataireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        CategoriePrestataire::create([
            'titre' => 'Mariage',
            'description' => 'Catégorie pour les événements de mariage au Sénégal'
        ]);

        CategoriePrestataire::create([
            'titre' => 'Traiteur',
            'description' => 'Catégorie pour les cérémonies de baptême au Sénégal'
        ]);

        CategoriePrestataire::create([
            'titre' => 'Décoration',
            'description' => 'Catégorie pour les fêtes d’anniversaire au Sénégal'
        ]);
    }
}
