<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\CarModel;

class CarModelTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(CarModel $carmodel)
    {
        return [
            'id' => $carmodel->id,
            'name' => $carmodel->name,
            'pic' => $carmodel->pic,
            'pic_url' => $carmodel->pic_url,
        ];
    }
}
