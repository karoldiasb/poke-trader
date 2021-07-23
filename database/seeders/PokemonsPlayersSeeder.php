<?php

namespace Database\Seeders;

use App\Http\Controllers\PokeApiController;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PokemonsPlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pokeApi = new PokeApiController;

        $arrayPokemons = [];
        $i = 6;
        while($i > 0){
            $pokemon = $pokeApi->getPokemonById($i);
            $arrayPokemons[] = $pokemon->name;
            $i--;
        }
        $json = json_encode($arrayPokemons);
        DB::table('pokemons_players')->insert(['player_id' => 1, 'jsonPokemons' => $json]);

        $arrayPokemons = [];
        $i = 12;
        while($i > 6){
            $pokemon = $pokeApi->getPokemonById($i);
            $arrayPokemons[] = $pokemon->name;
            $i--;
        }
        $json = json_encode($arrayPokemons);
        DB::table('pokemons_players')->insert(['player_id' => 2, 'jsonPokemons' => $json]);
    }
}
