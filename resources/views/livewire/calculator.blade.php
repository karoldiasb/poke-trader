<div>
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            @foreach ($arrayPlayers as $player)
                    <div class="card" style="width: 18rem; margin-top: 10px; margin-right: 10px">
                        <div class="card-body">
                            <h5 class="card-title">Pokemons do {{$player['descricao']}}</h5>
                            <h6>Pokemon - Experiência</h6>
                            @foreach ($player['latest_pokemons_player'] as $p)
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox"  
                                        name="inputPlayer{{$player['id']}}"
                                        wire:model.defer="inputPlayer{{$player['id']}}",
                                        value="{{$p['name']}}"
                                    >
                                    <label class="form-check-label">
                                        {{$p['name']}} - {{$p['base_experience']}}
                                    </label>
                                </div>
                                
                            @endforeach
                            

                            {{-- {{$player->latestPokemonsPlayer}} --}}
                            
                            {{-- @foreach ($player->pokemonsplayer as $pokemon)
                                @foreach(json_decode($pokemon->jsonPokemons) as $p)
                                    <div class="form-check">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox"  
                                            name="inputPlayer{{$player->id}}"
                                            wire:model.defer="inputPlayer{{$player->id}}",
                                            value="{{$p}}"
                                        >
                                        <label class="form-check-label">
                                            {{$p}}
                                        </label>
                                    </div>
                                @endforeach
                            @endforeach --}}
                        </div>
                        <div class="card-body">
                            <button 
                                class="btn btn-primary" 
                                type="button" 
                                wire:click="updateArray({{$player['id']}})"
                            >
                                Enviar para Troca
                            </button>
                        </div>
                    </div>
                @endforeach
            
            <div class="col">   
                <div class="card-body">
                    <h5 class="card-title">Pokemons para Troca</h5>
                        <p>Pokemons Jogador 1</p>
                        @foreach ($arrayToChangePlayer1 as $p)
                            <span class="badge bg-success">{{$p}}</span>
                        @endforeach
                        <p>Pokemons Jogador 2</p>
                        @foreach ($arrayToChangePlayer2 as $p)
                            <span class="badge bg-success">{{$p}}</span>
                        @endforeach
                </div>
                <div class="card-body">
                    <button class="btn btn-primary" type="button" wire:click="calculate">Calcular</button>
                </div>
            </div>
        </div>

        @if ($isShowResult)
            <h1 style="text-align: center; margin-top: 10px">Resultado</h1>
            <div class="alert alert-{{$successWarning}}" role="alert">
                <p>{{$msgChange}}</p>
            </div>

            @if ($isChangeFair)
                <div class="row d-flex justify-content-center">
                    <button class="btn btn-success" type="button" wire:click="change">Trocar Pokemons</button>
                </div>
            @endif
        @endif
        
        <h1 style="text-align: center; margin-top: 10px">Histórico</h1>

        <table class="table" style="margin-top: 20px">
            <thead>
              <tr>
                <th scope="col">Player</th>
                <th scope="col">Data da Troca</th>
                <th scope="col">Pokemons</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($arrayHistoryPlayers as $historyPlayer)
                    <tr>
                        <td>{{$historyPlayer['player']}}</td>
                        <td>{{$historyPlayer['date']}}</td>
                        <td>
                            @foreach ($historyPlayer['pokemons'] as $pokemon)
                                <span class="badge bg-secondary text-white">{{$pokemon}}</span>
                            @endforeach                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
    
</div>
