<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MatchmakingStart
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $ipConnexion;
    public $portConnexion;

    /**
     * Create a new event instance.
     */
    public function __construct($user, $ipConnexion, $portConnexion)
    {
        $this->user = $user;
        $this->ipConnexion = $ipConnexion;
        $this->portConnexion = $portConnexion;
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'type' => 'start'
            'ip' => $this->ipConnexion,
            'port' => $this->portConnexion
        ];
    }
    
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('matchmaking.'$this->user->id),
        ];
    }
}
