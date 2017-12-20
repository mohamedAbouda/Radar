<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CarModel;
use App\Transformers\CarModelTransformer;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = CarModel::get();
        return response()->json([
            'status' => 'true',
            'data'=>fractal()
            ->collection($models)
            ->transformWith(new CarModelTransformer)
            ->serializeWith(new \Spatie\Fractal\ArraySerializer())
            ->toArray(),
        ],200);
    }
}
