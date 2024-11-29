<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithPreCalculateFormulas;

use App\Models\Game;

class GameExport implements FromView, ShouldAutoSize, WithPreCalculateFormulas
{
    public $game;

    public function __construct(Game $game) 
    {
        $this->game = $game;
    }

    public function view(): View
    {
        return view('exports.game', [
            'game' => $this->game
        ]);
    }
}
