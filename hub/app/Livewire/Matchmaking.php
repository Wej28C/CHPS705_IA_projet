<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

use Livewire\Component;

use App\Models\Game;
use App\Models\Connection;

class Matchmaking extends Component
{
    public $matchmakingState = [
        "gameName" => "" 
    ];

    public function submitMatchmakingForm()
    {
        $validated = Validator::make( [
                'gameName' => $this->matchmakingState['gameName']
            ], [
                'gameName' => ['required', 'exists:games,name']
            ])->validate();

        $game = Game::where('name', $validated['gameName'])->first();
        $host = $game->hosts()->inRandomOrder()->first();

        $data = [
            'gameName' => $validated['gameName'],
            'ip' => $host->ip,
            'port' => $host->port,
            'idHost' => $host->id
        ];

        Session::put($data);

        //$this->dispatch('matchmaking-start', $data);
        return redirect()->route('game');
    }

    public function getGamesProperty()
    {
        return Game::all();
    }

    public function render()
    {
        return view('livewire.matchmaking');
    }
}
