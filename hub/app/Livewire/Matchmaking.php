<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Game;

class Matchmaking extends Component
{
    public $matchmakingState = [
        "gameName" => "" 
    ];

    public function submitMatchmakingForm()
    {
        $this->dispatch('matchmaking-start');
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
