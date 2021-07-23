<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players')->insert(['descricao' => 'Jogador 1']);
        DB::table('players')->insert(['descricao' => 'Jogador 2']);
    }
}
