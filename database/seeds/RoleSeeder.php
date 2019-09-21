<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'guild_master']);
        Permission::create(['name' =>'admin access']);
        Permission::create(['name' => 'manage guild']);

        $adminAcess = Permission::findById(1);
        $manageGuild = Permission::findById(2);

        $adminRole = Role::findById(1);
        $adminRole->givePermissionTo($adminAcess);
        $adminRole->givePermissionTo($manageGuild);

        $guildMasterRole = Role::findById(2);
        $guildMasterRole->givePermissionTo($manageGuild);
    }
}
