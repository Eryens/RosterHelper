<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Creates roles for the application
     * 
     * @return void
     */
    private function createRoles()
    {
        //Role::create(['name'=>'admin']);
        //Role::create(['name'=>'user']);
        //Permission::create(['name' =>'admin access']);
        // $user = auth()->user();

        // $user->assignRole('admin');
        // $permission = Permission::findById(1);
        // $role = Role::findById(1);
        // $role->givePermissionTo($permission);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        HomeController::createRoles();
        return view('home');
    }
    

}
