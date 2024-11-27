<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectionInstance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'connection_id',
        'instance_id'
    ];

    public function connection()
    {
        return $this->belongsTo(Connection::class);
    }

    public function instance()
    {
        return $this->belongsTo(Instance::class);
    }
}
