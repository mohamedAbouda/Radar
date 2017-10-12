<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Radar;
use App\Models\RadarReport;
use App\Transformers\RadarTransformer;
use League\Geotools\Coordinate\Ellipsoid;
use Toin0u\Geotools\Facade\Geotools;

class RadarController extends Controller
{


    public function SubmitRadar(Request $request)
    {
        $radius = 5;
        $data = $request->all();
        $data['type'] = 'Radar';

        $locations = Location::where('type','Radar')->get();
        foreach ($locations as $location) {
            $coordA   = Geotools::coordinate([$location->latitude,$location->longitude]);
            $coordB   = Geotools::coordinate([$data['latitude'],$data['longitude']]);
            $distance = Geotools::distance()->setFrom($coordA)->setTo($coordB);
            if($distance->in('km')->haversine() <= $radius){
                $checkBearing = $this->checkBearing($location->bearing,$data['bearing']);
                if($checkBearing == 'merge'){
                    if($location->latitude == $data['latitude'] && $location->longitude == $data['longitude']){

                        $data['location_id'] = $location->id;
                        $data['radius'] = 5;

                        $data['radar_id'] = Radar::where('location_id',$location->id)->pluck('id')->first();

                        if (isset($data['note']) && $data['note']) {
                            $createRadarReport = RadarReport::create($data);
                        }
                        return response()->json([
                            'message'=>'you have submit your Radar Report.',
                        ],200 );
                    }
                    $newLatLng = $this->merge($location->latitude,$location->longitude,$data['latitude'],$data['longitude']);
                    $locationCount = Location::where('id',$location->id)->pluck('merge_count')->first();
                    $updateLocation = Location::where('id',$location->id)->update([
                        'latitude'=>$newLatLng['lat'],
                        'longitude'=>$newLatLng['lng'],
                        'merge_count'=>$locationCount+1,
                    ]);
                    $data['radar_id'] = Radar::where('location_id',$location->id)->pluck('id')->first();
                    if (isset($data['note']) && $data['note']) {
                        $radarReport = RadarReport::create($data);
                    }
                    return response()->json([
                        'message'=>'You have upated and merged the latitude and longitude.',
                    ],200 );
                }
            }
        }

        $createLocation = Location::create($data);
        $data['location_id'] = $createLocation->id;
        $data['radius'] = 5;
        $createRadar = Radar::create($data);

        $data['radar_id'] = $createRadar->id;
        if (isset($data['note']) && $data['note']) {
            $createRadarReport = RadarReport::create($data);
        }

        return response()->json([
            'message'=>'You have submited the radar.',
        ],200 );
    }




    public function nearbyRadars(Request $request)
    {
        $radius = 20;
        $data = $request->all();
        $location = new Location;
        $addresses = $location->getByDistance($data['latitude'],$data['longitude'],$radius);

        $addressId=array();
        foreach ($addresses as $address) {
            $addressId[] = $address->id;
        }
        $radars = Radar::whereHas('location',function ($query) use($addressId) {
            $query->whereIn('id',$addressId);
        })->get();


        return response()->json([
            'data'=>fractal()
            ->collection($radars)
            ->transformWith(new RadarTransformer)
            ->serializeWith(new \Spatie\Fractal\ArraySerializer())
            ->toArray(),
        ],200);
    }

    public function getRadar(Request $request)
    {
        $id = $request->input('radar_id');

        $radar = Radar::where('id',$id)->first();

        if($radar){
            return response()->json([
                'data'=>fractal()
                ->item($radar)
                ->transformWith(new RadarTransformer)
                ->serializeWith(new \Spatie\Fractal\ArraySerializer())
                ->toArray(),
            ],200);
        }else{
            return response()->json([
                'message'=>'No Radar with this id.',
            ],400 );
        }
    }
}
