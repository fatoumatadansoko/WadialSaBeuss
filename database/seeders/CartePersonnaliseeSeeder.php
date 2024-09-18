<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CartePersonnalisee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CartePersonnaliseeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        CartePersonnalisee::create([
            'carte_invitation_id' => 1,
            'client_id' => 1
        ]);

        CartePersonnalisee::create([
            'carte_invitation_id' => 2,
            'client_id' => 1
        ]);
}
}
