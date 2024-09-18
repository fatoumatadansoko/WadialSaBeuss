<?php

namespace Database\Seeders;

use App\Models\Vote;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vote::create([
            'prestataire_id'=>1,
            'note' => 5,
            'client_id' => 1,
        ]);

        Vote::create([
            'note' => 4,
            'client_id' => 1,
            'prestataire_id'=>1,

        ]);    }
}
