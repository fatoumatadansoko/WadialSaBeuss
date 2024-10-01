<?php
namespace Database\Seeders;
// database/seeders/PrestatairesTableSeeder.php
use App\Models\Prestataire;
use Illuminate\Database\Seeder;

class PrestataireTableSeeder extends Seeder
{
    public function run()
    {
        Prestataire::create([
            'user_id' => '6',            
            'categorie_prestataire_id' => '1',
            'logo' => 'logo_decoration_diop.jpg',
            'ninea' => '456321ueueu',
        ]);

        Prestataire::create([
            'user_id' => '7',            
            'categorie_prestataire_id' => '2',
            'logo' => 'logo_resto_diop.jpg',
            'ninea' => '789456ttttt',
           
        ]);
    }
}
