<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lagna;
use App\Models\LagnaReport;
use App\Models\Location;
use App\Transformers\LagnaTransformer;
use League\Geotools\Coordinate\Ellipsoid;
use Toin0u\Geotools\Facade\Geotools;

class LagnaController extends Controller
{
    public function SubmitLagna(Request $request)
    {
    	$radius = 5;
        $data = $request->all();
         $data['type'] = 'Lagna';

        $locations = Location::where('type','Lagna')->get();
        foreach ($locations as $location) {
            $coordA   = Geotools::coordinate([$location->latitude,$location->longitude]);
            $coordB   = Geotools::coordinate([$data['latitude'],$data['longitude']]);
            $distance = Geotools::distance()->setFrom($coordA)->setTo($coordB);
            if($distance->in('km')->haversine() <= $radius){
                $checkBearing = $this->checkBearing($location->bearing,$data['bearing']);
                if($checkBearing == 'merge'){
                $newLatLng = $this->merge($location->latitude,$location->longitude,$data['latitude'],$data['longitude']);
                $updateLocation = Location::where('id',$location->id)->update([
                    'latitude'=>$newLatLng['lat'],
                    'longitude'=>$newLatLng['lng'],
                    ]);
                $data['lagna_id'] = Lagna::where('location_id',$location->id)->pluck('id')->first();
                $LagnaReport = LagnaReport::create($data);

                return response()->json([
                    'message'=>'You have upated and merged the latitude and longitude.',
                    ],200 );
                }
               

            }
        }
        $createLocation = Location::create($data);

        $data['location_id'] = $createLocation->id;
        $data['radius'] = 5;
        $createLagna = Lagna::create($data);

        $data['lagna_id'] = $createLagna->id;
        $createLagnaReport = LagnaReport::create($data);





        return response()->json([
            'message'=>'You have submited the Lagna.',
            ],200 );
    }

    public function nearbyLagnas(Request $request)
    {
        $radius = 20;
        $data = $request->all();
        $location = new Location;
        $addresses = $location->getByDistance($data['latitude'],$data['longitude'],$radius);

        $addressId=array();
        foreach ($addresses as $address) {
            $addressId[] = $address->id;
        }
        $lagnas = Lagna::whereHas('location',function ($query) use($addressId) {
            $query->whereIn('id',$addressId);
        })->get();

        return response()->json([
            'data'=>fractal()
            ->collection($lagnas)
            ->transformWith(new LagnaTransformer)
            ->serializeWith(new \Spatie\Fractal\ArraySerializer())
            ->toArray(),
            ],200);
    }
}
