<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; 

use App\Models\Game;

class Games extends Component
{
    use WithPagination;

    public $gameId;
    public $instances = [];

    /**
     * Les games possible
     * 
     * @return mixed
     */
    public function getGamesProperty()
    {
        return Game::paginate(10);
    }

    #[On('view_more')]
    public function updateInstances($id)
    {
        $this->gameId = $id;
        $this->instances = Game::findOrFail($this->gameId)->instances()->with('users', 'connections.robots')
            ->get(['instances.id', 'instances.created_at'])
            ->map(function ($instance) {
                return [
                    'id' => $instance->id,
                    'created_at' => $instance->created_at,
                    'users' => $instance->users->map(function ($user) {
                        return [
                            'id' => $user->id,
                            'name' => $user->name,
                        ];
                    }),
                    'robots' => $instance->connections->flatMap(function ($connection) {
                        return $connection->robots->map(function ($robot) {
                            return [
                                'id' => $robot->id,
                                'name' => $robot->name,
                            ];
                        });
                    }),
                ];
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.games');
    }
}
