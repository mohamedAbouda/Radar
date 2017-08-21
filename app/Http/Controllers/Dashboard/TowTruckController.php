<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TowTruck;

class TowTruckController extends Controller
{
    protected $view = 'dashboard.towtrucks.';

    public function index(Request $request)
    {
        $limit = 20;
        $data['resources'] = TowTruck::paginate($limit);
        $data['current_offset'] = ($request->get('page',1) * $limit) - $limit;
        return view($this->view.'index',$data);
    }

    public function create()
    {
        return view($this->view.'create');
    }

    public function store(Request $request)
    {

    }

    public function edit(Request $request,TowTruck $tow_truck)
    {

    }

    public function update(Request $request,TowTruck $tow_truck)
    {

    }

    public function show(TowTruck $tow_truck)
    {

    }

    public function delete(Request $request,TowTruck $tow_truck)
    {

    }
}
