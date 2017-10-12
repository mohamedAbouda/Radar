<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Car;
use Carbon\Carbon;

class OwnerCarTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['drivers'];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Car $car)
    {
        $data = [
			'id'=>$car->id,
			'model'=>$car->model,
			'plate_number'=>$car->plate_number,
            'maintenance_date' => Carbon::parse($car->maintenance_date)->format('d M. Y'),
			'mile_age'=>$car->mile_age,
			'registration_code'=>$car->registration_code,
			'owner_name' => $car->owner?$car->owner->full_name:'',
			'oil_change_date' => $car->oil_change_date,
			'tyre_replacement_date' => $car->tyre_replacement_date,
		];
        if(!$car->drivers){
			$data['drivers'] = new \stdClass(); //empty object
		}
		return $data;
    }

    public function includeDrivers(Car $car)
	{
        if($car->drivers){
            // dd($this->collection($car->drivers,new UserTransformer)->serializeWith(new \Spatie\Fractal\ArraySerializer()));
            return $this->collection($car->drivers,new UserTransformer);
        }
	}
}
