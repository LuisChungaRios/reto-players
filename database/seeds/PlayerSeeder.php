<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players')->insert([
           'name' => 'Pedro Gallese',
           'position' => 'Arquero',
           'goals' => 0
        ]);

         DB::table('players')->insert([
           'name' => 'Carlos Cáceda',
           'position' => 'Arquero',
           'goals' => 0
        ]);

         DB::table('players')->insert([
           'name' => 'Patricio Álvarez',
           'position' => 'Arquero',
           'goals' => 0
        ]);

         DB::table('players')->insert([
           'name' => ' Luis Abram',
           'position' => 'Defensa central',
           'goals' => 1
        ]);

         DB::table('players')->insert([
           'name' => 'Paolo Guerrero',
           'position' => 'Delantero Centro',
           'goals' => 39
        ]);

         DB::table('players')->insert([
           'name' => 'Edison Flores',
           'position' => 'Extremo Izquierdo',
           'goals' => 13
        ]);

         DB::table('players')->insert([
           'name' => 'Yoshimar Yotún',
           'position' => 'Mediocentro',
           'goals' => 3
        ]);

    }
}
