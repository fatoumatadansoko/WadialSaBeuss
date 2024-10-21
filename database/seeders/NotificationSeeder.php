<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notification::create([
            'object' => 'Invitation à un mariage',
            'message' => 'Vous avez été invité au mariage de Fatou et Modou.',
        ]);

        Notification::create([
            'object' => 'Invitation à un baptême',
            'message' => 'Vous êtes invité au baptême de Samba.',
        ]);    }
}
