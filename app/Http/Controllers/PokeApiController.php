<?php

namespace App\Http\Controllers;

use PokePHP\PokeApi;

class PokeApiController extends Controller
{
    private $pokeApi;

    public function __construct()
    {
        $this->pokeApi = new PokeApi;
    }


    public function getPokemonById($id)
    {
        $pokemon = $this->pokeApi->pokemon($id);
        return json_decode($pokemon);
    }

    public function getPokemonByName($name)
    {
        $pokemon = $this->pokeApi->pokemon($name);
        return json_decode($pokemon);
    }

}
