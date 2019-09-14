<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Raids;

class RaidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $raids = Raids::all();
        return view('raid.index')->with('raids', $raids);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('raid.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $raid = new Raids;
        $raid->name = $request->input('name');
        $raid->currentRaid = $request->has('currentRaid');
        $raid->save();

        return redirect('/raid')->with('success', 'Raid added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // We shouldn't do anything here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $raid = Raids::find($id);

        return view('raid.edit')->with('raid', $raid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $raid = Raids::find($id);
        $raid->name = $request->input('name');
        $raid->currentRaid = $request->has('currentRaid');
        $raid->save();

        return redirect('raid')->with('success', 'Raid edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $raid = Raids::find($id);
        $raid->delete();
        return redirect('raid')->with('success', 'Raid deleted');
    }
}
