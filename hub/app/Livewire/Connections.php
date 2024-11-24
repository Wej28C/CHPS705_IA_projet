<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Connection;
use App\Models\Robot;
use App\Models\Game;

use Illuminate\Support\Facades\Validator;

class Connections extends Component
{
    use WithPagination;

    public $createConnectionForm = [
        'ip' => '',
        'port' => '',
        'game_id' => '',
        'robot_id' => ''
    ];

    /**
     * Les ia possible
     * 
     * @return mixed
     */
    public function getRobotsProperty()
    {
        return Robot::all();
    }

    /**
     * Les games possible
     * 
     * @return mixed
     */
    public function getGamesProperty()
    {
        return Game::all();
    }

    /**
     * Les Connection a affiche
     * 
     * @return mixed
     */
    public function getConnectionsProperty()
    {
        return Connection::paginate(10);
    }

    public function createConnection()
    {
        $this->resetErrorBag();

        $validator = Validator::make([
            'ip' => $this->createConnectionForm['ip'],
            'port' => $this->createConnectionForm['port'],
            'game_id' => $this->createConnectionForm['game_id'],
            'robot_id' => $this->createConnectionForm['robot_id']
        ], [
            'ip' => ['required', 'ip'],
            'port' => ['required', 'numeric', 'min:1', 'max:65535'],
            'game_id' => ['required', 'exists:games,id'],
            'robot_id' => ['required', 'exists:robots,id'],
        ])->validate();

        Connection::create([
            'ip' => $validator['ip'],
            'port' => $validator['port'],
            'game_id' => $validator['game_id'],
            'robot_id' => $validator['robot_id']
        ]);

        $this->reset('createConnectionForm');
        $this->dispatch('connection-created');
    }

    public function deleteConnection($connectionId)
    {
        Connection::findOrFail($connectionId)->delete();
    }

    public function render()
    {
        return view('livewire.connections');
    }
}
