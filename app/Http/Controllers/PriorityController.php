<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Raids;

class PriorityController extends Controller
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

    public function choice() 
    {
        $raid = Raids::where('currentRaid', true)->first();
        return view('priority.choice')->with('raid', $raid);
    }
}
