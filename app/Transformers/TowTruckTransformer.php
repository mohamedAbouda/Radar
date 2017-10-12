<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\TowTruck;

class TowTruckTransformer extends TransformerAbstract
{
    /**
    * A Fractal transformer.
    *
    * @return array
    */
    public function transform(TowTruck $towtruck)
    {
        return [
            'id' => $towtruck->id,
            'name' => $towtruck->name,
            'phone' => $towtruck->phone,
            'pic' => $towtruck->pic_url,
        ];
    }
}
