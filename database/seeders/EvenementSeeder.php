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
    public function run(): void
    {
        Evenement::create([
            'titre' => 'Mariage de Fatou et Modou',
            'description' => 'Un mariage traditionnel à Dakar.',
            'event_date' => '2024-12-15',
            'type' => 'mariage',
            'lieu' => 'Dakar, Sénégal',
            'budget' => 5000000.00,
        ]);

        Evenement::create([
            'titre' => 'Baptême de Samba',
            'description' => 'Baptême religieux à Saint-Louis.',
            'event_date' => '2024-09-30',
            'type' => 'mariage',
            'lieu' => 'Saint-Louis, Sénégal',
            'budget' => 2000000.00,
        ]);    }
}
