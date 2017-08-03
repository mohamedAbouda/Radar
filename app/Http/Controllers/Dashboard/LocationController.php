<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Radar;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $radars_locations_ids = Radar::groupBy('location_id')
        // ->pluck('location_id')->toArray();
        // $lagnas_locations_ids = Radar::pluck('location_id')->toArray();
        // $data['resources'] = Location::whereNotIn('id',$radars_locations_ids)
        // ->paginate(20);
        $data['resources'] = Location::paginate(20);
        $index = request()->get('page',1);
        $data['counter_offset'] = $index * 20 - 20;
        return view('dashboard.locations.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Location $location)
    {
        $data['resource'] = $location;
        return view('dashboard.locations.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $location->update($request->all());
        return redirect()->route('dashboard.locations.index')->with(['success' => 'Radar updated successfulley']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->back()->with(['success' => 'Deleted successfully']);
    }
}
