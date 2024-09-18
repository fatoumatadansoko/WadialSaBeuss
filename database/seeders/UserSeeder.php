<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nom' => 'Admin Test',
            'email' => 'fatishma121@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '777123456',
            'adresse' => '123 Rue Ex',
            'status' => 'active',
            'description' => 'Utilisateur admin pour les tests',
        ]);
    }
}
