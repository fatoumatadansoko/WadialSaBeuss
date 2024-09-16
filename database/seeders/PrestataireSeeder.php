<?php

namespace Database\Seeders;

use App\Models\Prestataire;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PrestatairesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prestataire::create([
            'user_id'=>'1',
            'categorie_prestataire_id'=>'1',
            'logo' => 'prestataire1.png',
            'ninea' => '123456789',
            'disponibilite' => true,
        ]);

        Prestataire::create([
            'user_id'=>'1',
            'categorie_prestataire_id'=>'1',
            'logo' => 'prestataire2.png',
            'ninea' => '987654321',
            'disponibilite' => false,
        ]);    }
}
