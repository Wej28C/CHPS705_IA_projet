<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstanceUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ranking',
        'satisfaction',
        'instance_id',
        'user_id'
    ];

    public function instance()
    {
        return $this->belongsTo(Instance::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
