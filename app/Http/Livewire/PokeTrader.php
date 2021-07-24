<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Player;
use App\Http\Controllers\PokeApiController;
use App\Models\PokemonsPlayer;

class PokeTrader extends Component
{
    public $arrayPlayers;
    public $inputPlayer1;
    public $inputPlayer2;
    public $arrayToChangePlayer1;
    public $arrayToChangePlayer2;
    public $isShowResult;
    public $successWarning;
    public $msgChange;
    public $newArrayPlayer1;
    public $newArrayPlayer2;
    public $isChangeFair;
    public $arrayHistoryPlayers;
    public $isLoading;

    public function render()
    {
        return view('livewire.poke-trader');
    }

    public function mount()
    {
        $this->arrayPlayers = [];
        $this->inputPlayer1 = [];
        $this->inputPlayer2 = [];
        $this->arrayToChangePlayer1 = [];
        $this->arrayToChangePlayer2 = [];
        $this->isShowResult = false;
        $this->successWarning = "";
        $this->msgChange = "";
        $this->newArrayPlayer1 = [];
        $this->newArrayPlayer2 = [];
        $this->isChangeFair = false;
        $this->arrayHistoryPlayers = [];
        $this->isLoading = false;

        $players = Player::with(['latestPokemonsPlayer'])->get();
        $arrayPlayers = json_decode($players);
        $this->arrayPlayers = $this->getPokemonsWithBaseExperience($arrayPlayers);

        $historyPlayers = PokemonsPlayer::with(['player'])->orderBy('id','DESC')->get();
        $arrayHistoryPlayers = json_decode($historyPlayers);
        foreach($arrayHistoryPlayers as $historyPlayers){
            $this->arrayHistoryPlayers[] = [
                'player' => $historyPlayers->player->descricao,
                'pokemons' => json_decode($historyPlayers->jsonPokemons),
                'date' => $historyPlayers->created_at
            ];
        }
    }

    private function getPokemonsWithBaseExperience($players)
    {
        $pokeApi = new PokeApiController;

        $arrayPlayers = [];
        foreach($players as $player){
            $arrayPokemons = [];

            $lastPokemons = json_decode($player->latest_pokemons_player->jsonPokemons);
            foreach($lastPokemons as $pokemon){
                $pokemonAPI = $pokeApi->getPokemonByName($pokemon);
                $arrayPokemons[] = ['name' => $pokemon, 'base_experience' => $pokemonAPI->base_experience];
            }
            $arrayPlayers[] = [
                'id' => $player->id, 
                'descricao' => $player->descricao,
                'latest_pokemons_player' => $arrayPokemons
            ];
        }
        return $arrayPlayers;
    }

    public function updateArray($player)
    {
        if($player == 1){
            $this->arrayToChangePlayer1 = $this->inputPlayer1;
            return;
        }
        $this->arrayToChangePlayer2 = $this->inputPlayer2;
    }

    public function calculate()
    {
        $pokeApi = new PokeApiController;

        $totalBaseExperiencePlayer1 = 0;        
        foreach($this->arrayToChangePlayer1 as $p1){
            $pokemon = $pokeApi->getPokemonByName($p1);
            $totalBaseExperiencePlayer1 += $pokemon->base_experience;
        }
        
        $totalBaseExperiencePlayer2 = 0;
        foreach($this->arrayToChangePlayer2 as $p2){
            $pokemon = $pokeApi->getPokemonByName($p2);
            $totalBaseExperiencePlayer2 += $pokemon->base_experience;
        }

        if(abs($totalBaseExperiencePlayer1 - $totalBaseExperiencePlayer2) > 20){
            $this->isChangeFair = false;
            $this->successWarning = "warning";
            $this->msgChange = "Ops! Troca injusta. A diferença entre Jogador 1 ($totalBaseExperiencePlayer1) 
            e Jogador 2 ($totalBaseExperiencePlayer2) é maior que 20.";
            return;
        }
        $this->isChangeFair = true;
        $this->successWarning = "success";
        $this->msgChange = "Yes! Troca justa. A diferença entre Jogador 1 ($totalBaseExperiencePlayer1) 
            e Jogador 2 ($totalBaseExperiencePlayer2) é menor que 20.";
    }

    public function change()
    {
        $arrayPlayer1 = []; $arrayPlayer2 = [];
        foreach($this->arrayPlayers as $player){
            foreach($player['latest_pokemons_player'] as $pokemonplayer){
                if($player['id'] == 1){
                    $arrayPlayer1[] = $pokemonplayer['name'];
                }
                if($player['id'] == 2){
                    $arrayPlayer2[] = $pokemonplayer['name'];
                }
            }
        }
        $this->newArrayPlayer1 = array_diff($arrayPlayer1, $this->arrayToChangePlayer1);
        $this->newArrayPlayer2 = array_diff($arrayPlayer2, $this->arrayToChangePlayer2);

        $player1 = array_merge($this->newArrayPlayer1, $this->arrayToChangePlayer2);
        $this->insertPokemonsPlayer(1, json_encode($player1));
        
        $player2 = array_merge($this->newArrayPlayer2, $this->arrayToChangePlayer1);
        $this->insertPokemonsPlayer(2, json_encode($player2));

        $this->mount();
    }

    public function insertPokemonsPlayer($id, $json)
    {
        $pokemonplayer = new PokemonsPlayer();
        $pokemonplayer->player_id = $id;
        $pokemonplayer->jsonPokemons = $json;

        $pokemonplayer->save();
    }
}
