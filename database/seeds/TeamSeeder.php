<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $player = factory(\App\Player::class)->create([
            'name' => 'Paolo Guerrero',
            'position' => 'Delantero Centro',
            'goals' => 39
        ]);

        $player2  = factory(\App\Player::class)->create([
            'name' => 'Edison Flores',
            'position' => 'Extremo Izquierdo',
            'goals' => 13
        ]);


        $team = factory(\App\Team::class)->create(['name' => 'universitario']);
        $team->players()->attach($player2);
        $team2 = factory(\App\Team::class)->create(['name' => 'Flamengo']);
        $team2->players()->attach($player);

        $team3 = factory(\App\Team::class)->create(['name' => 'Corinthians']);
        $team3->players()->attach($player);

        $team4 = factory(\App\Team::class)->create(['name' => 'Bayer de Munich']);
        $team4->players()->attach($player);



    }
}
