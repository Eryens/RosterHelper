<?php

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\PlayerClass;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $druid = PlayerClass::where('name', 'Druid')->first();

        DB::table('users')->insert([
            'username' => 'Eryens',
            'password' => bcrypt('admin'),
            'player_class_id' => $druid->id,
        ]);

        $user = User::where('username', 'Eryens')->first();

        if($user) {
            $user->assignRole('admin');
        }
    }
}
