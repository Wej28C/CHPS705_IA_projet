<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ip',
        'port',
        'game_id',
        'robot_id'
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function robot()
    {
        return $this->belongsTo(Robot::class);
    }
}
