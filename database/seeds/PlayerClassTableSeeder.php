<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('player_classes')->insert([
            'name' => 'Death Knight',
            'color' => '#C41F3B',
        ]);

        DB::table('player_classes')->insert([
            'name' => 'Demon Hunter',
            'color' => '#A330C9'
        ]);

        DB::table('player_classes')->insert([
            'name' => 'Druid',
            'color' => '#FF7D0A'
        ]);

        DB::table('player_classes')->insert([
            'name' => 'Hunter',
            'color' => '#ABD473'
        ]);

        DB::table('player_classes')->insert([
            'name' => 'Mage',
            'color' => '#40C7EB'
        ]);

        DB::table('player_classes')->insert([
            'name' => 'Monk',
            'color' => '#00FF96'
        ]);

        DB::table('player_classes')->insert([
            'name' => 'Paladin',
            'color' => '#F58CBA'
        ]);

        DB::table('player_classes')->insert([
            'name' => 'Priest',
            'color' => '#FFFFFF'
        ]);

        DB::table('player_classes')->insert([
            'name' => 'Rogue',
            'color' => '#FFF569'
        ]);

        DB::table('player_classes')->insert([
            'name' => 'Shaman',
            'color' => '#0070DE'
        ]);

        DB::table('player_classes')->insert([
            'name' => 'Warlock',
            'color' => '#8787ED'
        ]);

        DB::table('player_classes')->insert([
            'name' => 'Warrior',
            'color' => '#C79C6E'
        ]);
    }
}
