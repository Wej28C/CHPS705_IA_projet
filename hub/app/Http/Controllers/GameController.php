<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\GameExport;
use App\Models\Game;

use Maatwebsite\Excel\Facades\Excel;

class GameController extends Controller
{
    public function export(Request $request) 
    {
        $id = $request->input('id');

        $game = Game::findOrFail($id);

        return Excel::download(new GameExport($game), $game->name.'.xlsx');
    }
}
