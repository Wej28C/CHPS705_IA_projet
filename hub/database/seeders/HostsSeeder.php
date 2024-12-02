<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Host;
use App\Models\Game;

class HostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $game = Game::where('name', 'shifumi', '=')->first();
    
        /*
        Host::create([
            'name' => 'hangman-v1',
            'ip' => '127.0.0.1',
            'port' => '12345',
            'game_id' => $game->id
        ]);*/
    }
}
