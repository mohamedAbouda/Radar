<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Radar;

class RadarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = request()->get('page',1);
        $data['resources'] = Radar::paginate(20);
        $data['counter_offset'] = $index*20 - 20;
        return view('dashboard.radars.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.radars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['bearing'] = 0;
        $input['speed'] = 0;
        $location = Location::create($input);
        $radar = Radar::create(['location_id' => $location->id , 'radius' => 5.00]);
        return redirect()->back()->with(['success' => 'Radar created successfulley']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Radar $radar)
    {
        $data['resource'] = $radar;
        return view('dashboard.radars.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Radar $radar)
    {
        $radar->location->update($request->all());
        // dd($location);
        return redirect()->back()->with(['success' => 'Radar updated successfulley']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Radar $radar)
    {
        $location = $radar->location;
        $location->delete();
        return redirect()->back()->with(['success' => 'Deleted successfully']);
    }
}
