<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Game extends Component
{
    public $ip;
    public $port;
    public $gameName;

    public function mount($post = null, $ip = null, $port = null, $gameName = null)
    {
        $this->ip = Session::get('ip');
        $this->port = Session::get('port');
        $this->gameName = Session::get('gameName');

        if (!$this->ip || !$this->port || !$this->gameName) 
        {
            return Redirect::to('/matchmaking');
        }
    }


    public function render()
    {
        return view('livewire.game');
    }
}
