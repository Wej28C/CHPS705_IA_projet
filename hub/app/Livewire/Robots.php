<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Robot;

use Illuminate\Support\Facades\Validator;

class Robots extends Component
{
    use WithPagination;

    public $createRobotForm = [
        'name' => ''
    ];

    /**
     * Les ia crees
     * 
     * @return mixed
     */
    public function getRobotsProperty()
    {
        return Robot::paginate(10);
    }

    public function createRobot()
    {
        $validator = Validator::make([
            'name' => $this->createRobotForm['name'],
        ], [
            'name' => ['required', 'unique:robots,name', 'max:255'],
        ])->validate();

        Robot::create($this->createRobotForm);

        $this->reset('createRobotForm');
        $this->dispatch('robot-created');
    }

    public function deleteRobot($id)
    {
        $robot = Robot::findOrFail($id);
        $robot->delete();
    }

    public function render()
    {
        return view('livewire.robots');
    }
}
