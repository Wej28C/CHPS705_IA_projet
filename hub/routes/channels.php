<?php

use Illuminate\Support\Facades\Broadcast;

use App\Models\User;

Broadcast::channel('matchmaking.{userId}', function (User $user) {
    return $user->id === $userId;
});

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
