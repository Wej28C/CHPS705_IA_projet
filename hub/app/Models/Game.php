<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description'
    ];

    public function hosts()
    {
        return $this->hasMany(Host::class);
    }

    public function connections()
    {
        return $this->hasMany(Connection::class);
    }

    public function robots()
    {
        return $this->connections()->flatMap->robot;
    }
}
