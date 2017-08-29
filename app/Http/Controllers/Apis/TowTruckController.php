<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TowTruck;
use App\Transformers\TowTruckTransformer;

class TowTruckController extends Controller
{
    public function index()
    {
        $trucks = TowTruck::get();
        return response()->json(fractal()
        ->collection($trucks)
        ->transformWith(new TowTruckTransformer)
        ->toArray(),200);
    }
}
