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
}
