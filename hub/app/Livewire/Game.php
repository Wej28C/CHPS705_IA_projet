<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Models\Instance;

class Game extends Component
{
    public $ip;
    public $port;
    public $gameName;
    public $idHost;
    public $user;

    public function mount($post = null, $ip = null, $port = null, $gameName = null)
    {
        $this->ip = Session::get('ip');
        $this->port = Session::get('port');
        $this->gameName = Session::get('gameName');
        $this->idHost = Session::get('idHost');

        $this->user = Auth::user();

        if (!$this->ip || !$this->port || !$this->gameName || !$this->idHost) 
        {
            return Redirect::to('/matchmaking');
        }
    }

    public function registerGame($satisfaction, $opponent_type, $opponent_id)
    {
        $instance = Instance::create([
            'host_id' => $this->idHost
        ]);

        $instance->users()->attach($this->user->id, [
            'ranking' => 0,
            'satisfaction' => $satisfaction,
        ]);
 
        if($opponent_type === "IA")
        {
            $instance->connections()->attach($opponent_id);
        }
        else if($opponent_type === "PLAYER")
        {
            $instance->users()->attach($opponent_id, [
                'ranking' => 0,
                'satisfaction' => 0,
            ]);
        }

        return Redirect::to('/matchmaking');
    }

    public function render()
    {
        return view('livewire.game');
    }
}
