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
        $game = Game::where('name', 'pendu', '=')->first();
        $robots = Robot::where('name', 'pendu-')

        Connection::create([
            'ip' => '127.0.0.1',
            'port' => '12345'
        ]);
    }
}
