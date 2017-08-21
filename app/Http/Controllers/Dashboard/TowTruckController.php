<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Request\Dashboard\TowTruckCreateRequest;
use App\Http\Request\Dashboard\TowTruckUpdateRequest;
use App\Models\TowTruck;

class TowTruckController extends Controller
{
    protected $view = 'dashboard.towtrucks.';

    public function index(Request $request)
    {
        $limit = 20;
        $data['resources'] = TowTruck::paginate($limit);
        $data['counter_offset'] = ($request->get('page',1) * $limit) - $limit;
        return view($this->view.'index',$data);
    }

    public function create()
    {
        return view($this->view.'create');
    }

    public function store(TowTruckCreateRequest $request)
    {
        if (TowTruck::create($request->all())) {
            return redirect()->back()->with('success' , 'Added successfully');
        }
        return redirect()->back()->withErrors(['error' => 'Something went wrong ! please try again.']);
    }

    public function edit(TowTruck $towtruck)
    {
        $data['resource'] = $towtruck;
        return view($this->view.'.edit' , $data);
    }

    public function update(TowTruckUpdateRequest $request,TowTruck $towtruck)
    {
        $input = $request->all();
        if ($towtruck->update($input)) {
            return redirect()->route('dashboard.towtrucks.index')->with('success' , 'Updated successfully');
        }
        return redirect()->back()->withErrors(['error' => 'Something went wrong ! please try again.']);
    }

    public function show(TowTruck $towtruck)
    {

    }

    public function destroy(TowTruck $towtruck)
    {
        if ($towtruck->pic && file_exists(public_path($towtruck->upload_distination.$towtruck->pic))) {
            unlink($towtruck->upload_distination.$towtruck->pic);
        }
        $towtruck->delete();
        return redirect()->back()->with('success' , 'Deleted successfully');
    }
}
