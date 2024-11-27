<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Connection;
use App\Models\Robot;
use App\Models\Game;

class ConnectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $game = Game::where('name', 'hangman', '=')->first();
        $robot = Robot::where('name', 'hangman-v1', '=')->first();

        Connection::create([
            'ip' => '127.23.2.1',
            'port' => '125',
            'game_id' => $game->id,
            'robot_id' => $robot->id
        ]);
    }
}
