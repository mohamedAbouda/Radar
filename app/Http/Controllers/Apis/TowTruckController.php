<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\TowTruckAccidentSelect;
use App\Models\TowTruck;
use App\Models\TowTruckAccident;
use App\Models\Accedent;
use App\Transformers\TowTruckTransformer;

class TowTruckController extends Controller
{
    public function index()
    {
        $occupied_trucks = TowTruckAccident::where('state',0)->pluck('tow_truck_id')
        ->toArray();
        $trucks = TowTruck::whereNotIn('id',$occupied_trucks)->get();
        return response()->json(fractal()
        ->collection($trucks)
        ->transformWith(new TowTruckTransformer)
        ->toArray(),200);
    }

    public function selectTowTruck(TowTruckAccidentSelect $request)
    {
        $input = $request->all();
        $tow_truck_accident_exists = TowTruckAccident::where('accident_id',$input['accident_id'])
        ->where('tow_truck_id',$input['tow_truck_id'])->exists();
        if ($tow_truck_accident_exists) {
            return response()->json([
                'state' => 'false',
                'error' => 'You already selected this tow truck.'
            ]);
        }
        $tow_truck_accident = TowTruckAccident::create($input);
        if ($tow_truck_accident) {
            return response()->json([
                'state' => 'true',
                'message' => 'Tow truck selection successful please wait or contact the tow truck for more details.'
            ]);
        }
        return response()->json([
            'state' => 'false',
            'error' => 'Something went wrong please try again.'
        ],500);
    }
}
