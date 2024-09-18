<?php

namespace Database\Seeders;

use App\Models\Evenement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EvenementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Evenement::create([
            'titre' => 'Mariage traditionnel',
            'description' => 'Un mariage traditionnel avec plus de 500 invités à Dakar',
            'event_date' => '2024-09-30',
            'lieu' => 'Dakar',
            'type' => 'mariage',
            'budget' => 'plus de 1000000'
        ]);

        Evenement::create([
            'titre' => 'Baptême à Thiès',
            'description' => 'Cérémonie de baptême dans la ville de Thiès',
            'event_date' => '2024-10-15',
            'lieu' => 'Thiès',
            'type' => 'anniversaire',
            'budget' => 'moins de 500000'
        ]); 
 
       }
}
