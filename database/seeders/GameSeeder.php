<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Studio;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = [
            [
                'studio' => 'Santa Monica Studio',
                'name' => 'God of War',
                'cover_image' => 'games/god-of-war.jpg',
                'release_date' => '2018-04-20',
                'genre' => 'Ação/Aventura',
                'pegi' => '18',
                'platform' => 'PS4',
            ],
            [
                'studio' => 'Santa Monica Studio',
                'name' => 'God of War Ragnarök',
                'cover_image' => 'games/god-of-war-ragnarok.jpg',
                'release_date' => '2022-11-09',
                'genre' => 'Ação/Aventura',
                'pegi' => '18',
                'platform' => 'PS4',
            ],
            [
                'studio' => 'Insomniac Games',
                'name' => 'Marvel\'s Spider-Man 2',
                'cover_image' => 'games/spider-man-2.jpg',
                'release_date' => '2023-10-20',
                'genre' => 'Ação/Aventura',
                'pegi' => '16',
                'platform' => 'PS5',
            ],
            [
                'studio' => 'Insomniac Games',
                'name' => 'Ratchet & Clank: Rift Apart',
                'cover_image' => 'games/ratchet-and-clank-rift-apart.jpg',
                'release_date' => '2021-06-11',
                'genre' => 'Plataformas',
                'pegi' => '7',
                'platform' => 'PS5',
            ],
            [
                'studio' => 'Guerrilla Games',
                'name' => 'Horizon Forbidden West',
                'cover_image' => 'games/horizon-forbidden-west.jpg',
                'release_date' => '2022-02-18',
                'genre' => 'RPG de Ação',
                'pegi' => '16',
                'platform' => 'PS4',
            ],
            [
                'studio' => 'Sucker Punch Productions',
                'name' => 'Ghost of Tsushima',
                'cover_image' => 'games/ghost-of-tsushima.jpg',
                'release_date' => '2020-07-17',
                'genre' => 'Ação/Aventura',
                'pegi' => '18',
                'platform' => 'PS4',
            ],
            [
                'studio' => 'CD Projekt Red',
                'name' => 'The Witcher 3: Wild Hunt',
                'cover_image' => 'games/the-witcher-3.jpg',
                'release_date' => '2015-05-19',
                'genre' => 'RPG',
                'pegi' => '18',
                'platform' => 'PS4',
            ],
            [
                'studio' => 'Capcom',
                'name' => 'Resident Evil 4',
                'cover_image' => 'games/resident-evil-4.jpg',
                'release_date' => '2023-03-24',
                'genre' => 'Survival Horror',
                'pegi' => '18',
                'platform' => 'PS5',
            ],
        ];

        foreach ($games as $gameData) {
            $studio = Studio::where('name', $gameData['studio'])->first();

            if (! $studio) {
                continue;
            }

            Game::updateOrCreate(
                [
                    'studio_id' => $studio->id,
                    'name' => $gameData['name'],
                ],
                [
                    'cover_image' => $gameData['cover_image'],
                    'release_date' => $gameData['release_date'],
                    'genre' => $gameData['genre'],
                    'pegi' => $gameData['pegi'],
                    'platform' => $gameData['platform'],
                ]
            );
        }
    }
}