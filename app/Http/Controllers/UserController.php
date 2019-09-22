<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.list');
    }

    /**
     * Returns raid user if true, all if false
     * 
     * @param  bool  $raid
     * @return \Illuminate\Http\Response
     */
    public function list($raid) 
    {
        if ($raid == 1) {
            return User::where('confirmed', true)->get();
        }
        else {
            return User::all();
        }
        
    }

    /**
     * Mark the player as confirmed or not
     * 
     * @param int $id
     * @param bool $confirm
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        $id = $request->input('id');
        $confirm = $request->input('confirm');

        $user = User::findOrFail($id);
        
        $user->confirmed = $confirm;
        $user->save();
    
        return ['message' => 'Player '.$id.' marked as '.$confirm];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|Numeric',
            'player_class_id' => 'required|Numeric',
        ]);

        $user = User::findOrFail($request->input('id'));
        $user->player_class_id = $request->input('player_class_id');
        $user->officer_note = $request->input('officer_note');
        $user->save();

        return ['message' => 'Updated user'];
    }
}
