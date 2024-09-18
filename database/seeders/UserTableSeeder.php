<?php
namespace Database\Seeders;

// database/seeders/UsersTableSeeder.php
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        // Générer 10 utilisateurs aléatoires
        User::factory()->count(10)->create();
    }
}
