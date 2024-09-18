<?php
namespace Database\Seeders;
// database/seeders/ClientsTableSeeder.php
use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    public function run()
    {
        // Générer 10 clients aléatoires
        Client::factory()->count(10)->create();
    }
}

