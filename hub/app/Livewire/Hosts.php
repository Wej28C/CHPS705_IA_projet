<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Host;
use App\Models\Game;

use Illuminate\Support\Facades\Validator;

class Hosts extends Component
{
    use WithPagination;

    public $createHostForm = [
        'name' => '',
        'ip' => '',
        'port' => '',
        'game_id' => '',
    ];

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
     * Les hosts possible
     * 
     * @return mixed
     */
    public function getHostsProperty()
    {
        return Host::paginate(10);
    }


    public function createHost()
    {
        $this->resetErrorBag();

        $validator = Validator::make([
            'name' => $this->createHostForm['name'],
            'ip' => $this->createHostForm['ip'],
            'port' => $this->createHostForm['port'],
            'game_id' => $this->createHostForm['game_id']
        ], [
            'name' => ['required', 'unique:hosts,name', 'max:100'],
            'ip' => ['required', 'ip'],
            'port' => ['required', 'numeric', 'min:1', 'max:65535'],
            'game_id' => ['required', 'exists:games,id'],
        ])->validate();

        Host::create($this->createHostForm);

        $this->reset('createHostForm');
        $this->dispatch('host-created');
    }

    public function deleteHost($id)
    {
        $host = Host::findOrFail($id);
        $host->delete();
    }

    public function render()
    {
        return view('livewire.hosts');
    }
}
