<?php
namespace Database\Seeders;
// database/seeders/PrestatairesTableSeeder.php
use App\Models\Prestataire;
use Illuminate\Database\Seeder;

class PrestataireTableSeeder extends Seeder
{
    public function run()
    {
        // Générer 10 prestataires aléatoires
        Prestataire::factory()->count(10)->create();
    }
}
