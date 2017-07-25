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

        $locations = Location::all();
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
                $data['radar_id'] = Radar::where('location_id',$location->id)->pluck('id')->first();
                $radarReport = RadarReport::create($data);

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
        $createRadarReport = RadarReport::create($data);





        return response()->json([
            'message'=>'You have submited the radar.',
            ],200 );
    }


    public function merge($lat1,$lng1,$lat2,$lng2)
    {

        $geotools = new \League\Geotools\Geotools();
        $coordA   = new \League\Geotools\Coordinate\Coordinate([$lat1, $lng1]);
        $coordB   = new \League\Geotools\Coordinate\Coordinate([$lat2, $lng2]);
        $point    =  $geotools->vertex()->setFrom($coordA)->setTo($coordB);
        $middlePoint = $point->middle();

        return ['lat' =>$middlePoint->getLatitude(),'lng'=>$middlePoint->getLongitude()];
    }
    public function checkBearing($bearing1,$bearing2)
    {
        $message = 'createNew';
        if($bearing1 >= 0 && $bearing1 <= 90){
            if($bearing2 >0 && $bearing2 <=90){
                $message = 'merge';
            }
        }elseif ($bearing1 >= 91 && $bearing1 <= 180) {
            if($bearing2 >91 && $bearing2 <=180){
                $message = 'merge';
            }
        }elseif ($bearing1 >= 181 && $bearing1 <= 270) {
            if($bearing2 >181 && $bearing2 <=270){
                $message = 'merge';
            }
        }elseif ($bearing1 >= 271 && $bearing1 <= 360) {
            if($bearing2 >271 && $bearing2 <=360){
                $message = 'merge';
            }
        }else{
            $message = 'not defiend';
        }

        return $message;
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
