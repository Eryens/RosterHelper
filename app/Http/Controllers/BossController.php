<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Raids;
use App\Boss;

class BossController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int raidId
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
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
            'idRaid' => 'required|Numeric',
            'name' => 'required|String|max:25',
            'order' => 'required|Numeric',
        ]);

        // Image stuff
        $imageName = $request['name'].'.'.$request->img->getClientOriginalExtension();
        $imgPath = '/img/' . $imageName;
        $request->img->move(public_path('img'), $imageName);

        return Boss::create([
            'raid_id' => $request['idRaid'],
            'name' => $request['name'],
            'order' => $request['order'],
            'img_path' =>$imgPath,
        ]);
    }

    /**
     * Update 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int raidId
     * @return \Illuminate\Http\Response
     */
    public function updateBoss(Request $request, $id)
    {
        $boss = Boss::findOrFail($id);

         $this->validate($request, [
             'idRaid' => 'required',
             'name' => 'required|String|max:25',
             'order' => 'required|Numeric',
         ]);

         $this->deletePictureOfBoss($boss->img_path);
         
        // Image stuff
        $imageName = $request['name'].'.'.$request->img->getClientOriginalExtension();
        $imgPath = '/img/' . $imageName;
        $request->img->move(public_path('img'), $imageName);

        $boss->img_path = $imgPath;
        $boss->save();
        $boss->update($request->all());

        return ['message' => 'Updated boss' . $id];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bosses = Boss::where('raid_id', $id)->orderBy('order')->get();
        return $bosses;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $boss = Boss::findOrFail($id);

        $this->deletePictureOfBoss($boss->img_path);

        $boss->delete();

        return ['message' => 'boss deleted'];
    }

    private function deletePictureOfBoss($picPath) 
    {
        if (file_exists(public_path().$picPath)) {
            File::delete(public_path().$picPath);
        }
    }
}
