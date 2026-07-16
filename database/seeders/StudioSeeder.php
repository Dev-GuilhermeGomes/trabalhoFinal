<?php

namespace Database\Seeders;

use App\Models\Studio;
use Illuminate\Database\Seeder;

class StudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studios = [
            ['name' => 'Santa Monica Studio', 'logo' => 'studios/santa-monica-studio.png'],
            ['name' => 'Insomniac Games', 'logo' => 'studios/insomniac-games.png'],
            ['name' => 'Guerrilla Games', 'logo' => 'studios/guerrilla-games.png'],
            ['name' => 'Sucker Punch Productions', 'logo' => 'studios/sucker-punch-productions.png'],
            ['name' => 'CD Projekt Red', 'logo' => 'studios/cd-projekt-red.png'],
            ['name' => 'Capcom', 'logo' => 'studios/capcom.png'],
        ];

        foreach ($studios as $studioData) {
            Studio::updateOrCreate(
                ['name' => $studioData['name']],
                ['logo' => $studioData['logo']]
            );
        }
    }
}