<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

use Livewire\Component;

use App\Models\Game;
use App\Models\Connection

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
        /*$host = $game->hosts()->inRandomOrder()->first();

        $data = [
            'gameName' => $validated['gameName'],
            'ip' => $host->ip,
            'port' => $host->port,
            'idHost' => $host->id
        ];*/
        // Gestion du matchmaking
        $matchResult = $this->findOpponent($game);
        if ($matchResult['type'] === 'IA vs IA') {
            // Simule une partie IA vs IA
            $this->simulateIAVsIA($matchResult['ia1'], $matchResult['ia2']);
        } else {
            // Démarre la partie Humain vs Humain ou Humain vs IA
            $data = [
                'gameName' => $validated['gameName'],
                'ip' => $matchResult['host']->ip,
                'port' => $matchResult['host']->port,
                'idHost' => $matchResult['host']->id,
                'opponentType' => $matchResult['type']
            ];
            $this->startWebSocketConnection($data);
        }
        
        Session::put($data);

        //$this->dispatch('matchmaking-start', $data);
        return redirect()->route('game');
    }
    private function findOpponent($game)
    {
        // Vérifie s'il y a un joueur humain disponible
        $humanOpponent = Connection::where('status', 'waiting')
            ->where('game_id', $game->id)
            ->inRandomOrder()
            ->first();

        if ($humanOpponent) {
            // Match Humain vs Humain
            $humanOpponent->update(['status' => 'matched']);
            return [
                'type' => 'Humain vs Humain',
                'host' => $humanOpponent
            ];
        }

        // Sinon, sélectionne une IA
        $ia = $this->getAI();

        if ($ia) {
            return [
                'type' => 'IA vs Humain',
                'host' => $ia
            ];
        }

        // Si aucun humain ou IA n'est disponible, simule une partie IA vs IA
        $ia1 = $this->getAI();
        $ia2 = $this->getAI();

        if ($ia1 && $ia2) {
            return [
                'type' => 'IA vs IA',
                'ia1' => $ia1,
                'ia2' => $ia2
            ];
        }

        throw new \Exception("Aucun adversaire disponible pour le matchmaking.");
    }
    private function simulateIAVsIA($ia1, $ia2)
    {
        // Simulation de la partie entre deux IA
        $gameResult = $this->simulateGame($ia1, $ia2);

        // Enregistrement des résultats dans la base de données
        Game::create([
            'player_a_id' => $ia1->id,
            'player_b_id' => $ia2->id,
            'result' => $gameResult['winner'],
            'details' => json_encode($gameResult)
        ]);

        // Logique supplémentaire ou notification si nécessaire
        session()->flash('success', "Partie IA vs IA simulée avec succès !");
    }

    /**
     * Récupère une IA disponible pour jouer.
     */
    private function getAI()
    {
        return Connection::where('type', 'AI')->inRandomOrder()->first();
    }

    /**
     * Simule le résultat d'une partie entre deux IA.
     */
    private function simulateGame($ia1, $ia2)
    {
        // Génère un résultat aléatoire
        $winner = rand(0, 2); // 0 = nul, 1 = IA1 gagne, 2 = IA2 gagne
        return [
            'winner' => $winner === 0 ? 'draw' : ($winner === 1 ? $ia1->id : $ia2->id),
            'scores' => [
                $ia1->id => $winner === 1 ? 1 : 0,
                $ia2->id => $winner === 2 ? 1 : 0,
            ]
        ];
    }
    private function startWebSocketConnection($data)
{
    $connector = new Connector();
    
    // Établissement de la connexion WebSocket
    $connector('ws://localhost:12345')->then(
        function(WebSocket $conn) use ($data) {
            // Envoi des données de matchmaking au serveur WebSocket
            $message = json_encode([
                'type' => 'matchmaking',
                'gameName' => $data['gameName'],
                'ip' => $data['ip'],
                'port' => $data['port'],
                'idHost' => $data['idHost'],
                'opponentType' => $data['opponentType'],
            ]);
            
            $conn->send($message);
            
            // Gérer les messages reçus du serveur WebSocket
            $conn->on('message', function($msg) {
                $response = json_decode($msg);
                // Gestion de la réponse du serveur (par exemple, démarrer la partie)
                if (isset($response->type) && $response->type == 'start') {
                    // Commence la partie en redirigeant vers la vue de jeu
                    return redirect()->route('game');
                }
            });
        },
        function(\Exception $e) {
            echo "Could not connect: {$e->getMessage()}\n";
        }
    );
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
