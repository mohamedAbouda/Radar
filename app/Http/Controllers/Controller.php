<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadImage($image)
    {
        $fileName = time() . '_' . str_random(4) . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('uploads/images/');
        $image->move($destinationPath,$fileName);
        return asset('/uploads/images/' . $fileName);
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
}
