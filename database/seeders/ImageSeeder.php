<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Image::create([
            'nom' => 'mon image',
            'image_data' => '4565f/ffffffff',
            'prestataire_id' => 1,

        ]);

        Image::create([
            'nom' => 'image2',
            'image_data' => '4565f/aaaaaaaa',
            'prestataire_id' => 1,
            
        ]);

        Image::create([
            'nom' => 'image3',
            'image_data' => '4565f/bbbbbbbb',
            'prestataire_id' => 2,
        ]);
    }
}
