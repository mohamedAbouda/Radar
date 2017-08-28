<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Lagna;
use App\Models\LagnaReport;

class LagnaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['resources'] = Lagna::paginate(20);
        $index = request()->get('page',1);
        $data['counter_offset'] = $index * 20 - 20;
        return view('dashboard.lagnas.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.lagnas.create');
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
         if($input['latitude']){
        $input['bearing'] = 0;
        $input['speed'] = 0;
        $input['type'] = 'lagna';
        $location = Location::create($input);
        $lagna = Lagna::create(['location_id' => $location->id , 'radius' => 5.00]);
        return redirect()->back()->with(['success' => 'Lagna created successfulley']);
        }else{
            return redirect()->back()->with(['error' => 'Please select Location.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lagna $lagna)
    {
        $index = request()->get('page',1);
        $data['resource'] = $lagna;
        $data['reports'] = $lagna->reports()->paginate(30);
        $data['counter_offset'] = $index * 30 - 30;
        return view('dashboard.lagnas.show',$data);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lagna $lagna)
    {
        $data['resource'] = $lagna;
        return view('dashboard.lagnas.edit',$data);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lagna $lagna)
    {
        $lagna->location->update($request->all());
        // dd($location);
        return redirect()->back()->with(['success' => 'Lagna updated successfulley']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lagna $lagna)
    {
        $location = $lagna->location;
        $location->delete();
        return redirect()->back()->with(['success' => 'Deleted successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editReport(LagnaReport $report)
    {
        $data['resource'] = $report;
        return view('dashboard.lagnas.reports.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateReport(Request $request, LagnaReport $report)
    {
        $report->update($request->all());
        return redirect()->back()->with(['success' => 'Report updated successfulley']);
    }

    public function destroyReport(LagnaReport $report)
    {
        $report->delete();
        return redirect()->back()->with(['success' => 'Deleted successfully']);
    }
}
