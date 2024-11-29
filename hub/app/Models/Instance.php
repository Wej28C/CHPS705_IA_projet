<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'host_id'
    ];

    public function host()
    {
        return $this->belongsTo(Host::class);
    }

    public function game()
    {
        return $this->host->game();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function usersWithPivot()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['ranking', 'satisfaction'])
            ->withTimestamps();
    }

    public function connections()
    {
        return $this->belongsToMany(Connection::class);
    }
}
