<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    function pokemonsplayer()
    {
        return $this->hasMany(PokemonsPlayer::class);
    }

    function latestPokemonsPlayer()
    {
        return $this->hasOne(PokemonsPlayer::class)->latest();
    }
}
